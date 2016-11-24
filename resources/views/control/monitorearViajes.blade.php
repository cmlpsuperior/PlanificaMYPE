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


<div class="container"  id="test1">

	<div class="row">
	    <div class="col s12 center">
	      <h5>Viajes del pedido N° {{ $idPedido }}</h5>
	    </div>
	</div>			
		
	<div class= "row ">
		@foreach($viajes as $key => $viaje)	
	
		<div class="col s12 m6 l4 ">
	
	      	<div class="card">
				
				<div class="card-content teal white-text center">
		            <span class="card-title ">Viaje N° {{$viaje->idViaje}}</span>
		        </div>

				<div class="card-content">

					<div class="right-align ">
						<p><strong>Cobrado: S/. </strong></p>
					</div>
					<br>
					@if ($viaje->empleado!=null)
					<p><strong>Chofer:</strong> {{ $viaje->empleado->apellidoPaterno}} {{ $viaje->empleado->apellidoMaterno}}, {{ $viaje->empleado->nombres}}</p>
					@else
					<p><strong>Chofer:</strong>  - </p>
					@endif

		            <p><strong>Hora salida:</strong> {{ $viaje->fechaSalida }}</p>
		            <p><strong>Tipo vehiculo:</strong> {{ $viaje->tipovehiculo->nombre }}</p>

		            @if ($viaje->vehiculo!=null)
		            <p><strong>Vehiculo:</strong> {{ $viaje->vehiculo->nombre }} - {{ $viaje->vehiculo->placa }}</p>
		            @else
		            <p><strong>Vehiculo:</strong>  -</p>
		            @endif
		            
					<div class="center teal-text">
						<h5>{{ $viaje->estado }}</h5>
					</div>

				</div>

				<div class="card-action right-align">
					<a class="modal-trigger blue-text" href="#modalMaterialesViaje-{{$viaje->idViaje}}">Materiales</a>
	            </div>

			</div>

		</div>

		@include('control.modalMaterialesViaje')

		@endforeach
	</div>
	
	<div class="row right-align">
		<a class="waves-effect waves-light btn" href="{{ url('control')}}"><i class="material-icons left">arrow_back</i>Volver</a>
		<a class="waves-effect waves-light btn" href="{{ url('control')}}">Aceptar</a>

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