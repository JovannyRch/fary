<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/images/icon.png">
    <title>Fary</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="topnav" id="myTopnav">
            <a href="/" class="active-nav"><b>Fary Red de Autopartes</b></a>
            <a href="/" > <i class="fa fa-wrench "></i> Autopartes</a>
              <a href="/cars" > <i class="fas fa-car"></i> Autos chocados</a>
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
              
              <a  href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="float-right d-none d-md-block"> <i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
           
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            @endguest
            
            <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="openTab()">&#9776;</a>
          </div>
          

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
