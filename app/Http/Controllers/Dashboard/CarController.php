<?php

namespace App\Http\Controllers\Dashboard;

use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CarController extends Controller
{
    public function index()
    {
        
        $cars = Car::with('user')
        ->orderBy('created_at','desc')
        ->paginate(15);

        $total = Car::count();
        foreach ($cars as &$p) {
            $comments = DB::table('comments_car_posts')->where('car_post_id', $p['id'])->count();
            $p['imgs'] = DB::select('select id,url from imgs_cars where car_id = ?', [$p->id]);
            $p['comments'] = $comments;
        }
        
        return view('admin.cars.index',['cars' => $cars, 'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {  
        $car['comments'] = $this->getComments($car->id);
        $car['imgs'] = DB::select('select url from imgs_cars where car_id = ?', [$car->id]);
        $car['user'] = DB::table('users')->select('name')->where('id', $car['user_id'])->first();
        return view('admin.cars.show',['car' => $car]);
    }


    public function getComments($car_id){
        
        $comments = DB::table('comments_car_posts')
        ->where('car_post_id',$car_id)
        ->join('users', 'users.id', '=', 'comments_car_posts.user_id')
        ->orderBy('comments_car_posts.created_at','desc')
        ->select('comments_car_posts.id','comments_car_posts.created_at as date', 'comments_car_posts.user_id','comments_car_posts.content', 'users.name as username')
        ->get();

        return $comments;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        foreach ($car->imgs as $img) {
            $this->deleteFile($img->url);
        }
        $car->delete();

        return back()->with('msg','Publicación eliminada con éxito');
    }

    public function deleteFile($path){
        $path = substr($path,1,strlen($path)-1);
        if(File::exists($path)) {
            File::delete($path);
        }
    }
}
