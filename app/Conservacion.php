<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conservacion extends Model
{
    public $table="conservacion";
    protected $fillable=['id_conservacion','descripcion'];
    public $timestamp=false;
}
