<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CondicionPropiedad;

class CondicionPropiedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $condicion = CondicionPropiedad::all();
        return compact('condicion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $condicion = CondicionPropiedad::create(['descripcion' => strtoupper($request->condicion)]);
        return $condicion ? 'bien' : 'error';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $condicion = CondicionPropiedad::where('id_condicion', $id)->update(['descripcion' => strtoupper($request->condicion)]);
        return $condicion ? 'bien' : 'error';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $condicion = CondicionPropiedad::where('id_condicion', $id)->delete();
        return $condicion ? 'bien' : 'error';
    }
}
