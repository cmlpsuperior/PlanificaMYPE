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

          {{Form::open (array('url' => 'pedido', 'method'=>'POST'))}} <!--para llamar al store, se le llama igual que al index, pero con metodo post-->
          <div class="row">

            <div class="col s12 m12 l6">
              <div class="card">

                <div class="card-content">
                  <i class="material-icons prefix">account_circle</i>
                  <span class="card-title">Datos del cliente</span>
                  <br><br>
                  <div class="row">
    
                    <div class="input-field col s6">                      
                      <select name="idCliente">                          
                        <option value="">Seleccionar</option>
                        @foreach ($clientes as $cliente)
                          <option value="{{$cliente->idCliente}}" @if ($cliente->idCliente == old('idCliente') ) selected @endif>{{$cliente->numeroDocumento}}</option>
                        @endforeach
                      </select>
                      <label for ="idCliente">Documento *</label>
                    </div> 

                    <div class="input-field col s6">
                      <input id="credito" type="text" class="validate"  disabled value="" name="credito">
                      <label for="credito">Crédito</label>
                    </div>
                                
                  </div> 

                  <div class="row">
    
                    <div class="input-field col s12">
                      <input id="nombreCompleto" type="text" class="validate"  disabled value="" name="nombreCompleto">
                      <label for="nombreCompleto">Nombre completo</label>
                    </div>
                                
                  </div>


                </div>


                <div class="card-action ">                  
                    <a href="#" class="teal-text">Buscar</a>
                
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
          
          <div class="row"><!--fila de los articulos-->
            <div class="col s12 m12">

              <div class="card">

                <div class="card-content">
                  <i class="material-icons prefix">shopping_cart</i>

                  <span class="card-title">Datos del articulo</span>
                  <br><br>
                  <div class="row">
    
                    <div class="input-field col s12"> 
                      
                      <select name="pIdArticulo" id="pIdArticulo">                          
                        <option value="">Seleccionar</option>
                        @foreach ($articulos as $articulo)
                          <option value="{{$articulo->idArticulo}}" @if ($articulo->idArticulo == old('idArticulo') ) selected @endif>
                            {{$articulo->nombre}} -  {{$articulo->marca->nombre}} ( {{$articulo->unidadMedida->nombre}} )
                          </option>
                        @endforeach
                      </select>
                      <label for ="idCliente">Descripcion*</label>
                    </div> 
                                
                  </div> 

                  <div class="row">
                    
                    <div class="input-field col s6">
                      <input id="pCantidad" type="number" step="0.5" min="0.5" class="validate" required value="{{ old('pCantidad') }}" name="pCantidad">
                      <label for="pCantidad">Cantidad *</label>
                    </div>

                    <div class="input-field col s6">
                      <input id="pPrecioUnitario" type="number" step="0.01" min="0.01" class="validate" required value="{{ old('pPrecioUnitario') }}" name="pPrecioUnitario">
                      <label for="pPrecioUnitario">Precio unitario *</label>
                    </div>
                                
                  </div>

                </div>

                <div class="card-action ">                  
                    <a href="#!" class="teal-text" id="btnAgregar">Agregar a la lista</a>
                
                </div>

              </div><!--fin de la tarjeta-->

            </div>
          </div>
          
          <div class="row">
            <h5>Lista de articulos</h5>
            <table class="bordered highlight responsive-table" id="detalles">
              <thead>
                <tr>
                    <th data-field="cantidad">Cantidad</th>
                    <th data-field="descripcion">Descripción</th>
                    <th data-field="precio">P.U.</th>
                    <th data-field="subtotal">Subtotal</th>
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
                  <th><h5 id="total">S/. 0.00</h5></th>
                  <th></th>
                  
                </tr>

              </tfoot>
            </table>    
                       
          </div>

          <!--Los botones del formulario-->
          <div class="row" id="guardar">

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

  $(document).ready(function(){
    $("#btnAgregar").click(function(){
      agregar();
    })

  });


  contador=0;
  total =0;
  subtotal=[];
  function agregar(){
    idArticulo= $("#pIdArticulo").val();
    articulo= $("#pIdArticulo option:selected").text();
    cantidad= $("#pCantidad").val();
    precioUnitario = $("#pPrecioUnitario").val();

    if (idArticulo!="" && cantidad!="" && cantidad>0 && precioUnitario!=""){
      subtotal[contador]= cantidad*precioUnitario;
      total= total+ subtotal[contador];

      var fila =  '<tr class="selected" id="fila"'+contador+'">'+                    
                    '<td><input type="hidden" name="cantidades[]" value="'+cantidad+'">'+cantidad+'</td>'+
                    '<td><input type="hidden" name="idArticulos[]" value="'+idArticulo+'">'+articulo+'</td>'+
                    '<td><input type="hidden" name="preciosUnitarios[]" value="'+precioUnitario+'">'+precioUnitario+'</td>'+
                    '<td>'+precioUnitario*cantidad+'</td>'+
                  '</tr>';

      contador++;

      limpiar();
      $("#total").html("S/. "+ total);
      evaluar();
      $("#detalles").append(fila);
    }
    else{
      alert("Error al agregar un articulo, verifique que los datos ingresados sean correctos");
    }
  }

  function limpiar(){
    $("#pPrecioUnitario").val("");
    $("#pCantidad").val("");
  }

  function evaluar(){
    if (total>0){
      $("#guardar").show();

    }
    else {
      $("#guardar").hide();
    }
  }

  function  eliminar (index){
    total= total-subtotal[index];
    $("#total").html("S/. "+ total);
    $("#fila"+index).remove();
    evaluar();
  }

</script>
@stop
