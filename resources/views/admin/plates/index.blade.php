@extends('layouts.dashboard')


@section('content')

  <h1>lista dei piatti tanto carina su cui fare le cosacce sporche e zozze</h1>

   <a name="" id="" class="btn btn-primary" href="{{ route('admin.plates.create') }}" role="button">Aggiungi un pitto</a> 

  @foreach ($plates as $plate)

    <a href="{{route('admin.plates.show', $plate)}}"><p>{{$plate->name}}</p></a>
  @endforeach

@endsection
