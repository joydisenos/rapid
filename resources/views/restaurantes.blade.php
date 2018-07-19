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
      



      <section>
        <div class="container">
         <div class="row">
        <div class="col-sm-12 text-center">

          <small class="mt-4">[44] Restaurantes en [Nombre Ciudad]</small>
          <hr>
    
      
        </div>
        
    <div class="col-sm-12 col-md-4">
          

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
    
     <div class="col-md-8 col-sm-12">
      
      <section id="blog">
        <div class="container">
          <div id="posts-carousel" class="owl-carousel mt-3 mb-3">

            @foreach($destacados as $destacado)
            <div class="blog block carousel-post"> 
              
              <h5>{{$destacado->nombre_del_restaurante}}</h5>
              <p>{{$destacado->descripcion}}</p>
              <p>{{$destacado->ciudad}}</p>
              <a href="{{url('restaurant').'/'.$destacado->slug}}">Visitar <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            </div>
            @endforeach

        


           

          </div>
        </div>
      </section>

          <small class="mt-4">Los mejores restaurantes de [Nombre ciudad] están aca</small>
          <hr>
        @foreach($restaurantes as $restaurant)
    <div class="row">
      <div class="col-xs-3 text-center">
       
        @if($restaurant->logo == '')
              @else
              <div class="col">
                  <a href="{{url('restaurant').'/'.$restaurant->slug}}">
                    <img src="{{asset('storage').'/'.$restaurant->logo}}" style="max-height: 64px; max-width: 64px; padding: 7px;" class="img-fluid" alt="{{$restaurant->nombre_del_restaurante}}">
                  </a>
              </div>
              @endif
      </div>
        <div class="col">
          <h5 class="mt-0">{{$restaurant->nombre_del_restaurante}}
            <span class="badge badge-success">Abierto</span></h5>
          <small><i class="fa fa-map-marker"></i> {{$restaurant->direccion}} - <i class="fa fa-cutlery"></i> {{$restaurant->categorias}}</small><br>
          <small><b>Tipo de envío:</b> (Delivery) - (TakeAway) - (Delivery + TakeAway)</small>
        </div>
        
        <div class="col">
          <a class="btn btn-warning ml-3 hidden-sm-down" href="{{url('restaurant').'/'.$restaurant->slug}}" role="button">Ver Menú</a>
        <a class="btn btn-warning ml-3 hidden-md-up" href="{{url('restaurant').'/'.$restaurant->slug}}" role="button">Ver</a>
        
        </div>
    </div>
    <hr>
        @endforeach
   
      
        </div>
    
      </div>
      <!-- /.row -->
      </div>
      </section>


      @endsection