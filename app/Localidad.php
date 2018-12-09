<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    public $table="localidad";
    protected $primaryKey="id_localidad";
    protected $fillable=['id_localidad','descripcion'];
    public $timestamps=false;
}
