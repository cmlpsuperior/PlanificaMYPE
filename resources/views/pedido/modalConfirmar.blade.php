
<!-- Modal Structure -->
<div id="modalConfirmar" class="modal">
  <div class="modal-content">
    <h4>Buscar pedido</h4>    

    <div class="row">
    
      <div class="input-field col s6">
        <input id="mcNumeroDocumento" type="text"  class="validate"  name="mcNumeroDocumento">
        <label for="mcNumeroDocumento">N° Documento</label>
      </div>

      <div class="input-field col s6">
        <input id="mcIdPedido" type="text"class="validate" name="mcIdPedido">
        <label for="mcIdPedido">Código pedido</label>
      </div>
                  
    </div> 

    <div class= "row">
      <div class="col s12 right-align">
        <a  class="waves-effect waves-light btn" id="btnBuscarPedidoModal">+ Buscar</a>
      </div>      
    </div>

    <div class="row">
            
      <table class="bordered highlight responsive-table" id="tblBuscarPedido">
        <thead>
          <tr>
              <th data-field="seleccionar">Selec.</th>
              
              <th data-field="nombre">Nombre</th>
              <th data-field="numeroDocumento">N° documento</th>
              <th data-field="fechaRegistro">Fecha registro</th>
              <th data-field="montoTotal">Monto (S/.)</th>
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
   	
   	<button class="modal-action modal-close waves-effect waves-teal btn-flat" name="btnAgregarPedidoModal" id="btnAgregarPedidoModal">Agregar</button> 
    <a  class="modal-action modal-close waves-effect waves-teal btn-flat">Cancelar</a>    
   
  </div>
</div>