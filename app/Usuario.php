<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;


class Usuario extends Model
{
 
    protected $table='users';

    protected $primaryKey = 'id';

    public $timestamps=false;

    protected $fillable = [
    	'usuario',
    	'password',
    	'idEmpleado',        
    ];    

    public function empleado (){
        return $this->belongsTo ('PlanificaMYPE\Empleado', 'idEmpleado', 'idEmpleado');
    }
}
