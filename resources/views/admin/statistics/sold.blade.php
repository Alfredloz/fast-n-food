@extends('layouts.dashboard')

@section('content')

  <h1 class="title_bills">Ricevute degli ordini</h1>

  <div class="card_container">
    @foreach ($bills as $bill)
      <div class="card-scontrino">
        <img class="card_image" src="{{asset("/images/back_office/scontrino.png")}}" alt="">

        <div class="card-body">
          <h4 class="card-title">Ordine del: {{ $bill->created_at }}</h4>
          <div class="card_info_orders">
            @foreach ($bill->plates as $plate)
              <div class="card_info">
                <p class="card_plate_name">x{{ $plate->pivot->plate_quantity}} - {{ $plate->name}}</p>
                <p class="card_plate_price">{{ $plate->price}} €</p>
              </div>
            @endforeach
          </div>
          <p class="card-text card_total">Totale: {{ $bill->total_price}} €</p>
        </div>


      </div>
  @endforeach
</div>

@endsection
