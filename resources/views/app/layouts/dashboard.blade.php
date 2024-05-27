{{-- @dd($recursos) --}}
@extends('app.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header-template">
            <div>
                PRODUÇÃO DA BRITAGEM
            </div>
        </div>
        <div >
            <canvas id="myChart" width="300" height="100"></canvas>
        </div>

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
                                        ESTOQUE MÁX: {{ str_replace(',', '.', number_format($recurso->estoque_maximo, 0)) }}
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

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('myChart').getContext('2d');
            var chartData = @json($chartData);

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Dados do Mês',
                        data: chartData.data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        fill:true,
                        tension: 0.8,
                        pointStyle:false,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('myChart').getContext('2d');
            var chartData = @json($chartData);

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Produção de Pedrisco',
                        data: chartData.data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        pointStyle:false
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                        custom: function(tooltipModel) {
                            // Tooltip Element
                            var tooltipEl = document.getElementById('chartjs-tooltip');
                            if (!tooltipEl) {
                                tooltipEl = document.createElement('div');
                                tooltipEl.id = 'chartjs-tooltip';
                                tooltipEl.innerHTML = '<table></table>';
                                document.body.appendChild(tooltipEl);
                            }

                            // Hide if no tooltip
                            if (tooltipModel.opacity === 0) {
                                tooltipEl.style.opacity = 0;
                                return;
                            }

                            // Set caret Position
                            tooltipEl.classList.remove('above', 'below', 'no-transform');
                            if (tooltipModel.yAlign) {
                                tooltipEl.classList.add(tooltipModel.yAlign);
                            } else {
                                tooltipEl.classList.add('no-transform');
                            }

                            function getBody(bodyItem) {
                                return bodyItem.lines;
                            }

                            // Set Text
                            if (tooltipModel.body) {
                                var titleLines = tooltipModel.title || [];
                                var bodyLines = tooltipModel.body.map(getBody);

                                var innerHtml = '<thead>';

                                titleLines.forEach(function(title) {
                                    innerHtml += '<tr><th>' + title + '</th></tr>';
                                });
                                innerHtml += '</thead><tbody>';

                                bodyLines.forEach(function(body, i) {
                                    var colors = tooltipModel.labelColors[i];
                                    var style = 'background:' + colors.backgroundColor;
                                    style += '; border-color:' + colors.borderColor;
                                    style += '; border-width: 2px';
                                    var span = '<span style="' + style + '"></span>';
                                    innerHtml += '<tr><td>' + span + body + '</td></tr>';
                                });
                                innerHtml += '</tbody>';

                                var tableRoot = tooltipEl.querySelector('table');
                                tableRoot.innerHTML = innerHtml;
                            }

                            // `this` will be the overall tooltip
                            var position = this._chart.canvas.getBoundingClientRect();

                            // Display, position, and set styles for font
                            tooltipEl.style.opacity = 1;
                            tooltipEl.style.position = 'absolute';
                            tooltipEl.style.left = position.left + window.pageXOffset + tooltipModel.caretX + 'px';
                            tooltipEl.style.top = position.top + window.pageYOffset + tooltipModel.caretY + 'px';
                            tooltipEl.style.fontFamily = tooltipModel._bodyFontFamily;
                            tooltipEl.style.fontSize = tooltipModel.bodyFontSize + 'px';
                            tooltipEl.style.fontStyle = tooltipModel._bodyFontStyle;
                            tooltipEl.style.padding = tooltipModel.yPadding + 'px ' + tooltipModel.xPadding + 'px';
                            tooltipEl.style.pointerEvents = 'none';
                        }
                    },
                    hover: {
                        mode: 'index',
                        intersect: false
                    }
                }
            });
        });
    </script>
@endsection
