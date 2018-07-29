@extends('admin.principal')
@section('titulo')
Precios Rapidelly
@endsection
@section('content')
<form action="{{url('admin/precios')}}" method="post">
	
	{{ csrf_field() }}
	

	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<p>Precio Mensual</p>
			</div>
			<div class="col-sm-8">
				<input type="number" step="0.5" name="precio_membresia" class="form-control" placeholder="Precio de la membresía" value="{{$preferencias->precio_membresia}}" required>
			</div>
		</div>

		<hr>
		
		<div class="row">
			<div class="col-sm-4">
				<p>Precio Destacar</p>
			</div>
			<div class="col-sm-8">
				<input type="number" step="0.5" name="precio_destacado" class="form-control" placeholder="Precio para destacar restaurant" value="{{$preferencias->precio_destacado}}" required>
			</div>
		</div>
		
		<div class="row">
			
			<div class="col text-right">
				<button type="submit" class="btn btn-danger">Guardar</button>
			</div>
		</div>
	</div>
		</form>


		
@endsection