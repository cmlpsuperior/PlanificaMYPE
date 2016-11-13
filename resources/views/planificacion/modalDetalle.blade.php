
<!-- Modal Structure -->
<div id="modalDetalle-{{$key}}" class="modal">
  <div class="modal-content">
    <h4>Detalle de la carga</h4>    

    <div class="row">
    
      <div class="input-field col s6">
        <input id="mdTipoVehiculo" type="text"  class="validate"  name="mdTipoVehiculo" value= "{{ $viaje['tipoVehiculo']->nombre }}">
        <label for="mdTipoVehiculo">Tipo de vehículo</label>
      </div>
                  
    </div> 
    
    <div class="row">
            
      <table class="bordered highlight responsive-table" id="tblDetalle-{{$key}}">
        <thead>
          <tr>
              <th >Cantidad</th>              
              <th >Unidad</th>
              <th >Material</th>
              <th >Volumen total (m3)</th>
              <th >Tipo de carga</th>
              <th >Cliente</th>
          </tr>
        </thead>
  
        <tbody>
            @foreach ($viaje['detallesLineas'] as $detalleLinea)
              <tr>                  
                <td>{{ $detalleLinea['cantidad'] }} </td>
                <td>{{ $detalleLinea['articulo']->unidadMedida->nombre }}</td>
                <td>{{ $detalleLinea['articulo']->nombre }} - {{ $detalleLinea['articulo']->marca->nombre }} </td>
                <td>{{ $detalleLinea['articulo']->volumen * $detalleLinea['cantidad']  }} </td>    
                <td>{{ $detalleLinea['articulo']->tipoCarga->nombre   }} </td>                  
                <td>{{ $detalleLinea['pedido']->cliente->nombres }} {{ $detalleLinea['pedido']->cliente->apellidoPaterno }}</td>
              </tr>
            @endforeach
        </tbody>
        
      </table>    
                 
    </div>

  </div>
  <br><br>
  <div class="modal-footer">    
    
    <a  class="modal-action modal-close waves-effect waves-teal btn-flat">Aceptar</a> 
    <a  class="modal-action modal-close waves-effect waves-teal btn-flat">Cancelar</a>    
   
  </div>
</div>