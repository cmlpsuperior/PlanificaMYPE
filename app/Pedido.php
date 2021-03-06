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
        'direccion',
        'telefono',
        'referencia',

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

    //relacion muchos a muchos con viaje:
    public function viajes (){
        return $this->belongsToMany('PlanificaMYPE\Viaje', 'pedidoxviaje', 'idPedido', 'idViaje')
                    ->withPivot('montoCobrado',  'fechaUbicado', 'fechaEntrega', 'observaciones');
    }
    
    //relaciond e muchos a muchos con articulo:
    public function articulos (){
        return $this->belongsToMany('PlanificaMYPE\Articulo', 'detallepedido', 'idPedido', 'idArticulo')
        			->withPivot('cantidad', 'cantidadAtendida', 'precioUnitario', 'monto');
    }

    

}
