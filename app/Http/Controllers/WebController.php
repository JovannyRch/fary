<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function index()
    {
        return view('web.index');
    }

    

    //
    public function createPost()
    {
        if(Auth::id()){
            return view('web.posts.create');
        }
        else{
            return redirect('login')->with('message', 'Inicia sesión para continuar');
        }
    }


    public function image(Request $request)
    {
        $request->validate([
            'image'=> 'required|mimes:jpeg,bmp,png|max:10240'
        ]);
        $filename = time().".".$request->image->extension();
        $request->image->move(public_path('images'),$filename);
        $data = [
            'image' => $filename
        ];
        return response()->json(['url' => URL::to('/').'/images/'.$filename]);

    }

    public function showPost($id){
        return view('web.index');
    }

    public function createCarPost(){
        if(Auth::id()){
            return view('web.cars.create');
        }
        else{
            return redirect('login')->with('message', 'Inicia sesión para continuar');
        }
    }
}
