<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class buscadorController extends Controller
{
    public function buscaProductosLogin(Request $request, $producto)
    {      
        $Consulta = DB::table('empresa_has_producto')
            ->join('producto', 'producto_id_producto', '=', 'id_producto')
            ->join('empresa', 'id_empresa', '=', 'empresa_id_empresa_producto')
            ->join('empresa_has_giro','id_empresa','=','empresa_id_empresa')
            ->join('giro', 'id_giro', '=', 'giro_id_giro')
            ->join('area_giro', 'id_area_giro', '=', 'area_giro_id_area_giro')
            ->where('nombre_producto',$producto)            
            ->get();
        return response()->json($Consulta);
    }

    public function buscaGirosLogin(Request $request, $giro)
    {
        $Consulta = DB::table('empresa_has_giro')
        ->join('empresa', 'id_empresa', '=', 'empresa_id_empresa')
        ->join('giro', 'id_giro', '=', 'giro_id_giro')        
        ->where('id_empresa',$id)            
        ->get();
        return response()->json($Consulta);
    }

    public function buscaProductosNoLogin(Request $request, $producto){
        $Consulta = DB::table('empresa_has_producto')
        ->join('producto', 'producto_id_producto', '=', 'id_producto')         
        ->select(DB::raw('count(*) as total, producto_id_producto'), "nombre_producto")
        ->where('nombre_producto',$producto)      
        ->groupBy('producto_id_producto', "nombre_producto")                      
        ->get();
        return response()->json($Consulta);         
    }
    public function logBusquedasProducto(Request $request, $producto){
        $Consulta = DB::table('log_busqueda')
        ->join('producto', 'id_producto_id_log_busqueda', '=', 'id_producto')         
        ->select(DB::raw('count(*) as total, id_producto_id_log_busqueda'), "nombre_producto")
        ->where('nombre_producto',$producto)      
        ->groupBy('id_producto_id_log_busqueda', "nombre_producto")                      
        ->get();
        return response()->json($Consulta);         
    }

}
