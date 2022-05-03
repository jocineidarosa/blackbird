@extends('app.layouts.app')
@section('titulo', 'Produtos')

@section('content')
    <main class="content">
        <div class="card">

            <div class="card-header-template">
                <div>{{$message ?? ''}}</div>
         
            </div>
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
                            <th scope="col" class="th-title">Visualizar</th>
                            <th scope="col" class="th-title">Editar</th>
                            <th scope="col" class="th-title">Excluir</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($operacoes as $operacao)
                            <tr>
                                <th scope="row">{{ $operacao->id }}</td>
                                <td>{{$operacao->equipamento->nome}}</td>
                                <td>{{$operacao->produto->nome}}</td>
                                <td>{{$operacao->quantidade}}</td>
                                <td>{{$operacao->horimetro_final}}</td>
                                <td>{{$operacao->data_inicio}}</td>
                                <td>{{$operacao->hora_inicio}}</td>
                                <td>{{$operacao->hora_fim}}</td>
                                <td><a class="btn btn-sm-template btn-primary" href="{{ route('recursos-producao.show', ['operacao' => $operacao->id]) }}">Visualizar</a></td>
                                <td><a class="btn btn-sm-template btn-primary" href="{{ route('recursos-producao.edit', ['operacao' => $operacao->id]) }}">Editar</a></td>
                                <td>
                                    <form id="form_{{ $operacao->id }}" method="post"
                                        action="{{ route('recursos-producao.destroy', ['operacao' => $operacao->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-sm-template btn-danger" href="#"
                                            onclick="document.getElementById('form_{{ $operacao->id }}').submit()">Excluir</a>
                                    </form>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>


        </div>


    </main>
@endsection
