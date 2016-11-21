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
	      <h5>3. Entregar materiales</h5>
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
		<div class="col s12 m4 l3">

	      	<div class="card">

	      		<div class="card-content teal white-text center">
		          <span class="card-title">Datos</span>                             
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
			
			<!--Tarjeta para registrar la hora de ubicacion del cliente-->
			<div class="card">
				<div class="card-content blue white-text center">
		          <i class="material-icons prefix">check</i>
		          <span class="card-title">Registro</span>                             
		        </div>
				
				<div class="card-content center">
					<a class="waves-effect waves-blue btn blue" id="btnAlmacen" >Ubicado</a>
					<h6 id="hHoraAlmacen">Hora ubicado</h6>
					<input type="hidden" value="" id="horaAlmacen">
				</div>

         	</div>			
			

		</div>


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
				                <th data-field="descargado">Cant. descargado</th>
				            </tr>
				        </thead>

				        <tbody>
				        	@foreach ($articulos as $articulo)
					            <tr>
					            	
					            	<td>{{ $articulo['cantidad'] }}</td>         
						            <td>{{ $articulo['articulo']->unidadMedida->nombre }}</td>
						            <td>{{ $articulo['articulo']->nombre }} - {{ $articulo['articulo']->marca->nombre }}</td>
						            <td><input type="number" min ="0" step="0.5" max="{{  $articulo['cantidad']  }}" value ="{{ $articulo['cantidad'] }}"></td>
						            <td hidden><input type="hidden" value ="{{ $articulo['articulo']->idArticulo }}"></td>					            
						        </tr>
					        @endforeach
				        </tbody>
				    </table>
					
				</div>

			</div>

		</div>

	</div>
	
	<div class= "row">
		<div class="col s12 m8 l6 offset-m2 offset-l3">
			<!--Tarjeta para registrar la hora de ubicacion del cliente-->
			<div class="card">
				<div class="card-content blue white-text center">
		          <i class="material-icons prefix">check</i>
		          <span class="card-title">Monto cobrado</span>                             
		        </div>
				
				<div class="card-content">
					
					<div class="row">
						<div class="col s12 center">
			              <h5>Cobrar: S/. {{ $pedido->montoTotal - $pedido->montoPagado }}</h5>
			            </div>
					</div>

					<div class="row">
						<div class="input-field col s6 offset-s3">
			              <input id="cobrado"  type="number" min="0" step ="0.01" max="{{$pedido->montoTotal - $pedido->montoPagado}}"   class="validate"  required value="{{ old('cobrado') }}" name="cobrado">
			              <label for="cobrado">Monto cobrado</label>
			            </div>
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
	      <button class="btn waves-effect waves-light" type="submit" name="action">Iniciar envío</button> 	      
	    </div>
	</div>
	{{ Form::close()}}

</div>
<br>
@endsection
