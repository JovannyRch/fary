<div>
    <ul class="list-group">
        <li class="list-group-item">
            <a href="#">{{ strtoupper(Auth::user()->name) }} </a>
        </li>
    </ul>
    <br>

    <ul class="list-group">
        <li class="list-group-item">
            <a href="{{ route('user.create')}}"> <i class="fa fa-user-plus"></i> Crear usuario</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('ads.create')}}"> <i class="fa fa-plus"></i> Nuevo anuncio publicitario</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('negocios.create')}}"> <i class="fa fa-store"></i> Registrar negocio</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('tipos.create')}}"> <i class="fa fa-plus"></i> Agregar tipo de negocio</a>
        </li>
       
    </ul>

    <br>
    <ul class="list-group">
        <li class="list-group-item">
            <a href="{{ route('admin-index') }}">
                <i class="fas fa-home"></i>
                Dashboard
            </a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('user.index') }}"> <i class="fa fa-users"></i> Usuarios</a>
            <span class="badge badge-dark float-right">{{ $users }}</span>
        </li>

        <li class="list-group-item">
            <a href="{{ route('post.index') }}"> <i class="fa fa-wrench"></i>  Autopartes </a>
            <span class="badge badge-dark float-right">{{ $posts }}</span>
        </li>
        <li class="list-group-item">
            <a href="{{ route('car.index') }}"> <i class="fa fa-car"></i> Autos chocados</a>
            <span class="badge badge-dark float-right">{{ $cars }}</span>
        </li>
        <li class="list-group-item">
            <a href="{{ route('tipos.index') }}"> <i class="fas fa-align-justify"></i> Tipos de Negocios</a>
            <span class="badge badge-dark float-right">{{ $tipos }}</span>
        </li>
        <li class="list-group-item">
            <a href="{{ route('negocios.index') }}"> <i class="fa fa-store"></i> Negocios</a>
            <span class="badge badge-dark float-right">{{ $negocios }}</span>
        </li>
        <li class="list-group-item">
            <a href="{{ route('ads.index') }}"> <i class="fa fa-tags"></i> Anuncios publicitarios</a>
            <span class="badge badge-dark float-right">{{ $ads }}</span>
        </li>
    </ul>
</div>