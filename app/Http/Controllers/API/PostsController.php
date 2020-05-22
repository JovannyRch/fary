<?php

namespace App\Http\Controllers\API;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::
        join('users', 'users.id', '=', 'posts.user_id')
        ->select('posts.*', 'users.name as username')
        ->orderBy('created_at','desc')
        ->paginate(10);
        return response()->json(['data' => $posts], 200);
    }


    public function show($id){
        $post = Post::where('posts.id', $id)
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->select('posts.*', 'users.name as username')->first();
        //$post['comments'] = $this->comments($id);
        return response()->json(['data' => $post], 200);
    }

    public function comments($id){
        $comments = DB::find($id,'post_id');
        return $comments;
    }

    public function destroy($id){
        try {
            $post = Post::where('id',$id)->first();
            $this->deleteImage($post->img);
            $post->delete();
            return response()->json(['data' => '', 'msg' => 'Eliminado correctamente'], 200);   
        } catch (\Throwable $th) {
            return response()->json(['data' => '', 'msg' =>'Ocurrió un error al eliminar'], 400);
        }
        
    }

    public function deleteImage($path){
        $path = substr($path,1,strlen($path)-1);
        if(File::exists($path)) {
            File::delete($path);
        }
    }

    public function filterPosts($latitud, $longitud, $distance = 30){
        $sql = " SELECT * FROM (
            SELECT *, 
                (
                    (
                        (
                            acos(
                                sin(( $LATITUDE * pi() / 180))
                                *
                                sin(( `latitud` * pi() / 180)) + cos(( $LATITUDE * pi() /180 ))
                                *
                                cos(( `latitud` * pi() / 180)) * cos((( $LONGITUDE - `longitud`) * pi()/180)))
                        ) * 180/pi()
                    ) * 60 * 1.1515 * 1.609344
                )
            as distance FROM `posts`
        ) posts
        WHERE distance <= $distance
        LIMIT 15;
    ";  
    }


    public function create(Request $request){
        
        
        $post = new Post();
        $data = $request->all();
        $post->content = $request->content;
        
        $post->user_id = Auth::user()->id; 
        
        
        if($request->latitud && $request->longitud){
            //Guardar ubicacion
            $post->latitud = $request->latitud;
            $post->longitud = $request->longitud;
        }

        if($request->hasFile('file')){
            $filename = time().".".$request->file->extension();
            $request->file->move(public_path('images'),$filename);
            $post->img = '/images/'.$filename; 
            
        }
        $post->save();
        return redirect('/');
    }
}

