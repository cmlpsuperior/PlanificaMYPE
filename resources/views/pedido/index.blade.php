@extends ('layouts.base')
@section ('contenido')

<!-- Estos linea es para las migajas-->
<nav class="teal">
  <div class="nav-wrapper container">
    <div class="col s12">
      <a href="#!" class="breadcrumb">Mant.</a>
      <a href="{{ url('pedido')}}" class="breadcrumb">Pedido</a>
    </div>
  </div>
</nav>


<div class="container">
	<br>
	<div class="row">
	    <div class="col s12 center">
	      <h5>Lista de pedidos</h5>
	      <div class="divider"></div>
	    </div>
	  </div>

	<div class= "row">
		<div class="col s12 right-align">
			<a href="{{ url('pedido/create')}}" class="waves-effect waves-light btn">+ Nuevo pedido</a>
		</div>
		
	</div>

	<div class= "row">
		<table class= "bordered highlight responsive-table">
	        <thead>
	         	<tr>	 
	         		<th data-field="cliente">Cliente</th>               
	                <th data-field="zona">Zona</th>	
	                <th data-field="fechaEnvio">Fecha envio</th>
	                <th data-field="estado">Estado</th>
	                <th data-field="estado">N° productos</th>
	                <th data-field="acciones">Acciones</th>
	            </tr>
	        </thead>

	        <tbody>

	        	@foreach ($pedidos as $pedido)
		            <tr>
		            	<td>{{ $pedido->cliente->nombres }} {{ $pedido->cliente->apellidoPaterno }} </td>			            
			            <td>{{ $pedido->zona->nombre}}</td>
			            <td>{{ $pedido->fechaEnvio}}</td>
			            <td>{{ $pedido->estado}}</td>
			            <td>{{ count($pedido->articulos) }}</td>
			            <td>
			            	<!--<a href="{{action('PedidoController@edit', ['id'=>$pedido->idPedido])}}" title="Editar"><i class="material-icons">edit</i></a>-->
			            	<a class="modal-trigger" href="#modal-delete-{{$pedido->idPedido}}" title="Anular"><i class="material-icons">delete</i></a>
			            </td>

			        </tr>  
					
					@include('pedido.modal')

		        @endforeach

	        </tbody>
	    </table>
		
		{{ $pedidos->links() }} <!--Esto sirve para paginar. No estoy seguro si funciona para el framework-->

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