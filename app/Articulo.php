<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table='articulo';

    protected $primaryKey = 'idArticulo';

    public $timestamps=false;

    protected $fillable = [
    	'nombre',
    	'precioBase',
    	'stock',
    	'volumen',
        'tiempoHorasAbastecer',
        'combinable',
        'minimoDivisible',
        'activo',
        
    	'idMarca',
    	'idTipoCarga',
    	'idUnidadMedida'
    ];

    protected $guarded = [
    ];

    //relaciones con otros modelos:
    public function marca()
    {
        return $this->belongsTo('PlanificaMYPE\Marca', 'idMarca', 'idMarca');
    }

    public function tipoCarga()
    {
        return $this->belongsTo('PlanificaMYPE\TipoCarga', 'idTipoCarga', 'idTipoCarga');
    }

    public function unidadMedida()
    {
        return $this->belongsTo('PlanificaMYPE\UnidadMedida', 'idUnidadMedida', 'idUnidadMedida');
    }

    //relaciond e muchos a muchos con articulo:
    public function pedidos (){
        return $this->belongsToMany('PlanificaMYPE\Pedido', 'detallepedido', 'idArticulo', 'idPedido')
                    ->withPivot('cantidad', 'cantidadAtendida', 'precioUnitario', 'monto');
    }

}
