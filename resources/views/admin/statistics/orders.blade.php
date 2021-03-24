@extends('layouts.dashboard')

@section('content')

<h1>Statistica degli ordini singoli singoli in cui si vedono i dettagli dei singoli ordini</h1>
<div class="card">
    <div class="card-body">
      <canvas id="myChart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

<script type="application/javascript">
// import Chart from 'chart.js';

const orders_info = {!! $orders !!};

console.log(orders_info);

const yearTtlAmount = [];

//let startingDate = moment().subtract(11, 'month');
//console.log(startingDate.format('YYYY MM DD'));

for (let i = 11; i >= 0; i--) {
  
  var monthTtlAmount = 0;
  var checkMonth = moment().subtract(i, 'month');
  var firstDay = checkMonth.startOf('month').format('YYYY MM DD');
  var lastDay = checkMonth.endOf('month').format('YYYY MM DD');

  console.log(firstDay, lastDay);

  orders_info.forEach(order => {
    let month = moment(order.created_at).isBetween(firstDay, lastDay); 

      if (month == true) {
        monthTtlAmount += order.total_price; 
      } 
    });
    yearTtlAmount.push(monthTtlAmount);
};

console.log(yearTtlAmount);
console.log(monthTtlAmount);

var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'My Orders',
                backgroundColor: ['red','orange', 'green', 'yellow', 'blue', 'purlple', 'pink', 'white', 'lightgrey', 'grey', 'brown', 'black'],
                borderColor: 'black',
                borderWidth: 1,

                data: [
                  yearTtlAmount[0],
                  yearTtlAmount[1],
                  yearTtlAmount[2],
                  yearTtlAmount[3],
                  yearTtlAmount[4],
                  yearTtlAmount[5],
                  yearTtlAmount[6],
                  yearTtlAmount[7],
                  yearTtlAmount[8],
                  yearTtlAmount[9],
                  yearTtlAmount[10],
                  yearTtlAmount[11]
                ]
            }]
        },

        // Configuration options go here
        options: {}
    });

</script>

@endsection
