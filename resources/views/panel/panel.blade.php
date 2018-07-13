@extends('panel.principal')
@section('titulo')
Panel @if(Auth::user()->tipo == 1) Cliente @elseif(Auth::user()->tipo == 2) Restaurant @endif
@endsection
@section('content')
Contenido del Card
@endsection