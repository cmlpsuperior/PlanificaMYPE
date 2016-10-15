<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table='cliente';

    protected $primaryKey = 'idcliente';

    public $timestamps=false;

    protected $fillable = [
    	'nombres',
    	'apellidoPaterno',
    	'apellidoMaterno',
    	'razonSocial',
    	'telefono',
    	'correo',
    	'direccion',
    	'numeroDocumento',
    	'habilitado',
    	'idTipoDocumento',
    	'idZona'
    ];

    protected $guarded = [
    ];
}
