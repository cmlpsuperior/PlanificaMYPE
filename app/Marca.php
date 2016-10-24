<?php

namespace PlanificaMYPE;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table='marca';

    protected $primaryKey = 'idMarca';

    public $timestamps=false;

    protected $fillable = [
    	'nombre'
    ];

    protected $guarded = [
    ];


    //relaciones con otros modelos:
    public function articulos()
    {
        return $this->hasMany('PlanificaMYPE\Articulo', 'idMarca', 'idMarca');
    }
}
