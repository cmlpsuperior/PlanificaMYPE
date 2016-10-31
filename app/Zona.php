<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $table='zona';

    protected $primaryKey = 'idZona';

    public $timestamps=false;

    protected $fillable = [
    	'nombre',
    	'urbanizacion',
    	'montoFlete'
    ];

    protected $guarded = [
    ];

    //relaciones con otros modelos:
    public function clientes()
    {
        return $this->hasMany('PlanificaMYPE\Cliente', 'idZona', 'idZona');
    }

    public function pedidos()
    {
        return $this->hasMany('PlanificaMYPE\Pedido', 'idZona', 'idZona');
    }
}
