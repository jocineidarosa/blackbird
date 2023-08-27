@extends('app.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header-template">
            <div>
                <i class="icofont-list mr-2"></i>LISTAGEM DE ORDEM DE PRODUÇÃO
            </div>
            <form id="formSearchingProducts" action="{{route('abastecimento.index')}}" method="get">
                <!--input box filtro buscar produto--------->
                <input type="text" id="query" name="filtro_equipamento" placeholder="Buscar Equipamento..." aria-label="Search through site content">
                <button type="submit" class="button-search">
                    <i class="icofont-search"></i>
                </button>
            </form>
        </div>

        <div class="card-header-template">
            <div>
                <a @can('admin') href="{{ route('ordem-producao.create') }}"
                @elsecan('user')data-bs-toggle="modal" data-bs-target="#modal_msg"  @endcan 
                class="btn btn-sm btn-primary mb-1">
                    <i class="icofont-plus-circle pr-2"></i>NOVO
                </a>
                <a href="{{ route('ordem-producao.index') }}" class="btn btn-sm btn-primary mb-1">
                    <i class="icofont-page pr-2"></i>TODOS
                </a>
                <a href="{{ route('ordem-producao.edit-filter') }}" class="btn btn-sm btn-primary mb-1">
                    <i class="icofont-filter"></i>CONSULTA AVANÇADA
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
                            <td>{{ str_replace(',', '.', number_format($ordem_producao->quantidade_producao, 0)) }}</td>
                            <td>{{ $ordem_producao->horimetro_final }}</td>
                            <td>
                                <div {{-- class="div-op" --}} class="btn-group btn-group-actions visible-on-hover">
                                    <a class="btn btn-sm-template btn-outline-primary"
                                        href="{{ route('ordem-producao.show', ['ordem_producao' => $ordem_producao->id]) }}"><i
                                            class="icofont-eye-alt"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-success"
                                        @can('admin')href="{{ route('ordem-producao.edit', ['ordem_producao' => $ordem_producao->id]) }}"
                                            @elsecan('user') data-bs-toggle="modal" data-bs-target="#modal_msg"@endcan>
                                        <i class="icofont-ui-edit"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-danger"
                                        @can('admin')href="#" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            @elsecan('user')data-bs-toggle="modal" data-bs-target="#modal_msg"@endcan
                                        data-id="{{ $ordem_producao->id }}">
                                        <i class="icofont-ui-delete"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    <tr class="th-title">
                        <td colspan="3"></td>
                        <td>Total</td>
                        <td>{{ str_replace(',', '.', number_format($total_producao, 0)) }}</td>
                        <td colspan="2"></td>
                    </tr>
                </tbody>
            </table>
            @component('app.shared.modal_delete')
                {{ route('ordem-producao.destroy') }}
            @endcomponent
            @component('app.shared.modal_msg_no_permission')
            @endcomponent
            <div class="d-flex justify-content-center">
                {{ $ordens_producoes->appends($request)->links() }}
            </div>
        </div>
    </div>
@endsection
