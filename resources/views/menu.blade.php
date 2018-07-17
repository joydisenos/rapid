@extends('layouts.principal')
@section('content')
<header id="header-style-1">
         @include('includes.nav')

          <div class="container">
            <div class="header-caption">
              <div class="row">
                <div class="col-md-12 header-content text-center" style="padding:150px 10px;">
                  <h3 class="header-title animated fadeInDown p-4" style="color:#000"><span class="text-primary">Rapidelly </span> - {{$restaurant->nombre_del_restaurante}}</h3>
                  <h5 class="header-text animated fadeIn" style="color:#000">{{$restaurant->descripcion}}</h5>
                      
                  
                </div>
              </div>
            </div>
          </div>

        </header>

    
            <!--<div class="page-header-title">
              <h2 class="heading-title text-center">Productos</h2>
            </div>-->
            <div class="features-wrap mt-4">
              


              @foreach($restaurant->productos->where('estatus','=',1)->chunk(2) as $row)


              <div class="row">
                @foreach($row as $producto)
                <div class="col-md-6 col-sm-6">
                  <div class="featured-box">
                    <div class="featured-icon">
                      <i class="fa fa-plus"></i>
                    </div>
                    <div class="featured-content text-center">
                      <h4>{{title_case($producto->nombre)}}</h4>
                      <div class="text-right">
                        <p>${{$producto->precio}}</p>
                      </div>
                      <p>{{$producto->descripcion}}</p>
                    </div>
                  </div>
                </div>
                @endforeach
                

                
              </div>

              @endforeach
            </div>

            
           
   
@endsection