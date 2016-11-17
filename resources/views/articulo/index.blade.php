@extends ('layouts.base')
@section ('contenido')

<!-- Estos linea es para las migajas-->
<nav class="teal">
  <div class="nav-wrapper container">
    <div class="col s12">
      <a href="#!" class="breadcrumb">Mant.</a>
      <a href="{{ url('articulo')}}" class="breadcrumb">Articulo</a>
    </div>
  </div>
</nav>


<div class="container">
	
  
	<br>
	<div class="row">
	    <div class="col s12 center">
	      <h5>Lista de articulos</h5>
	      <div class="divider"></div>
	    </div>
	  </div>

	<div class= "row">
		<div class="col s12 right-align">
			<a href="{{ url('articulo/create')}}" class="waves-effect waves-light btn">+ Nuevo articulo</a>
		</div>
		
	</div>

	<div class= "row">
		<table class= "bordered highlight responsive-table">
	        <thead>
	         	<tr>
	                <th data-field="unidadMedida">Unidad de medida</th>
	                <th data-field="descripcion">Descripción</th>
	                <th data-field="tipoCarga">Tipo de carga</th>
	                <th data-field="precio">Precio</th>
	                <th data-field="stock">Stock</th>
	                <th data-field="acciones">acciones</th>
	            </tr>
	        </thead>

	        <tbody>

	        	@foreach ($articulos as $articulo)
		            <tr>
			            <td>{{ $articulo->unidadMedida->nombre}}</td>
			            <td>{{ $articulo->nombre.' - '.$articulo->marca->nombre}}</td>
			            <td>{{ $articulo->tipoCarga->nombre}} - 		          
			            	@if ($articulo->combinable ===1)
			            	combinable
			            	@else
			            	no combinable
			            	@endif
			            </td>
			            <td>{{ $articulo->precioBase}}</td>
			            <td>{{ $articulo->stock}}</td>
			            <td>
			            	<a href="{{action('ArticuloController@edit', ['id'=>$articulo->idArticulo])}}" title="Editar"><i class="material-icons">edit</i></a>
			            	<a class="modal-trigger" href="#modal-delete-{{$articulo->idArticulo}}" title="Eliminar"><i class="material-icons">delete</i></a>
			            </td>

			        </tr>  
					
					@include('articulo.modal')

		        @endforeach

	        </tbody>
	    </table>
		
		{{ $articulos->links() }} <!--Esto sirve para paginar. No estoy seguro si funciona para el framework-->

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