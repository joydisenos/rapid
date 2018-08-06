<!DOCTYPE html>
<html lang="es">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Pedi comida a domicilio con Rapidelly.com">
    <meta name="author" content="Rapidelly.com">
	<link rel="icon" href="{{asset('img/favicon.png')}}" />

    <title>Rapidelly.com - Pedi comida online</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('vendor/business-frontpage.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <script src="{{asset('vendor/jquery.min.js')}}"></script>


  </head>

  <body>
    <!-- Navigation -->
    @include('includes.nav2')
    @include('includes.error')
    @include('includes.errors')
    @include('includes.notificacion')

    <!-- Page Content -->
    
    @yield('content')



    

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <div class="row">
        	<div class="col">
        		<span class="text-muted text-center">Rapidelly.com - 2018 - Argentina</span>
		<br>
		<img src="{{asset('img/logo.png')}}" width="150px" height="auto"/>
        	</div>
        	@guest

            <div class="col">
                <span class="text-muted text-center">Sumar mi Restaurant</span>
        <br>
        <a class="btn btn-warning btn-lg" data-toggle="modal" data-target="#agregarrestaurant"><b><i class="fas fa-store-alt"></i> Quiero ¡Sumar mi local!</b></a>
            </div>

            
            @else
            
            @endguest

        </div>
      </div>
      <!-- /.container -->
    </footer>

    @include('includes.agregarrestaurant')

    <!-- Bootstrap core JavaScript -->

    <script src="{{asset('vendor/bootstrap.bundle.min.js')}}"></script>
    @yield('scripts')

  </body>

</html>
