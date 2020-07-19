@extends('admin.master')
@section('content')
<div id="app" class=" ">
    
    
    
    <div class="card">
        <div class="card-header bg-dark text-white">
            Editar negocio
        </div>
        <div class="card-body">
            <form action="{{ route('negocios.update',$negocio->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @method('PUT')
                @include('admin.negocios._form')
                <button type="submit" class="btn btn-success text-white">Actualizar</button>
            </form>
        </div>
    </div>

</div>
@endsection