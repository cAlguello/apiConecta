<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class empresaController extends Controller
{
    public function verDatos(Request $request)
    {
        $Consulta = DB::table('empresa_has_giro')
            ->join('empresa', 'id_empresa', '=', 'empresa_id_empresa')
            ->join('giro', 'id_giro', '=', 'giro_id_giro')
            ->join('area_giro', 'id_area_giro', '=', 'area_giro_id_area_giro')
            ->get();
        return response()->json($Consulta);
    }

    public function verDatosId(Request $request, $id)
    {
        $Consulta = DB::table('empresa')
            ->where('id_empresa',$id)
            ->get();
        return response()->json($Consulta);
    }


    public function productosEmpresa(Request $request, $id)
    {
        $Consulta = DB::table('empresa_has_producto')
            ->join('producto', 'producto_id_producto', '=', 'id_producto')
            ->where('empresa_id_empresa_producto', $id)
            ->get();
        return response()->json($Consulta);
    }

    public function girosEmpresa(Request $request, $id)
    {
        $Consulta = DB::table('empresa_has_giro')
            ->join('empresa', 'id_empresa', '=', 'empresa_id_empresa')
            ->join('giro', 'id_giro', '=', 'giro_id_giro')
            ->where('id_empresa', $id)
            ->get();
        return response()->json($Consulta);
    }

    public function empresaActiva(Request $request)
    {
        $Consulta = DB::table('empresa')
            ->where('is_active_empresa', 1)
            ->get();
        return response()->json($Consulta);
    }

    public function empresaInactiva(Request $request)
    {
        $Consulta = DB::table('empresa')
            ->where('is_active_empresa', 0)
            ->get();
        return response()->json($Consulta);
    }
}
