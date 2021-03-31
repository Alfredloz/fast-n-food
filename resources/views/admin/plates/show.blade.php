@extends('layouts.dashboard')


@section('content')

@can ('access-plate', $plate)

  <h2>Descrizione del piatto</h2>

  <div class="show">
    <div class="img_show">
      <img src="{{ asset('storage/' . $plate->picture) }}" alt="">
    </div>
    <div class="info_show">
      <h3>{{$plate->name}}</h3>
      <span><i class="fas fa-tags"></i> {{$plate->price}} €</span>
      <p><i class="fas fa-align-left"></i> {{$plate->description_ingredients}}</p>
      @if ($plate->visibility == 1)
      <span><i class="fas fa-check-circle"></i> Disponibile</span>
      @else
      <span><i class="fas fa-times-circle"></i> Non disponibile</span>
      @endif
      <a class="btn btn_add" style="width: 200px; margin-top: 20px;" href="{{route("admin.plates.index")}}">Torna al menù</a>
    </div>
  </div>
@endcan

@cannot ('access-plate', $plate)
@include('layouts.partials.attention')
@endcannot
@endsection
