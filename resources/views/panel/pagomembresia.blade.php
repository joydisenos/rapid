<?php 

 $mp = new MP(env('YOUR_CLIENT_ID'), env('YOUR_CLIENT_SECRET'));
			    $preference_data = array(
			    
			            "items" => array(
			        array(
			            "title" => 'Membresía',
			            "currency_id" => "ARS",
			            "category_id" => "Sitio Web",
			            "quantity" => 1,
			            "unit_price" => (float)$precio
				        )
				    ),
			             "back_urls" => array(
			            "success" => url('panel'),
			            "failure" => url('panel'),
			            "pending" => url('panel')
			        )
				);
        $preference = $mp->create_preference($preference_data);
        header("Location: ".$preference["response"]["init_point"]);
		die();

?>