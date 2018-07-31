@extends('admin.principal')
@section('titulo')
Admin Restaurantes
@endsection
@section('content')




<div class="table-responsive m-t-40">
                                    <table class="table stylish-table">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Email</th>
                                                <th>Teléfono</th>
                                                <th>Tipo</th>
                                                <th>Estatus</th>
                                                <th>Localidad</th>
                                                <th>Ciudad (asignada)</th>
                                                <th>Seleccionar Ciudad</th>
                                                <th>Expira membresía</th>
                                                <th>Expira destacado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($usuarios as $usuario)
                                            <tr>
                                                <td>{{$usuario->name}} {{$usuario->apellido}}</td>
                                                <td>
                                                 {{$usuario->email}}</td>
                                                <td>{{$usuario->telefono}}</td>
                                                <td>
                                                	@if($usuario->tipo == 1)
                                                	Cliente
                                                	@else
                                                	Restaurant
                                                	@endif
                                                </td>
                                                <td>
                                                @if($usuario->estatus == 1)
                                                	
                                                    <a href="{{url('admin/restaurantes/a/0').'/'.$usuario->id}}" class="btn btn-warning">Activo</a>
                                                	@else
                                                    <a href="{{url('admin/restaurantes/a/1').'/'.$usuario->id}}" class="btn btn-danger">Suspendido</a>
                                                	
                                                	@endif
                                                </td>
                                                <td>
                                                	{{title_case($usuario->localidad)}}
                                                </td>
                                                <td>
                                                	@if($usuario->ciudad == 0)
                                                	<span style="color:red;">No Asignado</span>
                                                	@else
                                                	{{title_case($usuario->ciudads->nombre)}}
                                                	@endif
                                                </td>
                                                <td>
                                                	<form action="{{url('admin/asignar')}}" method="post">
                                                		{{ csrf_field() }}
                                                		<input type="hidden" name="user_id" value="{{$usuario->id}}">
                                                		<select class="form-control" name="ciudad">
                                                            <option>Seleccione la ciudad</option>
                                                			<option value="0">Desactivar</option>
                                                			@foreach($ciudades as $ciudad)
                                                			<option value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
                                                			@endforeach
                                                		</select>
                                                		<button class="btn btn-primary" type="submit">Asignar</button>
                                                	</form>
                                                </td>
                                                <td>
                                                	<form action="{{url('admin/restaurantes/e').'/'.$usuario->id}}" method="post">
                                                        {{csrf_field()}}
                                                     <input type="date" name="fecha" value="{{$usuario->expira}}" class="form-control">
                                                    <button type="submit" class="btn btn-primary">Asignar</button>
                                                        
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{url('admin/restaurantes/d').'/'.$usuario->id}}" method="post">
                                                        {{csrf_field()}}
                                                     <input type="date" name="fecha" value="{{$usuario->destacado}}" class="form-control">
                                                    <button type="submit" class="btn btn-primary">Asignar</button>
                                                        
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
@endsection