@extends('admin.master')
@section('content')
<div id="app" class=" ">
    
    <form action="{{ route('user.update',$user->id) }}" method="post">
        @method('PUT')
        @include('admin.users._form', ['pass' => false])
        <button type="submit" class="btn btn-success">Actualizar usuario</button>
    </form>
  

</div>
@endsection