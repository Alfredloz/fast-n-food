@extends('layouts.dashboard')

@section('content')

<h1>Statistica degli ordini singoli singoli in cui si vedono i dettagli dei singoli ordini</h1>
<div class="card">
    <div class="card-body">
      <canvas id="myChart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script type="application/javascript">
    
    // import Chart from 'chart.js';

    const orders_info = {!! $orders !!};
    console.log(orders_info[1].id); 
    var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'My Orders',
                    backgroundColor: ['red','orange', 'green', 'yellow', 'blue', 'purlple', 'pink', 'white', 'lightgrey', 'grey', 'brown', 'black'],
                    borderColor: 'black',
                    borderWidth: 1,

                    data: [2, 10, 5, 6, 20, 15, 18, 23, 13, 14, 9, 8]
                }]
            },

            // Configuration options go here
            options: {}
        });

</script>

@endsection
