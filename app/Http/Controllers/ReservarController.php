<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Reservar as ReservarResources;
use App\Http\Resources\ReservarCollection;
use App\reservar;

class ReservarController extends Controller
{
    public function __construct(reservar $reservar)
    {
        $this->reservar =$reservar;

    }


    public function index()
    {
        return response()->json(new ReservarCollection(
            $this->reservar->orderBy('id','desc')->get()
        ));
    }

    public function store(Request $request)
    {
        $dato = reservar::all();
        $numeric;


        foreach ($dato as $key => $value) {
            if ($value->id_restaurantes == $request->id_restaurantes) {
                if ($value->fecha == $request->fecha) {
                    $suma= $value->numero_reservas+$request->numero_reservas;
                      if ($suma== 15 || $suma >15) {
                        return response()->json(null, 400);

                      }else{
                        $numeric =1;
                      } 

                    }else{
                        $numeric =1;
                    }
                }else{
                    $numeric =1;
                }


            }

        
        if($dato == "[]" || $numeric == "1")
         {
        $reservar = $this->reservar->create($request->all());
        return response()->json(new ReservarResources($reservar),201);
        }
    }

    public function show(reservar $reservar)
    {
        return response()->json(new ReservarResources($reservar));

    }


    public function update(Request $request, reservar $reservar)
    {
        $dato = reservar::all();
        $numeric;
        foreach ($dato as $key => $value) {
            if ($value->id_restaurantes == $request->id_restaurantes) {
                if ($value->fecha == $request->fecha) {
                    $suma= $value->numero_reservas+$request->numero_reservas;
                      if ($suma== 15 || $suma >15) {
                        return response()->json(null, 400);

                      }else{
                        $numeric =1;
                      } 

                    }else{
                        $numeric =1;
                    }
                }else{
                    $numeric =1;
                }


            }
            if($dato == "[]" || $numeric == "1")
            {
        $reservar->update($request->all());

        return response()->json(new ReservarResources($reservar));
            }
    }


    public function destroy(reservar $reservar)
    {
        $reservar->delete();

        return response()->json(null, 204);
    }
}
