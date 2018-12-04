<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sector;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sector = Sector::all();
        return compact('sector');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sector = Sector::create(['descripcion' => ucfirst($request->sector)]);
        return $sector ? 'bien' : 'error';
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
        $sector = Sector::where('id_sector', $id)->update(['descripcion' => ucfirst($request->sector)]);
        return $sector ? 'bien' : 'error';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sector = Sector::where('id_sector', $id)->delete();
        return $sector ? 'bien' : 'error';
    }
}
