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
          

          <meta name="csrf-token" content="{{ csrf_token() }}" />

          {{Form::open (array('url' => 'pedido', 'method'=>'POST'))}} <!--para llamar al store, se le llama igual que al index, pero con metodo post-->
          
          <div class="row">
            <div class="col s12 center">
              <h5>Datos generales</h5>
              <div class="divider"></div>
            </div>
          </div>
          

          <div class="row">

            

            <div class="col s12 m12 l6">
              <div class="card">

                <div class="card-content">
                  <i class="material-icons prefix">account_circle</i>
                  <span class="card-title">Datos del cliente</span>
                  <br><br>
                  <div class="row">
                    <!--codigo del cliente esta oculto pero sera actualizado por JS-->
                    <input id="idCliente" type="hidden" value="" name="idCliente">

                    <div class="input-field col s6">                      
                      <input id="numeroDocumento" type="text" class="validate"  disabled value="" name="numeroDocumento">
                      <label for="numeroDocumento">Documento</label>
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
        @include('pedido.modalCliente')

@stop


@section ('scriptcontenido')

<script>

  $(document).ready(function(){

     // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();


    //Inicio: para que agrege a la tabla:
    evaluar();

    $("#btnAgregarModal").click(function(){
      agregar();      
      evaluar();
    });
    //Fin: para que agrege a la tabla

    //Inicio: agregar cliente
    $("#btnAgregarClienteModal").click(function(){
      agregarCliente();      
      
    });
    //fin: agregar cliente

    //Inicio: AJAX para actualizar la busqueda del modal
    $("#btnBuscarModal").click(function(){
      bMarca = $("#bMarca").val();
      bNombre = $("#bNombre").val();

      miUrl=  "{{ url('pedido/buscarArticulos') }}";
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

      

      $.ajax({        
        type: "POST",   
        url: miUrl,
        dataType : "JSON",
        data: {
            marca: bMarca,
            nombre: bNombre,
            _token: CSRF_TOKEN
        },
        success: function(data){

          console.log(data);  // for testing only
          $.each(data, function(){
            
            $('#tblBuscarArticulos tbody').empty();
            $.each(this, function(k, value){
              

              $('#tblBuscarArticulos').append('<tr>'+
                                                '<td><input type="number" name="" step="0.5" min="0.5" class="validate" ></td>'+
                                                '<td>'+value.nombreUnidadMedida+'</td>'+
                                                '<td><input type="hidden" name=""  value="'+value.idArticulo+'">'+value.nombre+'</td>'+
                                                '<td>'+value.nombreMarca+'</td>'+
                                                '<td><input type="number" name="" step="0.01" min="0.01" class="validate" value="'+value.precioBase+'"></td>'+
                                              '</tr>');

            });
            
            
         
          });
           
        },
        error: function (e) {
          console.log(e.responseText);
        },

      });
       
      
    });
    //Inicio: AJAX para actualizar la busqueda del modal


    //Inicio: AJAX para actualizar la busqueda cliente del modal
    $("#btnBuscarClienteModal").click(function(){
      bcNombre = $("#bcNombre").val();
      bcNumeroDocumento = $("#bcNumeroDocumento").val();

      miUrl=  "{{ url('pedido/buscarClientes') }}";
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

      

      $.ajax({        
        type: "POST",   
        url: miUrl,
        dataType : "JSON",
        data: {
            nombre: bcNombre,
            numeroDocumento: bcNumeroDocumento,
            _token: CSRF_TOKEN
        },
        success: function(data){

          console.log(data);  // for testing only
          
          $.each(data, function(){
            
            $('#tblBuscarClientes tbody').empty();
            $.each(this, function(k, value){
              
              if (value.credito == 1){
                  datoCredito = 'Si';
              }
              else 
                datoCredito = 'No';


              $('#tblBuscarClientes').append('<tr>'+
                                                '<td><input type="radio" name="radCliente" id="id'+k+'"><label for="id'+k+'">'+value.idCliente+'</label></td>'+
                                                '<td>'+value.nombres+' '+value.apellidoPaterno+' '+ value.apellidoMaterno+'</td>'+
                                                '<td>'+value.numeroDocumento+'</td>'+
                                                '<td>'+value.fechaNacimiento+'</td>'+
                                                '<td>'+datoCredito+'</td>'+
                                                '<td hidden>'+value.telefono+'</td>'+

                                                '<td hidden>'+value.idZona+'</td>'+
                                                '<td hidden>'+value.direccion+'</td>'+
                                                '<td hidden>'+value.referencia+'</td>'+
                                                '<td hidden>'+value.idCliente+'</td>'+
                                                '<td hidden>'+value.nombreZona+'</td>'+
                                              '</tr>');

            });
            
           
          });
          
        },
        error: function (e) {
          console.log(e.responseText);
        },

      });
       
      
    });
    //Inicio: AJAX para actualizar la busqueda del modal

  });

  //funciones y variables de apoyo para la tabla de articulos
  contador=0;
  total =0;
  subtotal=[];

  function agregar(){
    $('#tblBuscarArticulos tbody tr').each(function (index2) {

      var cantidad = $(this).find("td").eq(0).find("input").val();
      var unidadMedida = $(this).find("td").eq(1).html();
      var idArticulo = $(this).find("td").eq(2).find("input").val();
      var nombreArticulo = $(this).find("td").eq(2).html();
      var marca = $(this).find("td").eq(3).html();
      var precio = $(this).find("td").eq(4).find("input").val();
      if (cantidad!="" && precio != ""){ //me aseguro que los campos tengan datos.
        subtotal[contador]= cantidad*precio;
        total= total+ subtotal[contador];
      
      
      var fila =  '<tr class="selected" id="fila'+contador+'">'+                    
                    '<td><input type="hidden" name="cantidades[]" value="'+cantidad+'">'+cantidad+'</td>'+
                    '<td><input type="hidden" name="idArticulos[]" value="'+idArticulo+'"> ('+unidadMedida+') '+nombreArticulo+ ' - '+marca+'</td>'+
                    '<td><input type="hidden" name="preciosUnitarios[]" value="'+precio+'">'+precio+'</td>'+
                    '<td>'+precio*cantidad+'</td>'+
                    '<td><a class="modal-trigger" href="#!" onclick="eliminar('+contador+');" title="Eliminar"><i class="material-icons">delete</i></a></td>'
                  '</tr>';

      contador++;

      //actualizamos el total
      $("#montoTotalH").html("S/. "+ total); //valor que muestro
      $("#montoTotal").val(total); //valor que envio al controller
      //agregamos al detalle      
      $("#detalles").append(fila);

      //limpiamos el campos
      $(this).find("td").eq(0).find("input").val("");

      }
    });   
    
  }

  function evaluar(){
    if (total>0){
      //$("#btnGuardar").show();
      $("#btnGuardar").prop("disabled", false);

    }
    else {
      //$("#guardar").hide();
      $("#btnGuardar").prop("disabled", true);
    }
  }

  function  eliminar (index){
    total= total-subtotal[index];
    $("#montoTotalH").html("S/. "+ total);
    $("#montoTotal").val(total);
    $("#fila"+index).remove();
    evaluar();
  }
  


  //funciones y variables de apoyo para el cliente
  function agregarCliente(){
    $('#tblBuscarClientes tbody tr').each(function (index2) {

      
      var radio = $(this).find("td").eq(0).find("input").is(":checked"); //me indica si el radio fue seleccionado o no :)
      var nombre = $(this).find("td").eq(1).html();
      var numeroDocumento = $(this).find("td").eq(2).html();
      var credito = $(this).find("td").eq(4).html();
      var telefono = $(this).find("td").eq(5).html();
      var idZona = $(this).find("td").eq(6).html();
      var direccion = $(this).find("td").eq(7).html();
      var referencia = $(this).find("td").eq(8).html();
      var idCliente = $(this).find("td").eq(9).html();
      var nombreZona = $(this).find("td").eq(10).html();

      //alert(nombre +" "+ numeroDocumento+ " "+ credito +" " +telefono+" " + idZona + " "+ nombreZona +" "+ direccion +" " + referencia);
      
      if (radio){ //veo quien fue seleccionado      
        //Actualizamos los valores de los campos:
        $("#idCliente").val(idCliente);
        $("#numeroDocumento").val(numeroDocumento);
        $("#nombreCompleto").val(nombre);
        $("#credito").val(credito);

        $("#telefono").val(telefono);
        $("#direccion").val(direccion);
        $("#referencia").val(referencia);

        $("#idZona option[value='"+idZona+"']").attr("selected", true);
        $("#idZona").material_select();
        //$("#idZona").val('"'+idZona+'"');

        Materialize.updateTextFields(); //para que funcione el materialize
        return false; //esto hace que acabe la iteracion

      }
      

    });   
    
  }


</script>
@stop

