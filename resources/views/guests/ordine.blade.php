@extends('layouts.app')

@section('content')
<div class="success-payment">
    <i class="far fa-check-circle"></i><h1>Pagamento andato a buon fine</h1> 
    <hr>
    <h2>Abbiamo ricevuto il tuo ordine! A breve ti arriverà la consegna. Questi sono i dati di contatto:</h2>
    <h3>Nome: <strong>{{$_GET['name']}}</strong></h3>
    <h3>Telefono: <strong>{{$_GET['phone']}}</strong></h3>
    <h3>Indirizzo: <strong>{{$_GET['address']}}</strong></h3>
    <hr>
</div>

@endsection