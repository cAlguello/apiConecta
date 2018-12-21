<?php

namespace App\Http\Controllers;

use App\Mail\Contacto;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class mailController extends Controller
{
    public function mail(Request $request)
    {
        $objDemo = new \stdClass();
        $objDemo->demo_one = $request->input('mensaje');    
        $objDemo->demo_two = $request->input('mensaje2');  
        $objDemo->demo_three = $request->input('mensaje3');
        $sender = $request->input('destinatario');
        Mail::to($sender)->send(new Contacto($objDemo));
        
    }
}
