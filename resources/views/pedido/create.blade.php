@extends ('layouts.base')

@section ('contenido')


        <!-- Estos linea es para las migajas-->
        <nav class="teal">
          <div class="nav-wrapper container">
            <div class="col s12">
              <a href="#!" class="breadcrumb">Mant.</a>
              <a href="{{ url('pedido')}}" class="breadcrumb">Pedido</a>
              <a href="{{ url('pedido/create')}}" class="breadcrumb">Registrar</a>
            </div>
          </div>
        </nav>






        


        <!--Contenido del cuerpo-->
        <br>
        <div class="container">
          {{Form::open (array('url' => 'pedido', 'method'=>'POST'))}} <!--para llamar al store, se le llama igual que al index, pero con metodo post-->
          <div class="row">
            <div class="col s12 m10 l8 offset-m1 offset-l2 ">
              <div class="card">
                <div class="card-content">
                  
                    <div class="row">
                      <h4 class="teal-text">Registrar nuevo pedido</h4>
                    </div>
                    
                    <!--Mostrara los errores que se hayan cometido:-->
                    @if (count($errors)>0)
                    <div class="alert">
                      <ul>
                          @foreach ($errors -> all() as $error)
                            <li>{{$error}}</li>
                          @endforeach
                      </ul>
                    </div>
                    @endif

                    <div class="row">
                      <h5>Tipo de pedido</h5>
                    </div>

                    <div class="row">

                      <div class="input-field col s12">
                                            
                        <input name="tipoPedido" type="radio" id="tipoPedido1" value='1' @if (old('tipoPedido') ==  1) checked="checked" @endif />
                        <label for="tipoPedido1">Presencial</label>
                        
                        <input name="tipoPedido" type="radio" id="tipoPedido2" value='2' @if (old('tipoPedido') ==  2) checked="checked" @endif />
                        <label for="tipoPedido2">Por teléfono</label>                    
                        
                      </div>
                      
                    </div>

                    <br>
                    <div class="row">
                      <h5>Datos del cliente</h5>
                    </div>
                    
                    <div class="row">
      
                      <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <select name="idCliente">                          
                          <option value="">Seleccionar</option>
                          @foreach ($clientes as $cliente)
                            <option value="{{$cliente->idCliente}}" @if ($cliente->idCliente == old('idCliente') ) selected @endif>{{$cliente->numeroDocumento}} {{$cliente->nombres}}</option>
                          @endforeach
                        </select>
                        <label for ="idCliente">Cliente *</label>
                      </div> 

                      <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="nombreCliente" type="text" class="validate"  disabled value="" name="nombreCliente">
                        <label for="nombreCliente">Nombre</label>
                      </div>
                                  
                    </div>                    
                    
                    <br>
                    <div class="row">
                      <h5>Datos de envío</h5>
                    </div>

                    <div class="row">  

                      <div class="input-field col s6">
                        <i class="material-icons prefix">today</i>
                        <input id="fechaEnvio" type="date" class="datepicker" value="{{ old('fechaEnvio') }}" name="fechaEnvio">
                        <label for="fechaEnvio">Fecha de envío *</label>
                      </div>
                      
                      <div class="input-field col s6">
                        <i class="material-icons prefix">phone</i>
                        <input id="telefono" type="number" min="0" class="validate" value="{{ old('telefono') }}" name="telefono">
                        <label for="telefono" data-error="wrong" data-success="right">Teléfono</label>
                      </div>


                    </div>


                    <div class="row">
                      
                      <div class="input-field col s6">
                        <i class="material-icons prefix">location_on</i>
                        <select name="idZona" id="idZona">                          
                          <option value="">Seleccionar</option>
                          @foreach ($zonas as $zona)
                            <option value="{{$zona->idZona}}" @if ( $zona->idZona == old('idZona') ) selected @endif >{{$zona->nombre}}</option>
                          @endforeach
                        </select>
                        <label for ="idZona">Zona *</label>
                      </div> 

                      <div class="input-field col s6">
                        <i class="material-icons prefix">location_on</i>
                        <input id="direccion" type="text" class="validate" required value="{{ old('direccion') }}" name="direccion">
                        <label for="direccion">Dirección *</label>
                      </div>  

                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <i class="material-icons prefix">location_on</i>
                        <textarea id="referencia" class="materialize-textarea" name="referencia">{{ old('referencia') }}</textarea>
                        <label for="referencia">Referencia</label>
                      </div> 
                    </div>
          
                    
                </div>
              </div>
            </div>
          </div>



          <!--Los botones del formulario-->
          <div class="row">

            <div class="input-field col s12 right-align">
              <a class="waves-effect waves-light btn" href="{{ url('pedido')}}">Cancelar</a>
              <button class="btn waves-effect waves-light" type="submit" name="action">Registrar
                <i class="material-icons right">send</i>
              </button>                
            </div>              
          </div>
          
        {{ Form::close()}}
        </div>

@stop

@section ('scriptcontenido')
<script>  
    

    $(document).ready(function() {

      $('.datepicker').pickadate({ /*es para que funcione e datepicker*/
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 200, // Creates a dropdown of 15 years to control year
        format: 'yyyy/mm/dd'
      });

      /*Para inicar el select*/
      $('select').material_select();     

      

  });

  
  
</script>

@stop
