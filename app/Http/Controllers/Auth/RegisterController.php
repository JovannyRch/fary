<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Negocio;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data, $rol = 'normal')
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'rol' => $rol,
            'password' => Hash::make($data['password'])
        ]);
    }

    public function redirectTo(){
        $rol = Auth::user()->rol;
        switch ($rol) {
            case 'admin':
                return '/dashboard';
            case 'owner':
                return'/';
            default:
                return '/';
        }
    }

    public function registerNegocio()
    {

        return view('auth.register2');
    }

    public function addNegocio()
    {
        $tipos = DB::table('tipos')->get();
        $owners = DB::table('users')->select('id','name')->where('rol', 'owner')->get();
        return view('auth.register3',['negocio' => new Negocio(), 'owners' => $owners, "tipos" => $tipos]);
        
    }

    public function registerNegocioAccount(Request $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation
        ];
        
        if ($data['password'] == $data['password_confirmation']) {
         
            if(strlen($data['password']) >= 3){
                //Registra usuario
                $user = $this->create($data, 'owner');
                Auth::login($user);
                return redirect('/');
            }
            else{
                return back()->with('error','La contraseña debe tener al menos 3 carácteres');
            }
        }
        else {
            return back()->with('error','Las contraseñas no coinciden');
        }
    }
}
