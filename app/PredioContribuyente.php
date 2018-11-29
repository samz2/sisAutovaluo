<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PredioContribuyente extends Model
{
    public $table="prediocontribuyente";
    protected $fillable=[
        'id',
        'codPredio',
        'codContribuyente',
        'created_at',
        'updated_at'
    ];
}
