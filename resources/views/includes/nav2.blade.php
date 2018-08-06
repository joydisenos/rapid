<nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top">
      <div class="container">
        <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('img/logo.png')}}" width="100px" height="auto"/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{url('/')}}">Inicio
                <span class="sr-only">(current)</span>
              </a>
            </li>
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{url('/login')}}">
                Iniciar Sesión
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/register')}}">
                Registro
              </a>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link" href="{{url('/panel')}}">
                Panel
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                Cerrar Sesión
              </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
            @endguest
            
          </ul>
        </div>
      </div>
    </nav>