@extends('layouts.dashboard')


@section('content')

<h1>lista dei piatti tanto carina su cui fare le cosacce sporche e zozze</h1>

<a class="btn btn-primary" href="{{ route('admin.plates.create') }}" role="button">Aggiungi un pitto</a>



@foreach ($plates as $plate)

<a href="{{route('admin.plates.show', $plate)}}">
  <p>{{$plate->name}}</p>
</a>

<a class="btn btn-primary" href="{{ route('admin.plates.show', ['plate'=> $plate->id]) }}" role="button">Mostra un pitto</a>

<a class="btn btn-secondary" href="{{ route('admin.plates.edit', ['plate'=> $plate->id]) }}" role="button">Modifica un pitto</a>

<form action="{{route('admin.plates.destroy', ['plate'=> $plate->id] )}}" method="post">
  @csrf
  @method('DELETE')
  <button type="submit" class="btn btn-danger">Delete</button>
</form>
@endforeach

@endsection
