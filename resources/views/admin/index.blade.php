
@extends('admin.master') 

@section('content')


    <div class="card ">
        <div class="card-header bg-dark text-white">
            Resumen de la web en los útlimos 7 días
        </div>
        <div class="card-body">
            <div class="row">
                <div class="card card-body bg-light col-md-3 dash-box offset-md-1 p-3 mr-3">
                    <h2> <i class="fa fa-users"></i> {{ sizeof($last_users) }}</h2>
                    <h4>Usuarios registrados </h4>
                </div>

                <div class="card card-body bg-light col-md-3 dash-box p-3 mr-3">
                    <h2> <i class="fa fa-wrench"></i> {{ $last_posts }}</h2>
                    <h4>Publicaciones de autopartes </h4>
                </div>

                <div class="card card-body bg-light col-md-3 dash-box p-3">
                    <h2> <i class="fa fa-car"></i> {{ $last_cars }}</h2>
                    <h4>Publicaciones de autos chocados </h4>
                </div>
                
            </div>
            
        </div>
       
    </div>

    <div class="card mt-5 ">
        <div class="card-header bg-dark text-white">
            Últimos usuarios registrados
        </div>
        <div class="card-body">
            
           @if (sizeof($last_users) == 0)
                <div class="alert alert-warning">
                    No se han encontrado registros
                </div>
           @else
           <table class="table table-striped">
            <thead class="thead-default">
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($last_users as $user)
                        <tr >
                            <td scope="row"> {{ $user->name }} </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->address }}</td>
                        </tr>
                    @endforeach
                    
                </tbody>
        </table>
           @endif
            
        </div>
       
    </div>
@endsection

