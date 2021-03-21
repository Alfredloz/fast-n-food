@extends('layouts.dashboard')


@section('content')
<div class="login-container">
    <h1>Create your Dish</h1>
    @include('layouts.partials.errors')

    <form action="{{route('admin.plates.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        {{-- Input text name --}}
        <div class="input-container">
            <!-- <label for="name">Name</label> -->
            <i class="fas fa-pizza-slice"></i><input placeholder="Name" class="form-control" type="text" name="name" id="name" value="{{ old('name')}}">
        </div>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @error('slug')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <hr>

        {{-- Input number price --}}
        <div class="input-container">
            <!-- <label for="price">Price</label> -->
            <i class="fas fa-tags"></i><input placeholder="Price" class="form-control" type="number" name="price" id="price" step="0.01" min="0" max="9999.99" value="{{ old('price')}}">
        </div>
        @error('price')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <hr>

        {{-- Input textarea description --}}
        <div class="input-container">
            <!-- <label for="description_ingredients">Description</label> -->
            <textarea placeholder="Description" class="form-control" type="text" rows="3" name="description_ingredients" id="description_ingredients">{{old('description_ingredients')}}</textarea>
        </div>
        @error('description_ingredients')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <hr>

        {{-- Input file picture --}}
        <div class="input-container">
            <i class="fas fa-sign-in-alt"></i><label for="picture" class="col-md-4 col-form-label text-md-right">Add image</label>
            <input type="file" class="form-control-file" name="picture" id="picture" value="{{ old('picture')}}">
        </div>
        <hr>

        {{-- Input radio visibility --}}
        <div class="form-check my-4">
            <input type="radio" class="form-check-input" name="visibility" value="1" checked>
            <label for="visibility" class="form-check-label">Available</label>
            <br>
            <input type="radio" class="form-check-input" name="visibility" value="0">
            <label for="visibility" class="form-check-label">Not Available</label>
        </div>
        @error('visibility')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <hr>

        {{-- Submit button --}}
        <div class="login-container">
            <button type="submit" class="login-button" name="submit">Submit</button>
        </div>
    </form>

</div>
@endsection
