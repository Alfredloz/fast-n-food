@extends('layouts.dashboard')

@section('content')

  <h1>Ricevute degli ordini</h1>

  @foreach ($bills as $bill)  
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Ordine del: {{ $bill->created_at }}</h4>
        <hr>
        @foreach ($bill->plates as $plate)
          <p class="card-text">Piatto: {{ $plate->name}} x{{ $plate->pivot->plate_quantity}}</p>
          <p class="card-text">Prezzo: {{ $plate->price}} €</p>
        @endforeach
        <hr>
        <p class="card-text">Totale: {{ $bill->total_price}} €</p>
      </div>
    </div>         
  @endforeach

@endsection
