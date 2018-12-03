<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\persona;
use App\User;
use App\contribuyente;

class personaController extends Controller
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
        $hoy                        = $this->hoy();
        $persona                    = new Persona();
        $User                       = new User();
        $contribuyente              = new Contribuyente();
        if($request->persona['tipo']==3)
        {
        $contribuyente->codContribuyente = $request->persona['codContribuyente'];
        $contribuyente->nombre      = ucwords($request->persona['nombre']);
        $contribuyente->apellidos   = ucwords($request->persona['ape']);
        $contribuyente->dniRUC      = ucwords($request->persona['dni']);    
        $contribuyente->domicilio   = ucwords($request->persona['dir']);
        $contribuyente->create_at   = $hoy;
        $contribuyente->save();
        }   
        $persona->DNI               = $request->persona['dni'];
        $persona->Nombre            = ucwords($request->persona['nombre']);
        $persona->Apellidos         = ucwords($request->persona['ape']);
        $persona->Celular           = $request->persona['cel'];
        $persona->Direccion         = ucwords($request->persona['dir']);
        $persona->Tipo              = $request->persona['tipo'];
        $persona->created_at        = $hoy;
        $persona->fechaNacimiento   = $request->persona['fecha'];
        $User->id                   = $request->persona['dni'];
        $User->user                 = $request->persona['dni'];
        $User->password             = bcrypt($request->persona['dni']);
        $User->tipo                 = $request->persona['tipo'];
        $User->estado               = 1;
        $persona->save();
        $User->save();        
        return $persona;
    }
    public function hoy()
    {
        $aux = \DB::select("select curdate() as hoy");
        foreach($aux as $arr)
        {
            $hoy=$arr->hoy;
        }
        return $hoy;
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
    public function getDatos()
    {
        $usuarios = \DB::select("CALL `sp_mostrarUsuarios`()");
        return compact("usuarios");
    }
}
