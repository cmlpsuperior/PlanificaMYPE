@extends ('layouts.base')
@section ('contenido')

<!-- Estos linea es para las migajas-->
<nav class="teal">
  <div class="nav-wrapper container">
    <div class="col s12">      
       	<a  class="breadcrumb">Gestión</a>
      	<a  class="breadcrumb">Planificación</a>
    </div>
  </div>
</nav>


<div class="container">
	<br>
	<div class="row">
	    <div class="col s12 center">
	      <h5> <span class="teal-text">Paso 1 ------ Paso 2</span> ------ Paso 3 ------ Paso 4</h5>
	      
	    </div>
	  </div>	

	<div class="row">
	    <div class="col s12 center">
	      <h5 class="teal-text">2. Pedidos cercanos</h5>
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


	{{Form::open(array('action' => array('PlanificacionController@pedidosCercanos_procesar', $pedidoPrincipal->idPedido ), 'method' => 'POST')) }} 	
	<div class="row">
	    <div class="col s12">
	     	<input type="hidden" name="idPedidoPrincipal" value="{{$pedidoPrincipal->idPedido}}">
	      
	    </div>
	</div>

	<div class= "row">
		<table class= "bordered highlight responsive-table" id="tblPedidos">
	        <thead>
	         	<tr>	 
	         		<th data-field="seleccion">Selecionar</th>
	         		<th data-field="cliente">Cliente</th>               
	                <th data-field="zona">Zona</th>	
	                <th data-field="fechaRegistro">Fecha registro</th>
	                <th data-field="fechaEnvio">Fecha envio</th>
	                <th data-field="estado">Estado</th>
	                <th data-field="estado">N° productos</th>
	                <th data-field="acciones">Acciones</th>
	            </tr>
	        </thead>

	        <tbody>

	        	@foreach ($pedidosCercanos as $pedido)
		            <tr>
		            	
		            	<td><input type="checkbox" checked name="idPedidosCercanos[]" value="{{$pedido->idPedido}}" id="id{{$pedido->idPedido}}"><label for="id{{$pedido->idPedido}}">{{$pedido->idPedido}}</label></td>
		            	<td>{{ $pedido->cliente->nombres }} {{ $pedido->cliente->apellidoPaterno }} </td>			            
			            <td>{{ $pedido->zona->nombre}}</td>
			            <td>{{ $pedido->fechaRegistro}}</td>
			            <td>{{ $pedido->fechaEnvio}}</td>
			            <td>{{ $pedido->estado}}</td>
			            <td>{{ count($pedido->articulos) }}</td>
			            <td>			            	
			            	<a class="modal-trigger" href="#modal-ver-{{$pedido->idPedido}}" title="Ver"><i class="material-icons">visibility</i></a>
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
