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
        'numeroDocumento',
        'fechaNacimiento',
        'genero',

    	'telefono',
    	'correo',
    	'direccion',
        'referencia',    	
    	'credito',
        
    	'idTipoDocumento',
    	'idZona'
    ];

    protected $guarded = [
    ];
}
