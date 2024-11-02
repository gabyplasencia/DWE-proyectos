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
        session(['sumaPuntos' => 0]);
        
        $mazoActual = session()->get('mazoActual');
        $miMano = session()->get('miMano');
        $sumaPuntos = session()->get('sumaPuntos');

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
        $sumaPuntos = session()->get('sumaPuntos');
        
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

        session()->put('mazoActual', $mazoActual);
        session()->put('miMano', $miMano);
        session()->put('sumaPuntos', $sumaPuntos);

        return view('blackjack', compact('miMano', 'sumaPuntos'));
    }
}