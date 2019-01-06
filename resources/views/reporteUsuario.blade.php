<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reporte Autovaluo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Municipalidad Distrital de Yarinacocha</title>
</head>
<style>
    body{
    background-color:#FFFFFF;
    overflow:hidden;
    font-family: 'Raleway', sans-serif;
    }
    
    .main-wrap{
    padding:3%;
    max-width:1200px;
    display:block;
    margin: 10px auto;
    }

    .table.table-striped {
    width:100%;
        border-collapse: collapse;
        background: #fff;
        overflow: hidden;
        box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
        -moz-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
        -webkit-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
        -o-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
        -ms-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15);
    }

    .table.table-striped thead {
        background: #fff;
        box-shadow: 0 5px 20px 0px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: 0 5px 20px 0px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0 5px 20px 0px rgba(0, 0, 0, 0.1);
        -o-box-shadow: 0 5px 20px 0px rgba(0, 0, 0, 0.1);
        -ms-box-shadow: 0 5px 20px 0px rgba(0, 0, 0, 0.1);
    }

    .table.table-striped th {
        padding: 0.9rem 0.5rem;
        font-weight: bold;
        border: 1px solid #efefef;
        text-align: left;
        border-top: 0px;
    }

    .table.table-striped tbody tr:nth-child(odd){
        background-color: rgba(0,0,0,.02);
    }

    .table.table-striped tbody tr td a {
        color: #3c2f17;
        font-size: 12px;
        text-decoration:none;
    font-weight:500;
    }

    .table.table-striped tr:nth-child(even) {
        background-color: #fff;
    }

    .table.table-striped tbody tr td {
        border: 1px solid #efefef;
        padding: 0.7rem;
        text-align: left;
        border-top: 0px;
    }

    .ftr{
        text-align: center;
        margin-top: 20px;
        font-weight: bold;
    }

    .ftr a{
        color: #fff;
    }
    .peque {
        font-size: 10px;
    }
</style>
        <?php
            $contribuyente = DB::select("SELECT * FROM `contribuyente` where dniRUC=".$id);
            
            $hoy = date("d/m/Y");
            $mes = date("m");
            switch ($mes) {
                case '1':
                    $sMes = "Enero";
                    break;
                case '2':
                    $sMes = "Febrero";
                    break;    
                case '1':
                    $sMes = "Marzo";
                    break;
                case '1':
                    $sMes = "Abril";
                    break;
                case '1':
                    $sMes = "Mayo";
                    break;
                case '1':
                    $sMes = "Junio";
                    break;
                case '1':
                    $sMes = "Julio";
                    break;
                case '1':
                    $sMes = "Agosto";
                    break;
                case '1':
                    $sMes = "Setiembre";
                    break;
                case '1':
                    $sMes = "Octubre";
                    break;
                case '1':
                    $sMes = "Noviembre";
                    break;    
                default:
                    $sMes = "Diciembre";
                    break;
            }
            $dia = date("d");
            $anio = date("Y");
            
            foreach ($contribuyente as $item)
            {
                $codigo   =   $item->codContribuyente;
                $nombre   =   $item->apellidos." ".$item->nombre;
                $dom      =   $item->domicilio;
            }
            $Impuesto      = DB::select("
            SELECT concat_ws(' ',predio.calle,predio.numero,'Mz. ',predio.mz,'Lt. ',predio.lote) as dir,
            ROUND ((a.valorConstruccion+a.valorterreno-a.descuento),2) as autovaluo, 
            ROUND ((a.valorConstruccion+a.valorterreno-a.descuento)*0.002,2) as impuesto,
            ROUND ((a.valorConstruccion+a.valorterreno-a.descuento)*0.0005,2) as cuota
            FROM predio 
            JOIN prediocontribuyente on predio.codPredio=prediocontribuyente.codPredio 
            JOIN autovaluo a ON prediocontribuyente.id=a.idpredioContribuyente
            where prediocontribuyente.codContribuyente=".$codigo
            );
            $autovaluo = DB::select('CALL `SP_Autovaluo`(?)',[$codigo]);
            foreach ($autovaluo as $item) {
                $calle      = $item->calle;
                $mz         = $item->mz;
                $lote       = $item->lote;
                $piso       = $item->piso;
                $material   = $item->idMaterial;
                $valorm     = $item->valorM2;
                $deprepe    = $item->deprePercent;
                $depreMonto = $item->depreMonto;
                $valorD     = $item->valorDepreciado;
                $aream2     = $item->areaM2;
                $valorArea  = number_format($item->valorArea,2,'.',',');
                $valorConst = number_format($item->valorConstruccion,2,'.',',');
                $area       = $item->area;
                $arancel    = $item->arancelM2;
                $vTerreno   = number_format($item->vTerreno,2,'.',',');
                $descuento  = number_format($item->descuento,2,'.',',');
                $total      = number_format($item->total,2,'.',',');
                $total1     = $item->total;

            }
        ?>
        
