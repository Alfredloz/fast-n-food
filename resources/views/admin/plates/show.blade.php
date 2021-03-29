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
      <span><i class="fas fa-tags"></i> {{$plate->price}} €</span>
      <p><i class="fas fa-align-left"></i> {{$plate->description_ingredients}}</p>
      @if ($plate->visibility == 1)
      <span><i class="fas fa-check-circle"></i> Available</span>
      @else
      <span><i class="fas fa-times-circle"></i> Not available</span>
      @endif
    </div>
  </div>
@endcan

@cannot ('access-plate', $plate)
@include('layouts.partials.attention')
@endcannot
@endsection
