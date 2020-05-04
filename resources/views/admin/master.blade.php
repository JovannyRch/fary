<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Autopartes Fary</title>
   {{--  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <link rel="stylesheet" href="{{asset("css/main.css")}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (Auth::user())
        <meta name="user_id" content="{{ Auth::user()->id }}">
    @else
        <meta name="user_id" content="">
    @endif

</head>
<body>
    <div  id="app">

                <x-HeaderAdmin />
               
                <div class="container-fluid" style="min-height: 100vh">
                    
                    <section id="main">
                        <div class="container">
                            <div class="row">

                                @if (session('msg'))
                                    <div class="alert alert-success col-12 p-2 text-center">
                                        {{session('msg')}}
                                    </div>
                                @endif
                
                                @if (session('warning'))
                                    <div class="alert alert-warning col-12 p-2 text-center">
                                        {{session('warning')}}
                                    </div>
                                @endif

                                <div class="col-md-3">
                                   <x-PagesAdmin />
                                </div>
                                <div class="col-md-9">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
               
       
        @include('admin.partials.footer-main')
    </div>
   
    <script src="{{asset("js/app.js")}}"></script>
</body>
</html>