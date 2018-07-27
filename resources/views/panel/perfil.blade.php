@extends('panel.principal')
@section('titulo')
Perfil
@endsection
@section('content')


                            <div class="row">
                                <div class="col-md-6">
                                	<center class="m-t-30"> 

                                        @if(Auth::user()->logo == '')
                                        <img src="{{asset('img/Fiesta.jpg')}}" id="perfil_prev" width="150" />
                                        @else
                                        <img src="{{asset('storage').'/'. Auth::user()->logo}}" id="perfil_prev" width="150" />
                                        @endif



                                    <h4 class="card-title m-t-10">{{title_case(Auth::user()->name)}} {{title_case(Auth::user()->apellido)}}</h4>
                                    <h6 class="card-subtitle">Registrado como 

									@if(Auth::user()->tipo == 1)
									Cliente
									@elseif(Auth::user()->tipo == 2)
									Restaurant
									@endif
                                    </h6>
                                    <!--<div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
                                    </div>-->
                                    @if(Auth::user()->tipo == 1)
                                    
                                    @elseif(Auth::user()->tipo == 2)
                                    <!-- Formulario de horarios -->


                                    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#horarios">
  Horarios y envío
</button>

<!-- Modal -->
<div class="modal fade" id="horarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Configuración</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      

      <form action="{{url('/actualizar/horario')}}" method="post" class="form-horizontal form-material">
    {{ csrf_field() }}

            <h3>Horario</h3>
                                    <div class="form-group">
                                        <label class="col-md-12">Lunes</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <input type="time" placeholder="desde" value="{{$lunes[0]}}" name="lunes[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="time" placeholder="hasta" value="{{$lunes[1]}}" name="lunes[]" class="form-control form-control-line" required>
                                        </div>
                                        </div>
                                    </div>
                                    
                                <div class="form-group">
                                    <label class="col-md-12">Martes</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <input type="time" placeholder="desde" value="{{$martes[0]}}" name="martes[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="time" placeholder="hasta" value="{{$martes[1]}}" name="martes[]" class="form-control form-control-line" required>
                                        </div>
                                        </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label class="col-md-12">Miércoles</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <input type="time" placeholder="desde" value="{{$miercoles[0]}}" name="miercoles[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="time" placeholder="hasta" value="{{$miercoles[1]}}" name="miercoles[]" class="form-control form-control-line" required>
                                        </div>
                                        </div>
                                </div>
                                   
                                <div class="form-group">
                                    <label class="col-md-12">Jueves</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <input type="time" placeholder="desde" value="{{$jueves[0]}}" name="jueves[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="time" placeholder="hasta" value="{{$jueves[1]}}" name="jueves[]" class="form-control form-control-line" required>
                                        </div>
                                        </div>
                                </div>
                                   
                                <div class="form-group">
                                    <label class="col-md-12">Viernes</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <input type="time" placeholder="desde" value="{{$viernes[0]}}" name="viernes[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="time" placeholder="hasta" value="{{$viernes[1]}}" name="viernes[]" class="form-control form-control-line" required>
                                        </div>
                                        </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-12">Sábado</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <input type="time" placeholder="desde" value="{{$sabado[0]}}" name="sabado[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="time" placeholder="hasta" value="{{$sabado[1]}}" name="sabado[]" class="form-control form-control-line" required>
                                        </div>
                                        </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label class="col-md-12">Domingo</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <input type="time" placeholder="desde" value="{{$domingo[0]}}" name="domingo[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="time" placeholder="hasta" value="{{$domingo[1]}}" name="domingo[]" class="form-control form-control-line" required>
                                        </div>
                                        </div>
                                   </div>


<h3>Datos de Envíos</h3>

<div class="text-left">
                            
                                   <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="checkbox" name="domicilio" value="1" class="form-check-input" 

                                      @if ($config->domicilio == 1)
                                      checked
                                      @else
                                      @endif
                                      >
                                      Entregas a domicilio
                                    </label>
                                  </div>

                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="checkbox" name="local" value="1" class="form-check-input"
                                      @if ($config->local == 1)
                                      checked
                                      @else
                                      @endif
                                      >
                                      Retiro en el Local
                                    </label>
                                  </div>
                      

                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="checkbox" name="tarjetadelivery" value="1" class="form-check-input"
                                      @if ($config->tarjetadelivery == 1)
                                      checked
                                      @else
                                      @endif
                                      >
                                      Tarjeta al delivery
                                    </label>
                                  </div>

                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="checkbox" name="efectivodelivery" value="1" class="form-check-input"
                                      @if ($config->efectivodelivery == 1)
                                      checked
                                      @else
                                      @endif
                                      >
                                      Efectivo al delivery
                                    </label>
                                  </div>
</div>
<div class="form-group">
                                    <label class="col-md-12">Costo del envío</label>
                                        
                                            <div class="col-md-12">
                                            <input type="number" value="{{$config->envio}}" placeholder="Costo del envío local" value="" step="0.5" name="envio" class="form-control form-control-line" required>
                                        
                                   </div>
                                   </div>

                                   <div class="form-group">
                                       <button type="submit" class="btn btn-success">Actualizar</button>
                                   </div>

                                   


    </form>
      </div>
      
    </div>
  </div>
</div>


                                    <!-- Fin Formulario de horarios -->
                                    @endif
                                </center>
                                </div>
                                <div class="col-md-6">

                                	<form action="{{url('/actualizar/usuario')}}" method="post" class="form-horizontal form-material" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    @if(Auth::user()->tipo == 2)

                                    <div class="form-group">
                                        <label class="col-md-12">Nombre del Restaurante</label>
                                        <div class="col-md-12">
                                            <input type="text" value="{{Auth::user()->nombre_del_restaurante}}" placeholder="Nombre del Restaurant" name="nombre_del_restaurante" class="form-control form-control-line" required>
                                        </div>
                                    </div>

                                    

                                    <div class="form-group">
                                        <label class="col-md-12">Descripción del Restaurante</label>
                                        <div class="col-md-12">
                                            <input type="text" value="{{Auth::user()->descripcion}}" placeholder="Descripción del Restaurant" name="descripcion" class="form-control form-control-line">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Logo</label>
                                        <div class="col-md-12">
                                            <input type="file" name="logo" id="perfil" class="form-control form-control-line">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Dirección</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" class="form-control form-control-line" name="direccion">{{Auth::user()->direccion}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Número de Teléfono</label>
                                        <div class="col-md-12">
                                            <input type="number" value="{{Auth::user()->telefono}}" name="telefono" class="form-control form-control-line" required>
                                        </div>
                                    </div>

                                    @else
                                    
                                    <div class="form-group">
                                        <label class="col-md-12">Imagen de perfil</label>
                                        <div class="col-md-12">
                                            <input type="file" name="logo" id="perfil" class="form-control form-control-line">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Número de Teléfono</label>
                                        <div class="col-md-12">
                                            <input type="number" value="{{Auth::user()->telefono}}" name="telefono" class="form-control form-control-line" required>
                                        </div>
                                    </div>

                                    @endif
                                    <!--
									<div class="form-group">
                                        <label class="col-md-12">Message</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" class="form-control form-control-line"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12">Select Country</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line">
                                                <option>London</option>
                                                <option>India</option>
                                                <option>Usa</option>
                                                <option>Canada</option>
                                                <option>Thailand</option>
                                            </select>
                                        </div>
                                    </div>
                                    -->

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">Actualizar</button>
                                        </div>
                                    </div>
                                </form>

                                

       
		

                           


</div>
</div>


<hr>

<div class="row">
    <div class="col-md-12">


@if(Auth::user()->tipo== 1)
        <div class="text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#direccion">
 <i class="fa fa-plus"></i> Agregar Dirección
</button>
       </div>

        <h3>Direcciones Registradas</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th>Alias</th>
                                            <th>Dirección</th>
                                            <th>Ciudad</th>
                                            <th>Barrio</th>
                                        </thead>
                                        <tbody>
                                            @foreach(Auth::user()->direcciones as $direccion)
                                            <tr>
                                                <td>{{$direccion->alias}}</td>
                                                <td>{{$direccion->direccion}}</td>
                                                <td>{{$direccion->ciudads->nombre}}</td>
                                                <td>{{$direccion->barrio}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
@endif



        </div>
                            </div>
    

                       





<!-- Modal -->
<div class="modal fade" id="direccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Dirección</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('direccion/nueva')}}" method="post" class="form-horizontal form-material">

            {{ csrf_field() }}

            <div class="form-group">
                <label class="col-md-12">Alias</label>
                <div class="col-md-12">
                    <input type="text" rows="5" name="alias" class="form-control form-control-line" placeholder="Ejemplo: casa, oficina..." required>
                </div>
            </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Dirección</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" name="direccion" class="form-control form-control-line" required></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Ciudad</label>
                                        <div class="col-md-12">
                                            <select name="ciudad"  class="form-control form-control-line" required>
                                                <option value="">Seleccione su ciudad</option>
                                                @foreach($ciudades as $ciudad)
                                                <option value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Barrio (opcional)</label>
                                        <div class="col-md-12">
                                            <input type="text" name="barrio" placeholder="barrio" class="form-control form-control-line">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        
                                                                                  

                                        <div class="row">

                                            <div class="col">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>  
                                            
                                            <div class="col">
                                            <button class="btn btn-primary">Registrar</button>
                                        </div>
                                        


                                        </div>
                                    </div>
                                </form>
      </div>
     
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
  function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#perfil_prev').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#perfil").change(function() {
  readURL(this);
});
</script>
@endsection