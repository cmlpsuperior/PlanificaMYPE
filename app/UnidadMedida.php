<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    protected $table='unidadmedida';

    protected $primaryKey = 'idUnidadMedida';

    public $timestamps=false;

    protected $fillable = [
    	'nombre'
    ];

    protected $guarded = [
    ];


    //relaciones con otros modelos:
    public function articulos()
    {
        return $this->hasMany('PlanificaMYPE\Articulo', 'idUnidadMedida', 'idUnidadMedida');
    }
}
