<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reservar extends Model
{
    protected $fillable = ['fecha','id_restaurantes','numero_reservas'];

    public  function Restaurantes()
    {
        return $this->belongsTo(restaurante::class,'id_restaurantes');

    }
}
