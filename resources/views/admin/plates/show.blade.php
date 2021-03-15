@extends('layouts.dashboard')


@section('content')

@can ('access-plate', $plate)

  <h2>Info plate</h2>

  <img src="{{ asset('storage/' . $plate->picture) }}" style="width: 20rem; height: 15rem" alt="">
  <ul class="list-group mt-3">
    <li class="list-group-item">{{$plate->name}}</li>
    <li class="list-group-item">Eur {{$plate->price}}</li>
    <li class="list-group-item">{{$plate->description_ingredients}}</li>
    @if ($plate->visibility == 1)
    <li class="list-group-item">Available</li>
    @else
    <li class="list-group-item">Not available</li>      
    @endif
  </ul>
@endcan

@cannot ('access-plate', $plate)
  <img src="" alt="">
  <a href="{{route('admin.index')}}">Go back to your restaurant</a>
@endcannot



@endsection
