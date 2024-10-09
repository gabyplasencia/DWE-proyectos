<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackjack</title>
</head>
<body>
    <?php
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
        
        $mazo = [];
        //Armo el mazo
        for($i=0; $i<count($palos); $i++){
            for($j=0; $j<count($numeroCarta); $j++){
                array_push($mazo, "$numeroCarta[$j] de $palos[$i]");
            }
        }

        //Mezclo el mazo
        if (isset($_POST['mezclar'])) {
            shuffle($mazo);
            echo "<strong>Listo! Elige una carta</strong>";
        }

        //Elijo una carta
        $miMano = [];
        if (isset($_POST['mostrar-carta'])) {
            $carta = array_shift($mazo);
            echo "<strong>$carta</strong>";

                //Guardo las tres primeras cartas
                if(count($miMano) <= 3){
                    array_push($miMano, $carta);
                    print_r($miMano);
                }
        }





        // carta.php
        // class Carta{
        //     $numero
        //     $palo
        
        //     public function __toString(){
        //         return $palo.$numero;
        //     }
        // }
        
        
        // partida.php
        // class Partida{
            
        // }
        
        
        // principal.php
        //     session_start();
        
        //     include(carta.php);
        //     include(mazo.php);
        
        //     $mazo = $_SESSION['mazo'];
        //     $cartas = $_SESSION['cartas'];
        
        //     if( !isset($mazo)){
        //         $mazo = new Mazo();
        //         $mazo->barajar();
        //     }
        
        //     if( !isset($cartas)){
        //         $cartas = [];
        //     }
        
            
        
        
        //     $_SESSION['mazo'] = $mazo;
        //     $_SESSION['cartas'] = $cartas;
        
        //     if( isset($_REQUEST["formapostar"])){
        //         $cartas[] = $mazo->pedirCarta();
        //         $_SESSION['mazo'] = $mazo;
        //         $_SESSION['cartas'] = $cartas;
        //     }
        
        // echo "<input type=submit name=formapostar />
        
        // echo "<input type=submit name=meplanto /> 
    ?>
</body>
</html>