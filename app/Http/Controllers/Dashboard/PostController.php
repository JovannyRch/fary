<?php

namespace App\Http\Controllers\Dashboard;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        
        $posts = Post::
        join('users', 'users.id', '=', 'posts.user_id')
        ->select('posts.*', 'users.name as username')
        ->orderBy('created_at','desc')
        ->paginate(15);

        $total = Post::count();
        foreach ($posts as &$p) {
            $comments = DB::table('comments')->where('post_id', $p['id'])->count();
            
            $p['comments'] = $comments;
        }
        
        return view('admin.posts.index',['posts' => $posts, 'total' => $total]);
    }

    public function getLatest(){
        $last3months = new \DateTime();
        $last3months->modify ('-89 days');
        $posts = Post::
        join('users', 'users.id', '=', 'posts.user_id')
        ->select('posts.*', 'users.name as username')
        ->orderBy('created_at','desc')
        ->where('posts.created_at','<',$last3months->format('Y-m-d'))
        
        ->paginate(15);
        return $posts;
    }

    public function latest(){
        $posts = $this->getLatest();
        
        foreach ($posts as &$p) {
            $comments = DB::table('comments')->where('post_id', $p['id'])->count();
            $p['comments'] = $comments;
        }
        return view("admin.posts.latest",['posts' => $posts]);
    }

    public function latestDestroy(){
        $posts = $this->getLatest();
        foreach ($posts as &$post) {
            if($post->img){
                $this->deleteFile($post->img);
            }
            $post->delete();
        }
        return back()->with('msg', 'Publicaciones eliminadas con éxito');
    }
  
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

  
    public function show(Post $post)
    {  
        $post['comments'] = $this->getComments($post->id);
        $post['user'] = DB::table('users')->select('name')->where('id', $post['user_id'])->first();
        return view('admin.posts.show',['post' => $post]);
    }


    public function getComments($post_id){
        
        $comments = DB::table('comments')
        ->where('post_id',$post_id)
        ->join('users', 'users.id', '=', 'comments.user_id')
        ->orderBy('comments.created_at','desc')
        ->select('comments.id','comments.created_at as date', 'comments.user_id','comments.content', 'users.name as username')
        ->get();

        return $comments;
    }
  
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy(Post $post)
    {
        if($post->img){
            $this->deleteFile($post->img);
        }
        $post->delete();
        return back()->with('msg', 'Publicación eliminada con éxito');
    }

    public function deleteFile($path){
        $path = substr($path,1,strlen($path)-1);
        if(File::exists($path)) {
            File::delete($path);
        }
    }


    public function deleteAll(){
        Post::truncate();
        return back()->with('msg','Se han eliminado todas las publicaciones');
    }
}
