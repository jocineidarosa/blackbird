@extends('app.layouts.app')
@section('titulo', 'Produtos')

@section('content')
    <div class="card">
        {{-- 
        <div class="card-header-template">// essa mensagem aparece caso não seja possivel deletar o registro por dependecia
            <div>{{ $message ?? '' }}</div>
        </div> --}}
        <div class="card-header-template">
            <div>LISTAGEM DE OPERAÇOES DE EQUIPAMENTOS</div>
            <div>
                <a href="{{ route('recursos-producao.create') }}" class="btn btn-sm btn-primary">
                    NOVO
                </a>
            </div>

        </div>
        <div class="card-body">
            <table class="table-template table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="th-title">Id</th>
                        <th scope="col" class="th-title">Equipamento</th>
                        <th scope="col" class="th-title">Produto</th>
                        <th scope="col" class="th-title">QTDE.</th>
                        <th scope="col" class="th-title">Horímetro Final</th>
                        <th scope="col" class="th-title">Data</th>
                        <th scope="col" class="th-title">Hor.Ini.</th>
                        <th scope="col" class="th-title">Hor.Fim</th>
                        <th scope="col" class="th-title">Operações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($operacoes as $operacao)
                        <tr>
                            <th scope="row">{{ $operacao->id }}</td>
                            <td>{{ $operacao->equipamento->nome }}</td>
                            <td>{{ $operacao->produto->nome }}</td>
                            <td>{{ $operacao->quantidade }}</td>
                                        <td>{{ $operacao->horimetro_final }}</td>
                            <td>{{ Carbon\Carbon::parse($operacao->data)->format('d/m/Y') }}</td>
                            <td>{{ $operacao->hora_inicio }}</td>
                            <td>{{ $operacao->hora_fim }}</td>
                            <td>
                                <div class="div-op">
                                    <a class="btn btn-sm-template btn-primary mx-1"
                                        href="{{ route('recursos-producao.show', ['operacao' => $operacao->id]) }}"><i
                                            class="icofont-eye-alt"></i></a>
                                    <a class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan"
                                        href="{{ route('recursos-producao.edit', ['operacao' => $operacao->id]) }}"><i
                                            class="icofont-pen-alt-1"></i></a>
                                    <form id="form_{{ $operacao->id }}" method="post"
                                        action="{{ route('recursos-producao.destroy', ['operacao' => $operacao->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-sm-template btn-danger mx-1 @can('user') disabled @endcan"
                                            href="#"
                                            onclick="document.getElementById('form_{{ $operacao->id }}').submit()"><i
                                                class="icofont-close-squared-alt"></i></a>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- paginação --}}
            <div class="d-flex justify-content-center">
                {{ $operacoes->appends($request)->links() }}
            </div>
            {{-- paginação --}}

        </div>


    </div>

@endsection
