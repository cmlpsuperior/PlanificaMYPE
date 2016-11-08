@extends ('layouts.base')
@section ('contenido')

<!-- Estos linea es para las migajas-->
<nav class="teal">
  <div class="nav-wrapper container">
    <div class="col s12">      
      <a  class="breadcrumb">Planificacion</a>
    </div>
  </div>
</nav>


<div class="container">
	<br>
	<div class="row">
	    <div class="col s12 center">
	      <h5>Paso 1 ------ Paso 2 ------ Paso 3</h5>
	      
	    </div>
	  </div>	

	<div class="row">
	    <div class="col s12 center">
	      <h5>3. Vehículos disponibles</h5>
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


	{{Form::open(array('action' => array('PlanificacionController@vehiculosUtilizados_procesar', $pedidoPrincipal->idPedido ), 'method' => 'POST')) }} 	
	<div class="row">
	    <div class="col s12">
	     	<input type="text" name="idPedidoPrincipal" value="{{$pedidoPrincipal->idPedido}}">
	      
	    </div>
	</div>

	<div class= "row">
		<table class= "bordered highlight responsive-table" id="tbltiposVehiculos">
	        <thead>
	         	<tr>	 
	         		<th data-field="seleccion">Selecionar</th>
	         		<th data-field="cliente">Nombre</th>               
	                <th data-field="zona">N° vehículos disponibles</th>
	                <th data-field="acciones">Acciones</th> 
	            </tr>
	        </thead>

	        <tbody>

	        	@foreach ($tiposVehiculos as $tipo)
		            <tr>		            	
		            	<td>
		            		<input type="checkbox" name="idTiposVehiculos[]" value="{{$tipo->idTipoVehiculo}}" id="id{{$tipo->idTipoVehiculo}}"  @if ( count($tipo->vehiculos) ) checked @endif>
		            		<label for="id{{$tipo->idTipoVehiculo}}">{{$tipo->idTipoVehiculo}}</label>
		            	</td>
		            	<td>{{ $tipo->nombre }} </td>			            
			            <td>{{ count($tipo->vehiculos) }}</td>
			            <td>			            	
			            	<a class="modal-trigger" href="#modal-ver-{{$tipo->idTipoVehiculo}}" title="Ver"><i class="material-icons">visibility</i></a>
			            </td>

			        </tr>

		        @endforeach

	        </tbody>
	    </table>
		
		

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
