<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $table="material";
    protected $fillable=['id_material','descripcion'];
    public $timestamps=false;
}
