<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table='usuario';

    protected $primaryKey = 'idUsuario';

    public $timestamps=false;

    protected $fillable = [
    	'usuario',
    	'contrasenia',
    	'idEmpleado',        
    ];    

    public function empleado (){
        return $this->belongsTo ('PlanificaMYPE\Empleado', 'idEmpleado', 'idEmpleado');
    }
}
