@extends ('layouts.base')
@section ('contenido')

<!-- Estos linea es para las migajas-->
<nav class="teal">
  <div class="nav-wrapper container">
    <div class="col s12">      
      <a  class="breadcrumb">Envio</a>
      <a  class="breadcrumb">Pendientes</a>
    </div>
  </div>
</nav>

<div class="container">
	<br>
	<div class="row">
	    <div class="col s12 center">
	      <h5>4. Ubicación del cliente</h5>
	    </div>
	</div>
	<!--Mostrara los errores que se hayan cometido:-->
	  @if (count($errors)>0)
	  <div class="row">
	    <div class="alert col s12">
	      <ul>
	          @foreach ($errors -> all() as $error)
	            <li>{{$error}}</li>
	          @endforeach
	      </ul>
	    </div>            
	  </div>
	  @endif
		
	{{Form::open(array('action' => array('EnvioController@buscarCliente_procesar', $viaje->idViaje, $pedido->idPedido ), 'method' => 'POST')) }}
	
	<div class= "row">
		<div class="col s12 m8 l9">

	      	<div class="card">

	      		<div class="card-content teal white-text center">
		          <span class="card-title">Contacto</span>                             
		        </div>
				
				<div class="card-content">
					<div class="row">
						<h6><strong>Cliente</strong></h6>
					</div>
					<div class="row">
			            <div class="input-field col s6">
			              <input id="nombre" type="text"   value="{{ $pedido->cliente->apellidoPaterno }} {{ $pedido->cliente->apellidoPaterno }}, {{ $pedido->cliente->nombres }}" name="nombre" readonly>
			              <label for="nombre">Nombre</label>
			            </div>
			            <div class="input-field col s6">
			              <input id="telefono" type="text"    value="{{ $pedido->cliente->telefono }}" name="telefono" readonly>
			              <label for="telefono">Teléfono</label>
			            </div>
			        </div>
			        <br>
					<div class="row">
						<h6><strong>Ubicación</strong></h6>
					</div>
					<div class="row">
			            <div class="input-field col s6">
			              <input id="zona" type="text"   value="{{ $pedido->zona->nombre }}" name="zona" readonly>
			              <label for="zona">Zona</label>
			            </div>
			            <div class="input-field col s6">
			              <input id="direccion" type="text"   value="{{ $pedido->cliente->direccion }}" name="direccion" readonly>
			              <label for="direccion">Dirección</label>
			            </div>
			        </div>

			        <div class="row">
			            <div class="input-field col s12">
			              	<textarea id="referencia" class="materialize-textarea" name="referencia" readonly>{{ $pedido->cliente->referencia }}</textarea>
                      		<label for="referencia">Referencia</label>
			            </div>
			        </div>
					
				</div>

			</div>
		</div>

		<div class="col s12 m4 l3">
			<!--Tarjeta para registrar la hora de ubicacion del cliente-->
			<div class="card">
				<div class="card-content blue white-text center">
		          <i class="material-icons prefix">check</i>
		          <span class="card-title">Registrar llegada</span>                             
		        </div>
				
				<div class="card-content center">
					<a class="waves-effect waves-blue btn blue" id="btnAlmacen" >Ubicado</a>
					<h6 id="hHoraCliente">Hora ubicado</h6>
					<input type="hidden" value="" id="horaCliente" name="horaCliente">
				</div>

         	</div>	
		
		</div>

	</div>

	
	<div class="row">
	    <div class="col s12">
	      <br><br><br>
	      <div class="divider"></div>
	      
	    </div>
	</div>
	<div class="row">
	    <div class="col s12 right-align">
	      <button class="btn waves-effect waves-light" type="submit" name="action">Siguiente</button> 	      
	    </div>
	</div>
	{{ Form::close()}}

</div>
<br>
@endsection



@section ('scriptcontenido')
<script>  
    $(document).ready(function() {      
    	
    	$('#btnAlmacen').click(function() {
    	    		
    		$('#hHoraCliente').text(fechaHoraAhora());
    		$('#horaCliente').val(fechaHoraAhora());
    	});

  	});

    function fechaHoraAhora (){
    	var today = new Date();

		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();

		if(dd<10){
		    dd='0'+dd;
		} 
		if(mm<10){
		    mm='0'+mm;
		} 

		var h = addZero(today.getHours());
	    var m = addZero(today.getMinutes());
	    var s = addZero(today.getSeconds());

		return yyyy+'-'+mm+'-'+ dd+ ' ' +h+':'+m+':'+s;
    }

    function addZero(i) {
	    if (i < 10) {
	        i = "0" + i;
	    }
	    return i;
	}
  	
  
</script>

@stop