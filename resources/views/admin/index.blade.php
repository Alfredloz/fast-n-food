@extends('layouts.dashboard')

@section('content')
  <h1>DASHBOARD</h1>
  <h2>My resturant</h2>

  <a class="btn btn-primary my-3" href="{{ route('admin.plates.index')}}" role="button">Menu</a>

  <div class="mt-5">
    <h2>My statistics</h2>
    <p>General trend of the restaurant</p>
  </div>

@endsection
