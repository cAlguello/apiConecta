<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class generalStatsController extends Controller
{
    public function totalEmpresas(Request $request)
    {
        $Consulta = DB::table('empresa')
            ->count();
        return response()->json($Consulta);
    }
    public function totalProductos(Request $request)
    {
        $Consulta = DB::table('empresa_has_producto')
            ->count();
        return response()->json($Consulta);
    }
    public function totalContactos(Request $request)
    {
        $Consulta = DB::table('consulta')
            ->count();
        return response()->json($Consulta);
    }

    public function productosMasBuscados(Request $request)
    {
        $Consulta = DB::table('log_busqueda')
            ->join('producto', 'id_producto_id_log_busqueda', '=', 'id_producto')
            ->select(DB::raw('count(*) as total, id_producto_id_log_busqueda'), "nombre_producto")
            ->groupBy('id_producto_id_log_busqueda', "nombre_producto")
            ->get();
        return response()->json($Consulta);
    }

    public function cantidadLogEmpresas(Request $request, $id)
    {
        $Consulta = DB::table('log_consulta_empresa')
            ->select(DB::raw('count(*) as total, empresa_id_empresa_log_consulta_empresa'))
            ->where('empresa_id_empresa_log_consulta_empresa', '=', $id)
            ->groupBy('empresa_id_empresa_log_consulta_empresa')
            ->get();
        return response()->json($Consulta);

    }

    public function cantidadConsultasPorMesEmpresa(Request $request, $id)
    {
        
        $Consulta = DB::table('log_consulta_empresa')
            ->select(DB::raw('count(*) as dataLog, empresa_id_empresa_log_consulta_empresa '), DB::raw("DATE_FORMAT(fecha_log_consulta_empresa, '%m-%Y') new_date"), DB::raw('YEAR(fecha_log_consulta_empresa) year, MONTH(fecha_log_consulta_empresa) month'))
            ->where('empresa_id_empresa_log_consulta_empresa', '=', $id)
            ->groupBy('new_date', 'year', 'month', 'empresa_id_empresa_log_consulta_empresa')
            ->get();

            foreach ($Consulta as $Consultas) {
                $dateObj   = DateTime::createFromFormat('!m', $Consultas->month);                
                $monthName = $dateObj->format('M');
                $Consultas->month = $monthName;               
            }

        return response()->json($Consulta);
    }

}
