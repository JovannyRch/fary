@extends('admin.master')
@section('content')
<div id="app" class=" ">
    
    <form action="{{ route('user.store') }}" method="post">
        @include('admin.users._form', ['pass' => true])
        <button type="submit" class="btn btn-success">Registrar usuario</button>
    </form>
  

</div>
@endsection