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
			<img class="mr-3" src="{{asset('img/favicon.png')}}" width="64px" height="64px" alt="Generic placeholder image">
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
					<small><b>Costo de envio:</b>
					@if($restaurant->configuracion->enviomodo == 1)
					Envío Gratis
					@elseif($restaurant->configuracion->enviomodo == 2)
					Variable según la zona
					@elseif($restaurant->configuracion->enviomodo == 3)
					${{$restaurant->configuracion->envio}}
					@endif
					</small><br>
					<small><b>Horario de hoy:</b>
					@if($hoy->format('l') == 'Monday')
					  {{$lunes[0]}} a {{$lunes[1]}}, {{$lunes[2]}} a {{$lunes[3]}}</p>
					  @elseif($hoy->format('l') == 'Tuesday')
					  {{$martes[0]}} a {{$martes[1]}}, {{$martes[2]}} a {{$martes[3]}}
					  @elseif($hoy->format('l') == 'Wednesday')
					  {{$miercoles[0]}} a {{$miercoles[1]}}, {{$miercoles[2]}} a {{$miercoles[3]}}
					  @elseif($hoy->format('l') == 'Thursday')
					  {{$jueves[0]}} a {{$jueves[1]}}, {{$jueves[2]}} a {{$jueves[3]}}
					  @elseif($hoy->format('l') == 'Friday')
					  {{$viernes[0]}} a {{$viernes[1]}}, {{$viernes[2]}} a {{$viernes[3]}}
					  @elseif($hoy->format('l') == 'Saturday')
					  {{$sabado[0]}} a {{$sabado[1]}}, {{$sabado[2]}} a {{$sabado[3]}}
					  @elseif($hoy->format('l') == 'Sunday')
					  {{$domingo[0]}} a {{$domingo[1]}}, {{$domingo[2]}} a {{$domingo[3]}}
					  @endif	
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
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Opiniones ({{$restaurant->comentarios->count()}})</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
<br> 
 
 <hr>
	
@foreach($restaurant->productos->where('estatus','=',1) as $producto)
	<div class="media">
			@if($producto->foto == '')
			
			@if($restaurant->logo == '')
			<!-- Logo Por Defecto -->
			<img class="mr-3" src="{{asset('img/favicon.png')}}" width="64px" height="64px" alt="Generic placeholder image">
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


<div class="modal fade" id="producto{{$producto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	  
        <div class="media">
			
        	@if($producto->foto == '')
			
			@if($restaurant->logo == '')
			<!-- Logo Por Defecto -->
			<img class="mr-3" src="{{asset('img/favicon.png')}}" width="64px" height="64px" alt="Generic placeholder image">
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



<form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-12 control-label">E-Mail</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12 control-label">Contraseña</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Mantener sesión abierta
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-danger">
                                    Iniciar Sesión
                                </button>
                                 <a class="btn btn-outline-danger" href="{{url('register')}}">
                                    Registro
                                </a>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Olvido su contraseña?
                                </a>
                            </div>
                        </div>
                    </form>

@else

<form action="{{url('nueva/compra')}}" method="post">
	{{ csrf_field() }}
	<input type="hidden" value="{{$producto->id}}" name="producto_id">
	<input type="hidden" value="{{$restaurant->id}}" name="restaurant_id">
	<input type="hidden" value="{{$producto->precio}}" name="precio" id="precio{{$producto->id}}">

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
		
		<option selected value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		<option value="32">32</option>
		<option value="33">33</option>
		<option value="34">34</option>
		<option value="35">35</option>
		<option value="36">36</option>
		<option value="37">37</option>
		<option value="38">38</option>
		<option value="39">39</option>
		<option value="40">40</option>
		<option value="41">41</option>
		<option value="42">42</option>
		<option value="43">43</option>
		<option value="44">44</option>
		<option value="45">45</option>
		<option value="46">46</option>
		<option value="47">47</option>
		<option value="48">48</option>
		<option value="49">49</option>
		<option value="50">50</option>
		
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
      </form>
      @endguest


	
</div>
	
  </div>
</div>


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
  
  <p>Dirección: {{$restaurant->direccion}} - {{$restaurant->ciudad}}</p>
  <p>Teléfono: {{$restaurant->telefono}}</p>
  <h6>Horario de hoy:</h6>
  @if($hoy->format('l') == 'Monday')
  <p>Lunes: {{$lunes[0]}} a {{$lunes[1]}}, {{$lunes[2]}} a {{$lunes[3]}}</p>
  @elseif($hoy->format('l') == 'Tuesday')
  <p>Martes: {{$martes[0]}} a {{$martes[1]}}, {{$martes[2]}} a {{$martes[3]}}</p>
  @elseif($hoy->format('l') == 'Wednesday')
  <p>Miercoles: {{$miercoles[0]}} a {{$miercoles[1]}}, {{$miercoles[2]}} a {{$miercoles[3]}}</p>
  @elseif($hoy->format('l') == 'Thursday')
  <p>Jueves: {{$jueves[0]}} a {{$jueves[1]}}, {{$jueves[2]}} a {{$jueves[3]}}</p>
  @elseif($hoy->format('l') == 'Friday')
  <p>Viernes: {{$viernes[0]}} a {{$viernes[1]}}, {{$viernes[2]}} a {{$viernes[3]}}</p>
  @elseif($hoy->format('l') == 'Saturday')
  <p>Sábado: {{$sabado[0]}} a {{$sabado[1]}}, {{$sabado[2]}} a {{$sabado[3]}}</p>
  @elseif($hoy->format('l') == 'Sunday')
  <p>Domingo: {{$domingo[0]}} a {{$domingo[1]}}, {{$domingo[2]}} a {{$domingo[3]}}</p>
  @endif

  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
  @foreach($restaurant->comentarios as $comentario)
  <div class="row">
  	<div class="col-md-4 mt-4 text-center">
  @switch($comentario->puntos)
    @case(1)
        <i style="color:yellow" class="fas fa-star"></i>
        @break

    @case(2)
        <i style="color:yellow" class="fas fa-star"></i>
        <i style="color:yellow" class="fas fa-star"></i>
        @break

    @case(3)
        <i style="color:yellow" class="fas fa-star"></i>
        <i style="color:yellow" class="fas fa-star"></i>
        <i style="color:yellow" class="fas fa-star"></i>
        @break

    @case(4)
        <i style="color:yellow" class="fas fa-star"></i>
        <i style="color:yellow" class="fas fa-star"></i>
        <i style="color:yellow" class="fas fa-star"></i>
        <i style="color:yellow" class="fas fa-star"></i>
        @break

    @case(5)
        <i style="color:yellow" class="fas fa-star"></i>
        <i style="color:yellow" class="fas fa-star"></i>
        <i style="color:yellow" class="fas fa-star"></i>
        <i style="color:yellow" class="fas fa-star"></i>
        <i style="color:yellow" class="fas fa-star"></i>
        @break

    @default
        <i style="color:yellow" class="fas fa-star"></i>
@endswitch
  	</div>
  	<div class="col-md-8 mt-4">
  		<div class="text-center">
  			<p><b>"{{$comentario->comentario}}"</b></p>
  			<p>{{title_case($comentario->user->name)}} {{title_case($comentario->user->apellido)}}</p>
  		</div>
  	</div>
  </div>
  <hr>
  @endforeach
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
