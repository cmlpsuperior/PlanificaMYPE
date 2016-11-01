@extends ('layouts.base')
@section ('contenido')

<!-- Estos linea es para las migajas-->
<nav class="teal">
  <div class="nav-wrapper container">
    <div class="col s12">
      <a href="#!" class="breadcrumb">Mant.</a>
      <a href="{{ url('cliente')}}" class="breadcrumb">Clientes</a>
    </div>
  </div>
</nav>


<div class="container">
	<br>
	<div class="row">
	    <div class="col s12 center">
	      <h5>Lista de clientes</h5>
	      <div class="divider"></div>
	    </div>
	  </div>
	
	<div class= "row">
		<div class="col s12 right-align">
			<a href="{{ url('cliente/create')}}" class="waves-effect waves-light btn">+ Nuevo cliente</a>
		</div>
		
	</div>

	<div class= "row">
		<table class= "bordered highlight responsive-table">
	        <thead>
	         	<tr>
	                <th data-field="dni">Documento</th>
	                <th data-field="nombre">Nombre</th>
	                <th data-field="fechaRegistro">Correo</th>
	                <th data-field="zona">Zona</th>
	                <th data-field="credito">Crédito</th>
	                <th data-field="acciones">acciones</th>
	            </tr>
	        </thead>

	        <tbody>

	        	@foreach ($clientes as $cliente)
	            <tr>
		            <td hidden="true">{{ $cliente->idCliente}}</td>
		            <td>{{ $cliente->numeroDocumento}}</td>
		            <td>{{ $cliente->nombres.' '.$cliente->apellidoPaterno.' '. $cliente->apellidoMaterno}}</td>
		            <td>{{ $cliente->correo}}</td>
		            <td>{{ $cliente->zona->nombre}}</td>
		            <td>
		            	@if ($cliente->credito ===1)
		            	Sí
		            	@else
		            	No
		            	@endif
		            </td>
		            <td>
		            	<a href="{{action('ClienteController@edit', ['id'=>$cliente->idCliente])}}" title="Editar"><i class="material-icons">edit</i></a>
		            </td>

		        </tr>   

		        @endforeach

	        </tbody>
	    </table>
		
		{{ $clientes->links() }} <!--Esto sirve para paginar. No estoy seguro si funciona para el framework-->

	</div>
	


</div>
<br>
@endsection