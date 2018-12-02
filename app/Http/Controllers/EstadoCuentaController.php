<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstadoCuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function getEstado()
    {
        // PENDIENTE
        // SELECT pc.codPredio, SUM((ec.formato + ec.impuesto_predial + ec.limpieza_publica + ec.barrido_calles + ec.parques_jardines + ec.serenazgo)) as suma
        // FROM `prediocontribuyente` pc, estado_cuenta ec
        // WHERE pc.codPredio = ec.id_predio
        // GROUP BY pc.codPredio

        // ULTIMA CONSULTA SALVAJE
        // SELECT id_predio, (max(periodo) - min(periodo)) as 'años', 
        // SUM((formato + impuesto_predial + limpieza_publica + barrido_calles + parques_jardines + serenazgo)) as suma
        // FROM `estado_cuenta` 
        // GROUP by id_predio

        $predioSalvaje = \DB::select("SELECT pc.codPredio as 'Codigo_Predio', 
                GROUP_CONCAT(DISTINCT pc.CodContribuyente) as 'Codigo_Contribuyente', 
                COUNT(DISTINCT pc.codContribuyente) as 'Cantidad_Contribuyente', 
                GROUP_CONCAT(DISTINCT CONCAT(c.nombre, ' ', c.apellidos)) as 'Nombres_Apellidos',
                GROUP_CONCAT(DISTINCT p.latitud)  AS 'Latitud', GROUP_CONCAT(DISTINCT p.longitud) as 'Longitud',
                GROUP_CONCAT(DISTINCT p.calle) as 'Calle', GROUP_CONCAT(DISTINCT p.numero) as 'Numero', 
                GROUP_CONCAT(DISTINCT p.piso) as 'Piso',
                SUM(DISTINCT (ec.formato + ec.impuesto_predial + ec.limpieza_publica + ec.barrido_calles + ec.parques_jardines + ec.serenazgo)) as suma
                FROM `prediocontribuyente` pc, `contribuyente` c, `predio` p, `estado_cuenta` ec
                WHERE pc.codContribuyente = c.dniRUC 
                AND pc.codPredio = p.codPredio
                AND ec.id_predio = pc.codPredio
                GROUP BY pc.codPredio");

        return compact('predioSalvaje');
    }

    public function getPersonal($id) {
        $estado_cuenta = \DB::table('estado_cuenta')->where('id_predio', $id)->get();
        $predio = \DB::table('predio')
            ->join('sector', 'predio.sector', '=', 'sector.id_sector')
            ->join('condicion_propiedad', 'predio.idCondicion', '=', 'condicion_propiedad.id_condicion')
            ->join('conservacion', 'predio.idConservacion', '=', 'conservacion.id_conservacion')
            ->join('material', 'predio.idMaterial', '=', 'material.id_material')
            ->join('clasificacion', 'predio.idClasificacion', '=', 'clasificacion.id_clasificacion')
            ->join('localidad', 'predio.idLocalidad', '=', 'localidad.id_localidad')
            ->select('predio.codPredio', 'predio.calle', 'predio.numero', 'predio.piso', 'predio.mz', 'predio.lote', 
                'predio.interior', 'sector.descripcion as sector', 'condicion_propiedad.descripcion as condicion', 
                'conservacion.descripcion as conservacion', 'material.descripcion as material', 
                'clasificacion.descripcion as clasificacion', 'localidad.descripcion as localidad')
            ->where('predio.codPredio', '=', $id)->first();

        return compact('estado_cuenta', 'predio');
    }
}
