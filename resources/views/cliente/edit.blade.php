@extends ('layouts.base')

@section ('contenido')

<!-- Estos linea es para las migajas-->
        <nav class="teal">
          <div class="nav-wrapper container">
            <div class="col s12">
              <a href="#!" class="breadcrumb">Mant.</a>
              <a href="{{ url('cliente')}}" class="breadcrumb">Clientes</a>
              <a href="{{ action('ClienteController@edit', ['id'=>$cliente->idCliente])  }}" class="breadcrumb">Editar</a>
            </div>
          </div>
        </nav>

        


        <!--Contenido del cuerpo-->
        <br>
        <div class="container">

          <div class="row">
            <div class="col s12 m10 l8 offset-m1 offset-l2 ">
              <div class="card">
                <div class="card-content">
                  {{Form::model ($cliente, array('action' => array('ClienteController@update', $cliente->idCliente), 'method'=>'put'))}}
                    <div class="row">
                      <h4 class="teal-text">Modificar cliente</h4>
                    </div>
                    <br>
                    
                    <!--Mostrara los errores que se hayan cometido:-->
                    @if (count($errors)>0)
                    <div class="alert">
                      <ul>
                          @foreach ($errors -> all() as $error)
                            <li>{{$error}}</li>
                          @endforeach
                      </ul>
                    </div>
                    @endif

                    <div class="row">
                      <h5>Datos personales</h5>
                    </div>


                    <div class="row">
                      <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="Nombres" type="text" class="validate" required value="{{$cliente->nombres}}"  name="nombres">
                        <label for="Nombres">Nombres *</label>
                      </div>
                      
                      <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="ApellidoPaterno" type="text" class="validate" required value="{{$cliente->apellidoPaterno}}" name="apellidoPaterno">
                        <label for="ApellidoPaterno">Apellido paterno *</label>
                      </div>              
                    </div>

                    <div class="row">              
                      <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="ApellidoMaterno" type="text" class="validate" required value="{{$cliente->apellidoMaterno}}" name="apellidoMaterno">
                        <label for="ApellidoMaterno">Apellido materno *</label>
                      </div>

                    </div>

                    <div class="row">              
                      <div class="input-field col s6">
                        <i class="material-icons prefix">today</i>
                        <input id="fechaNacimiento" type="date" class="datepicker" value="{{$cliente->fechaNacimiento}}" name="fechaNacimiento">
                        <label for="fechaNacimiento">Fecha nacimiento *</label>
                      </div>

                      <div class="input-field col s6">
                                            
                        <input name="genero" type="radio" id="genero1" value='1' @if ($cliente->genero ===  1) checked="checked" @endif />
                        <label for="genero1">Hombre</label>
                        
                        <input name="genero" type="radio" id="genero2" value='2' @if ($cliente->genero ===  2) checked="checked" @endif />
                        <label for="genero2">Mujer</label>                    
                        
                      </div>

                    </div>

                    <!--Datos ocultos: tipo DNI y credito-->
                    <input type="hidden" value="{{$cliente->numeroDocumento}}" name="numeroDocumento">
                    <input type="hidden" value="{{$cliente->idTipoDocumento}}" name="idTipoDocumento">
                    <input type="hidden" value="{{$cliente->credito}}" name="credito">


                    <br>
                    <div class="row">
                      <h5>Datos de contacto</h5>
                    </div>

                    <div class="row">
                      <div class="input-field col s6">
                        <i class="material-icons prefix">phone</i>
                        <input id="icon_telephone" type="tel" class="validate" value="{{$cliente->telefono}}" name="telefono">
                        <label for="icon_telephone">Teléfono</label>
                      </div>

                      <div class="input-field col s6">
                        <i class="material-icons prefix">email</i>
                        <input id="email" type="email" class="validate" value="{{$cliente->correo}}" name="correo">
                        <label for="email" data-error="wrong" data-success="right">Correo</label>
                      </div>
                    </div>
                    

                    <div class="row">
                      <div class="input-field col s6">
                        <i class="material-icons prefix">location_on</i>
                        <select name="idZona">                          
                          <option value="{{$cliente->zona->idZona}}">{{$cliente->zona->nombre}}</option>

                          @foreach ($zonas as $zona)
                          <option value="{{$zona->idZona}}">{{$zona->nombre}}</option>
                          @endforeach

                        </select>
                        <label>Zona *</label>
                      </div>    

                      <div class="input-field col s6">
                        <i class="material-icons prefix">location_on</i>
                        <input id="direccion" type="text" class="validate" required  value="{{$cliente->direccion}}" name="direccion">
                        <label for="direccion">Dirección *</label>
                      </div>          
                    </div>
                  

                    <div class="row">
                      <div class="input-field col s12">
                        <i class="material-icons prefix">location_on</i>
                        <textarea id="referencia" class="materialize-textarea" name="referencia">{{ $cliente->referencia }}</textarea>
                        <label for="referencia">Referencia</label>
                      </div> 
                    </div>
                    


                    <!--Los botones del formulario-->
                    <div class="row">
                      <div class="input-field col s12 right-align">
                        <a class="waves-effect waves-light btn" href="{{ url('cliente')}}">Cancelar</a>
                        <button class="btn waves-effect waves-light" type="submit" name="action">Actualizar
                          <i class="material-icons right">send</i>
                        </button>                
                      </div>              
                    </div>
                    
                  {{ Form::close()}}
                </div>
              </div>
            </div>
          </div>
        </div>

@stop



@section ('scriptcontenido')
<script>
    $(document).ready(function() {

           

      $('.datepicker').pickadate({ /*es para que funcione e datepicker*/
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 200, // Creates a dropdown of 15 years to control year
        format: 'yyyy/mm/dd'
      });

      


      /*Para inicar el select*/
      $('select').material_select();     

    

  });

  
</script>
@stop