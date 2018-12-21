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
/*
    constructor(
        public id_consulta: any,
        public respuesta_consulta: any,
        public fecha_respuesta_consulta: any,
        public estado_consulta: any        
    ) { }
  }

   DB::table('empresa')
            ->where('id_empresa', $id_empresa)
            ->update(['nombre_empresa' => $nombre_empresa,
                'razon_social_empresa' => $razon_social_empresa,
                'tamaño_empresa' => $tamano_empresa,
                'calle_empresa' => $calle_empresa,
                'descripcion_empresa' => $descripcion_empresa,
                'numero_calle_empresa' => $numero_calle_empresa,
                'encargado_contacto_empresa' => $encargado_contacto_empresa,
                'fono_empresa' => $fono_empresa,
                'mail_empresa' => $mail_empresa,
            ]);
*/
    public function answerConsulta(Request $request)
    {
        $id_consulta = $request->input('id_consulta');
        $respuesta_consulta = $request->input('respuesta_consulta');
        $fecha_respuesta_consulta = $request->input('fecha_respuesta_consulta');
        $estado_consulta = $request->input('estado_consulta');
        DB::table('consulta')
            ->where('id_consulta', $id_consulta)
            ->update(['respuesta_consulta' => $respuesta_consulta,
                'fecha_respuesta_consulta' => $fecha_respuesta_consulta,
                'estado_consulta' => $estado_consulta
            ]);
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

    public function TiempoConsultasRespondidas(Request $request, $id)
    {
        $Consulta = DB::table('consulta')
            ->where('usuario_id_consulta', $id)
            ->where('estado_consulta', 1)
            ->avg('fecha_consulta');
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
