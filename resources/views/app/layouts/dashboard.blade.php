{{-- @dd($recursos) --}}
@extends('app.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header-template">
            <div>
                CONTROLE DA BRITAGEM
            </div>
        </div>

        <!-- Content Row -->
        <div class="row m-2">
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-primary shadow ">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 ">
                                <div
                                    class="font-weight-bold text-primary bg-secondary   rounded-3 rounded-top p-1 text-light mb-3">
                                    Horímetro Total
                                </div>
                                <div class="mb-2 font-weight-bold ">
                                    <span class="text-primary ">{{$producao_britagem->horimetro_britagem . ' HORAS'}}</span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-primary shadow ">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 ">
                                <div
                                    class="font-weight-bold  bg-secondary   rounded-3 p-1 text-light mb-3">
                                    Horímetro Parcial
                                </div>
                                <div class="mb-2 font-weight-bold">
                                    <span class="text-primary">{{Carbon\Carbon::parse($producao_britagem->horimetro_parcial_britagem)->format('H:i')}}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-primary shadow ">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 ">
                                <div
                                    class="font-weight-bold  bg-secondary   rounded-3 p-1 text-light mb-3">
                                    Energia Britagem
                                </div>
                                <div class="mb-2 font-weight-bold">
                                    <span class="text-primary">{{$producao_britagem->energia_britagem . ' '}}KW</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-primary shadow ">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 ">
                                <div
                                    class="font-weight-bold  bg-secondary   rounded-3 p-1 text-light mb-3">
                                    Produção pó
                                </div>
                                <div class="mb-2 font-weight-bold">
                                    <span class="text-primary">{{str_replace(',', '.', number_format($producao_britagem->po, 0)). '  KG'}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-primary shadow ">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 ">
                                <div
                                    class="font-weight-bold  bg-secondary   rounded-3 p-1 text-light mb-3">
                                    Produção Pedrisco
                                </div>
                                <div class="mb-2 font-weight-bold ">
                                    <span class="text-primary">{{str_replace(',','.',number_format($producao_britagem->producao_pedrisco, 0))}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-primary shadow ">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 ">
                                <div
                                    class="font-weight-bold  bg-secondary   rounded-3 p-1 text-light mb-3">
                                    Produção Pedra 1
                                </div>
                                <div class="mb-2 font-weight-bold">
                                    <span class="text-primary">{{str_replace(',','.',number_format($producao_britagem->producao_pedra34, 0))}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="card ">
        <div {{-- style="background-color:rgba(244, 244, 244, 0.883)" --}}>
            <canvas id="myChart" width="300" height="100"></canvas>{{-- renderiza chartjs --}}
        </div>





        <div class="card">
            <div class="card-header-template">
                <div>
                    ESTOQUES PRINCIPAIS
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">
                @foreach ($recursos as $recurso)
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2 ">
                                        <div
                                            class="font-weight-bold text-primary text-uppercase bg-primary rounded-3 p-2 text-light mb-3">
                                            <i class="icofont-bucket2"></i>
                                            {{ $recurso->nome_prod }}
                                        </div>
                                        <div class="mb-2 font-weight-bold">
                                            <span class="text-secondary">ESTOQUE BRUTO:</span> <span
                                                class="text-danger">{{ str_replace(',', '.', number_format($recurso->estoque_atual, 0)) }}</span>
                                        </div>
                                        <div class="mb-2 font-weight-bold  text-success">
                                            <span class="text-secondary">ESTOQUE ÚTIL:</span> <span
                                                class="text-danger">{{ str_replace(',', '.', number_format($recurso->estoque_util, 0)) }}</span>
                                        </div>
                                        <div class="mb-2 font-weight-bold">
                                            <span class="text-secondary">AUTONOMIA:</span> <span
                                                class="text-danger">{{ str_replace(',', '.', number_format($recurso->autonomia, 0)) }}</span>
                                            TON
                                        </div>
                                        <div class="mb-3">
                                            ESTOQUE MÁX:
                                            {{ str_replace(',', '.', number_format($recurso->estoque_maximo, 0)) }}
                                        </div>

                                        <div class="col">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                {{ $recurso->percent_estoque }}%</div>
                                            <div class="progress progress-sm mr-2">

                                                <div class="progress-bar {{ $recurso->percent_estoque > 30 ? 'bg-primary' : 'bg-danger' }} 
                                            {{ $recurso->percent_estoque > 60 ? 'bg-success' : '' }}"
                                                    role="progressbar" style="width: {{ $recurso->percent_estoque }}%"
                                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let ctx = document.getElementById('myChart').getContext('2d');
            let chartData = @json($chartData);

            let myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'PÓ DE PEDRA',
                        data: chartData.data,
                        backgroundColor: 'rgba(240, 159, 134, 0.1)',
                        borderColor: '#325aa8',
                        borderWidth: 1,
                        fill: true,
                        tension: 0,
                        pointStyle: false,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                    animations: false
                }
            });
            //aqui está o Ajax
            function fetchData() {
                fetch('/dashboard/get-chart-data')
                    .then(response => response.json())
                    .then(data => {
                        myChart.data.labels = data.labels;
                        myChart.data.datasets[0].data = data.data;
                        myChart.update();
                    })
                    .catch(error => console.error('Erro ao buscar dados:', error));
            }

            fetchData();
            setInterval(fetchData, 3000);
        });
    </script>
@endsection
