@extends('layouts.dashboard')

@section('content')

  <h1>Pagina carina della homepage del ristoratore autenticato</h1>

  <h2>da qui si puo andare a:</h2>



  <h3><a href="{{route('admin.plates.index')}}">lista piatti con il crud piatti </a></h3> 

  <h3>- pagina delle statistiche -</h3>


@endsection
