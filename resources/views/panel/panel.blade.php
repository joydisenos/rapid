
@extends('panel.principal')
@section('titulo')
Panel @if(Auth::user()->tipo == 1) Cliente @elseif(Auth::user()->tipo == 2) Restaurant @endif
@endsection
@section('content')


@if(Auth::user()->tipo == 1) 
 
<h4 class="card-title">Bienvenido! {{title_case(Auth::user()->name)}}</h4>

@elseif(Auth::user()->tipo == 2) 

<h4 class="card-title">Bienvenido! {{title_case(Auth::user()->name)}}</h4>
<p>Tienes {{$expira}} días de prueba para utilizar nuestro portal sin límite de ventas!</p>
<a href="{{url('restaurant').'/'.Auth::user()->slug}}" class="btn btn-danger">Mi Restaurant</a>
@if($expira <= 5)
<?php 

 $mp = new MP(env('YOUR_CLIENT_ID'), env('YOUR_CLIENT_SECRET'));
			    $preference_data = array(
			            "items" => array(
			        array(
			          
			            "title" => 'Membresía',
			            "currency_id" => "ARS",
			            "category_id" => "Sitio Web",
			            "quantity" => 1,
			            "unit_price" => (float)$preferencias->precio_membresia
				        )
				    ),
			             "back_urls" => array(
			            "success" => url('membresia/aprobado'),
			            "failure" => url('membresia/fail'),
			            "pending" => url('membresia/pendiente')
			        )
				);
        $preference = $mp->create_preference($preference_data);

?>
<a href="{{$preference['response']['init_point']}}" class="lightblue-M-Ov-ArOn" mp-mode="redirect" name="MP-Checkout" onreturn="execute_my_onreturn">Pagar Membresía</a>
<script type="text/javascript">
(function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
</script>
@endif
@foreach(Auth::user()->ventas->where('estatus','=',1)->chunk(3) as $row)
<div class="row">
	@foreach($row as $venta)
	<div class="col-md-4">
		<div class="card">
		  <div class="card-header bg-danger text-white">
		    Tienes un nuevo pedido!
		  </div>
		  <div class="card-block">
			    <h4 class="card-title">Cliente {{title_case($venta->user->name)}} {{title_case($venta->user->apellido)}}</h4>
			    @if($venta->delivery == 1)
        <p>Retiro en Local</p>
        @elseif($venta->delivery == 0)
        <p>Envío a domicilio</p>
        @endif

        @if($venta->pago == 1)
        <p>Pago con efectivo</p>
        @elseif($venta->pago == 2)
        <p>Pago con tarjeta</p>
        @endif

        @if($venta->delivery == 1)
        @else
        <p><strong>Dirección a entregar: </strong> {{$venta->direccion->direccion}}, {{$venta->direccion->ciudads->nombre}}, {{$venta->direccion->barrio}}</p>
        @endif

        <p>{{$venta->adicional}}</p>
			    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#venta{{$venta->id}}"><!-- Insertar modal con detalles -->Detalles</button>
		  </div>
		</div>
	</div>
	@endforeach
</div>
@endforeach
@foreach(Auth::user()->ventas as $venta)
<!-- Modal -->
<div class="modal fade" id="venta{{$venta->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cliente {{title_case($venta->user->name)}} {{title_case($venta->user->apellido)}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        @if($venta->delivery == 1)
        <p>Retiro en Local</p>
        @elseif($venta->delivery == 0)
        <p>Envío a domicilio</p>
        @endif

        @if($venta->pago == 1)
        <p>Pago con efectivo</p>
        @elseif($venta->pago == 2)
        <p>Pago con tarjeta</p>
        @endif

        @if($venta->delivery == 1)
        @else
        <p><strong>Dirección a entregar: </strong> {{$venta->direccion->direccion}}, {{$venta->direccion->ciudads->nombre}}, {{$venta->direccion->barrio}}</p>
        @endif

        <p>{{$venta->adicional}}</p>

        
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>Producto</th>
                    <th>Detalles</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    
                </thead>
                <tbody>
                    @foreach($venta->compras as $compra)
                    <tr>
                        <td>{{$compra->producto->nombre}}</td>
                        <td>{{$compra->sabores}} {{$compra->adicionales}}</td>
                        <td>{{$compra->cantidad}}</td>
                        <td>${{$compra->precio}}</td>
                    </tr>
                    @endforeach

                    <tr>
                        <td></td>
                        <td></td>
                        <td><strong>Envío</strong></td>
                        <td>${{$venta->envio}}</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td><strong>Total</strong></td>
                        <td>${{$venta->total}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
        <form action="{{url('venta').'/'.$venta->id}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="entrega" value="2">
        <button type="submit" class="btn btn-danger">Entregar</button>
    	</form>
		
		<form action="{{url('venta').'/'.$venta->id}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="entrega" value="3">
        <button type="submit" class="btn btn-outline-danger">Cancelar</button>
    	</form>
        
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->
@endforeach

@endif



@endsection
