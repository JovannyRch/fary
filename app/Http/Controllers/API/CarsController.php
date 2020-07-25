<?php

namespace App\Http\Controllers\API;

use App\Car;
use App\ImgsCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CarsController extends Controller
{
   
    public function index($lat = null, $long = null){
        if(Auth::check()){
            return $this->withLogin($lat, $long);
        }else{
            return $this->withOutLogin($lat,$long);
        }
    }

    public function withLogin($lat, $long){
        $user_id = Auth::user()->id;
        $otros = [];
        $cars = [];
        $myPosts = $this->myPosts($user_id);
        if($lat == null && $long == null){
            $cars = $this->myNoPosts($user_id); 
        }else {
            $location = $this->queryLocation($lat,$long);
            
            $query = Car::
            join('users', 'users.id', '=', 'cars.user_id')
            ->select('cars.rango','cars.content','cars.user_id','cars.created_at','cars.id', 'users.name as username','users.address',DB::raw($location))
            ->where("cars.user_id","!=",$user_id)
            ->toSql();
            
            $cars = DB::select("select * from ($query) as tabla1 where distance <= rango or rango = 10000 order by created_at desc, distance asc");
            //posts sin ubicacion
            $otros = Car::
            join('users', 'users.id', '=', 'cars.user_id')
            ->select('cars.rango','cars.content','cars.user_id','cars.created_at','cars.id', 'users.name as username','users.address',DB::raw($location))
            ->where("cars.user_id","!=",$user_id)
            ->whereNull('latitud')
            ->whereNull('longitud')
            ->toSql();
            $otros = DB::select($otros);
            $cars = $this->converJson($cars);
            $otros = $this->converJson($otros);

            
           
            foreach ($cars as &$car) {
                $car['imgs'] = $this->getImgsById($car['id']);
            }

            foreach ($otros as &$car) {
                $car['imgs'] = $this->getImgsById($car['id']);
            }
        }  
        return response()->json(['data' => $cars, 'otros' =>  $otros,'myposts' => $myPosts], 200);
    }

    public function myPosts($user_id){
        $cars = Car::
            join('users', 'users.id', '=', 'cars.user_id')
            ->select('cars.content','cars.user_id','cars.created_at','cars.id', 'users.name as username','users.address')
            ->where("cars.user_id","=",$user_id)
            ->orderBy('created_at','desc')->get();
        foreach ($cars as &$car) {
            $car['imgs'] = $this->getImgs($car);
        }
        return $cars;
    }


    public function myNoPosts($user_id){
        $cars = Car::
            join('users', 'users.id', '=', 'cars.user_id')
            ->select('cars.content','cars.user_id','cars.created_at','cars.id', 'users.name as username','users.address')
            ->where("cars.user_id","!=",$user_id)
            ->orderBy('created_at','desc')->take(100)->get();
        foreach ($cars as &$car) {
                $car['imgs'] = $this->getImgs($car);
        }
        return $cars;
    }


    public function withOutLogin($lat, $long){
        $otros = [];
        if($lat == null && $long == null){
            $cars = Car::
            join('users', 'users.id', '=', 'cars.user_id')
            ->select('cars.content','cars.user_id','cars.created_at','cars.id', 'users.name as username','users.address')
            ->orderBy('created_at','desc')->get();
          
            foreach ($cars as &$car) {
                $car['imgs'] = $this->getImgs($car);
            }
        }else{
            $location = $this->queryLocation($lat,$long);
            
            $query = Car::
            join('users', 'users.id', '=', 'cars.user_id')
            ->select('cars.rango','cars.content','cars.user_id','cars.created_at','cars.id', 'users.name as username','users.address',DB::raw($location))
            ->toSql();
            
            $cars = DB::select("select * from ($query) as tabla1 where distance <= rango or rango = 10000 order by created_at desc, distance asc");
            //posts sin ubicacion
            $otros = Car::
            join('users', 'users.id', '=', 'cars.user_id')
            ->select('cars.rango','cars.content','cars.user_id','cars.created_at','cars.id', 'users.name as username','users.address',DB::raw($location))
            ->whereNull('latitud')
            ->whereNull('longitud')
            ->toSql();
            $otros = DB::select($otros);
            $cars = $this->converJson($cars);
            $otros = $this->converJson($otros);

            
           
            foreach ($cars as &$car) {
                $car['imgs'] = $this->getImgsById($car['id']);
            }

            foreach ($otros as &$car) {
                $car['imgs'] = $this->getImgsById($car['id']);
            }
        }
        return response()->json(['data' => $cars,'otros' => $otros], 200);
    }


    public function converJson($data){
        $data = json_encode($data);
        $data = json_decode($data, true);
        return $data;
    }

    public function show($id){
        $post = Car::where('cars.id', $id)
        ->join('users', 'users.id', '=', 'cars.user_id')
        ->select('cars.content','cars.user_id','cars.created_at','cars.id', 'users.name as username','users.address')->first();
        //$post['comments'] = $this->comments($id);
        return response()->json(['data' => $post], 200);
    }


    public function queryLocation($lat, $long){
        $lat = doubleval($lat);
        $long = doubleval($long);
        return " (
            (
                (
                    acos(
                        sin(( $lat * pi() / 180))
                        *
                        sin(( `latitud` * pi() / 180)) + cos(( $lat * pi() /180 ))
                        *
                        cos(( `latitud` * pi() / 180)) * cos((( $long - `longitud`) * pi()/180)))
                ) * 180/pi()
            ) * 60 * 1.1515 * 1.609344
        ) as distance";
    }

    public function search($content,$lat = null, $long = null){
        if($lat == null && $long == null){
            $cars = Car::
            join('users', 'users.id', '=', 'cars.user_id')
            ->select('cars.*', 'users.name as username','users.address')
            ->orderBy('created_at','desc')
            ->where("cars.content","like","%$content%")
            ->limit(100)
            ->get();
            foreach ($cars as &$car) {
                $car['imgs'] = $this->getImgs($car);
            }
        }else {
            $location = $this->queryLocation($lat,$long);
            $cars = Car::
            join('users', 'users.id', '=', 'cars.user_id')
            ->select('cars.*', 'users.name as username','users.address', DB::raw($location) )
            ->orderBy('distance','desc')
            ->orderBy('created_at','desc')
            ->where("cars.content","like","%$content%")
            ->limit(100)
            ->get();
            foreach ($cars as &$car) {
                $car['imgs'] = $this->getImgs($car);
            }
        }
        return response()->json(['data' => $cars], 200);
    }


    public function getImgs($car){
        return DB::select('select id,url from imgs_cars where car_id = ? order by id desc', [$car->id]);
    }

    public function getImgsById($id){
        return DB::select('select id,url from imgs_cars where car_id = ? order by id desc', [$id]);
    }


    public function store(Request $request){
        
        $car = new Car();
        
        if($request->content && $request->imgs ){
            $car->user_id = $request->user_id;
            $car->content = $request->content;
            $car->rango = $request->rango;
            if($request->latitud && $request->longitud){
                //Guardar ubicacion
                $car->latitud = $request->latitud;
                $car->longitud = $request->longitud;
            }

            $car->save();
            if($car->id){
                $this->saveImgs($request->imgs,$car->id);
                return redirect('/cars');
            }
            return back();
        }
        

        $message = "";
        
        return back();
    }

    public function saveImgs($imgs, $car_id){
        $i = 1;
        foreach ($imgs as $img) {
            
            $filename = time()."$i.".$img->extension();
            $img->move(public_path('images'),$filename);
            $url = '/images/'.$filename;
            $car = new ImgsCar();
            $car->car_id = $car_id;
            $car->url = $url;
            $car->save();
            $i++;

            if($i == 7)break;
        }
    }

    public function destroy($id){
        $car = Car::where('id',$id)->first();
        if($car->id){
            try {
                $imgs = DB::select('select url from imgs_cars where car_id = ?', [$id]);
                $car->delete();
                $this->deleteImages($imgs);
                return response()->json(['msg' => 'Eliminado correctamente'], 200);
            } catch (\Throwable $th) {
                echo $th;
                //return response()->json(['msg'=> 'Ocurrió un error al eliminar'], 400);
            }
        }
        return response()->json(['msg' => 'El id no existe'], 400);
    }

    public function deleteImages($imgs){
        foreach ($imgs as $img) {
            $url = $img->url;
            $path = substr($url,1,strlen($url)-1);
            if(File::exists($path)) {
                File::delete($path);
            }
        }
    }
}
