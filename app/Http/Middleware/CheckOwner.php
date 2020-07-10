<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()) {
            return redirect('/login');
        }
        if(Auth::user()->rol == 'owner'){
            $negocio = Auth::user()->negocio;
            if(!$negocio){
                return redirect('/register/negocio/paso2');
            }
            return $next($request);
        }
        return $next($request);
    }
}
