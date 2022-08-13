@extends('app.layouts.app')

@section('content')
    <main class="content">
        <div class="card">
            <div class="card-header-template">
                <div>
                    LISTAGEM DE ORDEM DE PRODUÇÃO
                </div>
                <div>
                    <a class="btn btn-primary btn-sm" href="{{ route('ordem-producao.create') }}">NOVO</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table-template table-striped table-hover table-bordered mt-1">
                    <thead>
                        <tr>
                            <th scope="col" class="th-title">Id</th>
                            <th scope="col" class="th-title">equipamento</th>
                            <th scope="col" class="th-title">Produto</th>
                            <th scope="col" class="th-title">Quantidade de Produção</th>
                            <th scope="col" class="th-title">Data</th>
                            <th scope="col" class="th-title">Horímetro Final</th>
                            <th scope="col" class="th-title">Operações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($ordens_producoes as $ordem_producao)
                            <tr>
                                <th scope="row">{{ $ordem_producao->id }}</td>
                                <td>{{ $ordem_producao->equipamento->nome }}</td>
                                <td>{{ $ordem_producao->produto->nome }}</td>
                                <td>{{ $ordem_producao->quantidade_producao }}</td>
                                <td>{{ Carbon\Carbon::parse($ordem_producao->data)->format('d/m/Y') }}</td>
                                <td>{{ $ordem_producao->horimetro_final }}</td>
                                <td>
                                    <div class="div-op">
                                        <a class="btn btn-sm-template btn-primary mx-1"
                                            href="{{ route('ordem-producao.show', ['ordem_producao' => $ordem_producao->id]) }}"><i
                                                class="icofont-eye-alt"></i></a>
                                        <a class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan"
                                            href="@can('admin'){{ route('ordem-producao.edit', ['ordem_producao' => $ordem_producao->id]) }}@endcan">
                                            <i class="icofont-pen-alt-1"></i></a>
                                        <form id="form_{{ $ordem_producao->id }}" method="post"
                                            action="@can('admin'){{ route('ordem-producao.destroy', ['ordem_producao' => $ordem_producao->id]) }}@endcan">
                                            @method('DELETE')
                                            @csrf
                                            <a class="btn btn-sm-template btn-danger mx-1 @can('user') disabled @endcan" href="#"
                                                onclick="document.getElementById('form_{{ $ordem_producao->id }}').submit()">
                                                <i class="icofont-close-squared-alt"></i></a>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{$ordens_producoes->appends($request)->links()}} 
                 </div>


            </div>


        </div>


    </main>
@endsection
