@extends('admin.master')
@section('content')
<div id="app" class=" ">
    
    <div class="card">
        <div class="card-header bg-dark text-white">
            Cargar anuncio publicitario
        </div>
        <div class="card-body">
            <form action="{{ route('ads.store') }}" method="post"  enctype="multipart/form-data" >
                @include('admin.ads._form', ['pass' => true])
                <button type="submit" class="btn btn-secondary text-white">Agregar</button>
            </form>
          
        
        </div>
    </div>
</div>
@endsection