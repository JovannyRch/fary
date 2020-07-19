@extends('admin.master')
@section('content')
<div id="app" class=" ">
    
  

    <div class="card">
        <div class="card-header bg-success text-white">
            Editar publicitario
        </div>
        <div class="card-body">
            <form action="{{ route('ads.update',$ad->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @include('admin.ads._form')
                <button type="submit" class="btn btn-success text-white">Actualizar publicación</button>
            </form>
            
        
        </div>
    </div>
  

</div>
@endsection