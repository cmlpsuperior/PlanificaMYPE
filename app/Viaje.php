<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    protected $table='viaje';

    protected $primaryKey = 'idViaje';

    public $timestamps=false;

    protected $fillable = [
    	'fechaRegistro',
    	'fechaSalida',
    	'fechaRetorno',
    	'estado',
    	
    	'idVehiculo',
    	'idTipoVehiculo',
    	'idEmpleado'
    ];

    protected $guarded = [
    ];

    //relaciones con otros modelos:
    public function tipoVehiculo()
    {
        return $this->belongsTo('PlanificaMYPE\TipoVehiculo', 'idTipoVehiculo', 'idTipoVehiculo');
    }

    public function empleado (){
    	return $this->belongsTo('PlanificaMYPE\Empleado', 'idEmpleado', 'idEmpleado');
    }

    public function vehiculo (){
    	return $this->belongsTo('PlanificaMYPE\Vehiculo', 'idVehiculo', 'idVehiculo');
    }


    //muchos a muchos
    public function articulos (){
        return $this->belongsToMany('PlanificaMYPE\Articulo', 'detalleviaje', 'idViaje', 'idArticulo')
                    ->withPivot('idPedido','cantidad', 'cantidadDescargado');
    }
    
}
