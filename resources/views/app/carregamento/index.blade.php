@extends('app.layouts.app')
@section('titulo', 'Produtos')

@section('content')
        <div class="card">
            <div class="card-header-template">
                <div>LISTAGEM DE CARREGAMENTO DE CARGAS</div>
                <div>
                    <a href="{{ route('carregamento.create') }}" class="btn btn-sm btn-primary">
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
                            <th scope="col" class="th-title">Hora Saída</th>
                            <th scope="col" class="th-title">Observação</th>
                            <th scope="col" class="th-title">Operaçoes</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($carregamentos as $carregamento)
                            <tr>
                                <th scope="row">{{ $carregamento->id }}</td>
                                <td>{{ $carregamento->veiculo->placa }}</td>
                                <td>{{ $carregamento->hora_saida }}</td>
                                <td>{{ $carregamento->observacao }}</td>
                                <td>
                                    <div class="div-op">
                                        <a class="btn btn-sm-template btn-primary mx-1"
                                            href="{{ route('carregamento.show', ['carregamento' => $carregamento->id]) }}"><i
                                                class="icofont-eye-alt"></i>
                                        </a>
                                        <a
                                            class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan 
                                            "href="{{ route('carregamento.edit', ['carregamento' => $carregamento->id]) }}">
                                            <i class="icofont-pen-alt-1"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-danger mx-1" href="#" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-id="{{ $carregamento->id }}"
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
                    {{ route('carregamento.destroy') }}
                @endcomponent
                <div class="d-flex justify-content-center">
                    {{ $carregamentos->appends($request)->links() }}
                </div>

            </div>


        </div>

@endsection
