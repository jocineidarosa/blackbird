@extends('app.layouts.app')

@section('content')
    <!-------------------------------------------------------------------------->
    <div class="card">
        <div class="card-header-template">
            <div><i class="icofont-list mr-2"></i>LISTAGEM DE PESAGENS</div>
            <form id="formSearchingProducts" action="{{ route('pesagem.index') }}" method="get">
                <!--input box filtro buscar pesagem--------->
                <input type="text" id="query" name="pesagem" placeholder="Buscar pesagem..."
                    aria-label="Search through site content">
                <button type="submit" class="button-search">
                    <i class="icofont-search"></i>
                </button>
            </form>
            <div>

                <a href="{{ route('pesagem.index') }}" class="btn btn-sm btn-primary">
                    <i class="icofont-page"></i>TODOS
                </a>
            </div>

        </div>
        <div class="card-body">
            <table class="table-template table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="th-title">Data</th>
                        <th scope="col" class="th-title">Placa</th>
                        <th scope="col" class="th-title">Sequencia</th>
                        <th scope="col" class="th-title">Parceiro</th>
                        <th scope="col" class="th-title">Produto</th>
                        <th scope="col" class="th-title">Motorista</th>
                        <th scope="col" class="th-title">Peso Tara</th>
                        <th scope="col" class="th-title">Peso Bruto</th>
                        <th scope="col" class="th-title">Peso Líquido</th>
                        <th scope="col" class="th-title">Tipo</th>
                        <th scope="col" class="th-title">Situação</th>
                        

                    </tr>
                </thead>

                <tbody>
                    @foreach ($pesagens as $pesagem)
                        <tr>
                            <th scope="row">{{ $pesagem->data }}</td>
                            <td>{{ $pesagem->placa }}</td>
                            <td>{{ $pesagem->sequencia }}</td>
                            <td>{{ $pesagem->parceiro->nome }}</td>
                            <td>{{ $pesagem->produto->nome }}</td>
                            <td>{{ $pesagem->motorista->nome }}</td>
                            <td>{{ str_replace(',', '.', number_format($pesagem->peso_tara, 0)) }}</td>
                            <td>{{ str_replace(',', '.', number_format($pesagem->peso_bruto, 0)) }}</td>
                            <td>{{ str_replace(',', '.', number_format($pesagem->peso_liquido, 0)) }}</td>
                            <td>{{ $pesagem->movimentacao }}</td>
                            <td>{{ $pesagem->situacao }}</td>
                            <td>
                                <div {{-- class="div-op" --}} class="btn-group btn-group-actions visible-on-hover">
                                    <a class="btn btn-sm-template btn-outline-primary"
                                        href="{{ route('pesagem.show', ['pesagem' => $pesagem->id]) }}"><i
                                            class="icofont-eye-alt"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-success "
                                        @can('admin') href="{{ route('pesagem.edit', ['pesagem' => $pesagem->id]) }}"
                                        @elsecan('user') data-bs-toggle="modal" data-bs-target="#modal_msg" @endcan>
                                        <i class="icofont-ui-edit"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-danger" href="#" data-bs-toggle="modal"
                                        @can('admin')data-bs-target="#deleteModal"
                                        @elsecan('user') data-bs-target="#modal_msg" @endcan
                                        data-id="{{ $pesagem->id }}">
                                        <i class="icofont-ui-delete"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            @component('app.shared.modal_delete')
                {{ route('produto.destroy') }}
            @endcomponent
            @component('app.shared.modal_msg_no_permission')
            @endcomponent
            <div class="d-flex justify-content-center">
                {{ $pesagens->appends($request)->links() }}
            </div>

        </div>


    </div>

@endsection
