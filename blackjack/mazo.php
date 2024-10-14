<?php
    class Mazo {
        
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
        }

        //Muestro el mazo
        public function mostrarMazo(){
            print_r($this->mazo);
        }

        //Saco una carta y guardo la mano
        public function sacarCartar(){
            if($this->sumaCartas <= 21) {
                $carta = array_pop($this->mazo);

                echo "<strong>Sacaste $carta</strong>\n";
                array_push($this->miMano, $carta);
                $visualizarMano = " ";
                foreach($this->miMano as $value) {
                    $visualizarMano .= "- ". $value." - ";
                }
                echo "<p>En tu mano tienes $visualizarMano</p>";

                $arrayCarta = explode(" ", $carta);
                $valorCarta = $arrayCarta[0];
                switch ($valorCarta) {
                    case "J":
                        $valorCarta = 11;
                        $this->sumaCartas = $this->sumaCartas + $valorCarta;
                        break;
                    case "Q":
                        $valorCarta = 12;
                        $this->sumaCartas = $this->sumaCartas + $valorCarta;
                        break;
                    case "K":
                        $valorCarta = 13;
                        $this->sumaCartas = $this->sumaCartas + $valorCarta;
                        break;
                    case "A":
                        if($this->sumaCartas > 10) {
                            $valorCarta = 1;
                            $this->sumaCartas = $this->sumaCartas + $valorCarta;
                        }else {
                            $valorCarta = 11;
                            $this->sumaCartas = $this->sumaCartas + $valorCarta;
                        }
    
                        break;
                    default:
                        $this->sumaCartas = $this->sumaCartas + $valorCarta;
                        break;
            }

            if($this->sumaCartas > 21) {
                echo "\n<strong>Perdiste :( \n Llegaste a $this->sumaCartas</strong>";
            }else{
                echo "\n<strong>Llevas acumulado un $this->sumaCartas</strong>";
            }
            }else {
                echo "\n<strong>Llegaste al límite</strong>";
                echo "\n<strong>Acumulaste un $this->sumaCartas</strong>";
            }
        }

        public function mePlanto() {
            echo "<strong>Te quedas en $this->sumaCartas</strong>";
        }

    }
?>