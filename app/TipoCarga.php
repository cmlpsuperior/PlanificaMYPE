<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class TipoCarga extends Model
{
    protected $table='tipocarga';

    protected $primaryKey = 'idTipoCarga';

    public $timestamps=false;

    protected $fillable = [
    	'nombre',
    	'descripcion'
    ];

    protected $guarded = [
    ];

    //relaciones con otros modelos:
    public function articulos()
    {
        return $this->hasMany('PlanificaMYPE\Articulo', 'idTipoCarga', 'idTipoCarga');
    }


    //relaciond e muchos a muchos con tipo de vehiculo:
    public function tiposVehiculos (){
        return $this->belongsToMany('PlanificaMYPE\TipoVehiculo', 'tipovehiculoxtipocarga',  'idTipoCarga', 'idTipoVehiculo')
                    ->withPivot('volumen');
    }
}
