<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackjack</title>
</head>
<body>

    <?php
        // session_start();
        // $palos = ["corazón", "diamante", "trebol", "pica"];

        // $numeroCarta = [];
        // for($i=1; $i <= 13; $i++){
        //     switch ($i) {
        //         case 1:
        //             array_push($numeroCarta, "A");
        //             break;
        //         case 11:
        //             array_push($numeroCarta, "J");
        //             break;
        //         case 12:
        //             array_push($numeroCarta, "Q");
        //             break;
        //         case 13:
        //             array_push($numeroCarta, "K");
        //             break;
        //         default:
        //             array_push($numeroCarta, $i);
        //             break;
        //     }
        // }
        
        // $mazo = [];
        // //Armo el mazo
        // for($i=0; $i<count($palos); $i++){
        //     for($j=0; $j<count($numeroCarta); $j++){
        //         array_push($mazo, "$numeroCarta[$j] de $palos[$i]");
        //     }
        // }

        // //Mezclo el mazo
        // if (isset($_POST['mezclar'])) {
        //     shuffle($mazo);
        //     echo "<strong>Listo! Elige una carta</strong>";
        // }

        
        // if (!isset($_SESSION['miMano'])) {
        //     $_SESSION['miMano'] = [];
        // }
        // //Muestro una carta random
        // if (isset($_POST['mostrar-carta'])) {
        //     $carta = array_shift($mazo);
        //     echo "<strong>$carta</strong>";

        //         //Guardo las tres primeras cartas
        //         if(count($_SESSION['miMano']) < 15){
        //             array_push($_SESSION['miMano'], $carta);
        //             print_r($_SESSION['miMano']);
        //         }
        // }


        session_start();

        include('mazo.php');

        $mazo = $_SESSION['mazo'];

        if( !isset($mazo)){
            $mazo = new Mazo();
        }

        //Muestro el mazo
        if (isset($_POST['mostrarMazo'])) {
            $mazo->mostrarMazo();
        }

        //Mezclo el mazo
        if (isset($_POST['mezclar'])) {
            $mazo->mezclarMazo();
            echo "<strong>Listo! Elige una carta</strong>";
        }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <button type="submit" name="mezclar">Mezclar las cartas</button>
        <button type="submit" name="mostrar-carta">Elegir una carta</button>
        <button type="submit" name="mostrarMazo">Mostrar mazo</button>
    </form>
</body>
</html>