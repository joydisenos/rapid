@extends('layouts.principal')
@section('content')
<header id="header-style-1">
         @include('includes.nav')

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
              @if($destacado->logo == '')
              @else
              <img src="{{asset('storage').'/'. $destacado->logo}}" alt="">
              @endif
              <h5>{{$destacado->nombre_del_restaurante}}</h5>
              <p>{{$destacado->descripcion}}</p>
              <p>{{$destacado->ciudad}}</p>
              <a href="{{url('restaurant').'/'.$destacado->slug}}">Visitar <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
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
                @if($destacado->logo == '')
              @else
              <div class="col-sm-4">
                  <img src="{{asset('storage').'/'.$restaurant->logo}}" class="img-fluid" alt="">
              </div>
              @endif
                
                <div class="col">
                  <div class="text-center">
                <h3><a href="{{url('restaurant').'/'.$restaurant->slug}}">{{$restaurant->nombre_del_restaurante}}</a></h3>
              </div>
                  <p>Categorias</p>
                  <p>{{$restaurant->descripcion}}</p>
                  <p><strong>{{title_case($restaurant->ciudad)}}</strong></p>

                  <a href="{{url('restaurant').'/'.$restaurant->slug}}" class="btn btn-common">Visitar</a>
                  
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

          
        </div>
      </div>
    </div>
  </section>

      @endsection