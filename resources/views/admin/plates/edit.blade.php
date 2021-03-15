@extends('layouts.dashboard')


@section('content')

@can ('access-plate', $plate)

<form action="{{route('admin.plates.update', ['plate' => $plate->id]) }}" method="post" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  {{-- Input text name --}}
  <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" type="text" name="name" id="name" value="{{ $plate->name }}">
  </div>
  @error('name')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror

  {{-- Input text description --}}
  <div class="form-group">
      <label for="description_ingredients">Description</label>
      <input class="form-control" type="text" name="description_ingredients"
          id="description_ingredients" value="{{ $plate->description_ingredients }}">
  </div>
  @error('description_ingredients')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror

  {{-- Input number price --}}
  <div class="form-group">
      <label for="price">Price</label>
      <input class="form-control" type="number" name="price" id="price" value="{{ $plate->price }}">
  </div>
  @error('price')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror

  {{-- Input radio visibility --}}
  <div class="form-check my-4">
      <input type="radio" class="form-check-input" name="visibility" id="visibility" value="1" {{ $plate->visibility ? 'checked' : '' }}>
      <label for="visibility" class="form-check-label">Avaliable</label>
      <br>
      <input type="radio" class="form-check-input" name="visibility" id="visibility" value="0" {{ $plate->visibility ? 'checked' : ''  }}>
      <label for="visibility" class="form-check-label">Not Avaliable</label>
  </div>
  @error('visibility')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror

  {{-- Inout file picture --}}
  @if ($plate->picture)
      <img src="{{ asset('storage/' . $plate->picture) }}" alt="">
  @endif

  <div class="form-group">
      <label for="picture">Picture</label>
      <input type="file" class="form-control-file" name="picture" id="picture">
      <small id="pictureHelper" class="form-text text-muted">Add a picture image here</small>
  </div>
  @error('picture')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror

  {{-- Submit button --}}
  <button type="submit" class="btn btn-success" name="submit">Submit</button>
</form>
@endcan

@cannot ('access-plate', $plate)

  <h3>FAI CACARE; NON modificare i piatti degli altri</h3>
  <a href="{{route('admin.index')}}">Torna al tuo ristorante e non rompere i coglioni, AGHERE</a>

@endcannot
@endsection
