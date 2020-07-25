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

    public function index($lat = null,$long = null){
        if(Auth::check()){
            return $this->withLogin($lat,$long);
        }else{
            return $this->withoutLogin($lat,$long);
        }

    }  


    public function withLogin($lat, $long){
        $otros = [];
        $user_id = Auth::user()->id;
        $myPosts = $this->myPosts($lat,$long);
        if($lat == null && $long == null){
            $posts = $this->myNoPosts();
            return response()->json(['data' => $posts,'otros' =>  $otros,'myPosts' => $myPosts], 200);
        }
        else{
            $location = $this->queryLocation($lat,$long,'posts');
            $posts = Post::
                join('users', 'users.id', '=', 'posts.user_id')
                ->select('posts.latitud','posts.longitud','posts.rango','posts.content','posts.created_at','posts.user_id','posts.img','posts.id',  'users.name as username','users.address', DB::raw($location))
                ->where('posts.user_id','!=',$user_id)
                ->toSql();
            $posts = DB::select("select * from ($query) as tabla1 where distance <= rango or rango = 10000 order by created_at desc, distance asc");
           
        }
        return response()->json(['data' => $posts, 'otros' =>  $otros,'myPosts' => $myPosts], 200);
    }

    public function withoutLogin($lat,$long){
        $otros = [];
        if($lat == null && $long == null){
            $posts = Post::
            join('users', 'users.id', '=', 'posts.user_id')
            ->select('posts.content','posts.created_at','posts.user_id','posts.img','posts.id', 'users.name as username','users.address')
            ->orderBy('created_at','desc')->get();
            return response()->json(['data' => $posts], 200);
        }
        else{
            $location = $this->queryLocation($lat,$long,'posts');
            $query = Post::
                join('users', 'users.id', '=', 'posts.user_id')
                ->select('posts.latitud','posts.longitud','posts.rango','posts.content','posts.created_at','posts.user_id','posts.img','posts.id',  'users.name as username','users.address', DB::raw($location))
               ->toSql();
            $posts = DB::select("select * from ($query) as tabla1 where distance <= rango  order by created_at desc, distance asc");
            //posts sin ubicacion
            $otros = Post::
            join('users', 'users.id', '=', 'posts.user_id')
            ->select('posts.content','posts.created_at','posts.user_id','posts.img','posts.id',  'users.name as username','users.address')
            ->whereNull('latitud')
            ->whereNull('longitud')
            ->toSql();
            $otros = DB::select($otros);
           
            
        }
        return response()->json(['data' => $posts, 'otros' =>  $otros,'misposts' => []], 200);
    }


    public function queryLocation($lat, $long,$table = ""){
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

    public function search($content, $lat = null, $long = null){
        if($lat == null && $long == null){
            $posts = Post::
                join('users', 'users.id', '=', 'posts.user_id')
                ->select('posts.content','posts.created_at','posts.user_id','posts.img','posts.id', 'users.name as username','users.address')
                ->orderBy('created_at','desc')
                ->where("posts.content","like","%$content%")
                ->limit(100)
                ->get();
        }
        else {
            $location = $this->queryLocation($lat,$long);
            $posts = Post::
            join('users', 'users.id', '=', 'posts.user_id')
            ->select('posts.content','posts.created_at','posts.user_id','posts.img','posts.id','users.name as username','users.address', DB::raw($location))
            ->orderBy('distance','desc')
            ->orderBy('created_at','desc')
            ->where("posts.content","like","%$content%")
            ->limit(100)
            ->get();
        }
        return response()->json(['data' => $posts], 200);
        
    }


    public function myPosts($user_id){
        $posts = Post::
            join('users', 'users.id', '=', 'posts.user_id')
            ->select('posts.content','posts.created_at','posts.user_id','posts.img','posts.id','users.name as username','users.address')
            ->orderBy('created_at','desc')
            ->where("posts.user_id","=",$user_id)
            ->get();
        return response()->json(['data' => $posts], 200);            
    }

    public function myNoPosts($user_id){
        $posts = Post::
            join('users', 'users.id', '=', 'posts.user_id')
            ->select('posts.content','posts.created_at','posts.user_id','posts.img','posts.id','users.name as username','users.address')
            ->orderBy('created_at','desc')
            ->where("posts.user_id","!=",$user_id)
            ->take(100)
            ->get();
        return response()->json(['data' => $posts], 200);
    }

    public function postsWithoutRange(){
        $query = Post::
                join('users', 'users.id', '=', 'posts.user_id')
                ->select('posts.rango','posts.content','posts.created_at','posts.user_id','posts.img','posts.id',  'users.name as username','users.address')
               ->toSql();
        $posts = DB::select("select * from ($query) as tabla1 where rango = 1000000 order by created_at desc");
        return response()->json(['data' => $posts, 'otros' =>  [],'misposts' => []], 200);
    }

    public function show($id){
        $post = Post::where('posts.id', $id)
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->select('posts.content','posts.created_at','posts.user_id','posts.img','posts.id','users.name as username','users.address')->first();
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
                                sin(( $latitud * pi() / 180))
                                *
                                sin(( `latitud` * pi() / 180)) + cos(( $latitud * pi() /180 ))
                                *
                                cos(( `latitud` * pi() / 180)) * cos((( $longitud - `longitud`) * pi()/180)))
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
        $post->rango = $request->rango;
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

