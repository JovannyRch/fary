<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fary</title>
    <link href=’https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel=”stylesheet”>
   {{--  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <link rel="icon" href="/images/icon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (Auth::user())
        <meta name="user_id" content="{{ Auth::user()->id?Auth::user()->id:""}}">
        <meta name="type" content="{{ Auth::user()->rol?Auth::user()->rol:"" }}">
        <meta name="username" content="{{ Auth::user()->name?Auth::user()->name:"" }}">
        <meta name="negocio" content="{{ Auth::user()->negocio?Auth::user()->negocio:"" }}">
    @else
        <meta name="user_id" content="">
        <meta name="type" content="">
        <meta name="username" content="">
        <meta name="negocio" content="">
    @endif
  
</head>
<body>
  
    <div  id="app">

        <div class="topnav" id="myTopnav">

            <router-link to="/" class="active-nav"><b>Fary Red de Autopartes</b></router-link>
            <router-link to="/" > <i class="fa fa-wrench "></i> Autopartes</router-link>
            <router-link to="/cars" > <i class="fa fa-car "></i> Autos chocados</router-link>
            <router-link to="/zona-publicitaria" > <i class="fas fa-store-alt"></i> Espacio publicitario</router-link>
            <router-link to="/mas" > <i class="fas fa-plus"></i> Más</router-link>
          
            
            @guest
            <a class="float-right" href="{{ route('login') }}">
                Iniciar sesión
            </a>
            @if (Route::has('register'))
                <a class="float-right" href="{{ route('register') }}">
                Registrarse
                </a>
            @endif
            @else
            
            <a  href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="float-right "> <i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
        
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endguest
            
            <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="openTab()">&#9776;</a>
        </div>
        
        
  
            <div class="container-fluid ">
                @yield('content')
            </div>
    </div>
   

    <script src="{{asset("js/app.js")}}"></script>
    <script>

    function openTab() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }

    </script>
</body>
</html>