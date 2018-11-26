<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CondicionPropiedad extends Model
{
    public $table="condicion_propiedad";
    protected $fillable=['id_condicion','descripcion'];
    public $timestamps=false;
}
