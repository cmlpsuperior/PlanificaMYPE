
<!-- Modal Structure -->
<div id="modalCliente" class="modal">
  <div class="modal-content">
    <h4>Buscar cliente</h4>    

    <div class="row">
    
      <div class="input-field col s6">
        <input id="bcNombre" type="text"class="validate" name="bcNombre">
        <label for="bcNombre">Nombre</label>
      </div>

      <div class="input-field col s6">
        <input id="bcNumeroDocumento" type="text"  class="validate"  name="bcNumeroDocumento">
        <label for="bcNumeroDocumento">N° Documento</label>
      </div>
                  
    </div> 

    <div class= "row">
      <div class="col s12 right-align">
        <a  class="waves-effect waves-light btn" id="btnBuscarClienteModal">+ Buscar</a>
      </div>      
    </div>

    <div class="row">
            
      <table class="bordered highlight responsive-table" id="tblBuscarClientes">
        <thead>
          <tr>
              <th data-field="seleccionar">Seleccionar</th>
              
              <th data-field="nombre">Nombre</th>
              <th data-field="numeroDocumento">N° documento</th>
              <th data-field="fechaNacimiento">Fecha nacimiento</th>
              <th data-field="credito">Crédito</th>
          </tr>
        </thead>

        <tbody>
          <!--Se va a llenar con AJAX-->
        </tbody>
        
      </table>    
                 
    </div>

  </div>
  <br><br>
  <div class="modal-footer">    
   	
   	<button class="modal-action modal-close waves-effect waves-teal btn-flat" name="btnAgregarClienteModal" id="btnAgregarClienteModal">Agregar</button> 
    <a  class="modal-action modal-close waves-effect waves-teal btn-flat">Cancelar</a>    
   
  </div>
</div>