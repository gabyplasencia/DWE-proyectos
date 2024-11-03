<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blackjack</title>
</head>
<body>
    <h1>Blackjack</h1>
    {{-- 
    Lo tenia para comprobar que se mantenia el mismo mazo y que se retiraban cartas del mazo
    <form action="/blackjack/mostrarmazo" method="post">
        @csrf
        <button type="submit" name="mostrar-mazo" value="mostrar-mazo">Mostrar mazo</button>
    </form> 
    --}}
    <div style="display: flex; gap:2rem; margin-bottom: 2rem;">
        @if (!$mePlanto)
        <form action="/blackjack/sacarcarta" method="post">
            @csrf
            <button type="submit" name="mostrar-carta" value="mostrar-carta">Elegir una carta</button>
        </form>
        <form action="/blackjack/meplanto" method="post">
            @csrf
            <button type="submit" name="me-planto" value="me-planto">Me planto</button>
        </form>
    @endif
    <form action="/blackjack/partidanueva" method="post">
        @csrf
        <button type="submit" name="partida-nueva" value="partida-nueva">Partida nueva</button>
    </form>
    </div>

    @isset($mazoActual)
        @foreach ($mazoActual as $carta)
            <p>{{$carta}}</p>  
        @endforeach
    @endisset

    <div style="display: flex; gap: 2rem;">
        <div style="border-right: 2px solid black; padding-right: 2rem;">    
            @isset($miMano)
                <strong>Tu mano</strong>
                <div style="display: flex; gap: 1rem;">
                    @foreach ($miMano as $carta)   
                        <p>{{$carta}}</p>  
                    @endforeach
                </div>
                @if($sumaPuntos <= 21)
                    <p>Llevas acumulados <strong> {{$sumaPuntos}} </strong>puntos</p>
                @else
                    <strong style="color:red;">Ups :( sumaste {{$sumaPuntos}} puntos</strong>
                @endif
            @endisset
        
            @if($mePlanto && $sumaPuntos <= 21)
                <strong>Te plantas con {{$sumaPuntos}} puntos</strong>
            @endif
            <br>
            @if($mePlanto && $crupierPara)
                @if($puntosCrupier > 21 && $sumaPuntos > 21)
                <strong style="color:red; font-size: 1.5rem;">Que mal... AMBOS PIERDEN! </strong>
                @else
                    @if ($yoGano)
                        <strong style="color:green; font-size: 1.5rem;">Yuju!! GANASTE</strong>
                    @else
                        <strong style="color:red; font-size: 1.5rem;">Lo siento... PERDISTE</strong>
                    @endif
                @endif
            @endif
        </div>

        <div>
            @isset($manoCrupier)
                <strong>Mano Crupier</strong>
                <div style="display: flex; gap: 1rem;">
                    @foreach ($manoCrupier as $carta)   
                        <p>{{$carta}}</p>  
                    @endforeach
                </div>
                @if($puntosCrupier <= 21)
                    <p>El crupier tiene <strong>{{$puntosCrupier}}</strong>  puntos</p>
                @else
                <strong>El crupier perdio con {{$puntosCrupier}} puntos</strong>
                @endif
            @endisset

            @if($crupierPara && $puntosCrupier <= 21)
                <strong>El crupier se planta con {{$puntosCrupier}} puntos</strong>
            @endif
            <br>
            @if($mePlanto && $crupierPara)
                @if($puntosCrupier > 21 && $sumaPuntos > 21)
                    <strong>What!</strong>
                @else
                    @if ($yoGano)
                        <strong>Perdio el crupier :P</strong>
                    @else
                        <strong>Gano el crupier, intentalo de nuevo...</strong>
                    @endif
                @endif
            @endif
        </div>
    </div>

</body>
</html>
