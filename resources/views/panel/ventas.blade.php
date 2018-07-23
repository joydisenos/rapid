@extends('panel.principal')
@section('titulo')
Ventas
@endsection
@section('content')

<h4 class="card-title">Listado de Ventas</h4>
                                <div class="table-responsive m-t-40">
                                    <table class="table stylish-table">
                                        <thead>
                                            <tr>
                                                <th>Cantidad</th>
                                                <th>Nombre</th>
                                                <th>Detalles</th>
                                                <th>Precio</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                           
                                            <tr>
                                                <td>6</td>
                                                <td>
                                                    <h6>Perros Calientes</h6><small class="text-muted">Comida rápida</small></td>
                                                <td>Comida rápida familiar</td>
                                                <td>$45</td>
                                                <td>Entregado</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
@endsection