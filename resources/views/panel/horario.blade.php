@extends('panel.principal')
@section('titulo')
Horarios y envío
@endsection
@section('content')
<form action="{{url('/actualizar/horario')}}" method="post" class="form-horizontal form-material">
    {{ csrf_field() }}

            <h3>Horario</h3>
                                    <div class="form-group">
                                        <label class="col-md-12">Lunes</label>
                                        <div class="row">
                                            <div class="col-sm-3">
                                            <input type="time" placeholder="desde" value="{{$lunes[0]}}" name="lunes[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="hasta" value="{{$lunes[1]}}" name="lunes[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="hasta" value="{{$lunes[2]}}" name="lunes[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="hasta" value="{{$lunes[3]}}" name="lunes[]" class="form-control form-control-line" required>
                                        </div>
                                        </div>
                                    </div>
                                    
                                <div class="form-group">
                                    <label class="col-md-12">Martes</label>
                                        <div class="row">
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="desde" value="{{$martes[0]}}" name="martes[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="hasta" value="{{$martes[1]}}" name="martes[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="desde" value="{{$martes[2]}}" name="martes[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="hasta" value="{{$martes[3]}}" name="martes[]" class="form-control form-control-line" required>
                                        </div>
                                        </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label class="col-md-12">Miércoles</label>
                                        <div class="row">
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="desde" value="{{$miercoles[0]}}" name="miercoles[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="hasta" value="{{$miercoles[1]}}" name="miercoles[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="desde" value="{{$miercoles[2]}}" name="miercoles[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="hasta" value="{{$miercoles[3]}}" name="miercoles[]" class="form-control form-control-line" required>
                                        </div>
                                        </div>
                                </div>
                                   
                                <div class="form-group">
                                    <label class="col-md-12">Jueves</label>
                                        <div class="row">
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="desde" value="{{$jueves[0]}}" name="jueves[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="hasta" value="{{$jueves[1]}}" name="jueves[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="desde" value="{{$jueves[2]}}" name="jueves[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="hasta" value="{{$jueves[3]}}" name="jueves[]" class="form-control form-control-line" required>
                                        </div>
                                        </div>
                                </div>
                                   
                                <div class="form-group">
                                    <label class="col-md-12">Viernes</label>
                                        <div class="row">
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="desde" value="{{$viernes[0]}}" name="viernes[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="hasta" value="{{$viernes[1]}}" name="viernes[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="desde" value="{{$viernes[2]}}" name="viernes[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="hasta" value="{{$viernes[3]}}" name="viernes[]" class="form-control form-control-line" required>
                                        </div>
                                        </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-12">Sábado</label>
                                        <div class="row">
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="desde" value="{{$sabado[0]}}" name="sabado[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="hasta" value="{{$sabado[1]}}" name="sabado[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="desde" value="{{$sabado[2]}}" name="sabado[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="hasta" value="{{$sabado[3]}}" name="sabado[]" class="form-control form-control-line" required>
                                        </div>
                                        </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label class="col-md-12">Domingo</label>
                                        <div class="row">
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="desde" value="{{$domingo[0]}}" name="domingo[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="hasta" value="{{$domingo[1]}}" name="domingo[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="desde" value="{{$domingo[2]}}" name="domingo[]" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="time" placeholder="hasta" value="{{$domingo[3]}}" name="domingo[]" class="form-control form-control-line" required>
                                        </div>
                                        </div>
                                   </div>


<h3>Datos de Envíos</h3>

<div class="text-left">
                            
                                   <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="checkbox" name="domicilio" value="1" class="form-check-input" 

                                      @if ($config->domicilio == 1)
                                      checked
                                      @else
                                      @endif
                                      >
                                      Entregas a domicilio
                                    </label>
                                  </div>

                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="checkbox" name="local" value="1" class="form-check-input"
                                      @if ($config->local == 1)
                                      checked
                                      @else
                                      @endif
                                      >
                                      Retiro en el Local
                                    </label>
                                  </div>
                      <h3>Formas de Pago</h3>

                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="checkbox" name="tarjetadelivery" value="1" class="form-check-input"
                                      @if ($config->tarjetadelivery == 1)
                                      checked
                                      @else
                                      @endif
                                      >
                                      Tarjeta al delivery
                                    </label>
                                  </div>

                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="checkbox" name="efectivodelivery" value="1" class="form-check-input"
                                      @if ($config->efectivodelivery == 1)
                                      checked
                                      @else
                                      @endif
                                      >
                                      Efectivo al delivery
                                    </label>
                                  </div>

                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="checkbox" name="tarjetalocal" value="1" class="form-check-input"
                                      @if ($config->tarjetalocal == 1)
                                      checked
                                      @else
                                      @endif
                                      >
                                      Tarjeta al Local
                                    </label>
                                  </div>

                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="checkbox" name="efectivolocal" value="1" class="form-check-input"
                                      @if ($config->efectivolocal == 1)
                                      checked
                                      @else
                                      @endif
                                      >
                                      Efectivo al Local
                                    </label>
                                  </div>
</div>

<h3>Costo de envío</h3>

<div class="container">
  <div class="form-check">
    <input class="form-check-input formaenvio" type="radio" name="enviomodo" id="gratis" value="1" @if($config->enviomodo == 1) checked @endif >
    <label class="form-check-label" for="gratis">Envío gratis</label>
  </div>

  <div class="form-check">
    <input class="form-check-input formaenvio" type="radio" name="enviomodo" id="segunzona" value="2" @if($config->enviomodo == 2) checked @endif  >
    <label class="form-check-label" for="segunzona">Variable según Zona</label>
  </div>

  <div class="form-check">
    <input class="form-check-input formaenvio" type="radio" name="enviomodo" id="costofijo" value="3" @if($config->enviomodo == 3) checked @endif  >
    <label class="form-check-label" for="costofijo">Costo fijo</label>
  </div>
</div>

<div class="form-group">
                                    <label class="col-md-12">Costo del envío</label>
                                        
                                            <div class="col-md-12">
                                            <input type="number" value="{{$config->envio}}" placeholder="Costo del envío local" value="" step="0.5" name="envio" id="costoenvio" class="form-control form-control-line" required>
                                        
                                   </div>
                                   </div>

                                   <div class="form-group">
                                       <button type="submit" class="btn btn-success">Actualizar</button>
                                   </div>

                                   


    </form>
@endsection
