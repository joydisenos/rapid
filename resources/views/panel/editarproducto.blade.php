@extends('panel.principal')
@section('titulo')
Editar Producto {{title_case($producto->nombre)}}
@endsection
@section('content')
<form action="{{url('producto/edit').'/'.$producto->id}}" method="POST" enctype="multipart/form-data">

	 {{ csrf_field() }}
	<input type="hidden" name="categoria_id" value="1">
	<input type="hidden" name="foto" value="foto">
	<div class="container">
		

		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-8">
				@if($producto->foto == '')
				<img src="{{asset('storage/restaurant.png')}}" alt="Foto de producto" width="200" id="producto_prev">
				@else
				<img src="{{asset('storage').'/'.$producto->foto}}" alt="Foto de producto" width="200" id="producto_prev">
				@endif
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<p>Foto</p>
			</div>
			<div class="col-md-8">
				<input type="file" class="form-control" id="foto_producto" name="foto">
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-4">
				<p>Nombre</p>
			</div>
			<div class="col-md-8">
				<input type="text" name="nombre" value="{{$producto->nombre}}" class="form-control" placeholder="Nombre del producto" required>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-4">
				<p>Precio</p>
			</div>
			<div class="col-md-8">
				<input type="number" step="0.5" name="precio" value="{{$producto->precio}}" class="form-control" placeholder="Precio del producto" required>
			</div>
		</div>

		<hr>

		
		<div class="row">
			<div class="col-md-4">
				<p>Sabores <small>separados por coma</small></p>
			</div>
			<div class="col-md-8">
				
					<input type="text" id="sabores" name="sabores" class="form-control" placeholder="(opcional) sabores separados por coma ','" value="{{$producto->sabores}}">
				

			</div>
		</div>

		<hr>

		

		<div class="row">
			<div class="col-md-4">
				<p>Descripción</p>
			</div>
			<div class="col-md-8">
				<textarea name="descripcion" id="" cols="30" rows="10" class="form-control" placeholder="Descripción del Producto">{{$producto->descripcion}}</textarea>
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
@section('scripts')
<script>
  function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#producto_prev').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#foto_producto").change(function() {
  readURL(this);
});


</script>
@endsection