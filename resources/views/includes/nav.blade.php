<nav class="navbar navbar-toggleable-sm navbar-light bg-faded">
            <div class="container">
              <a class="navbar-brand" href="{{url('/')}}"><img src="http://www.rapidelly.com/logo.png" alt=""></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i>
              </button>
              <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                <ul class="navbar-nav">
                    @auth
                    
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Zona de Usuarios</a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{url('panel')}}">Panel</a>
                      <a class="dropdown-item" href="{{url('perfil')}}">Mis Datos</a>
                      <a class="dropdown-item" href="{{url('favoritos')}}">Favoritos</a>
                      <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item">Cerrar Sesión</a>
                                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                    </div>
                </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Inicia Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Registro</a>
                    </li>
                    @endauth
                </ul>
              </div>
            </div>
          </nav>