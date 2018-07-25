@extends('panel.principal')
@section('titulo')
Ventas
@endsection
@section('content')

@if(Auth::user()->ventas->count() > 0)
<div class="table-responsive m-t-40">
                                    <table class="table stylish-table">
                                        <thead>
                                            <tr>
                                                <th>Usuario</th>
                                                <th>Teléfono</th>
                                                <th>Email</th>
                                                <th>Detalles</th>
                                                
                                                <th>Fecha</th>
                                                <th>Total</th>
                                                <th>Estatus</th>
                                                
                                                
                                            </tr>

                                        </thead>
                                        <tbody>

@foreach(Auth::user()->ventas as $venta)
<tr>
    <td>{{title_case($venta->user->name)}} {{title_case($venta->user->apellido)}}</td>
    <td>{{$venta->user->telefono}}</td>
    <td>{{$venta->user->email}}</td>
    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#venta{{$venta->id}}"><!-- Insertar modal con detalles -->Detalles</button></td>
    <td>{{$venta->created_at->format('d/m')}}</td>
    <td>{{$venta->total}}</td>
    <td>
        @if($venta->estatus == 1)
        <a href="#" class="btn btn-outline-danger">Entregar</a>
        @elseif($venta->estatus == 2)
        <span style="color: green;">Entregado</span>
        @endif
    </td>
    
</tr>


@endforeach
                                            </tbody>
                                    </table>
                                </div>

@foreach(Auth::user()->ventas as $venta)
<!-- Modal -->
<div class="modal fade" id="venta{{$venta->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cliente {{title_case($venta->user->name)}} {{title_case($venta->user->apellido)}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>Producto</th>
                    <th>Detalles</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    
                </thead>
                <tbody>
                    @foreach($venta->compras as $compra)
                    <tr>
                        <td>{{$compra->producto->nombre}}</td>
                        <td>{{$compra->sabores}} {{$compra->adicionales}}</td>
                        <td>{{$compra->cantidad}}</td>
                        <td>{{$compra->precio}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->
@endforeach

@else
<h4 class="card-title">Aún no tienes compras, puedes buscar restaurantes en tu localidad y ordenar tu comida favorita por <a href="{{url('/')}}">rapidelly.com</a></h4>
@endif
@endsection