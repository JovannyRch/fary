<?php

namespace App\Http\Controllers\API;

use App\CommentCarPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentCarPostsController extends Controller
{

   
    public function store(Request $request){
        $comment = new CommentCarPost();
       
        if($request->content && $request->car_post_id && $request->user_id){
            $comment->content = $request->content;
            $comment->user_id = $request->user_id;
            $comment->car_post_id = $request->car_post_id;
            $comment->save();
            return response()->json(['data' => $this->getComment($comment->id), 'msg' => 'Guardado con exito'], 200);
        }
        return response()->json(['data' => null, 'msg' => "Contenido inválido"], 400);
    }

    public function getFirtsComments($car_post_id){
        $comments = CommentCarPost::where('car_post_id',$car_post_id)
        ->join('users', 'users.id', '=', 'comments_car_posts.user_id')
        ->orderBy('comments_car_posts.created_at','desc')
        ->select('comments_car_posts.id','comments_car_posts.created_at as date', 'comments_car_posts.user_id','comments_car_posts.content', 'users.name as username')
        ->limit(4)
        ->get();

        return response()->json(['data' => $comments], 200);
    }

    public function getComment($id){
        return CommentCarPost::where('comments_car_posts.id',$id)
        ->join('users', 'users.id', '=', 'comments_car_posts.user_id')
        ->orderBy('comments_car_posts.created_at','desc')
        ->select('comments_car_posts.id','comments_car_posts.created_at as date', 'comments_car_posts.user_id','comments_car_posts.content', 'users.name as username')
        ->first();
    }

    public function getComments($car_post_id){
        
        $length = CommentCarPost::where('car_post_id',$car_post_id)->count();
        $comments = CommentCarPost::where('car_post_id',$car_post_id)
        ->join('users', 'users.id', '=', 'comments_car_posts.user_id')
        ->orderBy('comments_car_posts.created_at','desc')
        ->select('comments_car_posts.id','comments_car_posts.created_at as date', 'comments_car_posts.user_id','comments_car_posts.content', 'users.name as username')
      
        ->get();

        return response()->json(['data' => $comments], 200);
    }

    public function destroy($id){
        try {
            $comment = CommentCarPost::where('id',$id)->first();
            if($comment->id){
                $comment->delete();
                return response()->json(['data' => '', 'msg' => 'Eliminado correctamente'], 200);
            }
            return response()->json(['data' => '', 'msg'=>'Id no válido'], 200);
        } catch (\Throwable $th) {
            return response()->json(['data' => '', 'msg' =>'Ocurrió un error al eliminar'], 400);
        }
        
    }
}
