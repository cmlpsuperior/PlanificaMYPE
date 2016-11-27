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
	      <h5>5. Entregar y cobrar al cliente</h5>
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
		
	{{Form::open(array('action' => array('EnvioController@entregarMateriales_procesar', $viaje->idViaje, $pedido->idPedido ), 'method' => 'POST')) }}
	
	<div class= "row">
		
		<div class="col s12 m8 l9">

	      	<div class="card">

	      		<div class="card-content teal white-text center">
		          <span class="card-title">Lista de materiales</span>                             
		        </div>
				
				<div class="card-content">

					<table class= "bordered highlight responsive-table" id="tblPedidos">
				        <thead>
				         	<tr>	 
				         		<th data-field="cantidad">Cantidad</th>
				         		<th data-field="unidad">Unidad</th>               
				                <th data-field="material">Material</th>
				                <th data-field="descargado" class="blue-text">Cant. descargado</th>
				            </tr>
				        </thead>

				        <tbody>
				        	@foreach ($articulos as $articulo)
					            <tr>
					            	
					            	<td>{{ $articulo['cantidad'] }}</td>         
						            <td>{{ $articulo['articulo']->unidadMedida->nombre }}</td>
						            <td>{{ $articulo['articulo']->nombre }} - {{ $articulo['articulo']->marca->nombre }}</td>
						            <td><input class="blue-text" type="number" min ="0" step="0.5" max="{{  $articulo['cantidad']  }}" value ="{{ $articulo['cantidad'] }}" name="cantidadesDescargados[]"></td>
						            <td hidden><input type="hidden" value ="{{ $articulo['articulo']->idArticulo }}" name ="idArticulos[]"></td>					            
						        </tr>
					        @endforeach
				        </tbody>
				    </table>
					
				</div>

			</div>

		</div>

		<div class="col s12 m4 l3">
			<!--Tarjeta para registrar la hora de ubicacion del cliente-->
			<div class="card">
				<div class="card-content blue white-text center">
		          <i class="material-icons prefix">check</i>
		          <span class="card-title">Saldo</span>                             
		        </div>
				
				<div class="card-content">
					
					<div class="row">
						<div class="col s12 center">
			              <h5>Cobrar: S/. {{ $pedido->montoTotal - $pedido->montoPagado }}</h5>
			            </div>
					</div>

					<div class="row">
						<div class="input-field col s6 offset-s3">
			              <input id="cobrado"  type="number" min="0" step ="0.01" max="{{$pedido->montoTotal - $pedido->montoPagado}}"   class="validate"  required  name="cobrado">
			              <label for="cobrado" >Cobrado <span class="red-text">*</span></label>
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
	      <button class="btn waves-effect waves-light" type="submit" name="action">Terminar envío</button> 	      
	    </div>
	</div>
	{{ Form::close()}}

</div>
<br>
@endsection
