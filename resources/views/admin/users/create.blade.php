@extends('admin.master')
@section('content')

    <div class="card">
        <div class="card-header bg-dark text-white">
            Crear usuario
        </div>
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="post" autocomplete="off">
                @include('admin.users._form', ['pass' => true])
                <button type="submit" class="btn btn-secondary text-white">Registrar usuario</button>
            </form>
          
        </div>
    </div>
@endsection