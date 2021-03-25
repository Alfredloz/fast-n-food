@extends('layouts.dashboard')


@section('content')

@can ('access-plate', $plate)

  <h2>Info plate</h2>

  <div class="show">
    <div class="img_show">
      <img src="{{ asset('storage/' . $plate->picture) }}" alt="">
    </div>
    <div class="info_show">
      <h3>{{$plate->name}}</h3>
      <span>{{$plate->price}} €</span>
      <p>{{$plate->description_ingredients}}</p>
      @if ($plate->visibility == 1)
      <span>Available</span>
      @else
      <span>Not available</span>      
      @endif
    </div>
  </div>
@endcan

@cannot ('access-plate', $plate)
@include('layouts.partials.attention')
@endcannot
@endsection
