@extends('app.layouts.app')

@section('content')
    <main class="content">
        <div class="card">
            <div class="card-header-template">
                {{$message ??''}}
            </div>
            <div class="card-header-template">
                <div> LISTAGEM DE SAÍDA DE PRODUTOS</div>
                <div>
                    <a href="{{ route('saida-produto.create') }}" class="btn btn-sm btn-primary">
                        NOVO
                    </a>
                </div>

            </div>
            <div class="card-body">
                <table class="table-template table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="th-title">Id</th>
                            <th scope="col" class="th-title">Data</th>
                            <th scope="col" class="th-title">Produto</th>
                            <th scope="col" class="th-title">Quantidade</th>
                            <th class="th-title">Operações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($saidas_produtos as $saida_produto)
                            <tr>
                                <th scope="row">{{ $saida_produto->id }}</td>
                                <td>{{Carbon\Carbon::parse($saida_produto->data )->format('d/m/Y')}}</td>
                                <td>{{ $saida_produto->produto->nome }}</td>
                                <td>{{ $saida_produto->quantidade }}</td>
                                <td>
                                    <div class="div-op">
                                        <a class="btn btn-sm-template btn-primary mx-1"
                                            href="{{ route('saida-produto.show', ['saida_produto' => $saida_produto->id]) }}"><i
                                                class="icofont-eye-alt"></i></a>
                                        <a class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan"
                                            href="{{ route('saida-produto.edit', ['saida_produto' => $saida_produto->id]) }}"><i
                                                class="icofont-pen-alt-1"></i></a>
                                        <form id="form_{{ $saida_produto->id }}" method="post"
                                            action="{{ route('saida-produto.destroy', ['saida_produto' => $saida_produto->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <a class="btn btn-sm-template btn-danger mx-1 @can('user') disabled @endcan" href="#"
                                                onclick="document.getElementById('form_{{ $saida_produto->id }}').submit()"><i
                                                    class="icofont-close-squared-alt"></i></a>
                                        </form>
                                    </div>
                                </td>

                            </tr>

                        @endforeach

                        
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{$saidas_produtos->appends($request)->links()}}
                </div>


            </div>


        </div>


    </main>
@endsection
