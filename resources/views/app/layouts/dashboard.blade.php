{{-- @dd($recursos) --}}
@extends('app.layouts.app')
@section('content')
    <div class="card ">
        <div class="card-header-template ">
            <div>
                TESTE DE PRODUÇÃO EM TERMPO REAL - BRESOLA
            </div>
        </div>
        <div style="background-color:rgba(38, 38, 40, 0.883)">
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


    {{--     <script>
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
                        backgroundColor: '#FFFFFF',
                        borderColor: '#2784c7',
                        borderWidth: 2,
                        fill: false, //preenche a parte de baixo
                        tension: 0, //deixa as linhas curvadas
                        pointStyle: false, //bolinhas ou retângulos
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                }
            });
        });


        function fetchData() {
            fetch('/api/get-chart-data')
                .then(response => response.json())
                .then(data => {
                    // Atualiza os dados do gráfico
                    myChart.data.labels = data.labels;
                    myChart.data.datasets[0].data = data.values;
                    myChart.update();
                })
                .catch(error => console.error('Erro ao buscar dados:', error));
        }


        // Atualiza os dados a cada 5 segundos
        setInterval(fetchData, 5000);

        // Chama a função para buscar os dados imediatamente ao carregar a página
        fetchData();
    </script> --}}


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
                        backgroundColor: 'rgba(0, 0, 0, 0.5',
                        borderColor: '#66f5f3',
                        borderWidth: 2,
                        fill: false,
                        tension: 0,
                        pointStyle: false,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#ffffff' // Cor das letras do eixo y
                            }
                        },

                        x: {
                            ticks: {
                                color: '#ffffff' // Cor das letras do eixo x
                            }
                        },
            
                    },
                    animations: {
                        duration: 1
                    },


                }
            });

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
