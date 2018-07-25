@extends('layouts.principal')
@section('content')
<header id="header-style-1">
         @include('includes.nav')

          <div class="container">
            <div class="header-caption">
              <div class="row">
                <div class="col-md-12 header-content text-center" style="padding:150px 10px;">
                  <h3 class="header-title animated fadeInDown p-4" style="color:#000"><span class="text-primary">Rapidelly </span> - Los mejores restaurantes en un sólo lugar</h3>
                  <h5 class="header-text animated fadeIn" style="color:#000">Selecciona tu ciudad</h5>
                      <form action="{{url('/restaurantes')}}"  method="post">
                         {{ csrf_field() }}
                      <select name="ciudad" id="" class="form-control">
                          @foreach($ciudades as $ciudad)
                          <option value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
                          @endforeach
                      </select>
                      <button type="submit" class="page-scroll btn btn-lg btn-default-filled animated fadeInUp">Buscar</button>
                      </form>
              
                  
                </div>
              </div>
            </div>


          </div>

        </header>

        <div class="header-style-2">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-6">
              <div class="hero-content-v2">
                <h3>Tienes un local? <strong>Aumenta tus ventas</strong></h3>
                
                <a href="{{url('/alta')}}" class="page-scroll btn btn-lg btn-default-filled">Sumar mi Local!</a>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6">
              <figure>
                <img src="img/bg/hero-1.png" alt="">
              </figure>
            </div>

          </div>
        </div>
      </div>


      


      @endsection