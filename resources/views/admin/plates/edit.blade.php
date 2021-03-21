@extends('layouts.dashboard')


@section('content')

@include('layouts.partials.errors')
<div class="login-container">
    <h1>Edit your Dish</h1>
    @can ('access-plate', $plate)
    
    <form action="{{route('admin.plates.update', ['plate' => $plate->slug]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        {{-- Input text name --}}
        <div class="input-container">
            <!-- <label for="name">Name</label> -->
            <i class="fas fa-pizza-slice"></i><input placeholder="Name" class="form-control" type="text" name="name" id="name" value="{{ old('name') ? old('name') : $plate->name }}">
        </div>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <hr>

        {{-- Input number price --}}
        <div class="input-container">
            <!-- <label for="price">Price</label> -->
            <i class="fas fa-tags"></i><input placeholder="Price" class="form-control" type="number" name="price" id="price" step="0.01" min="0" max="9999,99" value="{{ old('price') ? old('price') : $plate->price }}">
        </div>
        @error('price')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <hr>
    
        {{-- Input text description --}}
        <div class="input-container">
            <!-- <label for="description_ingredients">Description</label> -->
            <textarea class="form-control" type="text" rows="3" name="description_ingredients" id="description_ingredients">{{ old('description_ingredients') ? old('description_ingredients') : $plate->description_ingredients }}</textarea>
        </div>
        @error('description_ingredients')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <hr>
    
        {{-- Inout file picture --}}
        <div class="input-container">
            @if ($plate->picture)
            <img src="{{ asset('storage/' . $plate->picture) }}" style="width: 15rem; height: 10rem" alt="">
            @endif
        </div>
        <hr>
    
        <div class="input-container">
            <i class="fas fa-sign-in-alt"></i><label for="picture" class="col-md-4 col-form-label text-md-right">Change Picture</label>
            <input type="file" class="form-control-file" name="picture" id="picture">
        </div>
        @error('picture')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <hr>

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
        <hr>
    
        {{-- Submit button --}}
        <div class="login-container">
            <button type="submit" class="login-button" name="submit">Submit</button>
        </div>
    </form>
    @endcan
    
    @cannot ('access-plate', $plate)
    @include('layouts.partials.attention')
    @endcannot
</div>

@endsection
