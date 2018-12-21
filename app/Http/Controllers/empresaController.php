<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class empresaController extends Controller
{
    public function verDatos(Request $request)
    {
        $Consulta = DB::table('empresa')
            ->join('giro', 'id_giro', '=', 'id_giro_principal_empresa')
            ->join('area_giro', 'id_area_giro', '=', 'area_giro_id_area_giro')
            ->get();          
        return response()->json($Consulta);
    }

    public function verDatosId(Request $request, $id)
    {
        $Consulta = DB::table('empresa')
            ->where('id_empresa', $id)
            ->get();
        return response()->json($Consulta);
    }

    public function actualizaDatos(Request $request)
    {
        $id_empresa = $request->input('id_empresa');
        $nombre_empresa = $request->input('nombre_empresa');
        $razon_social_empresa = $request->input('razon_social_empresa');
        $tamano_empresa = $request->input('tamano_empresa');
        $calle_empresa = $request->input('calle_empresa');
        $descripcion_empresa = $request->input('descripcion_empresa');
        $numero_calle_empresa = $request->input('numero_calle_empresa');
        $ciudad_empresa = $request->input('ciudad_empresa');
        $encargado_contacto_empresa = $request->input('encargado_contacto_empresa');
        $fono_empresa = $request->input('fono_empresa');
        $mail_empresa = $request->input('mail_empresa');
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

    public function hanConsultado(Request $request, $id)
    {
        $data2 = [];

        $Consulta = DB::table('log_consulta_empresa')
            ->join('usuario', 'id_empresa_log_consulta_empresa', '=', 'usuario')
            ->join('empresa', 'empresa_id_empresa_log_consulta_empresa', '=', 'id_empresa')
            ->select('empresa_id_empresa_log_consulta_empresa as id', 'empresa_id_empresa_log_consulta_empresa as name', 'imagen_empresa as image', 'empresa_id_empresa_log_consulta_empresa as target', 'id_empresa_log_consulta_empresa as source')
            ->where('id_empresa_log_consulta_empresa', '=', $id)
            ->groupBy('id_empresa_log_consulta_empresa', 'empresa_id_empresa_log_consulta_empresa', 'imagen_empresa')
            ->get();
        foreach ($Consulta as $Consultas) {
            $Consultas->colorCode = 'black';
            $Consultas->weight = 100;
            $Consultas->strength = 10;
            $Consultas->shapeType = 'roundrectangle';
            //$Consultas->image= 'https://i3.wp.com/tentulogo.com/wp-content/uploads/HistoriadellogodeCocaCola.jpg';
            $data2[] = [
                'data' => $Consultas,
            ];
        }
        return response()->json($data2);

    }

    public function hanConsultadoDatacompleta(Request $request, $id)
    {

        $Consulta = DB::table('log_consulta_empresa')
            ->join('usuario', 'id_empresa_log_consulta_empresa', '=', 'usuario')
            ->join('empresa', 'empresa_id_empresa_log_consulta_empresa', '=', 'id_empresa')
            ->select(DB::raw('count(*) as total, id_empresa_log_consulta_empresa as id'), 'nombre_empresa', 'empresa_id_empresa_log_consulta_empresa as source')
            ->where('id_empresa_log_consulta_empresa', '=', $id)
            ->groupBy('id_empresa_log_consulta_empresa', 'empresa_id_empresa_log_consulta_empresa', 'nombre_empresa')
            ->get();

        return response()->json($Consulta);

    }

    public function graphDataEdgeEmpresa(Request $request, $id)
    {
// { data: { id: "93281000", name: 'Coca Cola', weight: 100, colorCode: 'blue', shapeType: 'roundrectangle', image: 'https://i3.wp.com/tentulogo.com/wp-content/uploads/HistoriadellogodeCocaCola.jpg' } },
        //{ data: { source: "91806000", target: "71540100", colorCode: 'blue', strength: 10 } },
        $data2 = [];

        $Consulta = DB::table('log_consulta_empresa')
            ->join('usuario', 'id_empresa_log_consulta_empresa', '=', 'usuario')
            ->join('empresa', 'empresa_id_empresa_log_consulta_empresa', '=', 'id_empresa')
            ->select('empresa_id_empresa_log_consulta_empresa as source', 'id_empresa_log_consulta_empresa as target')
            ->where('id_empresa_log_consulta_empresa', '=', $id)
            ->groupBy('id_empresa_log_consulta_empresa', 'empresa_id_empresa_log_consulta_empresa')
            ->get();
        foreach ($Consulta as $Consultas) {
            $Consultas->colorCode = 'black';
            $Consultas->strength = 10;
            $data2[] = [
                'data' => $Consultas,
            ];
        }
        return response()->json($data2);
    }
}
