@extends('admin.principal')
@section('titulo')
Admin Usuarios
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
                                                	activo
                                                	@else
                                                	suspendido
                                                	@endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
@endsection