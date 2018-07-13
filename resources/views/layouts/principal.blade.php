<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Rapidelly</title>

        <!-- Fonts -->
       <link rel="stylesheet" href="{{('css/font-awesome.min.css')}}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        <link rel="stylesheet" href="{{asset('css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}">
        <link rel="stylesheet" href="{{asset('css/owl.theme.css')}}">
        <link rel="stylesheet" href="{{asset('css/responsive.css')}}">

    </head>
    <body>
        

            @yield('content')

    <footer class="default-footer text-center bg-danger">
        <div class="container">
          <img class="mb-40 footer-logo img-fluid" src="http://www.rapidelly.com/logo.png" alt="" style="max-width:200px;width:100%;">
          <span class="copy-right dis-blk">Rapidelly - Todos los derechos reservados 2018</span>
          <span class="social">
            <a href="#"><i class="fa fa-facebook" style="color:#fff!important"></i></a>
            <a href="#"><i class="fa fa-twitter" style="color:#fff!important"></i></a>
            
          </span>
        </div>
      </footer>




  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/tether.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/owl.carousel.min.js')}}"></script>

  <script src="{{asset('js/form-validator.min.js')}}"></script>
  <script src="{{asset('js/contact-form-script.js')}}"></script>
  <script src="{{asset('js/main.js')}}"></script>
  @yield('scripts')
    </body>
</html>
