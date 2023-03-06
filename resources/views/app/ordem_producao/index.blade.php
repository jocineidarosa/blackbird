@extends('app.layouts.app')

@section('content')
        <div class="card">
            <div class="card-header-template">
                <div>
                    <i class="icofont-list mr-2"></i>LISTAGEM DE ORDEM DE PRODUÇÃO
                </div>
                <div>
                    <a class="btn btn-primary btn-sm mr-2 @can('user') disabled @endcan" href="{{ route('ordem-producao.create') }}">
                        <i class="icofont-plus-circle mr-1"></i>NOVO
                    </a>
                    <a class="btn btn-filter btn-sm" href="{{ route('ordem-producao.edit-filter') }}">
                        <i class="icofont-filter mr-1"></i></i>FILTRAR
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table class="table-template table-striped table-hover table-bordered mt-1">
                    <thead>
                        <tr>
                            <th scope="col" class="th-title">Id</th>
                            <th scope="col" class="th-title">Data</th>
                            <th scope="col" class="th-title">equipamento</th>
                            <th scope="col" class="th-title">Produto</th>
                            <th scope="col" class="th-title">Produção</th>
                            <th scope="col" class="th-title">Horímetro Final</th>
                            <th scope="col" class="th-title">Operações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($ordens_producoes as $ordem_producao)
                            <tr>
                                <th scope="row">{{ $ordem_producao->id }}</td>
                                <td>{{ Carbon\Carbon::parse($ordem_producao->data)->format('d/m/Y') }}</td>
                                <td>{{ $ordem_producao->equipamento->nome }}</td>
                                <td>{{ $ordem_producao->produto->nome }}</td>
                                <td>{{ str_replace(',','.',number_format($ordem_producao->quantidade_producao,0)) }}</td>
                                <td>{{ $ordem_producao->horimetro_final }}</td>
                                <td>
                                    <div {{-- class="div-op" --}} class="btn-group btn-group-actions visible-on-hover">
                                        <a class="btn btn-sm-template btn-outline-primary"
                                            href="{{ route('ordem-producao.show', ['ordem_producao' => $ordem_producao->id]) }}"><i
                                            class="icofont-eye-alt"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-outline-success  @can('user') disabled @endcan"
                                            href="{{ route('ordem-producao.edit', ['ordem_producao' => $ordem_producao->id]) }}">
                                            <i class="icofont-ui-edit"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-outline-danger @can('user') disabled @endcan" 
                                            href="#" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $ordem_producao->id }}">
                                            <i class="icofont-ui-delete"></i>
                                            </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        <tr class="th-title">
                            <td colspan="3"></td>
                            <td>Total</td>
                            <td>{{str_replace(',','.',number_format($total_producao, 0))}}</td>
                            <td colspan="2"></td>
                        </tr>
                    </tbody>
                </table>
                @component('app.shared.modal_delete')
                    {{route('ordem-producao.destroy')}}
                @endcomponent
                <div class="d-flex justify-content-center">
                    {{ $ordens_producoes->appends($request)->links() }}
                </div>
            </div>
        </div>

@endsection
