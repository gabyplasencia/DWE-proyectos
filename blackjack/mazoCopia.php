<?php
    class MazoCopia {
        
        private $mazo = [];
        private $partida;

        public function __construct($partida) {
            $this->partida = $partida;

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
            if($this->partida->getSumaCartas() <= 21) {
                $carta = array_pop($this->mazo);
                return $carta;
            }
        }

    }
?>