@extends('layouts.app')


@section('content')

<div id="app">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <restaurant-component restaurant ="{{ $restaurant }}" plates = "{{ $plates }}"></restaurant-component>
                
            </div>
            <div class="col-md-4">
                <cart-component restaurant ="{{ $restaurant }}"></cart-component>
            </div>
        </div>
    </div>
</div>

@endsection
