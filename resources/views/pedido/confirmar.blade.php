@extends ('layouts.base')

@section ('contenido')


        <!-- Estos linea es para las migajas-->
        <nav class="teal">
          <div class="nav-wrapper container">
            <div class="col s12">
              <a href="#!" class="breadcrumb">Mant.</a>
              <a href="{{ url('pedido')}}" class="breadcrumb">Pedido</a>
              <a href="{{ url('pedido/create')}}" class="breadcrumb">confirmar</a>
            </div>
          </div>
        </nav>



        <!--Contenido del cuerpo-->
        <br>
        <div class="container">
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
          

          <meta name="csrf-token" content="{{ csrf_token() }}" />

          {{Form::open (array('url' => 'pedido', 'method'=>'POST'))}} <!--para llamar al store, se le llama igual que al index, pero con metodo post-->
          
          <div class="row">
            <div class="col s12 center">
              <h5>Confirmar pedido</h5>
              <div class="divider"></div>
            </div>
          </div>
          

          <div class="row">

            

            <div class="col s12 m12 l6">
              <div class="card">

                <div class="card-content">
                  <i class="material-icons prefix">account_circle</i>
                  <span class="card-title">Pedido</span>
                  <br><br>
                  <div class="row">
                    <!--codigo del cliente esta oculto pero sera actualizado por JS-->
                    <input id="idCliente" type="hidden" value="" name="idCliente">


                    <div class="input-field col s6">                      
                      <input id="numeroDocumento" type="text" class="validate"  disabled value="" name="numeroDocumento">
                      <label for="numeroDocumento">Documento</label>
                    </div>                    
                                
                  </div> 

                  <div class="row">
    
                    <div class="input-field col s12">
                      <input id="nombreCompleto" type="text" class="validate"  disabled value="" name="nombreCompleto">
                      <label for="nombreCompleto">Nombre completo</label>
                    </div>
                                
                  </div>

                  <br><br><br><br>
                </div>


                <div class="card-action ">                  
                    <a href="#modalCliente" class="teal-text modal-trigger">Buscar</a>
                
                </div>
              
              </div><!--fin de la tarjeta-->
            </div>

            <div class="col s12 m12 l6">
              <div class="card">
                <div class="card-content">
                  <i class="material-icons prefix">location_on</i>
                  <span class="card-title">Datos de envío</span>
                  <br><br>

                  <div class="row">  

                    <div class="input-field col s6">
                      <i class="material-icons prefix">today</i>
                      <input id="fechaEnvio" type="date" class="datepicker" value="{{ old('fechaEnvio') }}" name="fechaEnvio">
                      <label for="fechaEnvio">Envío *</label>
                    </div>
                    
                    <div class="input-field col s6">
                      <i class="material-icons prefix">phone</i>
                      <input id="telefono" type="number" min="0" class="validate" value="{{ old('telefono') }}" name="telefono">
                      <label for="telefono" data-error="wrong" data-success="right">Teléfono</label>
                    </div>


                  </div>


                  <div class="row">
                    
                    <div class="input-field col s6">

                      <select name="idZona" id="idZona">                          
                        <option value="">Seleccionar</option>
                        @foreach ($zonas as $zona)
                          <option value="{{$zona->idZona}}" @if ( $zona->idZona == old('idZona') ) selected @endif >{{$zona->nombre}}</option>
                        @endforeach
                      </select>
                      <label for ="idZona">Zona *</label>
                    </div> 

                    <div class="input-field col s6">
                      <input id="direccion" type="text" class="validate" required value="{{ old('direccion') }}" name="direccion">
                      <label for="direccion">Dirección *</label>
                    </div>  

                  </div>

                  <div class="row">
                    <div class="input-field col s12">
                      <textarea id="referencia" class="materialize-textarea" name="referencia">{{ old('referencia') }}</textarea>
                      <label for="referencia">Referencia</label>
                    </div> 
                  </div>
          
                    
                </div>
              </div>
            </div>


          </div>

          <div class="row">
            <div class="col s12 center">
              <h5>Lista de articulos</h5>
              <div class="divider"></div>
            </div>
          </div>   

          <div class= "row">
            <div class="col s12 right-align">
              <a class="modal-trigger waves-effect waves-light btn" href="#modalAgregar" id="btnAbrirModalArticulos">Agregar articulos</a>
              
            </div>
            
          </div>

          <div class="row">
            
            <table class="bordered highlight responsive-table" id="detalles">
              <thead>
                <tr>
                    <th data-field="cantidad">Cantidad</th>
                    <th data-field="descripcion">Descripción</th>
                    <th data-field="precio">P.U. (S/.)</th>
                    <th data-field="subtotal">Subtotal (S/.)</th>
                    <th data-field="acciones">Acciones</th>
                </tr>
              </thead>

              <tbody>
                
              </tbody>
              <tfoot>
                <tr>
                  <th>Total</th>
                  <th></th>
                  <th></th>
                  <th><h5 id="montoTotalH" >S/. 0.00</h5></th>
                  <th><input type="hidden" name="montoTotal" id="montoTotal" value=""></th>
                  
                </tr>

              </tfoot>
            </table>    
                       
          </div>

          <!--Los botones del formulario-->
          <div class="row" id="guardar">

            <div class="input-field col s12 right-align">
              <a class="waves-effect waves-light btn" href="{{ url('pedido')}}">Cancelar</a>
              <button class="btn waves-effect waves-light" type="submit" name="action" id="btnGuardar">Registrar
                <i class="material-icons right">send</i>
              </button>                
            </div>              
          </div>
          
        {{ Form::close()}}
        </div>

        @include('pedido.modalAgregar')
    

@stop

@section ('scriptcontenido')
<script>

  $(document).ready(function(){

     // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();



  });
</script>
