@extends('admin.master')
@section('content')


<div class="card">
    <div class="card-header bg-dark text-white">
        Agregar negocio
    </div>
    <div class="card-body">
        @if (sizeof($tipos) > 0)
            <form action="{{ route('negocios.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @include('admin.negocios._form')
                <button type="submit" class="btn btn-secondary text-white">Registrar negocio</button>
            </form>
        @else
            <div class="alert alert-warning">
                Agrege tipo de negocios para continuar                
            </div>
            <div class="text-center">
                <a href="{{ route('tipos.create') }}"> Ir </a>
            </div>
        @endif
    </div>
</div>
@endsection