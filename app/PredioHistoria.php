<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PredioHistoria extends Model
{
    public $table="prediohistoria";
    protected $fillable=[
        'id',
        'codPredioContribuyente',
        'valorPredio',
        'anio',
        'percentPropiedad',
        'created_at',
        'updated_at'
    ];
}
