@extends('layouts.app')

@section('content')
<div class="container">

    
    <div class="row justify-content-center">
        @if (session('message'))
           <div class="col-8 text-center">
            <div class="alert alert-success ">
                <b>{{session('message')}}</b>
            </div>
           </div>
        @endif
       
        <div class="col-md-9">
            <div class="card">

                <div class="card-body">
                   {{--  <div class="card-title text-center mb-4">
                        <h3>{{ __('Inicio de de sesión') }}</h3>
                    </div> --}}
                   <div class="row ">

                       <div class="col-8 col-md-5 offset-2 offset-md-0">
                           <img class="w-100" src="/images/logo.jpg" alt="" srcset="">
                       </div>
                       <div class="col-12 col-md-7">
                        <div class="text-center mb-3">
                            <h3><b>Iniciar sesión</b></h3>
                        </div>
                        <form method="POST" class="w-100" action="{{ route('login') }}">
                            @csrf
    
                            <div class="form-group">
                                <label for="email" class="col-md-8 offset-md-2 col-form-label "><b>{{ __('Correo electrónico') }}</b></label>
    
                                <div class="col-md-8 offset-md-2">
                                    <input id="email" type="email" placeholder="Escribe tu correo" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                         

                            <div class="form-group ">
                                <label for="password" class="col-md-8 offset-md-2 col-form-label "><b>{{ __('Contraseña') }}</b></label>
    
                                <div class="col-md-8 offset-md-2">
                                    <input id="password" placeholder="Escribe tu contraseña" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            
                            <div class="form-group row mb-0  text-center" >
                                
                                <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-success text-white">
                                        {{ __('Ingresar') }}
                                    </button>
    
                                 {{--    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif --}}
                                </div>
                            </div>

                            <div class="text-center text-success">
                                ¿Aún no te has registrado? <br>
                                <b><a class="text-success" href="{{ route('register') }}">
                                <u>Registrate aquí</u></a></b>
                            </div>
                        </form>
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
