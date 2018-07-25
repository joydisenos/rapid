<p><b>Mi Pedido</b></p>
			<center><h4>Su pedido vacio <br>¿Con hambre?</h4>
			<p class="lead">Agregá lo que quieras pedir.</p>
			</center>
@guest
@else
			<div class="table-responsive">
				<table class="table">
					<thead>
						<th>Compra</th>
						<th>Detalles</th>
						<th>Precio</th>
						<th> <i class="fas fa-trash"></i> </th>
					</thead>
					    @foreach(Auth::user()->compras->where('pedido_id','=',0)->where('restaurant_id','=', $restaurant->id) as $compra)
					    <tr>
					    	<td>{{$compra->producto->nombre}}</td>
					    	<td>{{$compra->adicionales}} , {{$compra->sabores}}</td>
					    	<td>$precio</td>
					    	<td> <a href="{{url('compra/eliminar'.'/'.$compra->id)}}"> <i class="fas fa-minus"></i> </a> </td>
					    </tr>
					    @endforeach
				</table>
			</div>
			@endguest