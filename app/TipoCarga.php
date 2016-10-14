<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class TipoCarga extends Model
{
    protected $table='tipocarga';

    protected $primaryKey = 'idtipocarga';

    public $timestamps=false;

    protected $fillable = [
    	'nombre',
    	'descripcion'
    ];

    protected $guarded = [
    ];
}
