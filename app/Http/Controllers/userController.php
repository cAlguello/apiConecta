<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    public function confirmaUsuario(Request $request, $user)
    {
        $Usuario = DB::table('usuario')->where('usuario', $user)->first();
        if ($Usuario != null) {
                return response()->json($Usuario);
        } else {
            return null;
        }
    }

}
