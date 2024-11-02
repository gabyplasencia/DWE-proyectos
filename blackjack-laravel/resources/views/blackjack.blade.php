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
    <form action="/blackjack/mostrarmazo" method="post">
        @csrf
        <button type="submit" name="mostrar-mazo" value="mostrar-mazo">Mostrar mazo</button>
    </form>
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
                    <strong>Llevas acumulados {{$sumaPuntos}} puntos</strong>
                @else
                    <strong>Perdiste :( sumaste {{$sumaPuntos}} puntos</strong>
                @endif
            @endisset
        
            @if($mePlanto && $sumaPuntos <= 21)
            <br>
            <strong style="margin-top: 2rem;">Te quedas en {{$sumaPuntos}} puntos</strong>
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
                    <strong>El crupier tiene {{$puntosCrupier}} puntos</strong>
                @else
                    <strong>El crupier perdio con {{$puntosCrupier}} puntos</strong>
                @endif
            @endisset
        </div>
    </div>

</body>
</html>
