@extends('layouts.principal')
@section('content')
<header id="header-style-1">
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

          <div class="container">
            <div class="header-caption">
              <div class="row">
                <div class="col-md-12 header-content text-center" style="padding:150px 10px;">
                  <h3 class="header-title animated fadeInDown p-4" style="color:#000"><span class="text-primary">Rapidelly </span> - Los mejores restaurantes en un sólo lugar</h3>
                  <h5 class="header-text animated fadeIn" style="color:#000">Selecciona tu ciudad</h5>
                      <select name="" id="" class="form-control">
                          <option value="1">Buenos Aires</option>
                          <option value="2">Córdoba</option>
                          <option value="3">Rosario</option>
                          <option value="4">Salta</option>
                          <option value="5">Santa Fé</option>
                          <option value="6">San Juan</option>
                      </select>
                      <button type="submit" href="#" class="page-scroll btn btn-lg btn-default-filled animated fadeInUp">Buscar</button>
                  </form>
                  
                </div>
              </div>
            </div>
          </div>

        </header>

       <!-- posts carousel -->
      <section id="blog">
        <div class="container">
          <div id="posts-carousel" class="owl-carousel mt-3 mb-3">

            @foreach($destacados as $destacado)
            <div class="blog block carousel-post">
              <img src="{{asset('img/carne.jpg')}}" alt="">
              <h5>Nombre del Restaurant</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet atque fugit vitae voluptatem...</p>
              <p>{{$destacado->ciudad}}</p>
              <a href="#">Visitar <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            </div>
            @endforeach

        


           

          </div>
        </div>
      </section>

      <div class="mb-60"></div>

      <section class="blog">
    <div class="container">
      <div class="row">
        
        <div class="col-sm-12 col-md-9">
          @foreach($restaurantes as $restaurant)
          <div class="blog-block post-content-area">
            
           
            <form action="{{url('nueva/compra')}}" method="POST">
               {{ csrf_field() }}
            <div class="blog-post">
              
              
              <div class="row">

                <div class="col-sm-4">
                  <img src="{{asset('img/logo.jpg')}}" class="img-fluid" alt="">
                </div>
                <div class="col">
                  <div class="text-center">
                <h3><a href="">Nombre del Restaurant</a></h3>
              </div>
                  <p>Parrillas, Hamburguesas, Perros Calientes</p>
                  <p>Descripcion de restaurant</p>
                  <p><strong>{{title_case($restaurant->ciudad)}}</strong></p>

                  <a href="#" class="btn btn-common">Visitar</a>
                  
                </div>
               
              </div>
            
             
              
              
              
              
            </div>
            </form>

          </div>
<hr>
          <div class="mb-60"></div>
          @endforeach

          <!--<div class="blog-block post-content-area">
            
            <div class="blog-post">
              <h3><a href="#">Nombre del Restaurant</a></h3>
              <p>Descripción del Restaurant sin imagen</p>
              <a href="#" class="btn btn-common">Visitar</a>
            </div>
          </div>

          <div class="mb-60"></div>-->

          

        </div>
        
        <!-- Blog sidebar area -->
        <div class="col-sm-12 col-md-3">
          

          <div class="blog-block categories-sidebar-widget">
            <h4>Categorias</h4>
            <div class="post-category">
              <a href="#">Pizzerías <span class="pull-right">(3)</span></a>
            </div>

            <div class="post-category">
              <a href="#">Hamburguesas <span class="pull-right">(1)</span></a>
            </div>

            <div class="post-category">
              <a href="#">Parrilla <span class="pull-right">(2)</span></a>
            </div>

            <div class="post-category">
              <a href="#">Panadería <span class="pull-right">(5)</span></a>
            </div>
          </div>

          <div class="mb-60"></div>

          <div class="blog-block blog-posts-widget">
            <div class="widget-title">
              <h4>Más Comprados</h4>
            </div>
            <div class="blog-posts-small">
              @foreach($productos as $producto)
              <div class="blog-post-small first-post">
                <img src="{{asset('img/panes.jpg')}}">
                <a href="#">{{title_case($producto->nombre)}}</a>
                <p>vendidos <a href="#" class="post-date">900</a></p>
              </div>
            @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

      @endsection