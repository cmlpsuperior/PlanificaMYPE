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
	      <h5>Lista de viajes pendientes</h5>
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
		
	{{Form::open(array('action' => 'EnvioController@seleccionarViaje_procesar', 'method' => 'POST')) }} 	
	<div class= "row">
		<div class="col s12 m10 l8 center offset-m1 offset-l2">

	      	<div class="card">

	      		<div class="card-content teal white-text">
		          <i class="material-icons prefix">local_shipping</i>
		          <span class="card-title">Viajes pendientes</span>                             
		        </div>
				
				<div class="card-content">

					<table class= "bordered highlight responsive-table" id="tblPedidos">
				        <thead>
				         	<tr>	 
				         		<th data-field="seleccion">Selecionar</th>
				         		<th data-field="cliente">Ubicación</th>               
				                <th data-field="zona">N° Destinos</th>
				                <th data-field="zona">Tipo vehículo</th>
				                <th data-field="acciones">Acciones</th>
				            </tr>
				        </thead>

				        <tbody>
				        	@foreach ($viajes as $viaje)
					            <tr>
					            	<td><input type="radio" name="seleccionarViaje" id="id{{$viaje['viaje']->idViaje}}" value="{{$viaje['viaje']->idViaje}}" ><label for="id{{$viaje['viaje']->idViaje}}">{{ $viaje['viaje']->idViaje }}</label></td>         
						            <td>{{ $viaje['zona']->nombre }}</td>
						            <td>{{ $viaje['cantidadDestinos'] }}</td>
						            <td>{{ $viaje['viaje']->tipoVehiculo->nombre }}</td>
						            <td>			            	
						            	<a class="modal-trigger" href="#modal-ver-{{$viaje['viaje']->idViaje}}" title="Ver"><i class="material-icons">visibility</i></a>
						            </td>
						        </tr>
					        @endforeach
				        </tbody>
				    </table>
					{{ $viajes->links() }} <!--Esto sirve para paginar. No estoy seguro si funciona para el framework-->
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
	      <button class="btn waves-effect waves-light" type="submit" name="action">Iniciar envío</button> 	      
	    </div>
	</div>
	{{ Form::close()}}

</div>
<br>
@endsection

