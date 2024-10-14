<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackjack</title>
</head>
<body>
    <div class="wrapper" style="display: flex; flex-direction: column;">
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
        
        //Saco carta y sumo puntos
        if (isset($_POST['mostrar-carta'])) {
            $mazo->sacarCartar();        
        }

        //Se queda con los puntos actuales
        if (isset($_POST['me-planto'])) {
            $mazo->mePlanto();
        }
        
        $_SESSION['mazo'] = $mazo;
    ?>
    </div>
    <form action="<?php  echo $_SERVER['PHP_SELF'];?>" method="post">
        <button type="submit" name="mostrar-carta">Elegir una carta</button>
        <button type="submit" name="me-planto">Me planto</button>
        <button type="submit" name="mostrarMazo">Mostrar mazo</button>
    </form>
</body>
</html>