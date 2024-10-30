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
            //dd($mazo);
        } else {
            $mazo = session()->get('mazo'); //recupera datos
            dd($mazo);
        }
        
        $mazoActual = $mazo->getMazo();
        //dd($mazoActual);

        return view('blackjack', compact('mazoActual'));
    }
}
