<div class="topnav" id="myTopnav">
    <a href="#" class="active-nav"><b>Fary Red de Autopartes</b></a>

    @guest
      <a class="float-right" href="{{ route('login') }}">
        Iniciar sesión
      </a>
      @if (Route::has('register'))
        <a class="float-right" href="{{ route('register') }}">
          Registrarse
        </a>
      @endif
    @else
      
      <a  href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="float-right "> <i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
   
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    @endguest
    <script>

      function openTab() {
          var x = document.getElementById("myTopnav");
          if (x.className === "topnav") {
              x.className += " responsive";
          } else {
              x.className = "topnav";
          }
      }
  
      </script>
    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="openTab()">&#9776;</a>
  </div>
  