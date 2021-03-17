@extends('layouts.dashboard')


@section('content')

@include('layouts.partials.errors')
<h2>Add a new plate</h2>
@can ('access-plate', $plate)

<form action="{{route('admin.plates.update', ['plate' => $plate->slug]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Input text name --}}
    <div class="form-group">
        <label for="name">Name</label>
        <input class="form-control" type="text" name="name" id="name" value="{{ old('name') ? old('name') : $plate->name }}">
    </div>
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    {{-- Input text description --}}
    <div class="form-group">
        <label for="description_ingredients">Description</label>
        <textarea class="form-control" type="text" rows="3" name="description_ingredients"
            id="description_ingredients">{{ old('description_ingredients') ? old('description_ingredients') : $plate->description_ingredients }}</textarea>
    </div>
    @error('description_ingredients')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    {{-- Input number price --}}
    <div class="form-group">
        <label for="price">Price</label>
        <input class="form-control" type="number" name="price" id="price" step="0.01" min="0" max="9999,99" value="{{ old('price') ? old('price') : $plate->price }}">
    </div>
    @error('price')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    {{-- Input radio visibility --}}
    <div class="form-check my-4">
        <input type="radio" class="form-check-input" name="visibility" value="1"
            {{ $plate->visibility ? 'checked' : '' }}>
        <label for="visibility" class="form-check-label">Available</label>
        <br>
        <input type="radio" class="form-check-input" name="visibility" value="0"
            {{ $plate->visibility ? '' : 'checked'  }}>
        <label for="visibility" class="form-check-label">Not Available</label>
    </div>
    @error('visibility')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    {{-- Inout file picture --}}
    @if ($plate->picture)
    <img src="{{ asset('storage/' . $plate->picture) }}" style="width: 15rem; height: 10rem" alt="">
    @endif

    <div class="form-group">
        <label for="picture">Picture</label>
        <input type="file" class="form-control-file" name="picture" id="picture">
    </div>
    @error('picture')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    {{-- Submit button --}}
    <button type="submit" class="btn btn-success" name="submit">Submit</button>
</form>
@endcan

@cannot ('access-plate', $plate)
@include('layouts.partials.attention')
@endcannot

@endsection
