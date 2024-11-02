<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mazo extends Model {
            
    private $mazo = [];
    private $miMano = [];
    private $sumaCartas = 0;

    public function __construct() {

        $palos = ["corazón", "diamante", "trebol", "pica"];

        $numeroCarta = [];
        for($i=1; $i <= 13; $i++){
            switch ($i) {
                case 1:
                    array_push($numeroCarta, "A");
                    break;
                case 11:
                    array_push($numeroCarta, "J");
                    break;
                case 12:
                    array_push($numeroCarta, "Q");
                    break;
                case 13:
                    array_push($numeroCarta, "K");
                    break;
                default:
                    array_push($numeroCarta, $i);
                    break;
            }
        }

        //Armo el mazo
        for($i=0; $i<count($palos); $i++){
            for($j=0; $j<count($numeroCarta); $j++){
                array_push($this->mazo, "$numeroCarta[$j] de $palos[$i]");
            }
        }
        //Mezclo el mazo
        shuffle($this->mazo);
        //dd($this->mazo); 
    }
    
    public function setMazo(array $mazo) {
        $this->mazo = $mazo;
    }
    
    //Muestro el mazo
    public function getMazo(){
        return $this->mazo;
        //dd($this->getMazo());
    }

    public function getMiMano() {
        return $this->miMano;
    }

    //El jugador decide si se queda con su mano actual
    public function mePlanto() {
        echo "<strong>Te quedas en $this->sumaCartas</strong>";
    }

    //Borro la sesion y vuelvo a cargar la página
    public function partidaNueva() {
        session_destroy();
        header("Location: blackjack.php");
    }
}
