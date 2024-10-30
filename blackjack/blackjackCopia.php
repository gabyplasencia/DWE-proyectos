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
        include('mazoCopia.php');
        include('partida.php');
        session_start();

        if (!isset($_SESSION['mazo'])) {
            $partida = new Partida();
            $mazo = new MazoCopia($partida);     

            $_SESSION['mazo'] = $mazo; 
            $_SESSION['partida'] = $partida;
        } else {
            $mazo = $_SESSION['mazo']; 
            $partida = $_SESSION['partida'];
        }

        //Muestro el mazo
        if (isset($_POST['mostrar-mazo'])) {
            $mazo->mostrarMazo();
        }
        
        //Saco carta y sumo puntos
        if (isset($_POST['sacar-carta'])) {
            $partida->añadirCartaMiMano();        
        }

        //Se queda con los puntos actuales
        if (isset($_POST['me-planto'])) {
            $partida->mePlanto();
        }

        //Partida nueva
        if (isset($_POST['partida-nueva'])) {
            $partida->partidaNueva();
        }
        
        $_SESSION['mazo'] = $mazo;
        $_SESSION['partida'] = $partida;
    ?>
    </div>
    <form action="<?php  echo $_SERVER['PHP_SELF'];?>" method="post">
        <button type="submit" name="sacar-carta">Elegir una carta</button>
        <button type="submit" name="me-planto">Me planto</button>
        <button type="submit" name="mostrar-mazo">Mostrar mazo</button>
        <button type="submit" name="partida-nueva">Partida nueva</button>
    </form>
</body>
</html>


