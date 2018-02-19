@extends ('layouts.base')
@section ('contenido')

<!-- Estos linea es para las migajas-->
<nav class="teal">
  <div class="nav-wrapper container">
    <div class="col s12">      
      <a  class="breadcrumb">Gestión</a>
      <a  class="breadcrumb">Asignar viaje</a>    
  	</div>
  </div>
</nav>


<div class="container">
	<br>
	<div class="row">
	    <div class="col s12 center">
	      <h5> <span class="teal-text">Paso 1</span>  ------ Paso 2</h5>
	      
	    </div>
	  </div>	

	<div class="row">
	    <div class="col s12 center">
	      <h5 class="teal-text">1. Selecionar un viaje</h5>
	      <div class="divider"></div>
	      <br>
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


	{{Form::open(array('action' => 'AsignarViajeController@seleccionarViaje_procesar', 'method' => 'POST')) }} 	

	<div class= "row">
		<table class= "bordered highlight responsive-table" id="tblPedidos">
	        <thead>
	         	<tr>	 
	         		<th data-field="seleccion">Selecionar</th>
	         		<th data-field="cliente">Zona</th>              
	                <th data-field="zona">Tipo vehículo</th>	
	                <th data-field="fechaRegistro">N° destinos</th>
	                <th data-field="fechaRegistro">Registro</th>
	                <th data-field="fechaEnvio">Estado</th>
	                <th data-field="acciones">Acciones</th>
	            </tr>
	        </thead>

	        <tbody>

	        	@foreach ($viajes as $viaje)
		            <tr>
		            	
		            	<td><input type="radio" name="seleccionarViaje" id="id{{$viaje['viaje']->idViaje}}" value="{{$viaje['viaje']->idViaje}}" ><label for="id{{$viaje['viaje']->idViaje}}">{{$viaje['viaje']->idViaje}}</label></td>
		            	<td>{{ $viaje['zona']->nombre}}</td>		            
			            <td>{{ $viaje['viaje']->tipoVehiculo->nombre }}</td>
			            <td>{{ $viaje['cantidadDestinos']}}</td>
			            <td>{{ $viaje['viaje']->fechaRegistro }}</td>
			            <td>{{ $viaje['viaje']->estado }}</td>
			            <td>			            	
			            	<a class="modal-trigger" href="#modalDetalle-{{$viaje['viaje']->idViaje}}" title="Ver"><i class="material-icons">visibility</i></a>
			            </td>

			        </tr>  

		        @endforeach

	        </tbody>
	    </table>
		
		{{ $viajes->links() }} <!--Esto sirve para paginar. No estoy seguro si funciona para el framework-->

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

