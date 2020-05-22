<?php

namespace App\Http\Controllers\API;

use App\Car;
use App\ImgsCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CarsController extends Controller
{
    public function index(){
        $cars = Car::
        join('users', 'users.id', '=', 'cars.user_id')
        ->select('cars.*', 'users.name as username')
        ->orderBy('created_at','desc')
        ->paginate(10);
        foreach ($cars as &$car) {
            $car['imgs'] = DB::select('select url from imgs_cars where car_id = ?', [$car->id]);
        }
        return response()->json(['data' => $cars], 200);
    }

    public function store(Request $request){
        
        $car = new Car();
    
        if($request->content && $request->imgs ){
            $car->user_id = $request->user_id;
            $car->content = $request->content;

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
                return response()->json(['msg'=> 'Ocurrió un error al eliminar'], 400);
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
