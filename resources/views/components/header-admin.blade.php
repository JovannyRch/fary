<header id="header" class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h4  class="text-white" >
                    <img src="/images/icon.png" width="5%" >
                  <b>Red de Autopartes Usadas Fary</b>
                  </h4>
            </div>
            <div class="col-md-2">

                <div class="btn-group">
                    <button class="btn btn-success dropdown-toggle text-white" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                               Cuenta
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Cerrar sesión') }}
                     </a>
     
                   
                    </div>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>

  

</header>