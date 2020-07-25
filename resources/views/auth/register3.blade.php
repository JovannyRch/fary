@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">

                <div class="card-body form-register">
                    <div class="row">
                        <div class="col-8 col-md-5 offset-2 offset-md-0">
                            <img id="logo" class="w-100" src="/images/logo.jpg" alt="" srcset="">
                        </div>
                        <div class="col-12 col-md-7">
                            <div class="text-center mb-3">
                                <h3><b>Registro de negocio</b></h3>
                            </div>
                            <div class="alert alert-success text-center">
                                <b>Paso 2</b> Asociar negocio
                            </div>
                            @if (session('msg'))
                                <div class="alert alert-warning col-12 p-2 text-center">
                                    {{session('msg')}}
                                </div>
                            @endif
                            @if (sizeof($tipos) > 0)
                            <form id="form-create" action="{{ route('negocios.store') }}" method="post"
                                enctype="multipart/form-data" autocomplete="off">
                                @include('admin.negocios._form')
                                <button type="submit" class="btn btn-success text-white">Registrar negocio</button>
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
                </div>
            </div>
        </div>
    </div>

    
</div>


@endsection