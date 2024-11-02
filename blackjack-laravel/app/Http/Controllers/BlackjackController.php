<?php

namespace App\Http\Controllers;

use App\Models\Mazo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BlackjackController extends Controller {

    public function index() {
        $mazo = new Mazo();
        session(['mazoActual' => $mazo->getMazo()]);
        session(['miMano' => $mazo->getMiMano()]);
    
        $mazoActual = session()->get('mazoActual');
        $miMano = session()->get('miMano');
        //dd($mazoActual);
        return view('blackjack');
    }

    public function mostrarMazo(Request $request) { 
        $mazoActual = session()->get('mazoActual');
        return view('blackjack', compact('mazoActual'));
    }
}