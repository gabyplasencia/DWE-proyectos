<?php

namespace App\Http\Controllers;

use App\Models\Mazo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BlackjackController extends Controller {
    
    public function mostrarMazo(Request $request) { 
        if (!session()->has('mazo')) { 
           
            $mazo = new Mazo();
            session()->put('mazo', $mazo);//introduce datos
        } else {
            $mazo = session('mazo');//recupera datos
        }

        $accion = $mazo->mostrarMazo();
        
        return view('blackjack', compact('mazo', 'accion'));
    }
}
