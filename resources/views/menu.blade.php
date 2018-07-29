@extends('layouts.rapid')
@section('content')
 

@guest
@else
@if(Auth::user()->compras->where('pedido_id','=',0)->where('restaurant_id','=',$restaurant->id)->count() > 0)
<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-bottom d-block d-sm-none">
      <div class="container">
		
		<button class="btn btn-warning" style="width:100%;" data-toggle="modal" data-target="#carrito"><font color="white"><i class="fas fa-concierge-bell"></i> Ver pedido ({{Auth::user()->compras->where('pedido_id','=',0)->where('restaurant_id','=',$restaurant->id)->count()}})</font></button>

	  </div>
    </nav>
    @endif
    @endguest

    <!-- Page Content -->
    <div class="container">

      <div class="row">
        <div class="col-sm-12">
          <BR>
		  <div class="media">
			@if($restaurant->logo == '')
			<img class="mr-3" src="https://img.pystatic.com/restaurants/app24-logo-thumb-burger-king-terminal-1.png" width="64px" height="64px" alt="Generic placeholder image">
			@else
			<img class="mr-3" src="{{asset('storage').'/'.$restaurant->logo}}" width="64px" height="64px" alt="{{$restaurant->nombre_del_restaurante}}">
			@endif

				<div class="media-body">
					<h5 class="mt-0">{{title_case($restaurant->nombre_del_restaurante)}} 

						
						@if($abierto == 1)
						<span class="badge badge-success">Abierto</span>
						@else
						<span class="badge badge-danger">Cerrado</span>
						@endif
					</h5>
					<small><i class="fas fa-map-marker-alt"></i> {{$restaurant->direccion}} - {{$restaurant->categorias}}</small><br>
					<small><b>Tipo de envio:</b>
						@if($restaurant->configuracion->domicilio)
						- Delivery 
						@endif

						@if($restaurant->configuracion->local)
						- Retiro en local 	 
						@endif
							
					 </small><br>
					<small><b>Costo de envio:</b> ${{$restaurant->configuracion->envio}}</small><br>
					<!-- <small><b>Horario de hoy:</b> --> 
						
					</small>
				</div>
		</div>
		<hr>
		
        </div>
        <div class="col-md-8">
		
		<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Menú</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Informacion</a>
  </li>
  <!--<li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Opiniones (578)</a>
  </li>-->
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
<br> 
 <b>Categoria por ejemplo (HAMBURGUESAS)</b>
 <hr>
	
@foreach($restaurant->productos->where('estatus','=',1) as $producto)
	<div class="media">
			@if($producto->foto == '')
			
			@if($restaurant->logo == '')
			<!-- Logo Por Defecto -->
			<img class="mr-3" src="https://img.pystatic.com/restaurants/app24-logo-thumb-burger-king-terminal-1.png" width="64px" height="64px" alt="Generic placeholder image">
			@else
			<img class="mr-3" src="{{asset('storage').'/'.$restaurant->logo}}" width="64px" height="64px" alt="Generic placeholder image">
			@endif

			@else
			<img class="mr-3" src="{{asset('storage').'/'.$producto->foto}}" width="64px" height="64px" alt="Generic placeholder image">
			@endif
				<div class="media-body">
					<h5 class="mt-0">{{title_case($producto->nombre)}}</h5>
					<small>{{$producto->descripcion}}</small><br>
					<small><b>Precio ${{$producto->precio}}</b></small>
				</div>
				<button class="btn btn-warning ml-3" data-toggle="modal" data-target="#producto{{$producto->id}}"><b>+</b></button>
	</div>

<hr>

<!-- Modal -->
<form action="{{url('nueva/compra')}}" method="post">
	{{ csrf_field() }}
	<input type="hidden" value="{{$producto->id}}" name="producto_id">
	<input type="hidden" value="{{$restaurant->id}}" name="restaurant_id">
	<input type="hidden" value="{{$producto->precio}}" name="precio" id="precio{{$producto->id}}">

<div class="modal fade" id="producto{{$producto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	  
        <div class="media">
			
        	@if($producto->foto == '')
			
			@if($restaurant->logo == '')
			<!-- Logo Por Defecto -->
			<img class="mr-3" src="https://img.pystatic.com/restaurants/app24-logo-thumb-burger-king-terminal-1.png" width="64px" height="64px" alt="Generic placeholder image">
			@else
			<img class="mr-3" src="{{asset('storage').'/'.$restaurant->logo}}" width="64px" height="64px" alt="Generic placeholder image">
			@endif

			@else
			<img class="mr-3" src="{{asset('storage').'/'.$producto->foto}}" width="64px" height="64px" alt="Generic placeholder image">
			@endif

				<div class="media-body">
				<h5 class="mt-0">{{title_case($producto->nombre)}}</h5>
				<small>{{$producto->descripcion}}</small><br>
					
				</div>
				
	</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  


@guest

