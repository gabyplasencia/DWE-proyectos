<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackjack</title>
</head>
<body>

    <?php
        include('mazo.php');
        session_start();

        if (!isset($_SESSION['mazo'])) {
            $mazo = new Mazo();   // Crear un nuevo mazo   
            $_SESSION['mazo'] = $mazo; // Guardar el mazo en la sesión
        } else {
            $mazo = $_SESSION['mazo']; // Recuperar el mazo de la sesión
        }

        //Muestro el mazo
        if (isset($_POST['mostrarMazo'])) {
            $mazo->mostrarMazo();
        }

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

        $_SESSION['mazo'] = $mazo;
    ?>

    <form action="<?php  echo $_SERVER['PHP_SELF'];?>" method="post">
        <button type="submit" name="mostrar-carta">Elegir una carta</button>
        <button type="submit" name="mostrarMazo">Mostrar mazo</button>
    </form>
</body>
</html>