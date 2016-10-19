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
	<div class= "row">
		<h3>Lista de clientes</h3>
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
	          		<th data-field="id">Código</th>
	                <th data-field="dni"># Documento</th>
	                <th data-field="nombre">Nombre</th>
	                <th data-field="fechaRegistro">Correo</th>
	                <th data-field="direccion">Dirección</th>
	                <th data-field="credito">Crédito</th>
	                <th data-field="acciones">acciones</th>
	            </tr>
	        </thead>

	        <tbody>

	        	@foreach ($clientes as $cliente)
	            <tr>
		            <td>{{ $cliente->idCliente}}</td>
		            <td>{{ $cliente->numeroDocumento}}</td>
		            <td>{{ $cliente->nombres.' '.$cliente->apellidoPaterno.' '. $cliente->apellidoMaterno}}</td>
		            <td>{{ $cliente->correo}}</td>
		            <td>{{ $cliente->direccion}}</td>
		            <td>
		            	@if ($cliente->credito ===1)
		            	Sí
		            	@else
		            	No
		            	@endif
		            </td>
		            <td>
		            	<a href="" title="Editar"><i class="material-icons">edit</i></a>
		            	<a href="" title="Borrar"><i class="material-icons">delete</i></a>
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