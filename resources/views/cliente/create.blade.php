@extends ('layouts.base')
@section ('contenido')


        <!-- Estos linea es para las migajas-->
        <nav class="teal">
          <div class="nav-wrapper container">
            <div class="col s12">
              <a href="#!" class="breadcrumb">Mant.</a>
              <a href="#!" class="breadcrumb">Clientes</a>
              <a href="#!" class="breadcrumb">Registrar</a>
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
                  {{Form::open (array('url' => 'cliente', 'method'=>'POST'))}} <!--para llamar al store, se le llama igual que al index, pero con metodo post-->
                    <div class="row">
                      <h4 class="teal-text">Registrar nuevo cliente</h4>
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
                        <input id="Nombres" type="text" class="validate" required  value="{{ old('nombres') }}" name="nombres">
                        <label for="Nombres">Nombres *</label>
                      </div>
                      
                      <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="ApellidoPaterno" type="text" class="validate" required value="{{ old('apellidoPaterno') }}" name="apellidoPaterno">
                        <label for="ApellidoPaterno">Apellido paterno *</label>
                      </div>              
                    </div>

                    <div class="row">              
                      <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="ApellidoMaterno" type="text" class="validate" required value="{{ old('apellidoMaterno') }}" name="apellidoMaterno">
                        <label for="ApellidoMaterno">Apellido materno *</label>
                      </div>

                      <div class="input-field col s6">
                        <i class="material-icons prefix">assignment_ind</i>
                        <input id="dni" type="text" class="validate" required value="{{ old('numeroDocumento') }}" name="numeroDocumento">
                        <label for="dni">DNI *</label>
                      </div>

                    </div>
                    <br>
                    <div class="row">
                      <h5>Datos de contacto</h5>
                    </div>

                    <div class="row">
                      <div class="input-field col s6">
                        <i class="material-icons prefix">phone</i>
                        <input id="icon_telephone" type="tel" class="validate" value="{{ old('telefono') }}" name="telefono">
                        <label for="icon_telephone">Teléfono</label>
                      </div>

                      <div class="input-field col s6">
                        <i class="material-icons prefix">email</i>
                        <input id="email" type="email" class="validate" value="{{ old('correo') }}" name="correo">
                        <label for="email" data-error="wrong" data-success="right">Correo</label>
                      </div>
                    </div>
                    

                    <div class="row">
                      <div class="input-field col s6">
                        <i class="material-icons prefix">location_on</i>
                        <select name="zona" required class="validate">
                          <option value="" disabled selected>Seleccionar</option>
                          <option value="1">Caja de agua</option>
                          <option value="2">Bayovar</option>
                          <option value="3">Mariategui</option>
                          <option value="4">Mariscal caceres</option>
                          <option value="5">Jicamarca</option>
                          <option value="6">10 de octubre</option>

                        </select>
                        <label>Zona *</label>
                      </div>    

                      <div class="input-field col s6">
                        <i class="material-icons prefix">location_on</i>
                        <input id="direccion" type="text" class="validate" required value="{{ old('direccion') }}" name="direccion">
                        <label for="direccion">Dirección *</label>
                      </div>          
                    </div>
                  

                    <div class="row">
                      <div class="input-field col s12">
                        <i class="material-icons prefix">location_on</i>
                        <textarea id="referencia" class="materialize-textarea" value="{{ old('referencia') }}" name="referencia"></textarea>
                        <label for="referencia">Referencia</label>
                      </div> 
                    </div>
                    


                    <!--Los botones del formulario-->
                    <div class="row">
                      <div class="input-field col s12 right-align">
                        <a class="waves-effect waves-light btn">Cancelar</a>
                        <button class="btn waves-effect waves-light" type="submit" name="action">Registrar
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

@endsection