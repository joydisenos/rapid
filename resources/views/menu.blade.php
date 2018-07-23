@extends('layouts.rapid')
@section('content')
<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-bottom d-block d-sm-none">
      <div class="container">
		<small><font color="white">Este navbar mostrar cuando agreguen algo al carrito sino, no mostrarlo</font></small>
		<button class="btn btn-warning" style="width:100%;" data-toggle="modal" data-target="#carrito"><font color="white"><i class="fas fa-concierge-bell"></i> Ver pedido ()</font></button>

	  </div>
    </nav>
    

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
					<h5 class="mt-0">{{title_case($restaurant->nombre_del_restaurante)}} <span class="badge badge-success">Abierto</span> o <span class="badge badge-danger">Cerrado</span></h5>
					<small><i class="fas fa-map-marker-alt"></i> {{$restaurant->direccion}} - {{$restaurant->categorias}}</small><br>
					<small><b>Tipo de envio:</b> (Delivery) - (TakeAway) - (Delivery + TakeAway)</small><br>
					<small><b>Costo de envio:</b> Si realiza envios colocar aqui el costo envio (Si el costo es fijo mostrar el precio sino colocar "costo según zona"</small>
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
	
@foreach($restaurant->productos as $producto)
	<div class="media">
			<img class="mr-3" src="https://img.pystatic.com/restaurants/app24-logo-thumb-burger-king-terminal-1.png" width="64px" height="64px" alt="Generic placeholder image">
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
<div class="modal fade" id="producto{{$producto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	  
        <div class="media">
			<img class="mr-3" src="https://img.pystatic.com/restaurants/app24-logo-thumb-burger-king-terminal-1.png" width="64px" height="64px" alt="Generic placeholder image">
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
			<input type="checkbox" class="custom-control-input" value="{{$sabor}}" name="sabores[]" id="sabor{{$key}}">
				<label class="custom-control-label" for="sabor{{$key}}">{{title_case($sabor)}}</label>
	</div>
	@endforeach
	@endif
		
<hr>
	
	@if(count($producto->presentaciones))
		<small>Puede Agregar adicionales a su pedido</small>
	@foreach($producto->presentaciones as $adicional)
	  
		
		
		
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="customCheck6" name="adicionales[]" value="{{$adicional->presentacion}}">
				<label class="custom-control-label" for="customCheck6">{{title_case($adicional->presentacion)}}+ ${{$adicional->precio}}</label>
		</div>
		

		

		@endforeach
		@endif
		
	<small>Seleccione la cantidad</small>
	
	<select class="custom-select" name="cantidad">
		<option selected value="">Seleccionar cantidad</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
	</select>
	<hr>
	
		
		
      
	 @endguest 



	 @guest

	 </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning" disabled>Agregar ${{$producto->precio}}</button>
      </div>


	 @else
    </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning">Agregar ${{$producto->precio}}</button>
      </div>
      @endguest
	
</div>
	
  </div>
</div>
</form>

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
			
			<a class="btn btn-warning" style="width:100%;" href="{{url('checkout').'/'.$restaurant->slug}}" role="button"><i class="fas fa-concierge-bell"></i> Continuar</a>
			
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
			<center><h4>Su pedido vacio <br>¿Con hambre?</h4>
			<p class="lead">Agregá lo que quieras pedir. [Mostrar asi en version movil].</p>
			</center>
	</div>
    
	<div class="modal-footer">
        <a class="btn btn-default" style="width:100%;" data-dismiss="modal" role="button">Volver al menu</a>
		<a class="btn btn-warning" style="width:100%;" href="/checkout.html" role="button"><i class="fas fa-concierge-bell"></i> Continuar</a>
		
      </div>
<center><small>Si no hay nada en el carrito colocar el boton continuar como "disabled"</small>	  </center>
    
	
</div>
	
  </div>
</div>

		
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
@endsection