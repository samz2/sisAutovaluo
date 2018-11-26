<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class predio extends Model
{
    public $table='predio';
    protected $fillable = [
        'CodPredio',
        'calle',
        'numero',
        'piso',
        'mz',
        'lote',
        'interior',
        'sector',
        'idCondicion',
        'idConservacion',
        'idMaterial',
        'idClasificacion',
        'idLocalidad',
        'latitud',
        'longitud',
        'created_at'
    ];
}
