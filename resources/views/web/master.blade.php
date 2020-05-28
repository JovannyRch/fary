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
   {{--  @if (Auth::user())
        Cosas del usuario: {{Auth::user()->id}}
        Negocio del usuario: {{Auth::user()->negocio}}
    @endif --}}
    <div  id="app">
        @include('web.partials.nav-header-main')
            <div class="container">
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