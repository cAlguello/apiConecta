<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class giroController extends Controller
{
    public function verDatos(Request $request){ 
        $Consulta = DB::table('giro')
            ->get();
            return response()->json($Consulta);
    }

    public function addGiroEmpresa(Request $request){
        $id_giro = $request->input('id_giro');
        $id_empresa = $request->input('empresa_id_empresa');
        DB::insert('insert into empresa_has_giro (empresa_id_empresa, giro_id_giro) values (?, ?)', [$id_empresa, $id_giro]);
    }

    public function setGiroPrincipal(Request $request){
        $id_giro = $request->input('id_giro');
        $id_empresa = $request->input('empresa_id_empresa');
        DB::table('empresa')
        ->where('id_empresa', $id_empresa)
        ->update(['id_giro_principal_empresa' => $id_giro,
        ]);
    }

}
