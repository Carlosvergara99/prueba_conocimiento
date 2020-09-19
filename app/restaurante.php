<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class restaurante extends Model
{
    protected $fillable = ['nombre','descripcion','direccion','ciudad','foto'];

}
