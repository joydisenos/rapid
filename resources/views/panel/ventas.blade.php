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

@foreach($ventas as $venta)
<tr>
    <td>{{title_case($venta->user->name)}} {{title_case($venta->user->apellido)}}</td>
    <td>{{$venta->user->telefono}}</td>
    <td>{{$venta->user->email}}</td>
    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#venta{{$venta->id}}"><!-- Insertar modal con detalles -->Detalles</button></td>
    <td>{{$venta->created_at->format('d/m')}}</td>
    <td>{{$venta->total}}</td>
    <td>
        <form action="{{url('venta').'/'.$venta->id}}" method="post">
        {{csrf_field()}}
        <select name="entrega" id="entrega" class="form-control">
            <option value="1" 
            @if($venta->estatus == 1)
            selected
            @endif
            >Pendiente</option>
            <option value="2"
            @if($venta->estatus == 2)
            selected
            @endif
            >Entregado</option>
            <option value="3"
            @if($venta->estatus == 3)
            selected
            @endif
            >Cancelado</option>
        </select>
        <button class="btn btn-primary">Marcar</button>
        </form>
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
        
        @if($venta->delivery == 1)
        <p>Retiro en Local</p>
        @elseif($venta->delivery == 0)
        <p>Envío a domicilio</p>
        @endif

        @if($venta->pago == 1)
        <p>Pago con efectivo</p>
        @elseif($venta->pago == 2)
        <p>Pago con tarjeta</p>
        @endif

        @if($venta->delivery == 1)
        @else
        <p><strong>Dirección a entregar: </strong> {{$venta->direccion->direccion}}, {{$venta->direccion->ciudads->nombre}}, {{$venta->direccion->barrio}}</p>
        @endif

        <p>{{$venta->adicional}}</p>

        
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
                        <td>${{$compra->precio}}</td>
                    </tr>
                    @endforeach

                    <tr>
                        <td></td>
                        <td></td>
                        <td><strong>Envío</strong></td>
                        <td>${{$venta->envio}}</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td><strong>Total</strong></td>
                        <td>${{$venta->total}}</td>
                    </tr>
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
<h4 class="card-title">Aún no tienes ventas registradas, comparte tu restaurante con clientes y comienza a multiplicar tus pedidos hoy mismo! </h4>
@endif
@endsection