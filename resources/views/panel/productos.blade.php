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
                                                <th>Detalles</th>
                                                <th>Precio</th>
                                            </tr>
                                        </thead>
                                        <tbody>
    @foreach(Auth::user()->productos as $producto)
    <tr>
        <td><span class="round round-warning">P</span></td>
        <td>
            <h6>{{$producto->nombre}}</h6><small class="text-muted">{{$producto->categoria_id}}</small></td>
        <td>{{$producto->descripcion}}</td>
        <td>${{$producto->precio}}</td>
    </tr>
    @endforeach
                                        </tbody>
                                    </table>
                                </div>
@endsection