<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class predioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $user = $user->id;
        $predio=\DB::select("SELECT p.codPredio, p.calle, p.numero, p.piso, p.mz, p.lote, p.interior, s.descripcion as sector,
                            cp.descripcion as condicion, co.descripcion as conservacion, m.descripcion as material,
                            c.descripcion as clasificacion, l.descripcion as localidad, p.latitud, p.longitud from predio p
                                INNER JOIN sector s ON p.sector=s.id_sector
                                INNER JOIN condicion_propiedad cp ON p.idCondicion=cp.id_condicion
                                INNER JOIN conservacion co ON p.idConservacion=co.id_conservacion
                                INNER JOIN material m on p.idMaterial=m.id_material
                                INNER JOIN clasificacion c ON p.idClasificacion=c.id_clasificacion
                                INNER JOIN localidad l ON p.idLocalidad=l.id_localidad");
       return compact('predio');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
