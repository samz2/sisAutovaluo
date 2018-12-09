<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    public $table="sector";
    protected $fillable=[
        'id_sector',
        'descripcion'
    ];

    public $timestamps = false;
}
