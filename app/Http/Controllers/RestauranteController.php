<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Restaurante as RestauranteResources;
use App\Http\Resources\RestauranteCollection;
use App\restaurante;

class RestauranteController extends Controller
{
    public function __construct(restaurante $restaurante)
    {
        $this->restaurante =$restaurante;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(new RestauranteCollection(
            $this->restaurante->orderBy('id','desc')->get()
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $restaurante = $this->restaurante->create($request->all());
        return response()->json(new RestauranteResources($restaurante),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(restaurante $restaurante)
    {
        return response()->json(new RestauranteResources($restaurante));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $restaurante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, restaurante $restaurante)
    {
        $restaurante->update($request->all());

        return response()->json(new RestauranteResources($restaurante));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(restaurante $restaurante)
    {
        $restaurante->delete();

        return response()->json(null, 204);
    }
}
