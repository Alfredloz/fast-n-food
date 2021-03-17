@extends('layouts.app')


@section('content')

<div id="app">
    <restaurant-component restaurant ="{{ $restaurant }}" plates = "{{ $plates }}"></restaurant-component>
</div>

@endsection
