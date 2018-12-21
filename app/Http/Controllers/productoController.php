<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productoController extends Controller
{
    public function verDatos(Request $request)
    {
        $Consulta = DB::table('producto')
            ->join('rubro', 'id_rubro', '=', 'rubro_id_rubro')
            ->get();
        return response()->json($Consulta);
    }
    public function addProducto(Request $request)
    {
        $id_producto = $request->input('id_producto');
        $id_rubro = $request->input('id_rubro');
        $id_empresa = $request->input('empresa_id_empresa_producto');
        DB::insert('insert into empresa_has_producto (producto_id_producto, producto_rubro_id_rubro, empresa_id_empresa_producto ) values (?,?, ?)', [$id_producto, $id_rubro, $id_empresa]);
    }
}
