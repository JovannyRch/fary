@extends('admin.master')
@section('content')

    <div class="card">
        <div class="card-header bg-dark text-white">
            Agregar tipo de negocio
        </div>
        <div class="card-body">
            <form action="{{ route('tipos.store') }}" method="post" autocomplete="off">
                @include('admin.tipos._form')
                <button type="submit" class="btn btn-secondary text-white">Registrar tipo</button>
            </form>
          
        </div>
    </div>
@endsection