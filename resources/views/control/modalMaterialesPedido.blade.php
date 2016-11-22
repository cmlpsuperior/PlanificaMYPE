<!-- Modal Structure -->
<div id="modalMaterialesPedido-{{$pedido->idPedido}}" class="modal">
  <div class="modal-content">
    <h4>Materiales</h4>    

    <div class="row">
            
      <table class="bordered highlight responsive-table" id="tblBuscarArticulos">
        <thead>
          <tr>
              <th data-field="cantidad">Cantidad</th>              
              <th data-field="unidad">Unidad</th>
              <th data-field="material">Material</th>
              <th data-field="marca">Marca</th>
              <th data-field="atentida">Cant. atendida</th>
          </tr>
        </thead>

        <tbody>
        @foreach ($pedido->articulos as $key => $articulo)
          <tr>
            <td>{{ $articulo->pivot->cantidad }} </td>
            <td>{{ $articulo->unidadMedida->nombre }} </td>
            <td>{{ $articulo->nombre }} </td>
            <td>{{ $articulo->marca->nombre }} </td> 
            
            <td class="teal-text">{{ $articulo->pivot->cantidadAtendida }} </td>
          </tr>
        @endforeach
        </tbody>
        
      </table>    
                 
    </div>

  </div>
  <br><br>
  <div class="modal-footer">    
   	
   	<button class="modal-action modal-close waves-effect waves-teal btn-flat" name="btnMaterialesPedido" id="btnMaterialesPedido">Aceptar</button>   
   
  </div>
</div>