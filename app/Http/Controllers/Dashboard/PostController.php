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
}
