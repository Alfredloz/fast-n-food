<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Mail</title>
    <style media="screen">
      body{
        background-color: lightgrey;
      }
    </style>
  </head>


  <body>
    <h1>Ordine</h1>

    <h3>Nome Cliente: {{$infoClient[0]}}</h3>
    <p>Numero di telefono: {{$infoClient[1]}}</p>
    <p>Indirizzo di consegna: {{$infoClient[2]}}</p>

    @foreach ($sale as $food)
      <h2>Nome piatto: {{$food['name']}}</h2>
      <p>Quantità: {{$food['quantity']}}</p>
    @endforeach

    <h3>Totale pagato: {{$tot}}</h3>
  </body>
</html>
