<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table='vehiculo';

    protected $primaryKey = 'idVehiculo';

    public $timestamps=false;

    protected $fillable = [
    	'nombre',
    	'anio',
    	'modelo',
    	'placa',
    	'idMarcaVehiculo',
    	'idTipoVehiculo'
    ];

    protected $guarded = [
    ];

    //relaciones con otros modelos:
    public function tipoVehiculo()
    {
        return $this->belongsTo('PlanificaMYPE\TipoVehiculo', 'idTipoVehiculo', 'idTipoVehiculo');
    }

    public function marcaVehiculo (){
    	return $this->belongsTo('PlanificaMYPE\MarcaVehiculo', 'idMarcaVehiculo', 'idMarcaVehiculo');
    }
}
