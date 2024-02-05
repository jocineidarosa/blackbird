@extends('app.layouts.app')

@section('content')
    <!-------------------------------------------------------------------------->
    <div class="card">
        <div class="card-header-template">
            <div><i class="icofont-list mr-2"></i>LISTAGEM DE MANUTENÇÃO</div>
            <form id="formSearchingProducts" action="{{ route('manutencao.index') }}" method="get">
                <!--input box filtro buscar manutencao--------->
                <input type="text" id="query" name="descricao" placeholder="Buscar manutencao..."
                    aria-label="Search through site content">
                <button type="submit" class="button-search">
                    <i class="icofont-search"></i>
                </button>
            </form>
            <div>
                <a @can('admin')href="{{ route('manutencao.create') }}"
                @elsecan('user')data-bs-toggle="modal" data-bs-target="#modal_msg" @endcan
                    class="btn btn-sm btn-primary">
                    <i class="icofont-plus-circle mr-1"></i>NOVO
                </a>
                <a href="{{ route('manutencao.index') }}" class="btn btn-sm btn-primary">
                    <i class="icofont-page"></i>TODOS
                </a>
            </div>

        </div>
        <div class="card-body">
            <table class="table-template table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="th-title">Id</th>
                        <th scope="col" class="th-title">Data</th>
                        <th scope="col" class="th-title">Hora</th>
                        <th scope="col" class="th-title">Descricao</th>
                        <th scope="col" class="th-title">Equipamento</th>
                        <th scope="col" class="th-title">OPERAÇÕES</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($manutencoes as $manutencao)
                        <tr>
                            <th scope="row">{{ $manutencao->id }}</td>
                            <td>{{ $manutencao->data_inicio }}</td>
                            <td>{{ $manutencao->hora_inicio }}</td>
                            <td>{{ $manutencao->descricao }}</td>
                            <td>{{ $manutencao->equipamento->nome}}</td>
                            <td>
                                <div {{-- class="div-op" --}} class="btn-group btn-group-actions visible-on-hover">
                                    <a class="btn btn-sm-template btn-outline-primary"
                                        href="{{ route('manutencao.show', ['manutencao' => $manutencao->id]) }}"><i
                                            class="icofont-eye-alt"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-success "
                                        @can('admin') href="{{ route('manutencao.edit', ['manutencao' => $manutencao->id]) }}"
                                        @elsecan('user') data-bs-toggle="modal" data-bs-target="#modal_msg" @endcan>
                                        <i class="icofont-ui-edit"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-success"
                                        @can('admin') href="{{ route('manutencao.create', ['manutencao_selected' => $manutencao->id]) }}"
                                       @elsecan('user') data-bs-toggle="modal" data-bs-target="#modal_msg" @endcan>
                                        <i class="icofont-plus-square"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-danger" href="#" data-bs-toggle="modal"
                                        @can('admin')data-bs-target="#deleteModal"
                                        @elsecan('user') data-bs-target="#modal_msg" @endcan
                                        data-id="{{ $manutencao->id }}">
                                        <i class="icofont-ui-delete"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            @component('app.shared.modal_delete')
                {{ route('manutencao.destroy') }}
            @endcomponent
            @component('app.shared.modal_msg_no_permission')
            @endcomponent
            <div class="d-flex justify-content-center">
                {{ $manutencoes->appends($request)->links() }}
            </div>

        </div>


    </div>

@endsection
