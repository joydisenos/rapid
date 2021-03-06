@extends('panel.principal')
@section('titulo')
Compras
@endsection
@section('content')


@if( session('pedido'))



<h5 class="card-title">Pedido realizado Correctamente! a Restaurant {{title_case(session('pedido')->restaurant->nombre_del_restaurante)}}</h5>

<p>se ha recibido el siguiente pedido:</p>

<div class="table-responsive m-t-40">
                                    <table class="table stylish-table">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Detalles</th>
                                                <th>Precio</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                           @foreach(session('pedido')->compras as $compra)

                                           <tr>
                                           	<td>{{$compra->producto->nombre}}</td>
                                           	<td>{{$compra->cantidad}}</td>
                                           	<td>{{$compra->sabores}} {{$compra->adicionales}}</td>
                                           	<td>{{$compra->precio}}</td>
                                           </tr>

                                           @endforeach

                                           <tr>
                                             <td></td>
                                             <td></td>
                                             <td>Envío</td>
                                             <td>{{session('pedido')->envio}}</td>
                                           </tr> 

                                           <tr>
                                             <td></td>
                                             <td></td>
                                             <td>Total</td>
                                             <td>{{session('pedido')->total}}</td>
                                           </tr> 
                                           
                                        </tbody>
                                    </table>
                                </div>
<div class="text-center">
	<p>En breves momentos procesaremos su solicitud! Para mayor información puede comunicarse con nosotros por el teléfono: {{session('pedido')->restaurant->telefono}} o por nuestro correo electrónico: <a href="mailto:{{session('pedido')->restaurant->email}}">{{session('pedido')->restaurant->email}}</a></p>
</div>
@endif



@if(Auth::user()->pedidos->count() > 0)
<div class="table-responsive m-t-40">
                                    <table class="table stylish-table">
                                        <thead>
                                            <tr>
                                                <th>Restaurant</th>
                                                <th>Productos</th>
                                                <th>Total</th>
                                                <th>Estatus</th>
                                                
                                            </tr>

                                        </thead>
                                        <tbody>

@foreach($pedidos as $pedido)
<tr>
	<td>{{$pedido->restaurant->nombre_del_restaurante}}</td>
	<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pedido{{$pedido->id}}"><!-- Insertar modal con detalles -->Detalles</button></td>
	<td>{{$pedido->total}}</td>
	<td>
		@if($pedido->estatus == 1)
		Pendiente
		@elseif($pedido->estatus == 2)

		<span style="color: green;">Entregado</span>
    @if($pedido->comentario == 0)
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#comment" data-restaurant="{{$pedido->restaurant_id}}" data-pedido="{{$pedido->id}}"><!-- Insertar modal con detalles -->Comentar</button>
    @endif
    @elseif($pedido->estatus == 3)
		<span style="color: red;">Cancelado</span>
    @endif
	</td>
</tr>

@endforeach
                                        	</tbody>
                                    </table>
                                </div>

@foreach(Auth::user()->pedidos as $compra)
<!-- Modal -->
<div class="modal fade" id="pedido{{$compra->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Restaurant {{$compra->restaurant->nombre_del_restaurante}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>Producto</th>
                    <th>Detalles</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    
                </thead>
                <tbody>
                    @foreach($compra->compras as $comprasing)
                    <tr>
                        <td>{{$comprasing->producto->nombre}}</td>
                        <td>{{$comprasing->sabores}} {{$comprasing->adicionales}}</td>
                        <td>{{$comprasing->cantidad}}</td>
                        <td>{{$comprasing->precio}}</td>
                    </tr>
                    @endforeach
                     <tr>
                        <td></td>
                        <td></td>
                        <td><strong>Envío</strong></td>
                        <td>{{$compra->envio}}</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td><strong>Total</strong></td>
                        <td>{{$compra->total}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->
@endforeach

@else
<h4 class="card-title">Aún no tienes compras, puedes buscar restaurantes en tu localidad <a href="{{url('/')}}">rapidelly.com</a></h4>
@endif

<div class="modal fade" id="comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comentarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="{{url('comentar')}}" method="post">
      <div class="modal-body">
       
          {{csrf_field()}}
          <input type="hidden" id="restaurant_id" name="restaurant_id">
          <input type="hidden" id="pedido_id" name="pedido_id">
          <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
          
          <div class="row">
            <div class="col-md-4">
               <label class="col-form-label">Valoración:</label>
            </div>
            <div class="col-md-8">
              <div class="estrellas">
          <p class="clasificacion">
            <input id="radio1" type="radio" name="puntos" value="5"><!--
            --><label for="radio1">★</label><!--
            --><input id="radio2" type="radio" name="puntos" value="4"><!--
            --><label for="radio2">★</label><!--
            --><input id="radio3" type="radio" name="puntos" value="3"><!--
            --><label for="radio3">★</label><!--
            --><input id="radio4" type="radio" name="puntos" value="2"><!--
            --><label for="radio4">★</label><!--
            --><input id="radio5" type="radio" name="puntos" value="1"><!--
            --><label for="radio5">★</label>
          </p>
          </div>
            </div>
          </div>
          

          <div class="form-group">
            <label for="message-text" class="col-form-label">Comentario:</label>
            <textarea class="form-control" id="message-text" name="comentario"></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Comentar</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script>
  $('#comment').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var recipient = button.data('restaurant')
  var pedido = button.data('pedido') 


  var modal = $(this)
  modal.find('.modal-title').text('Comentarios')
  modal.find('#restaurant_id').val(recipient)
  modal.find('#pedido_id').val(pedido)
})
</script>
@endsection