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
	      <h5>2. Ir al almacén</h5>
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
	{{Form::open(array('action' => array('EnvioController@llegadaAlmacen_procesar', $viaje->idViaje ), 'method' => 'POST')) }}
	
	<div class= "row">

		<div class="col s12 l8 center">

	      	<div class="card">

	      		<div class="card-content teal white-text">
		          <span class="card-title">Lista de materiales</span>                             
		        </div>
				
				<div class="card-content">

					<table class= "bordered highlight responsive-table" id="tblPedidos">
				        <thead>
				         	<tr>	 
				         		<th data-field="seleccion">Cantidad</th>
				         		<th data-field="cliente">Unidad</th>               
				                <th data-field="zona">Material</th>
				            </tr>
				        </thead>

				        <tbody>
				        	@foreach ($articulos as $articulo)
					            <tr>
					            	<td>{{ $articulo['cantidad'] }}</td>
					            	<td>{{ $articulo['articulo']->unidadMedida->nombre }}</td>		
					            	<td>{{ $articulo['articulo']->nombre }} - {{ $articulo['articulo']->marca->nombre }}</td>
					            					            					            
						        </tr>
					        @endforeach
				        </tbody>
				    </table>

				</div>

			</div>
		</div>

		<div class="col s12 l4 center">

			<div class="card">

	      		<div class="card-content teal white-text">
		          <span class="card-title">Registrar llegada</span>                             
		        </div>
				
				<div class="card-content">

					<div class= "row">
						<div class="col s12 ">
							<a class="waves-effect waves-blue btn blue" id="btnAlmacen" >En almacén</a>
						</div>
						<div class="col s12">
							<h6 id="hHoraAlmacen">Hora Almacen</h6>
							<input type="text" value="" id="horaAlmacen" name="horaAlmacen">
						</div>
					</div>

				</div>

			</div>
		</div>
		


	</div>

	<div class="row">
	    <div class="col s12">
	      
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
    	    		
    		$('#hHoraAlmacen').text(fechaHoraAhora());
    		$('#horaAlmacen').val(fechaHoraAhora());
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

		return yyyy+'-'+dd+'-'+mm + ' ' +h+':'+m+':'+s;
    }

    function addZero(i) {
	    if (i < 10) {
	        i = "0" + i;
	    }
	    return i;
	}
  	
  
  
</script>

@stop
