
@extends('panel.principal')
@section('titulo')
Panel @if(Auth::user()->tipo == 1) Cliente @elseif(Auth::user()->tipo == 2) Restaurant @endif
@endsection
@section('content')


@if(Auth::user()->tipo == 1) 
 
<h4 class="card-title">Bienvenido! {{title_case(Auth::user()->name)}}</h4>

@elseif(Auth::user()->tipo == 2) 

<h4 class="card-title">Bienvenido! {{title_case(Auth::user()->name)}}</h4>
<p>Tienes {{$expira}} días de prueba para utilizar nuestro portal sin límite de ventas!</p>
@if($expira <= 5)
<?php 

 $mp = new MP(env('YOUR_CLIENT_ID'), env('YOUR_CLIENT_SECRET'));
			    $preference_data = array(
			            "items" => array(
			        array(
			          
			            "title" => 'Membresía',
			            "currency_id" => "ARS",
			            "category_id" => "Sitio Web",
			            "quantity" => 1,
			            "unit_price" => (float)$preferencias->precio_membresia
				        )
				    ),
			             "back_urls" => array(
			            "success" => url('membresia/aprobado'),
			            "failure" => url('membresia/fail'),
			            "pending" => url('membresia/pendiente')
			        )
				);
        $preference = $mp->create_preference($preference_data);

?>
<a href="{{$preference['response']['init_point']}}" class="lightblue-M-Ov-ArOn" mp-mode="redirect" name="MP-Checkout" onreturn="execute_my_onreturn">Pagar Membresía</a>
<script type="text/javascript">
(function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
</script>
@endif



@endif



@endsection
