@extends('panel.principal')
@section('titulo')
Perfil
@endsection
@section('content')


                            <div class="row">
                                <div class="col-md-6">
                                	<center class="m-t-30"> <img src="{{asset('img/Fiesta.jpg')}}" width="150" />
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
                                </center>
                                </div>
                                <div class="col-md-6">

                                	<form action="{{url('/actualizar/usuario')}}" method="post" class="form-horizontal form-material">
                                    {{ csrf_field() }}
                                    
                                    <div class="form-group">
                                        <label class="col-md-12">Número de Teléfono</label>
                                        <div class="col-md-12">
                                            <input type="number" value="{{Auth::user()->telefono}}" name="telefono" class="form-control form-control-line" required>
                                        </div>
                                    </div>
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

        <div class="text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#direccion">
 <i class="fa fa-plus"></i> Agregar Dirección
</button>
       </div>

        <h3>Direcciones Registradas</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th>Dirección</th>
                                            <th>Ciudad</th>
                                            <th>Barrio</th>
                                        </thead>
                                        <tbody>
                                            @foreach(Auth::user()->direcciones as $direccion)
                                            <tr>
                                                <td>{{$direccion->direccion}}</td>
                                                <td>{{$direccion->ciudad}}</td>
                                                <td>{{$direccion->barrio}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
                                        <label class="col-md-12">Dirección</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" name="direccion" class="form-control form-control-line" required></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Ciudad</label>
                                        <div class="col-md-12">
                                            <input type="text" name="ciudad" placeholder="ciudad" class="form-control form-control-line" required>
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