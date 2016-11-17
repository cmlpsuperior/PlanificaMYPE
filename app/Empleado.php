<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table='empleado';

    protected $primaryKey = 'idEmpleado';

    public $timestamps=false;

    protected $fillable = [
    	'nombres',
    	'apellidoPaterno',
    	'apellidoMaterno',
    	'numeroDocumento',
        'correo',
        'estado',
        'sueldo',
        'licencia',
        'fechaIngreso',
        'fechaSalida',
        
    	'idCargo',
    	'idTipoDocumento'
    ];

    protected $guarded = [
    ];

    //relaciones con otros modelos:
    public function cargo()
    {
        return $this->belongsTo('PlanificaMYPE\Cargo', 'idCargo', 'idCargo');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo('PlanificaMYPE\TipoDocumento', 'idTipoDocumento', 'idTipoDocumento');
    }

    public function viajes()
    {
        return $this->hasMany ('PlanificaMYPE\Viaje', 'idEmpleado', 'idEmpleado');
    }

    public function pedidos (){
        return $this->hasMany ('PlanificaMYPE\Pedido', 'idPedido', 'idPedido');
    }

    public function usuario (){
        return $this->hasOne ('PlanificaMYPE\Usuario', 'idEmpleado', 'idEmpleado');
    }
}
