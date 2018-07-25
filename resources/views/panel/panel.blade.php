@extends('panel.principal')
@section('titulo')
Panel @if(Auth::user()->tipo == 1) Cliente @elseif(Auth::user()->tipo == 2) Restaurant @endif
@endsection
@section('content')


@if(Auth::user()->tipo == 1) 
 
<h4 class="card-title">Bienvenido! {{title_case(Auth::user()->name)}}</h4>
@elseif(Auth::user()->tipo == 2) 

<h4 class="card-title">Bienvenido! {{title_case(Auth::user()->name)}}</h4>
<p>Tienes 15 días de prueba para utilizar nuestro portal sin límite de ventas!</p>

@endif



@endsection