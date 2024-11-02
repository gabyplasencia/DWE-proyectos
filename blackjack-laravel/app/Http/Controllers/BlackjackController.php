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
        //dd($miMano);
        return view('blackjack');
    }

    public function mostrarMazo(Request $request) {

        $mazoActual = session()->get('mazoActual');
        //dd($mazoActual);
        return view('blackjack', compact('mazoActual'));
    }

    public function sacarCarta(Request $request) {
        
        $mazo = session()->get('mazo');
        
        $mazoActual = session()->get('mazoActual');
        $miMano = session()->get('miMano');
        
        $carta = array_pop($mazoActual);
        
        array_push($miMano, $carta);
        //dd($miMano);
        session()->put('mazoActual', $mazoActual);
        session()->put('miMano', $miMano);

        return view('blackjack', compact('miMano'));
    }
}