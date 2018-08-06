@extends('panel.principal')
@section('titulo')
Favoritos
@endsection
@section('content')
<h4 class="card-title">Restaurantes Favoritos</h4>


<div class="table-responsive m-t-40">
                                    <table class="table stylish-table">
                                        <thead>
                                            <tr>
                                                <th>Restaurant</th>
                                                <th>Descripcion</th>
                                                <th>Direccion</th>
                                                <th>Menu</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
            @foreach(Auth::user()->favoritos as $favorito)
            <tr>
                <td>{{$favorito->restaurant->nombre_del_restaurante}}</td>
                <td>{{$favorito->restaurant->descripcion}}</td>
                <td>{{$favorito->restaurant->direccion}}</td>
                <td> <a href="{{url('restaurant').'/'.$favorito->restaurant->slug}}" class="btn btn-danger">Ver Menu</a> </td>
            </tr>
            @endforeach
 </tbody>
                                    </table>
 </div>
@endsection