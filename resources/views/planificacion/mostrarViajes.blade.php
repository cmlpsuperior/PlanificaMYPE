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
	      <h5> <span class="teal-text">Paso 1 ------ Paso 2 ------ Paso 3 ------ Paso 4</span> </h5>
	      
	    </div>
	  </div>	

	<div class="row">
	    <div class="col s12 center">
	      <h5 class="teal-text">4. Viajes propuestos</h5>
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


	{{Form::open(array('action' => array('PlanificacionController@viajes_procesar', $pedidoPrincipal->idPedido ), 'method' => 'POST')) }} 	
	<div class="row">
	    <div class="col s12">
	     	<input type="hidden" name="idPedidoPrincipal" value="{{$pedidoPrincipal->idPedido}}">	      
	    </div>
	</div>

	<div class= "row">
		<table class= "bordered highlight responsive-table" id="tbltiposVehiculos">
	        <thead>
	         	<tr>	 
	         		<th data-field="seleccion">N° viaje</th>
	         		<th data-field="cliente">Zona</th>               
	                <th data-field="zona">Vehiculo</th>
	                <th data-field="zona">N° materiales</th>
	                <th data-field="destinos">N° destinos</th>
	                <th data-field="acciones">Acciones</th>
	            </tr>
	        </thead>

	        <tbody>

	        	@foreach ($viajes as $key => $viaje)

		            <tr>		            	
		            	<td hidden>{{ $viaje['tipoVehiculo']->idTipoVehiculo }} </td>
		            	<td>{{ $key +1 }} </td>	
		            	<td>{{ $pedidoPrincipal->zona->nombre }} </td>
		            	<td>{{ $viaje['tipoVehiculo']->nombre }}</td>
		            	<td>{{ count($viaje['detallesLineas']) }}</td>
			            <td>{{ count($viaje['pedidos']) }}</td>	
						<td>
							<a class="modal-trigger" href="#modalDetalle-{{$key}}" title="ver detalle"><i class="material-icons">visibility</i></a>
						</td>
			        </tr>
					
			        

		        @endforeach

	        </tbody>
	    </table>
		@foreach ($viajes as $key => $viaje)
			@include('planificacion.modalDetalle')
		@endforeach
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

@section ('scriptcontenido')
<script>  
    

    $(document).ready(function() {        

     // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();  

  	});
  
  
</script>

@stop