@extends('layouts.app')

@section('content')
    <h1>Pagamento andato a buon fine</h1>
    <h2>nome: {{$_GET['name']}}</h2>
    <h2>phone: {{$_GET['phone']}}</h2>
    <h2>address: {{$_GET['address']}}</h2>

@endsection