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
	      <h5>3. Destinos</h5>
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
		
	<div class= "row ">
		@foreach($pedidos as $key => $pedido)	
	
		<div class="col s12 m6 l4 ">
	
	      	<div class="card">
								
				<div class="card-content">
					<div class="center">
						<span class="card-title ">Destino {{ $key+1 }}</span>
					</div>
					
		            <p><strong>Cliente:</strong> {{ $pedido->cliente->apellidoPaterno}} {{ $pedido->cliente->apellidoMaterno}}, {{ $pedido->cliente->nombres}}</p>
		            <p><strong>Zona:</strong> {{ $pedido->zona->nombre}}</p>
		            <p><strong>Dirección:</strong> {{ $pedido->cliente->direccion }}</p>

				</div>

				<div class="card-action right-align">
	              <a href="  #!  " class="blue-text">Ver detalle</a>
	              <a href=" {{ action('EnvioController@buscarCliente', ['id'=>$viaje->idViaje, 'idPedido'=>$pedido->idPedido]) }}  " class="blue-text">Iniciar</a>
	            </div>

			</div>

		</div>

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
	      <a href=" " class="btn waves-effect waves-light">Siguiente</a> 	      
	    </div>
	</div>

</div>
<br>
@endsection

