
@extends('admin.master') 

@section('content')
    <h2><b>Administración de usuarios</b></h2>
    <table class="table">
        <thead >
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr >
                    <td scope="row">{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->address}}</td>
                    <td>
                        <button type="button" class="btn btn-danger"> <i class="fa fa-trash"></i> </button>
                        <a type="button" class="btn btn-warning" > <i class="fa fa-edit"></i> </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection