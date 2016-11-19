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
	      <h5>Paso 1 ------ Paso 2</h5>
	      
	    </div>
	  </div>	

	<div class="row">
	    <div class="col s12 center">
	      <h5>2. Selecionar un empledo</h5>
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


	{{Form::open(array('action' => array('AsignarViajeController@seleccionarEmpleado_procesar', $idViaje ), 'method' => 'POST')) }} 	

	<div class= "row">
		<table class= "bordered highlight responsive-table" id="tblPedidos">
	        <thead>
	         	<tr>	 
	         		<th data-field="seleccion">Selecionar</th>
	         		<th data-field="cliente">Documento</th>              
	                <th data-field="zona">Nombre</th>
	                <th data-field="fechaRegistro">N° viajes dia</th>	
	                <th data-field="fechaRegistro">Licencia</th>	                
	                <th data-field="fechaEnvio">Cargo</th>
	            </tr>
	        </thead>

	        <tbody>

	        	@foreach ($empleados as $empleado)
		            <tr>		            	
		            	<td>
		            		<input type="radio" name="seleccionarEmpleado" id="id{{$empleado->idEmpleado}}" value="{{$empleado->idEmpleado}}" >
		            		<label for="id{{$empleado->idEmpleado}}">{{$empleado->idEmpleado}}</label>
		            	</td>
		            	<td>{{ $empleado->numeroDocumento }} </td>		            
			            <td>{{ $empleado->apellidoPaterno }} {{ $empleado->apellidoMaterno }}, {{ $empleado->nombres }}</td>
			            <td>{{ count( $empleado->viajes->where('fechaSalida', '>=', date("Y-m-d"))   ) }}</td>
			            <td>{{ $empleado->licencia }} </td>
			            <td>{{ $empleado->cargo->nombre }}</td>			            

			        </tr>  

		        @endforeach

	        </tbody>
	    </table>
		
		{{ $empleados->links() }} <!--Esto sirve para paginar. No estoy seguro si funciona para el framework-->

	</div>
	
	<div class="row">
	    <div class="col s12">
	      <br><br><br>
	      <div class="divider"></div>
	      
	    </div>
	</div>
	<div class="row">
	    <div class="col s12 right-align">
	      <button class="btn waves-effect waves-light" type="submit" name="action">Confirmar</button> 	      
	    </div>
	</div>
	{{ Form::close()}}

</div>
<br>
@endsection

