<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard(){
        $data = [];
        $data['users'] = DB::table('users')->count();
        $data['posts'] = DB::table('posts')->count();
        $data['cars'] = DB::table('cars')->count();
        $today = new \DateTime();
        
        $lastWeek = new \DateTime();
        $lastWeek->modify ('-365 days');
        $data['last_users'] = DB::table('users')->whereBetween('created_at',[$lastWeek->format('Y-m-d'), $today->format('Y-m-d')])->orderBy('created_at', 'desc')->limit(10)->get();

        
        $data['last_posts'] = DB::table('posts')->whereBetween('created_at',[$lastWeek->format('Y-m-d'), $today->format('Y-m-d')])->count();
        $data['last_cars'] = DB::table('cars')->whereBetween('created_at',[$lastWeek->format('Y-m-d'), $today->format('Y-m-d')])->count();
       
       
        return view('admin.index',$data);
    }

    public function users(){
        $users = User::paginate(20);
        return view('admin.users.index', ['users' => $users]);
    }
    public function createUser(){
        
        return view('admin.users.create', ['user' => new User()]);
    }

    public function showUser(User $user){
        return view('admin.users.show');
    }
    public function editUser(User $user){
        echo "Todo chido";
    }

    public function destroyUser(User $user){

    }
}
