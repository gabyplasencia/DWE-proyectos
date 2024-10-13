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
            $mazo = new Mazo();     
            $_SESSION['mazo'] = $mazo; 
        } else {
            $mazo = $_SESSION['mazo']; 
        }

        //Muestro el mazo
        if (isset($_POST['mostrarMazo'])) {
            $mazo->mostrarMazo();
        }
        
        if (isset($_POST['mostrar-carta'])) {
            $mazo->sacarCartar();        
        }

        $_SESSION['mazo'] = $mazo;
    ?>

    <form action="<?php  echo $_SERVER['PHP_SELF'];?>" method="post">
        <button type="submit" name="mostrar-carta">Elegir una carta</button>
        <button type="submit" name="mostrarMazo">Mostrar mazo</button>
    </form>
</body>
</html>