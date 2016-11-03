<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table='pedido';

    protected $primaryKey = 'idPedido';

    public $timestamps=false;

    protected $fillable = [
    	'fechaRegistro',
    	'fechaEnvio',
    	'montoTotal',
    	'montoPagado',
        'estado',

        'idCliente',
        'idEmpleado',        
    	'idZona'
    ];

    protected $guarded = [
    ];

    //relaciones con otros modelos:
    public function empleado()
    {
        return $this->belongsTo('PlanificaMYPE\Empleado', 'idEmpleado', 'idEmpleado');
    }

    public function cliente()
    {
        return $this->belongsTo('PlanificaMYPE\Cliente', 'idCliente', 'idCliente');
    }

    public function zona()
    {
        return $this->belongsTo('PlanificaMYPE\Zona', 'idZona', 'idZona');
    }

    //relaciond e muchos a muchos con articulo:
    public function articulos (){
        return $this->belongsToMany('PlanificaMYPE\Articulo', 'detallepedido', 'idPedido', 'idArticulo')
        			->withPivot('cantidad', 'cantidadAtendida', 'precioUnitario', 'monto');
    }
}
