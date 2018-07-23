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

      


      @endsection