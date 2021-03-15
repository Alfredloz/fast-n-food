@extends('layouts.dashboard')


@section('content')

@can ('show-plate', $plate)

  <h1>Piatto singolo bello con tutte le informazione</h1>

  <h2>{{$plate->name}}</h2>
  <h3>{{$plate->price}}</h3>

@endcan

@cannot ('show-plate', $plate)

  <h3>FAI CACARE; NON guardare i piatti degli altri</h3>

  <a href="{{route('admin.index')}}">Torna al tuo ristorante e non rompere i coglioni, AGHERE</a>

@endcannot



@endsection
