@extends('panel.principal')
@section('titulo')
Productos
@endsection
@section('content')

<a href="{{url('producto/nuevo')}}" class="btn btn-primary mb-4"> <i class="fa fa-plus"></i> Nuevo</a>

<h4 class="card-title">Listado de Productos</h4>
                                <div class="table-responsive m-t-40">
                                    <table class="table stylish-table">
                                        <thead>
                                            <tr>
    <th>Imagen</th>
    <th>Nombre</th>
    <th>Sabores</th>
    <th>Precio</th>
    <th>Adicionales</th>
    <th>Detalles</th>
    <th>Activar/Ocultar</th>
    <th>Editar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
    @foreach(Auth::user()->productos as $producto)
    <tr>
        <td>
            @if($producto->foto == '')
            <span class="round round-warning">P</span>
            @else
            <img src="{{asset('storage').'/'.$producto->foto}}" class="img-fluid" alt="{{$producto->nombre}}">
            @endif
        </td>
        <td>
            <h6>{{$producto->nombre}}</h6><small class="text-muted">{{$producto->categoria_id}}</small></td>
        <td>{{$producto->sabores}}</td>
        <td>${{$producto->precio}}</td>
        <td>
            
            @if(count($producto->presentaciones))
            <a href="{{url('producto/presentaciones').'/'.$producto->id}}"><i class="fa fa-edit"></i> Modificar</a> <br>
            @foreach($producto->presentaciones as $presentacion)
            {{$presentacion->presentacion}}, ${{$presentacion->precio}} <br>
            @endforeach
            @else
            <a href="{{url('producto/presentaciones').'/'.$producto->id}}"><i class="fa fa-plus"></i> Agregar</a>
            @endif
        </td>
        <td>{{$producto->descripcion}}</td>
        <td>
            @if($producto->estatus == 1)
            <a href="{{url('/activar').'/'.$producto->id.'/2'}}" class="btn btn-danger">Ocultar</a>
            @elseif($producto->estatus == 2)
            <a href="{{url('/activar').'/'.$producto->id.'/1'}}" class="btn btn-warning">Mostrar</a>
            @endif
        </td>
        <td><a href="{{url('producto/edit').'/'.$producto->id}}" class="btn btn-danger"><i class="fa fa-edit"></i> Editar</a></td>
    </tr>
    @endforeach
                                        </tbody>
                                    </table>
                                </div>
@endsection