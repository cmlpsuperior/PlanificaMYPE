
<!-- Modal Structure -->
<div id="modalConfirmar-{{$key}}" class="modal">
  <div class="modal-content">
    <h4>Detalle de la carga</h4>    

    <div class="row">
    
      <div class="input-field col s6">
        <input id="mdTipoVehiculo" type="text"  class="validate"  name="mdTipoVehiculo" readonly>
        <label for="mdTipoVehiculo">Tipo de vehículo</label>
      </div>
                  
    </div> 

    <div class="row">
            
      <table class="bordered highlight responsive-table" id="tblBuscarPedido">
        <thead>
          <tr>
              <th data-field="cantidad">Cantidad</th>              
              <th data-field="nombre">Unidad</th>
              <th data-field="numeroDocumento">Material</th>
              <th data-field="fechaRegistro">Cliente</th>
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