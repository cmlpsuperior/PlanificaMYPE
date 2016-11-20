@extends ('layouts.base')
@section ('contenido')

<!-- Estos linea es para las migajas-->
<nav class="teal">
  <div class="nav-wrapper container">
    <div class="col s12">
      <a href="#!" class="breadcrumb">Mant.</a>
      <a href="{{ url('empleado')}}" class="breadcrumb">Empleado</a>
    </div>
  </div>
</nav>


<div class="container">
	
  
	<br>
	<div class="row">
	    <div class="col s12 center">
	      <h5>Lista de empleados</h5>
	    </div>
	  </div>

	<div class= "row">
		<div class="col s12 right-align">
			<a href="{{ url('empleado/create')}}" class="waves-effect waves-light btn">Nuevo empleado<i class="material-icons right">add</i></a>
		</div>
		
	</div>

	<div class= "row">
		{{Form::open (array('url' => 'empleado', 'method'=>'GET'))}}
		<!--Panel de la izquierda-->
	    <div class="col s12 m3 l2 center">
	      	<div class="card">
				
				<!--header de la tarjeta-->
	      		<div class="card-content teal white-text">
		          <i class="material-icons prefix">filter_list</i>
		          <span class="card-title">Filtros</span>                             
		        </div>
				
				<!--cuerpo de la tarjeta-->
				<div class="card-content">

					<div class="row"> 
			            <div class="input-field col s12">                      
			              <input id="bNumeroDocumento" type="number" value="" name="bNumeroDocumento">
			              <label for="bNumeroDocumento">Documento</label>
			            </div> 
			        </div>

			        <div class="row"> 
			            <div class="input-field col s12">
			              <input id="bNombre" type="text" value="" name="bNombre">
			              <label for="bNombre">Nombre</label>
			            </div>
			        </div>

			        <div class="row"> 
			            <div class="input-field col s12">
			              <select name="bIdCargo" id= "bCargo">                          
	                        	<option value="">Seleccionar</option>
	                        @foreach ($cargos as $cargo)
	                        	<option value="{{$cargo->idCargo}}" @if ($cargo->idCargo == $bIdCargo ) selected @endif>{{$cargo->nombre}}</option>
	                        @endforeach
	                      </select>
	                      <label for="bIdCargo">Cargo</label>
			            </div>
			        </div>  
					
				</div>
				
				<!--foot de la tarjeta-->
				<div class="card-action right-align">
					<button class="waves-effect waves-teal btn-flat blue-text" type="submit" name="action">
						Filtrar
				    </button>      
		        </div>

			</div>
		</div>
		{{ Form::close()}}

		<div class="col s12 m9 l10 center">

	      	<div class="card">

	      		<div class="card-content teal white-text">
		          <i class="material-icons prefix">group</i>
		          <span class="card-title">Lista de trabajores</span>                             
		        </div>
				
				<div class="card-content">
                
					<table class= "bordered highlight responsive-table">
				        <thead>
				         	<tr>
				                <th data-field="documento">N° Documento</th>
				                <th data-field="apellidos">Nombre</th>
				                
				                <th data-field="fechaIngreso">Cargo</th>
				                <th data-field="estado">Estado</th>
				                <th data-field="acciones">Acciones</th>
				            </tr>
				        </thead>

				        <tbody>
			        	@foreach ($empleados as $empleado)
				            <tr>
					            <td>{{ $empleado->numeroDocumento}}</td>
					            <td>{{ $empleado->apellidoPaterno }} {{$empleado->apellidoMaterno }}, {{ $empleado->nombres }}</td>
					            <td>{{ $empleado->cargo->nombre}}</td>
					            <td>{{ $empleado->estado}}</td>
					            <td>
					            	<a href="{{action('EmpleadoController@edit', ['id'=>$empleado->idEmpleado])}}" title="Editar"><i class="material-icons">edit</i></a>
					            	<!--<a class="modal-trigger" href="#modal-delete-{{$empleado->idEmpleado}}" title="Eliminar"><i class="material-icons">delete</i></a>-->
					            </td>
					        </tr> 

				        @endforeach
				        </tbody>

				    </table>
					
					{{ $empleados->links() }} <!--Esto sirve para paginar. No estoy seguro si funciona para el framework-->
				</div>

			</div>

		</div>

		        
		
		

	</div>

</div>
@endsection

@section ('scriptcontenido')
<script>  
    

    $(document).ready(function() {        

     // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();  

  	});
  
  
</script>

@stop