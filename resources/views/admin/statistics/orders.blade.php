@extends('layouts.dashboard')

@section('content')

<div class="statistic">
  <h1>Statistica degli ordini e guadagni</h1>
  <div class="chartjs">
    <canvas id="myChart"></canvas>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

<script type="application/javascript">
//import Chart from 'chart.js';


// Dati ordini provenienti dal db
const orders_info = {!! $orders !!};

//console.log(orders_info);

//Array dei ricavi totali per ognuno dei 12 mese
const yearTtlAmount = [];

//Array delle etichette degli ultimi 11 mesi 
const labels = [];

//Array contente il numero di ordini di ciascun mese
const orderCounters = [];

//Ciclo per i calcoli degli ordini dal mese attuale fino agli 11 mesi precedenti 
for (let i = 11; i >= 0; i--) {
  
  var monthTtlAmount = 0;
  var orderCounter = 0;
  var checkMonth = moment().subtract(i, 'month'); // Sottrazione di [i] mesi dalla data corrente 
  var firstDay = checkMonth.startOf('month').format('YYYY MM DD'); 
  var lastDay = checkMonth.endOf('month').format('YYYY MM DD');
  labels.push(checkMonth.format('MMMM YY'));

  //Ciclo dei dati provenienti dal db
  orders_info.forEach(order => {
    let month = moment(order.created_at).isBetween(firstDay, lastDay); 

      //Se l'ordine appartiene al mese considerato in questo ciclo:
      if (month == true) {
        monthTtlAmount += order.total_price;
        orderCounter++; 
      } 
    });
    yearTtlAmount.push(monthTtlAmount);
    orderCounters.push(orderCounter);
};
//console.log(yearTtlAmount);
//console.log(monthTtlAmount);

//Struttura Chart,Js --> Prendo il contesto del tag canvas
var ctx = document.getElementById('myChart').getContext('2d');
  
  //Global Options
  Chart.defaults.global.defaultFontSize = 18;
  Chart.defaults.global.defaultFontStyle = 'bold';
  Chart.defaults.global.defaultFontColor = '#435070';
    var chart = new Chart(ctx, {

        // The type of chart we want to create
        type: 'line',
        responsive: true,
        // The data for our dataset
        data: {
            labels: labels,
            datasets: [
              {
                label: 'Totale incasso (€)',
                backgroundColor: 'rgba(255, 155, 41, 0.5)',
                borderColor: 'rgb(250, 100, 0)', 
                borderWidth: 2,
                hoverBorderWidth: 4, 
                hoverBorderColor: 'rgb(67, 80, 112)', 
                data: yearTtlAmount
            },
            {
                label: 'Numeri ordini',
                backgroundColor: 'rgba(192, 33, 62, 0.5)', 
                borderColor: 'rgb(192, 33, 62)', 
                borderWidth: 2,
                type: 'line',
                data: orderCounters
            }
          ]
        },

        options: {
          responsive: true,
          maintainAspectRatio: false,
          title: {
            display: true,
            text: 'Ordini ricevuti e guadagni',
            fontSize: 20
          },
          legend: {
            position: 'top',
          },
          // layout: {
          //   padding: {
          //       left: 100,
          //       right: 100,
          //       top: 20,
          //       bottom: 70
          //   }
          // }  
        }
    });

</script>

@endsection
