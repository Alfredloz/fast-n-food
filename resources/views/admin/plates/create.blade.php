@extends('layouts.dashboard')


@section('content')
@include('layouts.partials.errors')

<h2>Create your plate</h2>

<form action="{{route('admin.plates.store')}}" method="post" enctype="multipart/form-data">
    @csrf

    {{-- Input text name --}}
    <div class="form-group">
        <label for="name">Name</label>
        <input class="form-control" type="text" name="name" id="name" value="{{ old('name')}}">
    </div>
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @error('slug')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror


    {{-- Input textarea description --}}
    <div class="form-group">
        <label for="description_ingredients">Description</label>
        <textarea class="form-control" type="text" rows="3" name="description_ingredients" id="description_ingredients">{{old('description_ingredients')}}</textarea>
    </div>
    @error('description_ingredients')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    {{-- Input number price --}}
    <div class="form-group">
        <label for="price">Price</label>
        <input class="form-control" type="number" name="price" id="price" step="0.01" min="0" max="9999.99" value="{{ old('price')}}">
    </div>
    @error('price')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    {{-- Input radio visibility --}}
    <div class="form-check my-4">
        <input type="radio" class="form-check-input" name="visibility" id="visibility" value="1" checked>
        <label for="visibility" class="form-check-label">Avaliable</label>
        <br>
        <input type="radio" class="form-check-input" name="visibility" id="visibility" value="0">
        <label for="visibility" class="form-check-label">Not Avaliable</label>
    </div>
    @error('visibility')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    {{-- Input file picture --}}
    <div class="form-group">
        <label for="picture">Add image</label>
        <input type="file" class="form-control-file" name="picture" id="picture" value="{{ old('picture')}}">
    </div>

    {{-- Submit button --}}
    <button type="submit" class="btn btn-success" name="submit">Submit</button>
</form>
@endsection
