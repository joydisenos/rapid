@extends('layouts.rapid')
@section('content')
<!-- Page Content -->
    <div class="container">

      <div class="row">
        <div class="col-sm-12">
         <br>
		 <h3>Último paso: ¡Finalizá tu pedido a {{$restaurant->nombre_del_restaurante}}</h3>
		 
		<hr>
		
        </div>
        <div class="col-md-8">
		<form action="{{url('checkout')}}" method="post">
			{{csrf_field()}}
			<input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
			<input type="hidden" name="envio" value="0">

		<br> 
			
			<b>Seleccioná tu direccion de entrega</b>
				<hr>

				@if(Auth::user()->direcciones->count() == 0)
				<h6>No tienes direcciones registradas!</h6>
				<button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#direccion">
				Registrar direccion
				</button>
				@endif
				
				@foreach(Auth::user()->direcciones as $direccion)
				<div class="custom-control custom-radio">
					<input type="radio" id="direccion{{$direccion->id}}" name="direccion" class="custom-control-input" value="{{$direccion->id}}">
					<label class="custom-control-label" for="direccion{{$direccion->id}}"><b>Casa</b> {{$direccion->direccion}} <a href="#">Editar</a></label>
				<hr>
				
				</div>
				@endforeach
				<hr>
				
			<b>Seleccioná un medio de pago</b>
				<hr>
				
			<div class="custom-control custom-radio">
					<input type="radio" id="efectivo" name="delivery" value="1" class="custom-control-input">
					<label class="custom-control-label" for="efectivo"><b>Efectivo al Delivery o en el Local</b></label>
			</div>
			
			<div class="custom-control custom-radio">
					<input type="radio" id="tarjeta" name="delivery" value="2" class="custom-control-input">
					<label class="custom-control-label" for="tarjeta"><b>Tarjeta al Delivery o en el Local</b></label>
			</div>
			
			<hr>
			
			
			<b>Notas Adicionales (opcional)</b>
				 <div class="form-group">
    <label for="exampleFormControlTextarea1">Paga con cambio / entre calles (opcional)</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="adicional"></textarea>
  </div>	
	<hr>
<button class="btn btn-warning" style="width:100%;" type="submit">Enviar Pedido</button>
</form>
<br><br>
	

	
		
		</div>
		 
		 
		 <div class="col-md-4">
			@include('includes.mipedido')
			<hr>
		 </div>
		 
		
      </div>
      <!-- /.row -->

      <div class="row">
        
		<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	  
        <div class="media">
			<img class="mr-3" src="https://img.pystatic.com/restaurants/app24-logo-thumb-burger-king-terminal-1.png" width="64px" height="64px" alt="Generic placeholder image">
				<div class="media-body">
				<h5 class="mt-0">Titulo - Producto con/sin imagen</h5>
				<small>Descripcion del producto - small ..</small><br>
					
				</div>
				
	</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <small>Si tiene sabores mostrar aqui</small><br>
	  <div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="customCheck1">
				<label class="custom-control-label" for="customCheck1">Sabor 1</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="customCheck2">
				<label class="custom-control-label" for="customCheck2">Sabor 2</label>
		</div>
		
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="customCheck3">
				<label class="custom-control-label" for="customCheck3">Sabor 3</label>
		</div>
	  <small>Si tiene Adicionales mostrar aqui</small>
		
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="customCheck4">
				<label class="custom-control-label" for="customCheck4">Adicional 1 + $Precioadicional</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="customCheck5">
				<label class="custom-control-label" for="customCheck5">Adicional 2 + $Precioadicional</label>
		</div>
		
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="customCheck6">
				<label class="custom-control-label" for="customCheck6">Adicional 3 $Precioadicional</label>
		</div>
		

		<hr>
		
	<small>Si no tiene sabores ni adicionales mostrar un select para saber que cantidad de este producto desea *El select mostrarlo igual para saber cuantos productos desea tenga o no sabores/adicionales</small>
	
	<select class="custom-select">
		<option selected>Seleccionar cantidad</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
	</select>
	<hr>
	<div class="form-group">
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Agregar aclaraciones"></textarea>
  </div>
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning">Agregar ($Precio este modal)</button>
      </div>
	  
    
	
</div>
	
  </div>
</div>

		
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Modal -->
<div class="modal fade" id="direccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Dirección</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('direccion/nueva')}}" method="post" class="form-horizontal form-material">

            {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="col-md-12">Dirección</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" name="direccion" class="form-control form-control-line" required></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Ciudad</label>
                                        <div class="col-md-12">
                                            <input type="text" name="ciudad" placeholder="ciudad" class="form-control form-control-line" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Barrio (opcional)</label>
                                        <div class="col-md-12">
                                            <input type="text" name="barrio" placeholder="barrio" class="form-control form-control-line">
                                        </div>
                                    </div>


                                    <div class="container">
                                        
                                                                                  

                                        <div class="row">

                                            <div class="col">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>  
                                            
                                            <div class="col">
                                            <button class="btn btn-primary">Registrar</button>
                                        </div>
                                        


                                        </div>
                                    </div>
                                </form>
      </div>
     
    </div>
  </div>
</div>
@endsection