@extends('panel.principal')
@section('titulo')
Compras
@endsection
@section('content')
Contenido del Card
@if( session('pedido'))

{{session('pedido')->id}}
@endif
@endsection