@extends('app.layouts.app')
@section('content')
<div class="card">
    <div class="card-header-template">
        <div>
            ESTOQUES PRINCIPAIS
        </div>
        <div>
            <a class="btn btn-primary btn-sm mr-2" href="{{ route('ordem-producao.create') }}"></i>PRODUTOS
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        @foreach ($estoque_produtos as $estoque)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 font-weight-bold text-primary text-uppercase mb-1">
                                    {{ $estoque->nome }}</div>
                                <div class="h5 mb-2 font-weight-bold  text-success">
                                    ESTOQUE: {{str_replace(',','.',number_format($estoque->estoque_atual, 0))}}
                                </div>
                                <div class="h5 mb-3 ">
                                    MÁX: {{$estoque->estoque_maximo}}
                                </div>

                                <div class="col">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        {{ $estoque->percent_estoque }}%</div>
                                    <div class="progress progress-sm mr-2">

                                        <div class="progress-bar {{ $estoque->percent_estoque > 30 ? 'bg-primary' : 'bg-danger' }} 
                                            {{ $estoque->percent_estoque > 60 ? 'bg-success' : '' }}"
                                            role="progressbar" style="width: {{ $estoque->percent_estoque }}%"
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
