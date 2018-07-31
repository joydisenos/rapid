@component('mail::message')
# Pedido Realizado <br>

<p>se ha recibido el siguiente pedido:</p>

<div class="table-responsive m-t-40">
                                    <table class="table stylish-table">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Detalles</th>
                                                <th>Precio</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>

                                        	 </tbody>
                                    </table>
                                </div>



<p>En breves momentos procesaremos su solicitud! Para mayor información puede comunicarse con nosotros por el teléfono:  o por nuestro correo electrónico: <a href="#">#</a></p>

@component('mail::button', ['url' => 'http://www.rapidelly.com'])
Ir a mis compras
@endcomponent

Todos los Derechos Reservados, Rapidelly.com<br>
{{ config('app.name') }}
@endcomponent
