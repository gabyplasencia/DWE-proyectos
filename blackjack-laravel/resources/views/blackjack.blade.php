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
    <form action="/blackjack/sacarcarta" method="post">
        @csrf
        <button type="submit" name="mostrar-carta" value="mostrar-carta">Elegir una carta</button>
    </form>
    {{-- <form action="/blackjack/sacarcarta" method="post">
        @csrf
        <button type="submit" name="me-planto" value="me-planto">Me planto</button>
    </form>
    <form action="/blackjack/sacarcarta" method="post">
        @csrf
        <button type="submit" name="partida-nueva" value="partida-nueva">Partida nueva</button>
    </form> --}}

    @isset($mazoActual)
        @foreach ($mazoActual as $carta)
            <p>{{$carta}}</p>  
        @endforeach
    @endisset

    @isset($miMano)
        <strong>Mi mano</strong>
        @foreach ($miMano as $carta)   
            <p>{{$carta}}</p>  
        @endforeach
    @endisset

</body>
</html>
