<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    public $table="localidad";
    protected $fillable=['id_localidad','descripcion'];
}
