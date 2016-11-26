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
	      <h5>1. Seleccionar vehículo</h5>
	    </div>
	</div>
	<br><br>
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

	{{Form::open(array('action' => array('EnvioController@seleccionarVehiculo_procesar', $viaje->idViaje ), 'method' => 'POST')) }}
	<div class="row">
		<div class="col s12 m10 l6 offset-m1 offset-l3">

			<div class="card">

				<div class="card-content blue white-text center">
		          <span class="card-title">Vehículo</span>                             
		        </div>
				
				<div class="card-content">
					<div class="input-field">

						<select name="idVehiculo" id="idVehiculo">
			    		<option value="" >Seleccione vehículo</option>
			    	@if ($vehiculos != null)		        		
			            @foreach ($vehiculos as $vehiculo)
			            <option value="{{$vehiculo->idVehiculo}}" @if ($vehiculo->idVehiculo == old('idVehiculo') ) selected  @endif>{{$vehiculo->nombre}} - {{$vehiculo->placa}}</option>
			            @endforeach
			        @endif
			        </select>
			        <label for="idVehiculo">{{$viaje->tipoVehiculo->nombre}} <span class="red-text">*</span></label>

					</div>
					

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
