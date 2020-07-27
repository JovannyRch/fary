<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectTo(){
        $rol = Auth::user()->rol;
        
        switch ($rol) {
            case 'admin':
                return '/dashboard';
            case 'owner':
                $negocio = Auth::user()->negocio;
                if($negocio == null){
                    return '/register/negocio/paso2';
                }
                return'/';
            default:
                return '/';
        }
    }
}
