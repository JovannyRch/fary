@extends('admin.master')
@section('content')

    
   
  
    <div class="card">
        <div class="card-header bg-dark text-white">
            Actualizar usuario
        </div>
        <div class="card-body">
            <form action="{{ route('user.update',$user->id) }}" method="post">
                @method('PUT')
                @include('admin.users._form', ['pass' => false])
                <button type="submit" class="btn btn-secondary text-white">Guardar cambios</button>
            </form>
          
        </div>
    </div>

@endsection