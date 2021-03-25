@extends('layouts.dashboard')

@section('content')

  <div class="presentation">
    <h1>Benvenuto nella tua personale dashboard</h1>
    <hr>
    <p>Ciao Boss, da qui puoi gestire il tuo ristorante: puoi creare, modificare o cancellare tutti i tuoi piatti e specialità direttamente dal tuo menù.<br>Inoltre puoi controllare le tue statistiche di vendita degli ultimi 12 mesi e l'elenco completo di tutti i piatti venduti.</p>
  </div>

  <div class="dashboard_menu">
    <a class="img_dashboard" href="{{ route('admin.plates.index')}}" role="button"><img src="{{asset('/images/back_office/menu.png')}}" alt=""><h3>Menu</h3></a>
    <a class="img_dashboard" href="{{ route('admin.orders')}}" role="button"><img src="{{asset('/images/back_office/analytics.png')}}" alt=""><h3>Statistiche</h3></a>
    <a class="img_dashboard" href="{{ route('admin.sold')}}" role="button"><img src="{{asset('/images/back_office/invoice.png')}}" alt=""><h3>Ordini ricevuti</h3></a>
  </div>

  

@endsection
