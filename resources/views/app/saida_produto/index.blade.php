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
                            <th scope="col" class="th-title">Produto</th>
                            <th scope="col" class="th-title">Quantidade</th>
                            <th scope="col" class="th-title">Data</th>
                            <th class="th-title"></th>
                            <th class="th-title"></th>
                            <th class="th-title"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($saidas_produtos as $saida_produto)
                            <tr>
                                <th scope="row">{{ $saida_produto->id }}</td>
                                <td>{{ $saida_produto->produto->nome }}</td>
                                <td>{{ $saida_produto->quantidade }}</td>
                                <td>{{Carbon\Carbon::parse($saida_produto->data )->format('d/m/Y')
                                }}</td>
                                <td><a class="btn btn-sm-template btn-primary" href="#">Visualizar</a>
                                </td>
                                <td><a class="btn btn-sm-template btn-primary" href="#">Editar</a>
                                </td>
                                <td>
                                    <form id="form_{{ $saida_produto->id }}" method="post" 
                                        action="{{route('saida-produto.destroy', ['saida_produto'=>$saida_produto->id])}}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-sm-template {{$saida_produto->motivo == '1' ? 'btn-primary' : 'btn-danger'}}" href="#"
                                            onclick="document.getElementById('form_{{$saida_produto->id }}').submit()">Excluir</a>
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
