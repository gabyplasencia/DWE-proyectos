<?php

namespace App\Http\Controllers;

use App\Models\Crupier;
use App\Models\Mazo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BlackjackController extends Controller {

    public function index() {

        $mazo = new Mazo();
        $crupier = new Crupier();

        session(['mazoActual' => $mazo->getMazo()]);
        session(['miMano' => $mazo->getMiMano()]);
        session(['manoCrupier' => $crupier->getManoCrupier()]);
        session(['sumaPuntos' => 0]);
        session(['mePlanto' => false]);
        
        $mazoActual = session()->get('mazoActual');
        $miMano = session()->get('miMano');
        $manoCrupier = session()->get('manoCrupier');
        $sumaPuntos = session()->get('sumaPuntos');
        $mePlanto = session()->get('mePlanto');

        $carta = array_pop($mazoActual);
        array_push($manoCrupier, $carta);

        session()->put('mazoActual', $mazoActual);
        session()->put('manoCrupier', $manoCrupier);
        //dd($miMano);
        return view('blackjack', compact('sumaPuntos', 'mePlanto', 'manoCrupier'));
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
        $manoCrupier = session()->get('manoCrupier');
        $sumaPuntos = session()->get('sumaPuntos');
        $mePlanto = session()->get('mePlanto');
        
        if($sumaPuntos <= 21){
            $carta = array_pop($mazoActual);
            array_push($miMano, $carta);

            //Vuelvo un array el string de la carta y cojo el primer valor
            $arrayCarta = explode(" ", $carta);
            $valorCarta = $arrayCarta[0];

            //Segun la carta (número o letra) hago la asignación y suma del total
            switch ($valorCarta) {
                case "J":
                    $valorCarta = 11;
                    $sumaPuntos = $sumaPuntos + $valorCarta;
                    break;
                case "Q":
                    $valorCarta = 12;
                    $sumaPuntos = $sumaPuntos + $valorCarta;
                    break;
                case "K":
                    $valorCarta = 13;
                    $sumaPuntos = $sumaPuntos + $valorCarta;
                    break;
                case "A":
                    if($sumaPuntos > 10) {
                        $valorCarta = 1;
                        $sumaPuntos = $sumaPuntos + $valorCarta;
                    }else {
                        $valorCarta = 11;
                        $sumaPuntos = $sumaPuntos + $valorCarta;
                    }
                    break;
                default:
                    $sumaPuntos = $sumaPuntos + $valorCarta;
                    break;
            }
        }

        if ($sumaPuntos > 21) {
            $mePlanto = true;
        }

        session()->put('mazoActual', $mazoActual);
        session()->put('miMano', $miMano);
        session()->put('manoCrupier', $manoCrupier);
        session()->put('sumaPuntos', $sumaPuntos);
        session()->put('mePlanto', $mePlanto);

        return view('blackjack', compact('miMano', 'sumaPuntos', 'mePlanto', 'manoCrupier'));
    }

    public function mePlanto(Request $request) {
        $mazo = session()->get('mazo');
        
        $mazoActual = session()->get('mazoActual');
        $miMano = session()->get('miMano');
        $manoCrupier = session()->get('manoCrupier');
        $sumaPuntos = session()->get('sumaPuntos');
        $mePlanto = session()->get('mePlanto');
        
        $mePlanto = true;

        session()->put('mePlanto', $mePlanto);

        return view('blackjack', compact('miMano', 'sumaPuntos', 'mePlanto', 'manoCrupier'));
    }

    public function partidaNueva() {

        session()->flush();

        return redirect('/'); 
    }
}