<body>
        
    <center>
    <table border="">
        <tr align="center">
            <td rowspan="3"><img src="img/logo.png" height="80" width="70"></td>
            <td style="font-size: 14px"><b>DECLARACIÓN JURADA DEL IMPUESTO PREDIAL</b></td>
            <td style="font-size: 22px;"><b>HR</b></td>
        </tr>
        <tr align="center">
            <td style="font-size: 12px">DECRETO SUPREMO N° 154-2004 - EF</td>
            <td class="peque"> HOJA RESUMEN</td>
        </tr>
        <tr align="center">
            <td class="peque"><b>GERENCIA DE ADMINISTRACIÓN TRIBUTARIA</b></td>
            <td class="peque">{{$hoy}}</td>
        </tr>
        <tr align="center">
            <td class="peque">Municipalidad Distrital de Yarinacocha</td>
            <td colspan="2">&nbsp;</td>
        </tr>
    </table>
    
    <h4>IDENTIFICACIÓN DEL CONTRIBUYENTE</h4>
    <hr>
    <table class="table table-striped" style="font-size:10px;">
        <tr class="tr" align="center">
            <td class="td"><b>CODIGO:</b></td>
            <td>{{$codigo}}</td>
        </tr>
        <tr>
            <td class="td"><b>CONTRIBUYENTE:</b></td>
            <td>{{$nombre}}</td>
        </tr>
        <tr>
            <td class="td"><b>DNI/RUC:</b></td>
            <td>{{$id}}</td>
        </tr>
        <tr>
            <td class="td"><b>DOMICILIO FISCAL:</b></td>
            <td>{{$dom}}</td>
        </tr>
    </table>
    <h4>DETERMINACION DEL IMPUESTO</h4>
    <hr>
    <table class="table table-striped" style="font-size:10px;" >
            <tr>
                    <td><b>ANEXO</b></td>
                    <td><b>UBICACIÓN DEL PREDIO</b></td>
                    <td><b>VALOR DEL PREDIO</b></td>
                    <td><b>% PROPIEDAD</b></td>
                    <td><b>AUTOVALUO</b></td>
            </tr>
            @foreach ($Impuesto as $item)
            <tr>
                    <td>A</td>
                    <td>{{$item->dir}}</td>
                    <td>{{number_format($item->autovaluo,2,'.',',')}}</td>
                    <td>100.00</td>
                    <td>{{number_format($item->autovaluo,2,'.',',')}}</td>
            </tr>
            {{$autovaluo = number_format($item->autovaluo,2,'.',',')}}
            {{$imp = number_format(($item->autovaluo)*0.002,2,'.',',')}}
            {{$tri = number_format(($item->autovaluo)*0.0005,2,'.',',')}}
            @endforeach
    </table>
    <hr>
    <table class="table table-striped" style="font-size:10px;">
        
        <tr>
                <td rowspan="4"></td>
                <td rowspan="4"></td>
                <td rowspan="4"></td>
            <td colspan="2" align="center">RESUMEN</td>
        </tr>
        <tr>
            <td>TOTAL AUTOVALUO</td>
            <td>{{$autovaluo}}</td>
        </tr>
        <tr>
            <td>IMPUESTO ANUAL</td>
            <td>{{$imp}}</td>
        </tr>
        <tr>
            <td>CUOTA TRIMESTRAL</td>
            <td>{{$tri}}</td>
        </tr>
    </table>
    </center>
    Puerto Callao,{{$dia}} de, {{$sMes}} del {{$anio}}
    <div style="page-break-after:always;"></div>
    <table border="">
            <tr align="center">
                <td rowspan="3"><img src="img/logo.png" height="80" width="70"></td>
                <td style="font-size: 14px"><b>DECLARACIÓN JURADA DEL IMPUESTO PREDIAL</b></td>
                <td style="font-size: 22px;"><b>PU</b></td>
            </tr>
            <tr align="center">
                <td style="font-size: 12px">DECRETO SUPREMO N° 154-2004 - EF</td>
                <td class="peque">PREDIO URBANO</td>
            </tr>
            <tr align="center">
                <td class="peque"><b>GERENCIA DE ADMINISTRACIÓN TRIBUTARIA</b></td>
                <td class="peque">{{$hoy}}</td>
            </tr>
            <tr align="center">
                <td class="peque">Municipalidad Distrital de Yarinacocha</td>
                <td colspan="2">&nbsp;</td>
            </tr>
    </table>
    <hr>
    <table class="table table-striped peque">
        <tr>
            <td><b>APELLIDOS Y NOMBRES Y/O RAZÓN SOCIAL</b></td>
            <td><b>CÓDIGO</b></td>
        </tr>
        <tr>
            <td>{{$nombre}}</td>
            <td>{{$codigo}}</td>
        </tr>
    </table>
    <hr>
    <h5 style="font-size: 10px;text-justify: inter-word; ">UBICACIÓN DEL PREDIO</h5>
    <table class="table table-striped peque">
        <tr>
            <td><b>VIA-CALLE-NUMERO-INTERIOR</b></td>
            <td><b>MZA.</b></td>
            <td><b>LTE.</b></td>
            <td><b>LOCALIDAD</b></td>
            <td><b>%CONDOMINIO</b></td>
        </tr>
        <tr>
            <td>{{$calle}}</td>
            <td>{{$mz}}</td>
            <td>{{$lote}}</td>
            <td>C.P. AREA URBANA</td>
            <td>100</td>
        </tr>
    </table>
    <h5 style="font-size: 10px;text-justify: inter-word; ">DATOS RELATIVOS AL PREDIO </h5>
    <table class="table table-striped peque">
        <tr>
            <td><b>ESTADO PREDIO</b></td>
            <td><b>TIPO PREDIO</b></td>
            <td><b>USO DE PREDIO</b></td>
            <td><b>CONDICION DE PROPIEDAD</b></td>
        </tr>
        <tr>
            <td>TERMINADO</td>
            <td>INDEPENDIENTE</td>
            <td>CASA HABITACIÓN - ZONA A</td>
            <td>PROPIO ÚNICO</td>
        </tr>
    </table>
    <h5 style="font-size: 10px;text-justify: inter-word; ">DATOS RELATIVOS AL PREDIO PARA DEPRECIACIÓN</h5>
    <table class="table table-striped peque">
        <tr>
            <td><b>CLASIFICACIÓN</b></td>
            <td><b>MATERIAL PREDIO</b></td>
            <td><b>ESTADO DE CONSERVACIÓN</b></td>
        </tr>
        <tr>
            <td>CASA HABITACIÓN</td>
            <td>ADOBE/QUINCHA/MADERA</td>
            <td>BUENO</td>
        </tr>
    </table>
    <h5 style="font-size: 10px;text-justify: inter-word; ">DETERMINACIÓN DEL AUTOVALUO</h5>
    <table class="table table-striped peque">
        <tr>
            <td rowspan="2"><b>PISO</b></td>
            <td rowspan="2"><b>MATERIAL</b></td>
            <td rowspan="2"><b>ESTADO</b></td>
            <td rowspan="2"><b>ANTIGÜEDAD</b></td>
            <td rowspan="2"><b>CATEGORIA</b></td>
            <td rowspan="2"><b>VALOR M2</b></td>
            <td colspan="2"><b>DEPRECIACIÓN</b></td>
            <td rowspan="2"><b>VALOR DEPRECIADO</b></td>
            <td colspan="2"><b>AREA CONSTRUIDA</b></td>
            <td rowspan="2"><b>VALOR DE LA CONSTRUCCIÓN</b></td>
        </tr>
        <tr>
            <td><b>%</b></td>
            <td><b>MONTO</b></td>
            <td><b>M2</b></td>
            <td><b>VALOR</b></td>
        </tr>
        <tr>
            <td>{{$piso}}</td>
            <td>{{$material}}</td>
            <td>02</td>
            <td>17</td>
            <td>HEHGIIG</td>
            <td>{{$valorm}}</td>
            <td>{{$deprepe}}</td>
            <td>{{$depreMonto}}</td>
            <td>{{$valorD}}</td>
            <td>{{$aream2}}</td>
            <td>{{$valorArea}}</td>
            <td>{{$valorConst}}</td>
        </tr>    
    </table>
    <hr>
    <table class="table table-striped peque">
        <tr>
            <td><b>AREA DE TERRENO</b></td>
            <td><b>ARANCEL M2.</b></td>
            <td><b>VALOR TOTAL DE CONSTRUCCIÓN</b></td>
            <td><b>VALOR DEL TERRENO</b></td>
            <td><b>DESCUENTO</b></td>
            <td><b>INCREMENTO</b></td>
            <td><b>TOTAL AUTOVALUO</b></td>
        </tr>
        <tr>    
            <td>{{$area}}</td>
            <td>{{$arancel}}</td>
            <td>{{$valorConst}}</td>
            <td>{{$vTerreno}}</td>
            <td>{{$descuento}}</td>
            <td>0.00</td>
            <td>{{$total}}</td>
        </tr>    
    </table>
    <h5 style="font-size: 10px;text-justify: inter-word; ">FECHA DE EMISIÓN: {{$hoy}}</h5>
    <small style="font-size: 10px;text-justify: inter-word; ">Art. 14 del DS N° 156-2004-EF. La actualización de los valores de predios por las Municipalidades, sustituye la obligación
        de presentar la Declaración Jurada, y se entenderá como válida en caso que el contribuyente no lo objete dentro del plazo establecido para el pago al contado del impuesto
    </small>
    <div style="page-break-after:always;"></div>
    <table border="">
            <tr align="center">
                <td rowspan="3"><img src="img/logo.png" height="80" width="70"></td>
                <td style="font-size: 14px"><b>LIQUIDACIÓN DEL IMPUESTO PREDIAL</b></td>
                <td style="font-size: 22px;"><b>HLP</b></td>
            </tr>
            <tr align="center">
                <td style="font-size: 12px">T.U.O. DE LA LEY DE TRIBUTACIÓN MUNICIPAL</td>
                <td class="peque">HOJA DE LIQUIDACIÓN PREDIAL</td>
            </tr>
            <tr align="center">
                <td class="peque"><b>(D.S. N 156-2004-EF)</b></td>
                <td class="peque">{{$hoy}}</td>
            </tr>
            <tr align="center">
                <td class="peque">Municipalidad Distrital de Yarinacocha</td>
                <td colspan="2">&nbsp;</td>
            </tr>
    </table>
    <hr>
    <table class="table table-striped peque">
        <tr>
            <td><b>CÓDIGO</b></td>
            <td colspan="7"><b>APELLIDOS Y NOMBRES / RAZON SOCIAL</b></td>
            <td><b>DNI/RUC/OTROS</b></td>
        </tr>
        <tr>
            <td>{{$codigo}}</td>
            <td colspan="7">{{$nombre}}</td>
            <td>{{$id}}</td>
        </tr>
        <tr>
            <td colspan="4"><b>CONJUNTO URBANO</b></td>
            <td colspan="4"><b>VIA</b></td>
            <td><b>NUMEROS</b></td>
        </tr>
        <tr>
            <td colspan="4">AREA URBANA DE YARINACOCHA</td>
            <td colspan="4">{{$calle}}</td>
            <td></td>
        </tr>
        <tr>
            <td><b>DPTO/INT</b></td>
            <td><b>EDIF/BLOCK</b></td>
            <td><b>PISO</b></td>
            <td><b>MZ.</b></td>
            <td><b>LOTE</b></td>
            <td><b>LETRA</b></td>
            <td><b>ZONA</b></td>
            <td><b>USO</b></td>
            <td><b>% PROPIEDAD</b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>{{$piso}}</td>
            <td>{{$mz}}</td>
            <td>{{$lote}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td>HLP.condominio</td>
        </tr>
        <tr>
            <td colspan="9"><b>REFERENCIA</b></td>
        </tr>
        <tr>
            <td colspan="2"><b>RÉGIMEN</b></td>
            <td><b>N° DE PREDIOS DECLARADOS</b></td>
            <td colspan="3"><b>BASE IMPONIBLE</b></td>
            <td colspan="3"><b>BASE IMPONIBLE AFECTA</b></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td>1</td>
            <td colspan="3">{{$total}}</td>
            <td colspan="3">{{$total}}</td>
        </tr>
    </table>
    <h5>CRITERIO PARA LADETERMINACIÓN DEL IMPUESTO PREDIAL</h5>
    <hr>
    <table class="table table-striped peque">
        <tr>
            <td><b>TRAMOS DE AUTOVALUO NUEVOS SOLES (UIT EN S/. 3,850)</b></td>
            <td><b>ALICUOTA</b></td>
            <td><b>BASE IMPONIBLE POR TRAMOS</b></td>
            <td><b>IMPUESTO ANUAL EN S/.</b></td>
        </tr>
        <tr>
            <td>a 15 UIT's (hasta S/.57,750)</td>
            <td>0.002</td>
            <td>{{$total}}</td>
            <td>{{number_format($total1*0.002,2)}}</td>
        </tr>
        <tr>
            <td>a 60 UIT's (S/.57,750 hasta S/. 231,000,000)</td>
            <td>0.006</td>
            <td>0.00</td>
            <td>0.00</td>
        </tr>
        <tr>
            <td>mas de 60 UIT's (más de S/. 231,000,000)</td>
            <td>0.1</td>
            <td>0.00</td>
            <td>0.00</td>
        </tr>
        <tr>
            <td colspan="3"><b>BASE IMPONIBLE AFECTA / IMPUESTO ANUAL (S/.)</b></td>
            <td>{{number_format($total1*0.002,2)}}</td>
        </tr>
    </table>  
</body>
</html>   