<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Mail</title>
    <style media="screen">
      body{
        background-color: #F8F9FD;
      }
    </style>
  </head>


  <body>
    <h1>Ordine efffettuato</h1>

    <h3>Nome del cliente: {{$infoClient[0]}}</h3>
    <p>Numero di telefono: {{$infoClient[1]}}</p>
    <p>Indirizzo di consegna: {{$infoClient[2]}}</p>

    @foreach ($sale as $food)
      <h3>Nome piatto: {{$food['name']}}</h3>
      <p>Quantità: {{$food['quantity']}}</p>
    @endforeach

    <h3>Totale pagato: {{$tot}} €</h3>
  </body>
</html>
