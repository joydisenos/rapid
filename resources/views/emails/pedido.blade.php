@component('mail::message')
# Pedido Realizado <br>

<p>Hola, {{title_case($pedido->user->name)}} hemos recibido el siguiente pedido al restaurant {{title_case($pedido->restaurant->nombre_del_restaurante)}}:</p>

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



<p>En breves momentos procesaremos su solicitud! Para mayor información puede comunicarse con nosotros por el teléfono: {{$pedido->restaurant->telefono}} o por nuestro correo electrónico: <a href="mailto:{{$pedido->restaurant->email}}">{{$pedido->restaurant->email}}</a>. {{$pedido->restaurant->direccion}}</p>

@component('mail::button', ['url' => 'http://www.rapidelly.com/compras'])
Ir a mis compras
@endcomponent

Todos los Derechos Reservados, Rapidelly.com<br>
{{ config('app.name') }}
@endcomponent
