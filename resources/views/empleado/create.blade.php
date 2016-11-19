@extends ('layouts.base')

@section ('contenido')


<!-- Estos linea es para las migajas-->
<nav class="teal">
  <div class="nav-wrapper container">
    <div class="col s12">
      <a href="#!" class="breadcrumb">Mant.</a>
      <a href="{{ url('empleado')}}" class="breadcrumb">Empleado</a>
      <a href="{{ url('empleado/create')}}" class="breadcrumb">Registrar</a>
    </div>
  </div>
</nav>


<!--Contenido del cuerpo-->
<br>
<div class="container">

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

  <div class="row">
    <div class="col s12 center ">
      <h5>Registrar empleado</h5>
      
    </div>
  </div>
          
  {{Form::open (array('url' => 'empleado', 'method'=>'POST'))}} <!--para llamar al store, se le llama igual que al index, pero con metodo post-->
  <div class="row">

    <div class="col s12 m12 l6">
      <div class="card ">

        <div class="card-content teal white-text">
            <i class="material-icons prefix">account_circle</i>
            <span class="card-title ">Datos personales</span>                  
        </div>

        <div class="card-content ">
          
          <div class="row">
            <div class="input-field col s6">
              <input id="nombres" type="text" class="validate"  required value="{{ old('nombres') }}" name="nombres">
              <label for="nombres">Nombres *</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s6">
              <input id="apellidoPaterno" type="text" class="validate"  required value="{{ old('apellidoPaterno') }}" name="apellidoPaterno">
              <label for="apellidoPaterno">Apellido Pat. *</label>
            </div>
            <div class="input-field col s6">
              <input id="apellidoMaterno" type="text" class="validate"  required value="{{ old('apellidoMaterno') }}" name="apellidoMaterno">
              <label for="apellidoMaterno">Apellido Mat. *</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s6">
              <select name="idTipoDocumento" id="idTipoDocumento">                          
                  
                @foreach ($tiposDocumentos as $tipoDocumento)
                  <option value="{{$tipoDocumento->idTipoDocumento}}" @if ($tipoDocumento->idTipoDocumento == old('idTipoDocumento') ) selected  @endif>{{$tipoDocumento->nombre}}</option>
                @endforeach
              </select>
              <label for="idTipoDocumento">Tipo doc. *</label>
            </div>
            <div class="input-field col s6">
              <input id="numeroDocumento" type="number" class="validate"  required value="{{ old('numeroDocumento') }}" name="numeroDocumento">
              <label for="numeroDocumento">N° Documento *</label>
            </div>
          </div>


        </div>
        
      </div>
    </div> <!--Acaba la tarjeta 1-->
    
    <!--inicia la tarjeta 2-->
    <div class="col s12 m12 l6">
      <div class="card">
        
        <div class="card-content teal white-text">
          <i class="material-icons prefix">info</i>
          <span class="card-title">Datos adicionales</span>                
        </div>

        <div class="card-content">

          <div class="row">              
            <div class="input-field col s6">
              <i class="material-icons prefix" for="fechaIngreso">today</i>
              <input id="fechaIngreso" type="date" class="datepicker" value="{{ old('fechaIngreso') }}" name="fechaIngreso">
              <label for="fechaIngreso">Ingreso *</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s6">                      
              <select name="idCargo" id="idCargo">                          
                <option value="">Seleccionar</option>
                @foreach ($cargos as $cargo)
                  <option value="{{$cargo->idCargo}}" @if ( $cargo->idCargo == old('idCargo') ) selected @endif >{{$cargo->nombre}}</option>
                @endforeach
              </select>
              <label>Cargo *</label>
            </div> 

            <div class="input-field col s6">
              <input id="sueldo" type="number" min="0" step="0.01" class="validate" required value="{{ old('sueldo') }}" name="sueldo">
              <label for="sueldo" data-error="wrong" data-success="right">sueldo (S/.) *</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s6">
              <input id="correo" type="text" class="validate"  value="{{ old('correo') }}" name="correo">
              <label for="correo">Correo</label>
            </div>
            <div class="input-field col s6">
              <input id="licencia" type="text" class="validate"  value="{{ old('licencia') }}" name="licencia">
              <label for="licencia">Licencia conducir</label>
            </div>
          </div>

        </div>
      </div>
    </div><!--Acaba la tarjeta 2-->

  </div>

  <!--Los botones del formulario-->
  <div class="row">
    <div class="input-field col s12 right-align">
      <a class="waves-effect waves-light btn" href="{{ url('empleado')}}">Cancelar</a>
      <button class="btn waves-effect waves-light" type="submit" name="action">Registrar
        <i class="material-icons right">send</i>
      </button>                
    </div>              
  </div>
  {{ Form::close()}}
</div>

@stop
