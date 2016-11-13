<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table='cargo';

    protected $primaryKey = 'idCargo';

    public $timestamps=false;

    protected $fillable = [
    	'nombre',
    	'descripcion'
    ];

    protected $guarded = [
    ];

    //relaciones con otros modelos:
    public function empleados()
    {
        return $this->hasMany('PlanificaMYPE\Empleado', 'idCargo', 'idCargo');
    }
}
