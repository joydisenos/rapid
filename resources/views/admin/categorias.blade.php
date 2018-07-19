@extends('admin.principal')
@section('titulo')
Admin Categorías
@endsection
@section('content')
<form action="{{url('admin/categoria')}}" method="post">
	
	{{ csrf_field() }}
	

	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<p>Categoria</p>
			</div>
			<div class="col-sm-8">
				<input type="text" name="categoria" class="form-control" placeholder="Nombre de la categoría" required>
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
					<th>Categoría</th>
					<th>Eliminar</th>
				</thead>
				<tbody>
					@foreach($categorias as $categoria)
					<tr>
						<td>{{$categoria->nombre}}</td>
						<td> <a href="{{url('admin/borrar/categoria').'/'.$categoria->id}}"><i class="fa fa-minus"></i></a> </td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection