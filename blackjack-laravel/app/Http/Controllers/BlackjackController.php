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
        $crupierPara = false;

        session(['mazoActual' => $mazo->getMazo()]);
        session(['miMano' => $mazo->getMiMano()]);
        session(['manoCrupier' => $crupier->getManoCrupier()]);
        session(['puntosCrupier' => 0]);
        session(['sumaPuntos' => 0]);
        session(['mePlanto' => false]);
        
        $mazoActual = session()->get('mazoActual');
        $miMano = session()->get('miMano');
        $manoCrupier = session()->get('manoCrupier');
        $puntosCrupier = session()->get('puntosCrupier');
        $sumaPuntos = session()->get('sumaPuntos');
        $mePlanto = session()->get('mePlanto');

        $carta = array_pop($mazoActual);
        array_push($manoCrupier, $carta);
        $arrayCarta = explode(" ", $carta);
        $numeroCarta = $arrayCarta[0];

        $valorCarta = $this->valorCarta($numeroCarta, $puntosCrupier);
        $puntosCrupier = $puntosCrupier + $valorCarta;

        session()->put('mazoActual', $mazoActual);
        session()->put('manoCrupier', $manoCrupier);
        session()->put('puntosCrupier', $puntosCrupier);
        //dd($miMano);
        return view('blackjack', compact('sumaPuntos', 'mePlanto', 'manoCrupier', 'puntosCrupier', 'crupierPara'));
    }

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
        $puntosCrupier = session()->get('puntosCrupier');
        $sumaPuntos = session()->get('sumaPuntos');
        $mePlanto = session()->get('mePlanto');

        $yoGano = false;
        $crupierPara = false;
        
        if($sumaPuntos <= 21){
            $carta = array_pop($mazoActual);
            array_push($miMano, $carta);

            //Vuelvo un array el string de la carta y cojo el primer valor
            $arrayCarta = explode(" ", $carta);
            $numeroCarta = $arrayCarta[0];

            $valorCarta = $this->valorCarta($numeroCarta, $sumaPuntos);
            $sumaPuntos = $sumaPuntos + $valorCarta;
        }

        if ($sumaPuntos > 21) {
            $mePlanto = true;
            $crupierPara = true;
        }

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

        if($mePlanto == true && $puntosCrupier < $sumaPuntos){
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
        }else {
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
        }

        if($puntosCrupier == 21) {
            $crupierPara = true;
        }else if($puntosCrupier > 16) {
            $crupierPara = true;
        }else if($puntosCrupier > 21) {
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

    public function partidaNueva() {

        session()->flush();

        return redirect('/'); 
    }
}