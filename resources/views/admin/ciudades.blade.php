@extends('admin.principal')
@section('titulo')
Admin Ciudades
@endsection
@section('content')
<form action="#" method="post">
	
	{{ csrf_field() }}
	

	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<p>Ciudad</p>
			</div>
			<div class="col-sm-8">
				<input type="text" name="ciudad" class="form-control" placeholder="Nombre de la ciudad" required>
			</div>
		</div>

		<hr>

		
		<div class="row">
			
			<div class="col text-right">
				<button type="submit" class="btn btn-danger">Agregar</button>
			</div>
		</div>

		</form>


			<div class="table-responsive">
			<table class="table">
				<thead>
					<th>Ciudad</th>
					<th>Eliminar</th>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
@endsection