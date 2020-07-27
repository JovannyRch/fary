<?php

namespace App\Http\Controllers\API;

use App\Post;
use App\Comment;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function store(Request $request){
        $comment = new Comment();
       
        if($request->content){
            $comment->content = $request->content;
            $comment->user_id = $request->user_id;
            $comment->post_id = $request->post_id;
            $comment->save();
            $this->saveNotification($comment->user_id,$comment->post_id,$comment->id);
            return response()->json(['data' => $this->getComment($comment->id), 'msg' => 'Guardado con exito'], 200);
        }
        return response()->json(['data' => null, 'msg' => "Contenido inválido"], 400);
    }


    public function saveNotification($user_id,$post_id,$comment_id){
        $post_user_id = Post::select("user_id")->where("id",$post_id)->first()['user_id'];
        
        //Notificaton type 0
        if($post_user_id != $user_id){
            $notification = new Notification();
            DB::delete("DELETE FROM notifications where post_id = $post_id and user_id = $user_id");
            $notification->user_id = $user_id;
            $notification->post_id = $post_id;
            $notification->comment_id = $comment_id;
            $notification->to_user_id = $post_user_id;
            $notification->save();
        }
        else {
            //Notification type 1
            $users = Notification::select("user_id")->where("post_id",$post_id)->where('type',0)->get();
           
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
        $comments = Comment::where('comments.post_id',$post_id)
        ->join('users', 'users.id', '=', 'comments.user_id')
        ->orderBy('comments.created_at','asc')
        ->select('comments.id','comments.created_at as date', 'comments.user_id','comments.content', 'users.name as username')
        ->limit(4)
        ->get();

        return response()->json(['data' => $comments], 200);
    }

    public function getComment($id){
        return Comment::where('comments.id',$id)
        ->join('users', 'users.id', '=', 'comments.user_id')
        ->orderBy('comments.created_at','asc')
        ->select('comments.id','comments.created_at as date', 'comments.user_id','comments.content', 'users.name as username')
        ->first();
    }

    public function getComments($post_id){
        
        $comments = Comment::where('post_id',$post_id)
        ->join('users', 'users.id', '=', 'comments.user_id')
        ->orderBy('comments.created_at','asc')
        ->select('comments.id','comments.created_at as date', 'comments.user_id','comments.content', 'users.name as username')
        ->get();

        return response()->json(['data' => $comments], 200);
    }

    public function destroy($id){
        try {
            $comment = Comment::where('id',$id);
            $comment->delete();
            return response()->json(['data' => '', 'msg' => 'Eliminado correctamente'], 200);
        } catch (\Throwable $th) {
            return response()->json(['data' => '', 'msg' =>'Ocurrió un error al eliminar'], 400);
        }
        
    }
}
