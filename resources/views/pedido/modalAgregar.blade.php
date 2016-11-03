
<!-- Modal Structure -->
<div id="modalAgregar" class="modal">
  <div class="modal-content">
    <h4>Agregar articulo</h4>    

    <div class="row">
    
      <div class="input-field col s6">
        <input id="bNombre" type="text"class="validate" name="bNombre">
        <label for="bNombre">Nombre</label>
      </div>

      <div class="input-field col s6">
        <input id="bMarca" type="text"  class="validate"  name="bMarca">
        <label for="bMarca">Marca</label>
      </div>
                  
    </div> 

    <div class= "row">
      <div class="col s12 right-align">
        <a href="#!" class="waves-effect waves-light btn" id="btnBuscarModal">+ Buscar</a>
      </div>      
    </div>

    <div class="row">
            
      <table class="bordered highlight responsive-table" id="tblBuscarArticulos">
        <thead>
          <tr>
              <th data-field="cantidad">Cantidad</th>
              <th data-field="descripcion">Unidad</th>
              <th data-field="descripcion">Nombre</th>
              <th data-field="descripcion">Marca</th>
              <th data-field="precio">P. U. (S/.)</th>
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
   	
   	<button class="modal-action waves-effect waves-teal btn-flat" name="btnAgregarModal" id="btnAgregarModal">Agregar</button> 
    <a  class="modal-action modal-close waves-effect waves-teal btn-flat">Cancelar</a>    
   
  </div>
</div>