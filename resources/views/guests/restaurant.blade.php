@extends('layouts.app')


@section('content')
<div class="restaurant-banner-container">
    <img class="banner-restaurant" src="{{'/storage/'. $banner }}" alt="Banner ristorante">
</div>
<div id="app">
    <div class="restaurant-container">
        <div class="plates">
            <restaurant-component restaurant ="{{ $restaurant }}" plates = "{{ $plates }}"></restaurant-component>
            
        </div>
        <div class="">
            <cart-component restaurant ="{{ $restaurant }}"></cart-component>
        </div>
    </div>
</div>

@endsection
