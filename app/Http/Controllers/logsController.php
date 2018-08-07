<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class logsController extends Controller
{

    public function addProductoLog(Request $request,$producto)
    {
        $validacion = DB::table('empresa_has_producto')
            ->join('producto', 'producto_id_producto', '=', 'id_producto')
            ->where('nombre_producto', $producto)
            ->first();
        if (is_null($validacion)) {
        } else {
            $productLogUser= $validacion->id_producto;
            DB::insert('insert into log_busqueda (id_producto_id_log_busqueda) values (?)', [$productLogUser]);
        }
    }

    public function addEmpresaLog(Request $request)
    {
        $empresaIdLog = $request->input('id_empresa_log_consulta_empresa');
        $empresaIdConsulta = $request->input('empresa_id_empresa_log_consulta_empresa');
        $fechaLog = $request->input('fecha_log_consulta_empresa');       
        DB::insert('insert into log_consulta_empresa (id_empresa_log_consulta_empresa, empresa_id_empresa_log_consulta_empresa, fecha_log_consulta_empresa ) values (?,?,?)', [$empresaIdLog,$empresaIdConsulta,$fechaLog]);
       
    }
}
