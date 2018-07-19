@extends('panel.principal')
@section('titulo')
Agregar Adicionales
@endsection
@section('content')
<p>¿Desea agregar adicionales al producto <strong>{{$producto->nombre}}</strong>?</p>
<form action="{{url('presentacion/nuevo')}}" method="post">
	
	{{ csrf_field() }}
	<input type="hidden" value="{{$producto->id}}" name="producto_id">

	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<p>Nombre</p>
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
				<input type="number" step="0.5" name="precio" class="form-control" placeholder="Nombre de la Precio" required>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-sm-4">
				<a href="{{url('productos')}}" class="btn btn-outline-danger">Ir a Productos</a>
			</div>
			<div class="col">
				<button type="submit" class="btn btn-danger">Agregar</button>
			</div>
		</div>

		</form>

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
						<td>{{title_case($presentacion->presentacion)}}</td>
						<td>{{$presentacion->precio}}</td>
						<td><a href="#"><i class="fa fa-trash"></i></a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	

@endsection