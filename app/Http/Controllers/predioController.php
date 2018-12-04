<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;
use App\CondicionPropiedad;
use App\Conservacion;
use App\Clasificacion;
use App\predio;
use App\Localidad;
use App\PredioContribuyente;
use App\PredioHistoria;
use App\Sector;

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

    public function getDatosSelect(){
        $material = Material::all();
        $conservacion = Conservacion::all();
        $condicion = CondicionPropiedad::all();
        $clasificacion=Clasificacion::all();
        $localidad=Localidad::all();
        $sector=Sector::all();
        return compact('material','conservacion','condicion','clasificacion','localidad','sector');
    }

    public function getContribuyente($e){
        $contribuyente=\DB::select("SELECT dniRUC, concat(nombre,' ',apellidos) as nombres from contribuyente where dniRUC like '$e%'");
        return compact('contribuyente');
    }

    public function getContribuyentesPredio($id){
        $contribuyentes=\DB::select("SELECT c.nombre, c.apellidos, c.codContribuyente,
                             c.dniRUC, c.domicilio, p.longitud, p.latitud, p.codPredio from contribuyente c 
                             INNER JOIN prediocontribuyente pc ON c.dniRUC=pc.codContribuyente INNER JOIN 
                             predio p ON p.codPredio=pc.codPredio WHERE pc.codPredio='$id'");
        return compact('contribuyentes');
    }

    public function getPredioContribuyentes($id){
        $datos=\DB::select("SELECT c.nombre, c.apellidos, c.dniRUC, p.codPredio, p.calle, p.numero, p.piso, p.mz, p.lote,
        p.interior, p.sector, p.idCondicion as condicion, p.idConservacion as conservacion, p.idMaterial as material, 
        p.idClasificacion as clasificacion, p.idLocalidad as localidad, p.longitud, p.latitud, max(ph.id) as idPH, 
        ph.codPredioContribuyente, ph.valorPredio, ph.anio, ph.percentPropiedad, pc.id as idPC from contribuyente c 
        INNER JOIN prediocontribuyente pc ON c.dniRUC=pc.codContribuyente INNER JOIN 
        predio p ON p.codPredio=pc.codPredio INNER JOIN prediohistoria ph ON pc.id=ph.codPredioContribuyente 
        WHERE pc.codPredio=$id GROUP BY ph.codPredioContribuyente");
        
        return compact('datos');
    }

    public function getClasificacion(){
        $datos=Clasificacion::all();
        return compact('datos');
    }

    public function storeClasificacion(Request $request){
        $clasificacion=Clasificacion::updateOrCreate(
            ['id_clasificacion'=>$request['clasificacionForm']['id_clasificacion']],
            [
                'descripcion'   =>$request['clasificacionForm']['descripcion']
            ]
        );
        if($clasificacion){
            return "OK";
        }else{
            return "FAIL";
        }
    }

    public function destroyClasificacion($id)
    {
        $eliminar=Clasificacion::where('id_clasificacion',$id)->delete();
        if($eliminar){
            return "OK";
        }else{
            return "FAIL";
        }
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
        // $predio=new predio();
        // $predio->CodPredio=$request['predio']['codPredio'];
        // $predio->calle=$request['predio']['calle'];
        // $predio->numero=$request['predio']['numero'];
        // $predio->piso=$request['predio']['piso'];
        // $predio->mz=$request['predio']['mz'];
        // $predio->lote=$request['predio']['lote'];
        // $predio->interior=$request['predio']['interior'];
        // $predio->sector=$request['predio']['sector'];
        // $predio->idCondicion=$request['predio']['condicion'];
        // $predio->idConservacion=$request['predio']['conservacion'];
        // $predio->idMaterial=$request['predio']['material'];
        // $predio->idClasificacion=$request['predio']['clasificacion'];
        // $predio->idLocalidad=$request['predio']['localidad'];
        // $predio->latitud=$request['predio']['latitud'];
        // $predio->longitud=$request['predio']['longitud'];
        // $predio->created_at=date('Y-m-d');
        // $predio->updated_at=date('Y-m-d');
        // $predio->save();
        $predio=predio::updateOrCreate(
            ['CodPredio'    =>  $request['predio']['codPredio'] ],
            [
                'calle'     =>  $request['predio']['calle'],
                'numero'    =>  $request['predio']['numero'],
                'piso'      =>  $request['predio']['piso'],
                'mz'        =>  $request['predio']['mz'],
                'lote'      =>  $request['predio']['lote'],
                'interior'  =>  $request['predio']['interior'],
                'sector'    =>  $request['predio']['sector'],
                'idCondicion'=> $request['predio']['condicion'],
                'idConservacion'=>$request['predio']['conservacion'],
                'idMaterial'=>  $request['predio']['material'],
                'idClasificacion'=>$request['predio']['clasificacion'],
                'idLocalidad'=> $request['predio']['localidad'],
                'latitud'   =>  $request['predio']['latitud'],
                'longitud'  =>  $request['predio']['longitud'],
                'created_at'=>  date('Y-m-d'),
                'updated_at'=>  date('Y-m-d')
            ]
        );

        // foreach ($request['contribuyentes'] as $key => $value) {
        //     \DB::table('prediocontribuyente')->where('id', '=', $request['rows'][$key]['idPC'])->delete();
        //     \DB::table('prediohistoria')->where('id', '=', $request['rows'][$key]['idPH'])->delete();
        // }
        \DB::table('prediocontribuyente')->where('CodPredio', '=', $request['predio']['codPredio'])->delete();
        //\DB::table('prediohistoria')->where('id', '=', $request['rows'][$key]['idPH'])->delete();

        foreach ($request['contribuyentes'] as $key => $value) {

            $prediocontribuyente=PredioContribuyente::updateOrCreate(
                ['id'   =>  $request['rows'][$key]['idPC'] ],
                [
                    'codPredio'         =>  $request['predio']['codPredio'],
                    'codContribuyente'  =>  $value[0],
                    'created_at'        =>  date('Y-m-d'),
                    'updated_at'        =>  date('Y-m-d')
                ]
            );
            $prediohistoria=PredioHistoria::updateOrCreate(
                //['id'=>$request['rows'][$key]['idPH'] ],
                //['id'=>null],
                [
                    'codPredioContribuyente'    =>  $prediocontribuyente->id,
                    'valorPredio'               =>  $request['rows'][$key]['valor'],
                    'anio'                      =>  $request['rows'][$key]['anio'],
                    'percentPropiedad'          =>  $request['rows'][$key]['percent'],
                    'created_at'                =>  date('Y-m-d'),
                    'updated_at'                =>  date('Y-m-d')
                ]
            );

            // $prediohistoria=new PredioHistoria();
            // $prediohistoria->id=$request['rows'][$key]['idPH'];
            // $prediohistoria->codPredioContribuyente=$prediocontribuyente->id;
            // $prediohistoria->valorPredio=$request['rows'][$key]['valor'];
            // $prediohistoria->anio=$request['rows'][$key]['anio'];
            // $prediohistoria->percentPropiedad=$request['rows'][$key]['percent'];
            // $prediohistoria->created_at=date('Y-m-d');
            // $prediohistoria->updated_at=date('Y-m-d');
            // $prediohistoria->save();

        }

        if($predio && $prediocontribuyente && $prediohistoria){
            return "OK";
        }else{
            return "FAIL";
        }
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
