@extends('app.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header-template">
            <div>LISTAGEM DE EQUIPAMENTOS</div>
            <form id="formSearchingProducts" action="{{ route('equipamento.index') }}" method="get">
                <!--input box filtro buscar produto--------->
                <input type="text" id="query" name="filtro_equipamento" placeholder="Nome do Equipamento..."
                    aria-label="Search through site content">
                <button type="submit" class="button-search">
                    <i class="icofont-search"></i>
                </button>
            </form>
            <div>
                <a class="btn btn-sm btn-primary" href="{{ route('equipamento.create') }}" class="btn">
                    NOVO
                </a>
            </div>
        </div>

        <div class="card-body">

            <table class="table-template table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="th-title">ID</th>
                        <th scope="col" class="th-title">Nome</th>
                        <th scope="col" class="th-title">Descrição</th>
                        <th scope="col" class="th-title">Marca</th>
                        <th scope="col" class="th-title">Cód Operação</th>
                        <th scope="col" class="th-title">Ano Fab</th>

                        <th scope="col" class="th-title">Operações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($equipamentos as $equipamento)
                        <tr>
                            <th scope="row">{{ $equipamento->id }}</td>
                            <td>{{ $equipamento->nome }}</td>
                            <td>{{ $equipamento->descricao }}</td>
                            <td>{{ $equipamento->marca->nome }}</td>
                            <td>{{ $equipamento->cod_operacao }}</td>
                            <td>{{ $equipamento->ano_fabricacao }}</td>

                            <td>
                                <div {{-- class="div-op" --}} class="btn-group btn-group-actions visible-on-hover">
                                    <a class="btn btn-sm-template btn-outline-primary"
                                        href="{{ route('equipamento.show', ['equipamento' => $equipamento->id]) }}"><i
                                            class="icofont-eye-alt"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-success "
                                        @can('admin') href="{{ route('equipamento.edit', ['equipamento' => $equipamento->id]) }}"
                                            @elsecan('user') data-bs-toggle="modal" data-bs-target="#modal_msg" @endcan>
                                        <i class="icofont-ui-edit"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-danger" href="#" data-bs-toggle="modal"
                                        @can('admin')data-bs-target="#deleteModal"
                                            @elsecan('user') data-bs-target="#modal_msg" @endcan
                                        data-id="{{ $equipamento->id }}">
                                        <i class="icofont-ui-delete"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @component('app.shared.modal_delete')
                {{ route('equipamento.destroy') }}
            @endcomponent
            <div class="d-flex justify-content-center">
                {{ $equipamentos->appends($request)->links() }}
            </div>
        </div>

    </div>
@endsection
