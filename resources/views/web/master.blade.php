<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fary</title>
   {{--  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <link rel="icon" href="/images/icon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (Auth::user())
        <meta name="user_id" content="{{ Auth::user()->id?Auth::user()->id:""}}">
        <meta name="type" content="{{ Auth::user()->rol?Auth::user()->rol:"" }}">
    @else
        <meta name="user_id" content="">
    @endif
  
</head>
<body>
    
    <div  id="app">
        @include('web.partials.nav-header-main')
            <div class="container-fluid">
                @yield('content')
            </div>
       
    </div>
   
    <script src="{{asset("js/app.js")}}"></script>
</body>
</html>