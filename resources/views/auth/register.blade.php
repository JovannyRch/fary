@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
               

                <div class="card-body">
                    <div class="row">
                        <div class="col-8 col-md-5 offset-2 offset-md-0">
                            <img id="logo" class="w-100" src="/images/logo.png" alt="" srcset="">
                        </div>
                        <div class="col-12 col-md-7">
                            <div class="text-center mb-3">
                                <h3><b>Registro de usuario</b></h3>
                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
        
                                <div class="form-group">
                                    <label for="name" class="col-md-8 offset-md-2 col-form-label"><b>Nombre</b></label>
        
                                    <div class="col-md-8 offset-md-2">
                                        <input id="name" type="text" placeholder="Escribe tu nombre" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label for="phone" class="col-md-8 offset-md-2 col-form-label"><b>Número telefónico</b></label>
        
                                    <div class="col-md-8 offset-md-2">
                                        <input id="phone"  placeholder="Escribe tu número telefónico" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
        
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label for="address" class="col-md-8 offset-md-2 col-form-label"><b>Dirección</b></label>
        
                                    <div class="col-md-8 offset-md-2">
                                        <input id="address" placeholder="Escribe tu direccíón" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">
        
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label for="email" class="col-md-8 offset-md-2 col-form-label"><b>Correo electrónico</b></label>
        
                                    <div class="col-md-8 offset-md-2">
                                        <input id="email" type="email" placeholder="Escribe tu correo electrónico" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label for="password" class="col-md-8 offset-md-2 col-form-label"><b>Contraseña</b></label>
        
                                    <div class="col-md-8 offset-md-2">
                                        <input id="password" type="password" placeholder="Escribe tu contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-8 offset-md-2 col-form-label"><b>Confirmación de contraseña</b></label>
        
                                    <div class="col-md-8 offset-md-2">
                                        <input id="password-confirm" placeholder="Repite tu contraseña" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
        
                                <div class="form-group row mb-0  text-center">
                                    <div class="col-md-8 offset-md-2">
                                        <button type="submit" class="btn btn-success text-white">
                                            Registrarse
                                        </button>
                                    </div>
                                </div>
                                <div class="text-center text-success">
                                    ¿Ya tienes cuenta? <br>
                                    <b><a class="text-success" href="{{ route('login') }}">
                                    <u>Inicia sesión aquí</u></a></b>
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
