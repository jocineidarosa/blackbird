@extends('app.layouts.app')
@section('titulo', 'Produtos')

@section('content')
        <div class="card">
            <div class="card-header-template">
                <div>LISTAGEM DE VEÍCULOS</div>
                <div>
                    <a href="{{ route('veiculo.create') }}" class="btn btn-sm btn-primary">
                        NOVO
                    </a>
                </div>

            </div>
            <div class="card-body">
                <table class="table-template table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="th-title">Id</th>
                            <th scope="col" class="th-title">Placa</th>
                            <th scope="col" class="th-title">Tipo Veículo</th>
                            <th scope="col" class="th-title">Funcionario</th>
                            <th scope="col" class="th-title">Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($veiculos as $veiculo)
                            <tr>
                                <th scope="row">{{ $veiculo->id }}</td>
                                <td>{{ $veiculo->placa }}</td>
                                <td>{{ $veiculo->tipo_veiculo->descricao}}</td>
                                <td>{{ $veiculo->funcionario->nome }}</td>
                                <td>{{ $veiculo->observacao }}</td>
                                <td>
                                    <div class="div-op">
                                        <a class="btn btn-sm-template btn-primary mx-1"
                                            href="{{ route('carregamento.show', ['carregamento' => $veiculo->id]) }}"><i
                                                class="icofont-eye-alt"></i>
                                        </a>
                                        <a
                                            class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan 
                                            "href="{{ route('carregamento.edit', ['carregamento' => $veiculo->id]) }}">
                                            <i class="icofont-pen-alt-1"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-danger mx-1" href="#" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-id="{{ $veiculo->id }}"
                                            @can('user') disabled @endcan>
                                            <i class="icofont-close-squared-alt"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @component('app.shared.modal_delete')
                    {{ route('ordem-producao.destroy', ['ordem_producao' => '1']) }}
                @endcomponent
                <div class="d-flex justify-content-center">
                   {{--  {{ $veiculos->appends($request)->links() }} --}}
                </div>

            </div>


        </div>

@endsection
