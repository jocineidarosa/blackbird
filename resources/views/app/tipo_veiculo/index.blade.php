@extends('app.layouts.app')
@section('titulo', 'Produtos')

@section('content')
        <div class="card">
            <div class="card-header-template">
                <div>LISTAGEM DE TIPOS DE VEÍCULOS</div>
                <div>
                    <a href="{{ route('tipo-veiculo.create') }}" class="btn btn-sm btn-primary">
                        NOVO
                    </a>
                </div>

            </div>
            <div class="card-body">
                <table class="table-template table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="th-title">Id</th>
                            <th scope="col" class="th-title">Tipo de Veículo</th>
                            <th scope="col" class="th-title">Operaçoes</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($tipo_veiculos as $tipo_veiculo)
                            <tr>
                                <th scope="row">{{ $tipo_veiculo->id }}</td>
                                <td>{{ $tipo_veiculo->descricao}}</td>
                  
                                <td>
                                    <div class="div-op">
                                        <a class="btn btn-sm-template btn-primary mx-1"
                                            href="{{ route('tipo-veiculo.show', ['tipo_veiculo' => $tipo_veiculo->id]) }}"><i
                                                class="icofont-eye-alt"></i>
                                        </a>
                                        <a
                                            class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan 
                                            "href="{{ route('tipo-veiculo.edit', ['tipo_veiculo' => $tipo_veiculo->id]) }}">
                                            <i class="icofont-pen-alt-1"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-danger mx-1" href="#" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-id="{{ $tipo_veiculo->id }}"
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
                    {{ route('tipo-veiculo.destroy') }}
                @endcomponent
                <div class="d-flex justify-content-center">
                    {{ $tipo_veiculos->appends($request)->links() }}
                </div>

            </div>


        </div>

@endsection
