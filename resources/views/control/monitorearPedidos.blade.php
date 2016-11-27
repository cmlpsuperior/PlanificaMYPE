@extends ('layouts.base')
@section ('contenido')

<nav class="teal">
  <div class="nav-wrapper container">
    <div class="col s12">
      <a href="#!" class="breadcrumb">Gestión</a>
      <a href="#!" class="breadcrumb">Control de pedidos</a>
    </div>
  </div>
</nav>

<!--este es el tab, hace referencia a id de Divs-->
<div class="row ">
    <div class="col s12 teal ">
      <ul class="tabs teal ">
        <li class="tab col s3 "><a class="active" href="#test1">Pendientes</a></li>
        <li class="tab col s3"><a  href="#test2">Finalizados</a></li>
      </ul>
    </div>	    
</div>

<div class="container"  id="test1">

	<div class="row">
	    <div class="col s12 center">
	      <h5>Pedidos pendientes ({{count($pedidosPendientes)}})</h5>
	    </div>
	</div>			
		
	<div class= "row ">
		@foreach($pedidosPendientes as $key => $pedido)	
	
		<div class="col s12 m6 l4 ">
	
	      	<div class="card">
				
				<div class="card-content teal white-text center">
		            <span class="card-title ">Pedido N° {{$pedido->idPedido}}</span>
		        </div>

				<div class="card-content">

					<div class="right-align ">
							<p><strong>Saldo: S/. {{ $pedido->montoTotal - $pedido->montoPagado }}</strong></p>
					</div>
					<br>
					<p><strong>Cliente:</strong> {{ $pedido->cliente->apellidoPaterno}} {{ $pedido->cliente->apellidoMaterno}}, {{ $pedido->cliente->nombres}}</p>
		            <p><strong>Zona:</strong> {{ $pedido->zona->nombre}}</p>
		            <p><strong>Dirección:</strong> {{ $pedido->cliente->direccion }}</p>
		            <p><strong>N° viajes:</strong> {{ count( $pedido->viajes ) }}</p>
					
		            
					<div class="center teal-text">
						<h5>{{ $pedido->estado }}</h5>
					</div>

				</div>

				<div class="card-action right-align">
					<a class="modal-trigger blue-text" href="#modalMaterialesPedido-{{$pedido->idPedido}}">Materiales</a>
	              	<a href=" {{ action('ControlController@verViajes', ['id'=>$pedido->idPedido] ) }}  " class="blue-text">Viajes</a>
	            </div>

			</div>

		</div>

		@include('control.modalMaterialesPedido')

		@endforeach
	</div>
	
</div>

<div class="container"  id="test2">

	<div class="row">
	    <div class="col s12 center">
	      <h5>Pedidos finalizados ({{count($pedidosFinalizados)}})</h5>
	    </div>
	</div>			
		
	<div class= "row ">
		@foreach($pedidosFinalizados as $key => $pedido)	
	
		<div class="col s12 m6 l4 ">
	
	      	<div class="card">
				
				<div class="card-content teal white-text center">
		            <span class="card-title ">Pedido N° {{$pedido->idPedido}}</span>
		        </div>

				<div class="card-content">

					<div class="right-align ">
							<p><strong>Saldo: S/. {{ $pedido->montoTotal - $pedido->montoPagado }}</strong></p>
					</div>
					<br>
					<p><strong>Cliente:</strong> {{ $pedido->cliente->apellidoPaterno}} {{ $pedido->cliente->apellidoMaterno}}, {{ $pedido->cliente->nombres}}</p>
		            <p><strong>Zona:</strong> {{ $pedido->zona->nombre}}</p>
		            <p><strong>Dirección:</strong> {{ $pedido->cliente->direccion }}</p>
		            <p><strong>N° viajes:</strong> {{ count( $pedido->viajes ) }}</p>
					
		            
					<div class="center teal-text">
						<h5>{{ $pedido->estado }}</h5>
					</div>

				</div>

				<div class="card-action right-align">
					<a class="modal-trigger blue-text" href="#modalMaterialesPedido-{{$pedido->idPedido}}">Materiales</a>
	              	<a href=" {{ action('ControlController@verViajes', ['id'=>$pedido->idPedido] ) }}  " class="blue-text">Viajes</a>
	            </div>

			</div>

		</div>

		@include('control.modalMaterialesPedido')

		@endforeach
	</div>
	
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