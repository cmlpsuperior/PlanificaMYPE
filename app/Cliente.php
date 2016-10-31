<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table='cliente';

    protected $primaryKey = 'idCliente';

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


    //relaciones con otros modelos:
    public function zona()
    {
        return $this->belongsTo('PlanificaMYPE\Zona', 'idZona', 'idZona');
    }

    public function pedidos()
    {
        return $this->hasMany ('PlanificaMYPE\Pedido', 'idCliente', 'idCliente');
    }
}
