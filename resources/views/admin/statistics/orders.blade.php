@extends('layouts.dashboard')


@section('content')

<h1>Statistica degli ordini singoli singoli in cui si vedono i dettagli dei singoli ordini</h1>
<div class="card">
  <div class="card-body">
    <canvas id="myChart"></canvas>
  </div>
</div>

<script type="application/javascript">

var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'My First dataset',
            backgroundColor: 'red',
            borderColor: 'blue',
            data: [0, 10, 5, 2, 20, 30, 45]
        }]
    },

    // Configuration options go here
    options: {}
});

</script>

@endsection
