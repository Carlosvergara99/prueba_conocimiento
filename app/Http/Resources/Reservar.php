<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Reservar extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'   => $this->id,
            'fecha' => $this->fecha,
            'id_restaurantes'=>$this->id_restaurantes,
            'nombre' =>$this->Restaurantes->nombre,
            'numero_reservas'=>$this->numero_reservas

            ];
    
    }
}
