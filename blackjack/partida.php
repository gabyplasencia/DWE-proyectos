<?php
    class Partida {

        private $mazo;
        private $miMano = [];
        private $sumaCartas = 0;

        public function __construct() {
            $this->mazo = new MazoCopia();
        }

        public function getSumaCartas() {
            return $this->sumaCartas;
        }

        public function añadirCartaMiMano() {
            $carta = $this->mazo->sacarCartar();

            echo "<strong>Sacaste $carta</strong>\n";
            array_push($this->miMano, $carta);

            //Muestro la mano del jugador
            $visualizarMano = " ";
            foreach($this->miMano as $value) {
                $visualizarMano .= "- ". $value." - ";
            }
            echo "<p>En tu mano tienes $visualizarMano</p>";

            //Vuelvo un array el string de la carta y cojo el primer valor
            $arrayCarta = explode(" ", $carta);
            $valorCarta = $arrayCarta[0];
            //Sumo los puntos
            $this->sumarPuntos($valorCarta);
        }

        public function sumarPuntos(string $valorCarta) {
                        //Segun la carta (número o letra) hago la asignación y suma del total
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
        }

        //El jugador decide si se queda con su mano actual
        public function mePlanto() {
            echo "<strong>Te quedas en $this->sumaCartas</strong>";
        }

        //Borro la sesion y vuelvo a cargar la página
        public function partidaNueva() {
            session_destroy();
            header("Location: blackjackCopia.php");
        }
    }
?>