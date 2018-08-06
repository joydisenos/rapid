@extends('layouts.rapid')
@section('content')
<!-- Header with Background Image -->
    <header class="business-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="display-5 text-center text-white mt-4" style="text-shadow:2px 2px #0c0c0c;"> Pedi delivery de {{$cat->nombre}} en {{title_case($ciudad->nombre)}} ahora!</h1>
          </div>
        </div>
      </div>
    </header>


<div class="container">
      <div class="row">
        <div class="col-sm-12">
          <small class="mt-4"></small>
          <hr>
		
		  
        </div>
        
		 <div class="col-sm-4 d-none d-sm-block">
          <small class="mt-4">Listado de categorias</small>
          <hr>
		  @foreach($categorias as $categoria)
		  <a href="{{url('restaurantes').'/'.$ciudad->slug.'/'.$categoria->slug}}"><small class="mt-4">{{$categoria->nombre}}</small></a> <br>
		  @endforeach
			
		  
        </div>
		
		 <div class="col-sm-8">
          <small class="mt-4">Los mejores restaurantes de {{title_case($ciudad->nombre)}} {{$cat->nombre}} están aca</small>
          <hr>

		
		@if($categoria->count() == 0)
          <div class="media">
          	<p>No tenemos restaurantes registrados en esta localidad, si tienes un restaurant registralo por {{url('alta')}} o deseas recomendar uno contáctanos!</p>
          </div>
        @endif

        @foreach($destacados as $restaurant)
		<div class="media" style="box-shadow:0px 0px 10px yellow; padding:5px">
			@if($restaurant->restaurant->logo == '')
			<img class="mr-3" src="{{asset('img/favicon.png')}}" width="64px" height="64px" alt="Generic placeholder image">
			@else
			<img class="mr-3" src="{{asset('storage').'/'.$restaurant->restaurant->logo}}" width="64px" height="64px" alt="Generic placeholder image">
			@endif
				<div class="media-body">
					<h5 class="mt-0">{{title_case($restaurant->restaurant->nombre_del_restaurante)}} 
						@guest
					@else
					<?php $favorito = App\Favorito::where('user_id' , '=' , Auth::user()->id)->where('restaurant_id' , '=' , $restaurant->restaurant->id)->first(); ?>
					@if($favorito == null)
					<a href="{{url('favorito/marcar').'/'.$restaurant->restaurant->id}}"><i class="far fa-star" style="color:yellow"></i></a>
					@else
					<a href="{{url('favorito/desmarcar').'/'.$restaurant->restaurant->id}}"><i class="fas fa-star" style="color:yellow"></i></a>
					@endif
					@endguest
					<span class="badge badge-danger">Destacado</span></h5>
					<small><i class="fas fa-map-marker-alt"></i> {{$restaurant->restaurant->direccion}} - <i class="fas fa-utensils"></i> {{$restaurant->restaurant->categorias}}</small><br>
					<small><b>Tipo de envio:</b>

					@if($restaurant->restaurant->configuracion->domicilio)
						- Delivery 
						@endif

						@if($restaurant->restaurant->configuracion->local)
						- Retiro en local 	 
						@endif
					</small><br>
					<small><b>Costo de envío:</b> 
					@if($restaurant->restaurant->configuracion->enviomodo == 1)
					Envío Gratis
					@elseif($restaurant->restaurant->configuracion->enviomodo == 2)
					Variable según la zona
					@elseif($restaurant->restaurant->configuracion->enviomodo == 3)
					${{$restaurant->restaurant->configuracion->envio}}
					@endif
					</small>
				</div>

				<a class="btn btn-warning ml-3 d-none d-sm-block" href="{{url('restaurant').'/'.$restaurant->restaurant->slug}}" role="button">Ver Menú</a>
				<a class="btn btn-warning ml-3 d-block d-sm-none" href="{{url('restaurant').'/'.$restaurant->restaurant->slug}}" role="button">Ver</a>
		</div>
		<hr>
		@endforeach
			
		@foreach($restaurantes as $restaurant)
		<div class="media" style="padding:5px">
			@if($restaurant->restaurant->logo == '')
			<img class="mr-3" src="{{asset('img/favicon.png')}}" width="64px" height="64px" alt="Generic placeholder image">
			@else
			<img class="mr-3" src="{{asset('storage').'/'.$restaurant->restaurant->logo}}" width="64px" height="64px" alt="Generic placeholder image">
			@endif
				<div class="media-body">
					<h5 class="mt-0">{{title_case($restaurant->restaurant->nombre_del_restaurante)}} 
					@guest
					@else
					<?php $favorito = App\Favorito::where('user_id' , '=' , Auth::user()->id)->where('restaurant_id' , '=' , $restaurant->restaurant->id)->first(); ?>
					@if($favorito == null)
					<a href="{{url('favorito/marcar').'/'.$restaurant->restaurant->id}}"><i class="far fa-star" style="color:yellow"></i></a>
					@else
					<a href="{{url('favorito/desmarcar').'/'.$restaurant->restaurant->id}}"><i class="fas fa-star" style="color:yellow"></i></a>
					@endif
					@endguest
					 </h5>
					<small><i class="fas fa-map-marker-alt"></i> {{$restaurant->restaurant->direccion}} - <i class="fas fa-utensils"></i> {{$restaurant->restaurant->categorias}}</small><br>
					<small><b>Tipo de envio:</b>

					@if($restaurant->restaurant->configuracion->domicilio)
						- Delivery 
						@endif

						@if($restaurant->restaurant->configuracion->local)
						- Retiro en local 	 
						@endif
					</small><br>
					<small><b>Costo de envío:</b> @if($restaurant->restaurant->configuracion->enviomodo == 1)
					Envío Gratis
					@elseif($restaurant->restaurant->configuracion->enviomodo == 2)
					Variable según la zona
					@elseif($restaurant->restaurant->configuracion->enviomodo == 3)
					${{$restaurant->restaurant->configuracion->envio}}
					@endif
				</small>
				</div>

				<a class="btn btn-warning ml-3 d-none d-sm-block" href="{{url('restaurant').'/'.$restaurant->restaurant->slug}}" role="button">Ver Menú</a>
				<a class="btn btn-warning ml-3 d-block d-sm-none" href="{{url('restaurant').'/'.$restaurant->restaurant->slug}}" role="button">Ver</a>
		</div>
		<hr>
		@endforeach
		  
        </div>
		
      </div>
      <!-- /.row -->

            

  </div>
    <!-- /.container -->

      @endsection