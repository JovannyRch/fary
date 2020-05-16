<nav id="nav" class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
    <div class="container">
      <router-link to="/" class="navbar-brand">
        <h4 >
          <img src="/images/icon.png" width="10%" >
        <b>Fary</b>
        </h4>
      </router-link>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto ">
        <li class="nav-item">
          <router-link class="nav-link text-white" to="/">Autopartes</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link text-white" to="/cars"> Autos Chocados</router-link>
        </li>

        <li class="nav-item">
          <router-link class="nav-link text-white" to="/zona-publicitaria"> Zona Publicitaria</router-link>
        </li>
       
      </ul>
      
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('login') }}">
                  <b>Iniciar sesión</b>
                </a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('register') }}">
                      <b>Registrarse</b>
                    </a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Cerrar sesión') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
      
    </div>
    </div>
  </nav>