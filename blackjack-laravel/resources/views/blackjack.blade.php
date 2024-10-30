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

    
        {{-- <p>{{$message}}</p> --}}
        @isset($mazo)
            <p>{{json_encode($mazo, JSON_UNESCAPED_UNICODE )}}</p>
        @endisset

   

</body>
</html>