<h3>Para realizar Pedidos es necesario ser un usuario registrado</h3>

<div class="row">
	<div class="col">
		<a href="{{url('login')}}" class="btn btn-warning">Iniciar Sesion</a>
	</div>
	<div class="col">
		<a href="{{url('register')}}" class="btn btn-warning">Registro</a>
	</div>
</div>

@else

	  @if($producto->sabores == '')
	  @else
	  <small>Seleccione su sabor</small><br>
	<?php $sabores = explode(',',$producto->sabores); ?>  
	@foreach($sabores as $key=>$sabor)
	<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" value="{{$sabor}}" name="sabores[]" id="sabor{{$key}}{{$producto->id}}">
				<label class="custom-control-label" for="sabor{{$key}}{{$producto->id}}">{{title_case($sabor)}}</label>
	</div>
	
	@endforeach
	<hr>
	@endif
		

	
	@if(count($producto->presentaciones))
		<small>Puede Agregar adicionales a su pedido</small>
	@foreach($producto->presentaciones as $adicional)
	  
		
		
		
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input adicionales{{$producto->id}} dinamico{{$producto->id}}" id="adicional{{$adicional->id}}" name="adicionales[]" value="{{$adicional->presentacion}}" data-precio="{{$adicional->precio}}">
				<label class="custom-control-label" for="adicional{{$adicional->id}}">{{title_case($adicional->presentacion)}}+ ${{$adicional->precio}}</label>
		</div>
		

		

		@endforeach
		<hr>
		@endif
		
	<small>Seleccione la cantidad</small>
	
	<select class="custom-select dinamico{{$producto->id}}" name="cantidad" id="cantidades{{$producto->id}}">
		<option selected value="">Seleccionar cantidad</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
	</select>
	
	
		
		
      
	 @endguest 


	 	</div>
	 @guest

	 
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning" disabled>Agregar $<span id="btnprecio{{$producto->id}}">{{$producto->precio}}</span></button>
      </div>


	 @else
	 

   
      <div class="modal-footer">
        @if(Auth::user()->tipo == 2)
        <div class="text-center bg-warning">
        	<p>Estás logeado como restaurante, para realizar compras debes entrar con una cuenta de cliente</p>
        </div>
        @else
        <button type="submit" class="btn btn-warning">Agregar $<span id="btnprecio{{$producto->id}}">{{$producto->precio}}</span></button>
        @endif
      </div>
      @endguest
	
</div>
	
  </div>
</div>
</form>

<script>
	$(document).ready(function() {


	$('.dinamico{{$producto->id}}').change(function(){	

			var precio = parseFloat( {{$producto->precio}} );
			var total = precio;
			var adicionales = 0;

		$('.adicionales{{$producto->id}}:checked').each(function(){

			
			
			var adicional = parseFloat( $(this).attr('data-precio') );
			
			adicionales += adicional;
			

			

			
			
		});

			var cantidad = $("#cantidades{{$producto->id}} option:selected").val();
			
			var total = (precio + adicionales) * cantidad;

			$('#btnprecio{{$producto->id}}').text(total);
			$('#precio{{$producto->id}}').val(total);

	});

	});
</script>

@endforeach



	

	
  </div>
  
  
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <b>Informacion del restaurante</b>
  
  <p>{{$restaurant->direccion}} - {{$restaurant->ciudad}} - Teléfono: {{$restaurant->telefono}}</p>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
  <b>Opiniones de los usuarios aqui</b>
  <p>Aqui puede ir la opinion de los usuarios sobre este restaurante, (esto podes sacarlo si queres, o dejarlo para implementarlo despues)</p>
  </div>
</div>
		
		</div>
		 
		 
		 <div class="col-md-4 d-none d-sm-block">
			@include('includes.mipedido')
			
			@guest
			@else
			@if(count(Auth::user()->compras->where('pedido_id','=',0)->where('restaurant_id','=',$restaurant->id)))
			<a class="btn btn-warning" style="width:100%;" href="{{url('checkout').'/'.$restaurant->slug}}" role="button"><i class="fas fa-concierge-bell"></i> Continuar</a>
			@endif
			@endguest
			
		<hr> 
		 </div>
		 
		 
		
      </div>
      <!-- /.row -->

      <div class="row">
        

<!-- Modal carrito -->
<div class="modal fade" id="carrito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
			<p><b>Mi pedido</b></p> 
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
      </div>
      
	 <div class="modal-body">
			
			@include('includes.mipedido')
			
	</div>
    
	<div class="modal-footer">
        <a class="btn btn-default" style="width:100%;" data-dismiss="modal" role="button">Volver al menu</a>
		<a class="btn btn-warning" style="width:100%;" href="{{url('checkout').'/'.$restaurant->slug}}" role="button"><i class="fas fa-concierge-bell"></i> Continuar</a>
		
      </div>

    
	
</div>
	
  </div>
</div>

		
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
@endsection
