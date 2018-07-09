@extends('panel.principal')
@section('titulo')
Agregar Producto
@endsection
@section('content')
<form action="{{url('producto/nuevo')}}" method="POST">

	 {{ csrf_field() }}
	<input type="hidden" name="categoria_id" value="1">
	<input type="hidden" name="foto" value="foto">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<p>Nombre</p>
			</div>
			<div class="col-md-8">
				<input type="text" name="nombre" class="form-control" placeholder="Nombre del producto" required>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-4">
				<p>Precio</p>
			</div>
			<div class="col-md-8">
				<input type="number" name="precio" step="0.05" class="form-control" placeholder="Precio" required>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-4">
				<p>Descripción</p>
			</div>
			<div class="col-md-8">
				<textarea name="descripcion" id="" cols="30" rows="10" class="form-control" placeholder="Descripción del Producto"></textarea>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-4">
				<button type="submit" class="btn btn-primary">Guardar</button>
			</div>
			<div class="col-md-8">
			</div>
		</div>
	</div>
</form>
@endsection