@extends('panel.principal')
@section('titulo')
Agregar Producto
@endsection
@section('content')
<form action="{{url('producto/nuevo')}}" method="POST" enctype="multipart/form-data">

	 {{ csrf_field() }}
	<input type="hidden" name="categoria_id" value="1">
	<input type="hidden" name="foto" value="foto">
	<div class="container">
		

		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-8">
				<img src="{{asset('storage/restaurant.png')}}" alt="Foto de producto" width="200" id="producto_prev">
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
				<input type="text" name="nombre" class="form-control" placeholder="Nombre del producto" required>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-4">
				<p>Precio</p>
			</div>
			<div class="col-md-8">
				<input type="number" step="0.5" name="precio" class="form-control" placeholder="Precio del producto" required>
			</div>
		</div>

		<hr>

		
		<div class="row">
			<div class="col-md-4">
				<p>Sabores <small>separados por coma</small></p>
			</div>
			<div class="col-md-8">
				
					<input type="text" id="sabores" name="sabores" class="form-control" placeholder="(opcional) sabores separados por coma ','">
				

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
				¿Desea agregar adicionales a su producto?
			</div>
			<div class="col-md-8">
				<button type="button" class="btn btn-primary" id="adicionales">
 				Agregar adicionales
				</button>
			</div>
		</div>

		<hr>

		<div class="agregar">
			
		</div>

		
		

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

var form = " <div class='row'><div class='col-md-4'><p>Adicional</p></div><div class='col-md-4'><input type='text' name='adicional[]' class='form-control' placeholder='Nombre'></div><div class='col-md-4'><input type='number' step='0.5' name='precio_adicional[]' class='form-control' placeholder='Precio'></div></div> "

$('#adicionales').click(function(){
	$('.agregar').append(form);
});

</script>
@endsection