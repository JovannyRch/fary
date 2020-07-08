@extends('admin.master')
@section('content')

    
   
  
    <div class="card">
        <div class="card-header bg-dark text-white">
            Actualizar tipo de negocio
        </div>
        <div class="card-body">
            <form action="{{ route('tipos.update',$tipo->id) }}" method="post">
                @method('PUT')
                @include('admin.tipos._form')
                <button type="submit" class="btn btn-secondary text-white">Guardar cambios</button>
            </form>
          
        </div>
    </div>

@endsection