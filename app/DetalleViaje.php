<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class DetalleViaje extends Model
{
    protected $table='detalleviaje';

    protected $primaryKey = 'idViaje';

    public $timestamps=false;

    protected $fillable = [
    	'idArticulo',
    	'idPedido',
    	'cantidad',
    	'cantidadDescargado'
    ];

    protected $guarded = [
    ];

    //relaciones con otros modelos:
    public function articulo()
    {
        return $this->belongsTo('PlanificaMYPE\Articulo', 'idArticulo', 'idArticulo');
    }

    public function pedido (){
    	return $this->belongsTo('PlanificaMYPE\Pedido', 'idPedido', 'idPedido');
    }

    public function viaje (){
    	return $this->belongsTo('PlanificaMYPE\Viaje', 'idViaje', 'idViaje');
    }
}
