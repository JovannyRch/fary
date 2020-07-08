@extends('dashboard.master')
@section('content')
<div class="form-group">
    <label for="title">Nombre</label>
    <input
        type="text"
        class="form-control"
        name="title"
        id="title"
        value="{{$user->name}}"
        readonly
    />
 
</div>
<div class="form-group">
    <label for="user">Apellidos</label>
    <input
        type="text"
        class="form-control"
        name="user"
        id="user"
        readonly
value="{{$user->surname}}"
    />
</div>

 
</div>
@endsection