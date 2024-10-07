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
        
        for($i=0; $i<count($palos); $i++){
            for($j=0; $j<count($numeroCarta); $j++){
                array_push($mazo, "$numeroCarta[$j] de $palos[$i]");
            }
        }

        shuffle($mazo);
        var_dump($mazo);
    ?>
</body>
</html>