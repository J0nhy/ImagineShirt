@can('viewAny', \App\Models\orders::class)
@extends('adminLayout')
@section('main')

<section class="sec-product-detail bg0 background">
    <h2 class="breadcrumbs linkBranco">Olá, {{ Auth::user()->name }}</h2>
</section>
<div class="row">

    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                Vendas por mês
            </div>
            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                Lucro por mês
            </div>
            <div class="card-body"><canvas id="myChart" width="100%" height="40"></canvas></div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                Estampas mais vendidas
            </div>
            <div class="card-body"><canvas id="topSellingImagesChart" width="100%" height="5"></canvas></div>
        </div>
    </div>


</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
var _ydata=JSON.parse('{!! json_encode($months) !!}');
var _xdata=JSON.parse('{!! json_encode($monthCount) !!}');
</script>

<script src="assets/chart-bar-demo.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var totalByMonth = {!! json_encode($totalByMonth) !!};

    var months = totalByMonth.map(item => item.month);
    var totals = totalByMonth.map(item => item.total);

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Total por Mês',
                data: totals,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var labels = {!! json_encode($labels) !!};
        //var labels = {!! $labels->pluck('name') !!};

        var data = {!! json_encode($data) !!};

        var ctx = document.getElementById('topSellingImagesChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#00ffff',
                        '#00ff00',

                        // Adicione mais cores conforme necessário
                    ],
                }],
            },
            options: {
                responsive: true,
            },
        });
    </script>

@endsection
@endcan
