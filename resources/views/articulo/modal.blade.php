
<!-- Modal Structure -->
<div id="modal-delete-{{$articulo->idArticulo}}" class="modal">
  <div class="modal-content">
    <h4>Eliminar articulo</h4>
    <p>¿Está seguro que desea eliminar el articulo?</p>
  </div>
  <div class="modal-footer">
    {{Form::Open (array ('action'=> array ('ArticuloController@destroy', $articulo->idArticulo), 'method'=>'delete'))}}
   	
   	<button class="modal-action modal-close waves-effect waves-teal btn-flat" type="submit" name="action">Eliminar</button> 
    <a  class="modal-action modal-close waves-effect waves-teal btn-flat">Cancelar</a>
    
    {{Form::close()}}
  </div>
</div>