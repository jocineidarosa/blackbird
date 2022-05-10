@extends('app.layouts.app')
@section('titulo', 'Produtos')

@section('content')
    <main class="content">
        <div class="card">
            <div class="card-header-template">
                <div>LISTAGEM DE PRODUTOS</div>
                <div>
                    <a href="{{ route('produto.create') }}" class="btn btn-sm btn-primary">
                        NOVO
                    </a>
                </div>

            </div>
            <div class="card-body">
                <table class="table-template table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Un.</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Estoque</th>
                            <th scope="col" class="th-operacao">sada</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <th scope="row">{{ $produto->id }}</td>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->marca->nome }}</td>
                                <td>{{ $produto->unidade_medida->nome}}</td>
                                <td>{{ $produto->categoria->nome}}</td>
                                <td>{{ $produto->estoque_atual }}</td>
                                <td><div class="div-op"><a class="btn btn-sm-template btn-primary mx-1" href="{{ route('produto.show', ['produto' => $produto->id]) }}" ><i class="icofont-ui-search" ></i></a>
                                <a class="btn btn-sm-template btn-success mx-1" href="{{ route('produto.edit', ['produto' => $produto->id]) }}"><i class="icofont-pen-alt-1"></i></a>
                                <form id="form_{{ $produto->id }}" method="post"
                                        action="{{ route('produto.destroy', ['produto' => $produto->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-sm-template btn-danger mx-1" href="#"
                                            onclick="document.getElementById('form_{{ $produto->id }}').submit()"><i class="icofont-close-squared-alt"></i></a>
                                    </form></div>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>


        </div>


    </main>
@endsection
