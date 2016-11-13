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
        return $this->belongTo('PlanificaMYPE\TipoVehiculo', 'idTipoVehiculo', 'idTipoVehiculo');
    }

    public function empleado (){
    	return $this->belongTo('PlanificaMYPE\Empleado', 'idEmpleado', 'idEmpleado');
    }

    public function vehiculo (){
    	return $this->belongTo('PlanificaMYPE\Vehiculo', 'idVehiculo', 'idVehiculo');
    }
}
