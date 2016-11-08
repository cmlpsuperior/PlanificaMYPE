<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class MarcaVehiculo extends Model
{
    protected $table='marcavehiculo';

    protected $primaryKey = 'idMarcaVehiculo';

    public $timestamps=false;

    protected $fillable = [
    	'nombre'
    	
    ];

    protected $guarded = [
    ];

    //relaciones con otros modelos:
    public function vehiculos()
    {
        return $this->hasMany('PlanificaMYPE\Vehiculo', 'idMarcaVehiculo', 'idMarcaVehiculo');
    }
}
