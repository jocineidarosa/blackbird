@extends('app.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header-template">
            <div>
                ESTOQUES PRINCIPAIS
            </div>
            <div>
                <a class="btn btn-primary btn-sm mr-2" href="{{ route('produto.index') }}"></i>PRODUTOS
                </a>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            @foreach ($recursos as $recurso)
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-primary text-uppercase ">
                                        {{ $recurso->nome_prod}}
                                    </div>
                                    <hr>
                                    <div class="mb-2 font-weight-bold  text-success">
                                        ESTOQUE: {{ str_replace(',', '.', number_format($recurso->estoque_atual, 0)) }}
                                    </div>
                                    <div class="mb-2 font-weight-bold  text-success">
                                        PARA USO: {{$recurso->estoque_util}}
                                    </div>
                                    <div class="mb-2 font-weight-bold  text-success">
                                        AUTONOMIA: {{str_replace(',','.',number_format($recurso->autonomia, 0))}}
                                    </div>
                                    <div class="mb-3 ">
                                        ESTQ MÁX: {{str_replace(',','.',number_format($recurso->estoque_maximo,0))}}
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
                                <div class="col-auto">
                                    <i class="icofont-navigation-menu"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
