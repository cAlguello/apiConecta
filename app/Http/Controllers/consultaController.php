<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class consultaController extends Controller
{
    public function addConsulta(Request $request)
    {
        $usuario_id = $request->input('usuario_id');
        $id_empresa = $request->input('empresa_id_empresa');
        $fecha_consulta = $request->input('fecha_consulta');
        $solicitud_consulta = $request->input('solicitud_consulta');
        DB::insert('insert into consulta (usuario_id_consulta, empresa_id_empresa, fecha_consulta, solicitud_consulta) values (?, ?, ?, ?)', [$usuario_id, $id_empresa, $fecha_consulta, $solicitud_consulta]);
    }

    public function ConsultasRespondidas(Request $request, $id)
    {
        $Consulta = DB::table('consulta')
            ->join('empresa', 'id_empresa', '=', 'empresa_id_empresa')
            ->where('usuario_id_consulta', $id)
            ->where('estado_consulta', 1)
            ->get();
        return response()->json($Consulta);
    }
    public function ConsultasRecibidas(Request $request, $id)
    {
        $Consulta = DB::table('consulta')
            ->join('empresa', 'id_empresa', '=', 'usuario_id_consulta')
            ->where('empresa_id_empresa', $id)
            ->where('estado_consulta', NULL)
            ->get();
        return response()->json($Consulta);
    }
}
