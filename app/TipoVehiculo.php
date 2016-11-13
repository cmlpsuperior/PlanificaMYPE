<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class TipoVehiculo extends Model
{
    protected $table='tipovehiculo';

    protected $primaryKey = 'idTipoVehiculo';

    public $timestamps=false;

    protected $fillable = [
    	'nombre',
    	'descripcion'
    ];

    protected $guarded = [
    ];

    //relaciones con otros modelos:
    public function vehiculos()
    {
        return $this->hasMany('PlanificaMYPE\Vehiculo', 'idTipoVehiculo', 'idTipoVehiculo');
    }

     //relaciones con otros modelos:
    public function viajes()
    {
        return $this->hasMany('PlanificaMYPE\Viaje', 'idTipoVehiculo', 'idTipoVehiculo');
    }

    //relaciond e muchos a muchos con tipo de carga:
    public function tiposCargas (){
        return $this->belongsToMany('PlanificaMYPE\TipoCarga', 'tipovehiculoxtipocarga', 'idTipoVehiculo', 'idTipoCarga')
                    ->withPivot('volumen')->orderBy('tipovehiculoxtipocarga.idTipoCarga', 'asc'); //asi se que el codigo 1 va a estar primero, es obligatorio
    }
}
