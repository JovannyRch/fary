<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function destroy($id){
        try {
            $comment = Comment::where('id',$id);
            $comment->delete();
            return back();
        } catch (\Throwable $th) {
            return back();
        }
        
    }
    public function destroyCarComment($id){
        try {
            $comment = DB::table('comments_car_posts')->where('id',$id);
            $comment->delete();
            return back();
        } catch (\Throwable $th) {
            return back();
        }
    }
}
