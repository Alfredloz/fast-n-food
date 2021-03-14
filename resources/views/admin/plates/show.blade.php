@extends('layouts.dashboard')


@section('content')

@can ('show-plate', $plate)

  <h1>Piatto singolo bello con tutte le informazione</h1>

  <h2>{{$plate->name}}</h2>
  <h3>{{$plate->price}}</h3>

@endcan

<h2>questo testo qua lo vedi in ogni caso</h2>

@endsection
