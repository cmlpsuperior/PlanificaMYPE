@extends ('layouts.base')
@section ('contenido')


        <!--Contenido del cuerpo-->
        
        <div class="container">
          <form class="col s12">
            <div class="row">
              <h4>Registrar nuevo cliente</h4>
            </div>
            <br>

            <div class="row">
              <h5>Datos personales</h5>
            </div>


            <div class="row">
              <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="Nombres" type="text" class="validate">
                <label for="Nombres">Nombres</label>
              </div>
              
              <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="ApellidoPaterno" type="text" class="validate">
                <label for="ApellidoPaterno">Apellido paterno</label>
              </div>              
            </div>

            <div class="row">              
              <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="ApellidoMaterno" type="text" class="validate">
                <label for="ApellidoMaterno">Apellido materno</label>
              </div>

              <div class="input-field col s6">
                <i class="material-icons prefix">assignment_ind</i>
                <input id="dni" type="text" class="validate">
                <label for="dni">DNI</label>
              </div>

            </div>
            <br>
            <div class="row">
              <h5>Datos de contacto</h5>
            </div>

            <div class="row">
              <div class="input-field col s6">
                <i class="material-icons prefix">phone</i>
                <input id="icon_telephone" type="tel" class="validate">
                <label for="icon_telephone">Teléfono</label>
              </div>

              <div class="input-field col s6">
                <i class="material-icons prefix">email</i>
                <input id="email" type="email" class="validate">
                <label for="email" data-error="wrong" data-success="right">Correo</label>
              </div>
            </div>
            

            <div class="row">
              <div class="input-field col s6">
                <i class="material-icons prefix">location_on</i>
                <select>
                  <option value="" disabled selected>Seleccionar</option>
                  <option value="1">Caja de agua</option>
                  <option value="2">Bayovar</option>
                  <option value="3">Mariategui</option>
                  <option value="4">Mariscal caceres</option>
                  <option value="5">Jicamarca</option>
                  <option value="6">10 de octubre</option>

                </select>
                <label>Zona</label>
              </div>    

              <div class="input-field col s6">
                <i class="material-icons prefix">location_on</i>
                <input id="direccion" type="text" class="validate">
                <label for="direccion">Dirección</label>
              </div>          
            </div>
          

            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">location_on</i>
                <textarea id="referencia" class="materialize-textarea"></textarea>
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
            
          </form>
        </div>
@stop