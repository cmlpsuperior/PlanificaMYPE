
<!-- Modal Structure -->
<div id="modal-delete-{{$pedido->idPedido}}" class="modal">
  <div class="modal-content">
    <h4>Anular pedido</h4>
    <p>¿Está seguro que desea anular el pedido?</p>
  </div>
  <div class="modal-footer">
    {{Form::Open (array ('action'=> array ('PedidoController@destroy', $pedido->idPedido), 'method'=>'delete'))}}
   	
   	<button class="modal-action modal-close waves-effect waves-teal btn-flat" type="submit" name="action">Eliminar</button> 
    <a  class="modal-action modal-close waves-effect waves-teal btn-flat">Cancelar</a>
    
    {{Form::close()}}
  </div>
</div>