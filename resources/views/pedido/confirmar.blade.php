@extends ('layouts.base')

@section ('contenido')


<!-- Estos linea es para las migajas-->
<nav class="teal">
  <div class="nav-wrapper container">
    <div class="col s12">
      <a href="#!" class="breadcrumb">Mant.</a>
      <a href="{{ url('pedido')}}" class="breadcrumb">Pedido</a>
      <a href="{{ action('PedidoController@confirmar') }}" class="breadcrumb">confirmar</a>
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
  
  {{Form::open ( array('action' => array('PedidoController@confirmar_update'), 'method'=>'put')) }}
  
  <div class="row">
    <div class="col s12 center">
      <h5>Confirmar pedido</h5>
    </div>
  </div>
  

  <div class="row">

    <div class="col s12 m5 l4">

      <div class="card">

        <div class="card-content teal white-text">
          <i class="material-icons prefix">account_circle</i>
          <span class="card-title">Cliente</span>               
        </div>

        <div class="card-content">
          
          <div class="row">
            <!--codigo del cliente esta oculto pero sera actualizado por JS-->
            <input id="idCliente" type="hidden" value="" name="idCliente">


            <div class="input-field col s6">                      
              <input id="numeroDocumento" type="text" class="validate"  readonly value="" name="numeroDocumento">
              <label for="numeroDocumento">Documento</label>
            </div>                    
                        
          </div> 

          <div class="row">

            <div class="input-field col s12">
              <input id="nombreCompleto" type="text" class="validate"  readonly value="" name="nombreCompleto">
              <label for="nombreCompleto">Nombre completo</label>
            </div>
                        
          </div>

          <br>
        </div>


        <div class="card-action right-align">                  
            <a href="#modalConfirmar" class="modal-trigger waves-effect waves-teal btn-flat blue-text">Buscar</a>
        
        </div>
      
      </div><!--fin de la tarjeta-->
    </div>

    <div class="col s12 m7 l8">

      <div class="card">

        <div class="card-content teal white-text">

          <i class="material-icons prefix">location_on</i>
          <span class="card-title">Pago del pedido</span> 

        </div>

        <div class="card-content">

          <div class="row">

            <div class="input-field col s6">
              <input id="idPedido" type="text" value="{{ old('idPedido') }}" name="idPedido" readonly>
              <label for="idPedido">Código pedido</label>
            </div> 

            <div class="input-field col s6">
              <i class="material-icons prefix">today</i>
              <input id="fechaRegistro" type="text"  value="{{ old('fechaRegistro') }}" name="fechaRegistro" readonly>
              <label for="fechaRegistro">Fecha registro</label>
            </div>

          </div>
          

          <div class="row">  

            <div class="input-field col s6">
              <input id="montoOriginal" type="number" min="0" step="0.01" class="" value="{{ old('montoOriginal') }}" name="montoOriginal" readonly>
              <label for="montoOriginal" data-error="wrong" data-success="right">Monto original (S/.)</label>
            </div>   

          </div>


          <div class="row">
            
            <div class="input-field col s6">
              <input id="montoPagado" type="number" min="0" step="0.01" class="" value="{{ old('montoPagado') }}" name="montoPagado">
              <label for="montoPagado" data-error="wrong" data-success="right">Monto pagado (S/.)</label>
            </div>

            <div class="input-field col s6">
              <input id="montoPendiente" type="number" min="0" step="0.01"  value="{{ old('montoPendiente') }}" name="montoPendiente" readonly>
              <label for="montoPendiente" data-error="wrong" data-success="right">Monto pendiente (S/.)</label>
            </div>

          </div>

          
  
            
        </div>
      </div>
    </div>


  </div>
         

          <!--Los botones del formulario-->
          <div class="row" id="guardar">

            <div class="input-field col s12 right-align">
              <a class="waves-effect waves-light btn" href="{{ url('pedido')}}">Cancelar</a>
              <button class="btn waves-effect waves-light" type="submit" name="action" id="btnGuardar">Confirmar
                <i class="material-icons right">send</i>
              </button>                
            </div>              
          </div>
          
        {{ Form::close()}}
      </div>

      @include('pedido.modalConfirmar')
    

@stop

@section ('scriptcontenido')
<script>  
    

    $(document).ready(function() {

        

     // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();   

    //Inicio: agregar pedido a confirmar desde el modal
    $("#btnAgregarPedidoModal").click(function(){
      agregarPedido();      
      
    });
    //fin:

    //Inicio: AJAX para actualizar la busqueda del pedido del modal
    $("#btnBuscarPedidoModal").click(function(){
      mcIdPedido = $("#mcIdPedido").val();
      bcNumeroDocumento = $("#mcNumeroDocumento").val();

      miUrl=  "{{ url('pedido/buscarPedidos') }}";
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

      $.ajax({        
        type: "GET",   
        url: miUrl,
        dataType : "JSON",
        data: {
            idPedido: mcIdPedido,
            numeroDocumento: bcNumeroDocumento,
            _token: CSRF_TOKEN
        },
        success: function(data){

          console.log(data);  // for testing only
          
          $.each(data, function(){
            
            $('#tblBuscarPedido tbody').empty();
            $.each(this, function(k, value){
              
              $('#tblBuscarPedido').append('<tr>'+
                                                '<td><input type="radio" name="radPedido" id="id'+k+'"><label for="id'+k+'">'+value.idPedido+'</label></td>'+
                                                '<td>'+value.nombreCliente+' '+value.apellidoPaternoCliente+' '+ value.apellidoMaternoCliente+'</td>'+
                                                '<td>'+value.numeroDocumentoCliente+'</td>'+                                           
                                                '<td>'+value.fechaRegistro+'</td>'+
                                                '<td>'+value.montoTotal+'</td>'+

                                                '<td hidden>'+value.idPedido+'</td>'+
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


  //apoyo del modal buscar pedido
  function agregarPedido(){
    $('#tblBuscarPedido tbody tr').each(function (index2) {

      
      var radio = $(this).find("td").eq(0).find("input").is(":checked"); //me indica si el radio fue seleccionado o no :)
      var nombre = $(this).find("td").eq(1).html();
      var numeroDocumento = $(this).find("td").eq(2).html();
      var fechaRegistro = $(this).find("td").eq(3).html();
      var montoTotal = $(this).find("td").eq(4).html();
      var idPedido = $(this).find("td").eq(5).html(); //oculto

      //alert(nombre +" "+ numeroDocumento+ " "+ credito +" " +telefono+" " + idZona + " "+ nombreZona +" "+ direccion +" " + referencia);
      
      if (radio){ //veo quien fue seleccionado      
        //Actualizamos los valores de los campos:
        $("#idPedido").val(idPedido);
        $("#numeroDocumento").val(numeroDocumento);
        $("#nombreCompleto").val(nombre);

        $("#fechaRegistro").val(fechaRegistro);
        $("#montoOriginal").val(montoTotal);
        
        Materialize.updateTextFields(); //para que funcione el materialize
        return false; //esto hace que acabe la iteracion
      }
      

    });   
    
  }
  
  
</script>

@stop