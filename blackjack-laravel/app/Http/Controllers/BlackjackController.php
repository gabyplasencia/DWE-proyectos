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
            $mazoActual = $mazo->getMazo();
            session()->put('mazoActual', $mazoActual);
            //dd($mazo);
            //dd($mazoActual);
        } else {
            $mazo = session()->get('mazo'); //recupera datos
            $mazoActual = session()->get('mazoActual');
            //dd($mazo);
            //dd($mazoActual);
        }
        
        //dd($mazoActual);

        return view('blackjack', compact('mazoActual'));
    }

    public function sacarCarta(Request $request) {

        if (!session()->has('mazo')) { 
            $mazo = new Mazo();
            session()->put('mazo', $mazo);
            $mazoActual = $mazo->getMazo();
            
            $mazo->pruebaSacarCarta();
            $miMano = $mazo->getMiMano();

            session()->put('mazo', $mazo);
            session()->put('miMano', $miMano);
            session()->put('mazoActual', $mazoActual);
            //dd($miMano);
            //dd($mazoActual);
        } else {
            $mazo = session()->get('mazo'); 
            $mazoActual = session()->get('mazoActual');
            $miMano = session()->get('miMano');

            $mazo->pruebaSacarCarta();

            session()->push('miMano', $mazo->getMiMano());

            session()->put('mazo', $mazo);
            session()->put('mazoActual', $mazoActual);
            session()->put('miMano', $miMano);
            //dd($miMano);
            //dd($mazoActual);
        }

        return view('blackjack', compact('miMano'));
    }

}
