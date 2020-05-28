<?php

namespace App\Http\Controllers\API;

use App\Car;
use App\CommentCarPost;
use App\NotificationCars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CommentCarPostsController extends Controller
{

   
    public function store(Request $request){
        $comment = new CommentCarPost();
       
        if($request->content && $request->post_id && $request->user_id){
            $comment->content = $request->content;
            $comment->user_id = $request->user_id;
            $comment->car_post_id = $request->post_id;
            $comment->save();
            $this->saveNotification($comment->user_id,$comment->car_post_id,$comment->id);
            return response()->json(['data' => $this->getComment($comment->id), 'msg' => 'Guardado con exito'], 200);
        }
        return response()->json(['data' => null, 'msg' => "Contenido inválido"], 400);
    }

    public function saveNotification($user_id,$post_id,$comment_id){
        $post_user_id = Car::select("user_id")->where("id",$post_id)->first()['user_id'];
       
        if($post_user_id != $user_id){
            $notification = new NotificationCars();
            DB::delete("DELETE FROM notifications_cars where post_id = $post_id and user_id = $user_id");
            $notification->user_id = $user_id;
            $notification->post_id = $post_id;
            $notification->comment_id = $comment_id;
            $notification->to_user_id = $post_user_id;
            
            $notification->save();
        }
        else {
            //Notification type 1
            $users = DB::select("select DISTINCT user_id from notifications where id = $post_id and type = 0");
            DB::delete("DELETE FROM notifications where post_id = $post_id and user_id = $user_id and type = 1");
            foreach ($users as $user) {
                $to_user_id = $user['user_id'];
                $notification = new Notification();
                $notification->user_id = $user_id;
                $notification->post_id = $post_id;
                $notification->comment_id = $comment_id;
                $notification->to_user_id = $to_user_id;
                $notification->type = 1;
                $notification->save();
            }
        
        }
    }

  

    public function getFirtsComments($post_id){
        $comments = CommentCarPost::where('car_post_id',$post_id)
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

    public function getComments($post_id){
        
        $length = CommentCarPost::where('car_post_id',$post_id)->count();
        $comments = CommentCarPost::where('car_post_id',$post_id)
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
