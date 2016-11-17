<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table='tipodocumento';

    protected $primaryKey = 'idTipoDocumento';

    public $timestamps=false;

    protected $fillable = [
    	'nombre',
    	'descripcion'
    ];

    protected $guarded = [
    ];

    //relaciones con otros modelos:
    public function clientes()
    {
        return $this->hasMany('PlanificaMYPE\Cliente', 'idTipoDocumento', 'idTipoDocumento');
    }

    //relaciones con otros modelos:
    public function empleados()
    {
        return $this->hasMany('PlanificaMYPE\Empleado', 'idTipoDocumento', 'idTipoDocumento');
    }
    
}
