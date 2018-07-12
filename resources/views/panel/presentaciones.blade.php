@extends('panel.principal')
@section('titulo')
Agregar Presentaciones
@endsection
@section('content')
<p>Agregue las presentaciones o tamaños junto con el precio del producto <strong>{{$producto->nombre}}</strong></p>
<form action="">
	
	{{ csrf_field() }}

	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<p>Presentación</p>
			</div>
			<div class="col-sm-8">
				<input type="text" name="nombre" class="form-control" placeholder="Nombre de la presentación" required>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-sm-4">
				<p>Precio</p>
			</div>
			<div class="col-sm-8">
				<input type="text" name="precio" class="form-control" placeholder="Nombre de la Precio" required>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col">
				<button type="submit" class="btn btn-danger">Agregar</button>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table">
				<thead>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Eliminar</th>
				</thead>
				<tbody>
					@foreach($producto->presentaciones as $presentacion)
					<tr>
						<td>{{$presentacion->nombre}}</td>
						<td>{{$presentacion->precio}}</td>
						<td><a href="#"><i class="fa fa-trash"></i></a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
</form>
@endsection