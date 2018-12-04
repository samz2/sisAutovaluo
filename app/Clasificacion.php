<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
    public $table="clasificacion";
    protected $primaryKey="id_clasificacion";
    protected $fillable=['id_clasificacion','descripcion'];
    public $timestamps=false;
}
