<?php

namespace App\Http\Controllers;

use App\Models\Crupier;
use App\Models\Mazo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BlackjackController extends Controller {

    //Inicializo mis variables y redirijo a la vista de blackjack con el mazo ya cargado
    public function index() {

        $mazo = new Mazo();
        $crupier = new Crupier();
        $crupierPara = false;

        //pongo los datos de cada variable en una sesion
        session(['mazoActual' => $mazo->getMazo()]);
        session(['miMano' => $mazo->getMiMano()]);
        session(['manoCrupier' => $crupier->getManoCrupier()]);
        session(['puntosCrupier' => 0]);
        session(['sumaPuntos' => 0]);
        session(['mePlanto' => false]);
        
        //Declaro las variables con los datos de la sesion
        $mazoActual = session()->get('mazoActual');
        $miMano = session()->get('miMano');
        $manoCrupier = session()->get('manoCrupier');
        $puntosCrupier = session()->get('puntosCrupier');
        $sumaPuntos = session()->get('sumaPuntos');
        $mePlanto = session()->get('mePlanto');

        //La partida inicia con una carta en la mano del crupier
        $carta = array_pop($mazoActual);
        array_push($manoCrupier, $carta);
        $arrayCarta = explode(" ", $carta);
        $numeroCarta = $arrayCarta[0];

        $valorCarta = $this->valorCarta($numeroCarta, $puntosCrupier);
        $puntosCrupier = $puntosCrupier + $valorCarta;

        //Actualizo los datos de las sesiones modificadas
        session()->put('mazoActual', $mazoActual);
        session()->put('manoCrupier', $manoCrupier);
        session()->put('puntosCrupier', $puntosCrupier);
        //dd($miMano);
        return view('blackjack', compact('sumaPuntos', 'mePlanto', 'manoCrupier', 'puntosCrupier', 'crupierPara'));
    }

    //Determino los puntos de la carta que se eligio
    //este metodo lo usa tanto el jugador como el crupier
    public function valorCarta($numeroCarta, $puntosTotales) {
        //Segun la carta (número o letra) hago la asignación y suma del total
        switch ($numeroCarta) {
            case "J":
                return 11;
                break;
            case "Q":
                return 12;
                break;
            case "K":
                return 13;
                break;
            case "A":
                if($puntosTotales > 10) {
                    return 1;
                }else {
                    return 11;
                }
                break;
            default:
                return $numeroCarta;
                break;
        }
    }

    //Comparo los puntajes y condiciones de cada puntaje
    //y determino quien gano
    public function comprararPuntajes($misPuntos, $puntosCrupier) {
        if($misPuntos > $puntosCrupier && $misPuntos <= 21) {
            return true;
        }else if($misPuntos < $puntosCrupier && $puntosCrupier > 21) {
            return true;
        }else if($misPuntos > $puntosCrupier && $misPuntos > 21) {
            return false;
        }else if($misPuntos == $puntosCrupier) {
            return true;
        }else {
            return false;
        }
    }

    //Muestro el mazo, pero solo use este metodo para verificaciones
    //el jugador no vera este boton
    public function mostrarMazo(Request $request) {
        $mazoActual = session()->get('mazoActual');
        //dd($mazoActual);
        return view('blackjack', compact('mazoActual'));
    }

    //Saco carta, calculo puntajes y el crupier si cumple la condicion tambien coge una carta
    public function sacarCarta(Request $request) {
        
        $mazo = session()->get('mazo');
        
        //recupero las sesiones
        $mazoActual = session()->get('mazoActual');
        $miMano = session()->get('miMano');
        $manoCrupier = session()->get('manoCrupier');
        $puntosCrupier = session()->get('puntosCrupier');
        $sumaPuntos = session()->get('sumaPuntos');
        $mePlanto = session()->get('mePlanto');

        //declaro mis varibale (no vi necesario crear una sesion para estas)
        $yoGano = false;
        $crupierPara = false;
        
        //Determino si el jugador puede coger mas cartas o no
        if($sumaPuntos <= 21){
            $carta = array_pop($mazoActual);
            array_push($miMano, $carta);

            //Vuelvo un array el string de la carta y cojo el primer valor
            $arrayCarta = explode(" ", $carta);
            $numeroCarta = $arrayCarta[0];

            $valorCarta = $this->valorCarta($numeroCarta, $sumaPuntos);
            $sumaPuntos = $sumaPuntos + $valorCarta;
        }

        //Si el jugador pierde colocando esas dos variables en true termina la partida
        if ($sumaPuntos > 21) {
            $mePlanto = true;
            $crupierPara = true;
        }

        //Considere que cartas por debajo de 16 era un riesgo aceptable
        if($puntosCrupier < 16){
            $carta = array_pop($mazoActual);
            array_push($manoCrupier, $carta);

            //Vuelvo un array el string de la carta y cojo el primer valor
            $arrayCarta = explode(" ", $carta);
            $numeroCarta = $arrayCarta[0];

            $valorCarta = $this->valorCarta($numeroCarta, $puntosCrupier);
            $puntosCrupier = $puntosCrupier + $valorCarta;
        }else {
            $crupierPara = true;
        }

        //estos 3 if los puse separados porque no entraba en algunos si usaba else if
        if($puntosCrupier == 21) {
            $crupierPara = true;
        }
        if($puntosCrupier > 16) {
            $crupierPara = true;
        }
        if($puntosCrupier > 21) {
            $crupierPara = true;
            $mePlanto = true;
        }

        //Si ambos paran termina la partida y calculo puntajes
        if($mePlanto && $crupierPara){
            $yoGano=$this->comprararPuntajes($sumaPuntos, $puntosCrupier);
        }

        //Actualizo las sesiones
        session()->put('mazoActual', $mazoActual);
        session()->put('miMano', $miMano);
        session()->put('manoCrupier', $manoCrupier);
        session()->put('puntosCrupier', $puntosCrupier);
        session()->put('sumaPuntos', $sumaPuntos);
        session()->put('mePlanto', $mePlanto);

        return view('blackjack', compact('miMano', 'sumaPuntos', 'mePlanto', 'manoCrupier', 'puntosCrupier', 'crupierPara', 'yoGano'));
    }

    public function mePlanto(Request $request) {
        $mazo = session()->get('mazo');
        
        $mazoActual = session()->get('mazoActual');
        $miMano = session()->get('miMano');
        $manoCrupier = session()->get('manoCrupier');
        $puntosCrupier = session()->get('puntosCrupier');
        $sumaPuntos = session()->get('sumaPuntos');
        $mePlanto = session()->get('mePlanto');
        
        $mePlanto = true;
        $crupierPara = false;
        $yoGano = false;

        //Si el jugador para y el crupier aun puede coger cartas, lo hara una vez mas
        if($puntosCrupier < 16){
            $carta = array_pop($mazoActual);
            array_push($manoCrupier, $carta);

            //Vuelvo un array el string de la carta y cojo el primer valor
            $arrayCarta = explode(" ", $carta);
            $numeroCarta = $arrayCarta[0];

            $valorCarta = $this->valorCarta($numeroCarta, $puntosCrupier);
            $puntosCrupier = $puntosCrupier + $valorCarta;
            $crupierPara = true;
        }else {
            $crupierPara = true;
        }

        if($puntosCrupier == 21) {
            $crupierPara = true;
        }
        if($puntosCrupier > 16) {
            $crupierPara = true;
        }
        if($puntosCrupier > 21) {
            $crupierPara = true;
            $mePlanto = true;
        }

        if($mePlanto && $crupierPara){
            $yoGano=$this->comprararPuntajes($sumaPuntos, $puntosCrupier);
        }

        session()->put('mePlanto', $mePlanto);
        session()->put('manoCrupier', $manoCrupier);
        session()->put('puntosCrupier', $puntosCrupier);

        return view('blackjack', compact('miMano', 'sumaPuntos', 'mePlanto', 'manoCrupier', 'puntosCrupier', 'crupierPara', 'yoGano'));
    }

    //Inicio una oartida nueva
    public function partidaNueva() {

        //Borro todos los datos de la sesion
        session()->flush();
        //Redirijo a la raiz de nuevo
        return redirect('/'); 
    }
}