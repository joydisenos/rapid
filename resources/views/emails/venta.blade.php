@component('mail::message')
# Pedido Realizado <br>

<p>se ha recibido el siguiente pedido de {{title_case($pedido->user->name)}} {{title_case($pedido->user->apellido)}}, sus datos de contacto son: <b>email:</b> {{$pedido->user->email}} <b>teléfono:</b> {{$pedido->user->telefono}} <br>  al restaurant {{title_case($pedido->restaurant->nombre_del_restaurante)}}:</p>

<p>
@if($pedido->delivery == 1)
        Retiro en Local
        @elseif($pedido->delivery == 0)
        Envío a domicilio
        @endif

        @if($pedido->pago == 1)
        Pago con efectivo
        @elseif($pedido->pago == 2)
        Pago con tarjeta
        @endif

        @if($pedido->delivery == 1)
        @else
        <strong>Dirección a entregar: </strong> {{$pedido->direccion->direccion}}, {{$pedido->direccion->ciudads->nombre}}, {{$pedido->direccion->barrio}}
        @endif
        
        <br>
        {{$pedido->adicional}}
</p>
        

<div class="table-responsive m-t-40">
                                    <table class="table stylish-table">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Detalles</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>

                    @foreach($pedido->compras as $compra)
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
                        <td>${{$pedido->envio}}</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td><strong>Total</strong></td>
                        <td>${{$pedido->total}}</td>
                    </tr>

                                        	 </tbody>
                                    </table>
                                </div>



<p>Contacta con el cliente rápido para mantener excelentes comentarios!</p>

@component('mail::button', ['url' => 'http://www.rapidelly.com/ventas'])
Ir a mis ventas
@endcomponent

Todos los Derechos Reservados, Rapidelly.com<br>
{{ config('app.name') }}
@endcomponent
