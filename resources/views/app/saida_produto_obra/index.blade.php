@extends('app.layouts.app')
@section('titulo', 'Produtos')

@section('content')
        <div class="card">
            <div class="card-header-template">
                <div>SAÍDA DE PRODUTO PRODUTO X OBRA</div>
                <div>
                    <a class="btn btn-filter btn-sm" href="{{ route('saida-produto-obra.edit-filter') }}">
                        <i class="icofont-filter mr-1"></i></i>FILTRAR
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
                            <th scope="col" class="th-title">Obra</th>
                            <th scope="col" class="th-title">Quantidade</th>
                            <th scope="col" class="th-title">Operaçoes</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($produtos_obra as $saida_produto)
                            <tr>
                                <th scope="row">{{ $saida_produto->id }}</td>
                                <td>{{$saida_produto->data}}</td>
                                <td>{{ $saida_produto->produto }}</td>
                                <td>{{ $saida_produto->obra }}</td>
                                <td>{{ str_replace(',','.',number_format($saida_produto->quantidade,0)) }}</td>
                                <td>
                                    <div class="div-op">
                                        <a class="btn btn-sm-template btn-primary mx-1"
                                            href="{{ route('produto.show', ['produto' => $saida_produto->id]) }}"><i
                                                class="icofont-eye-alt"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan"
                                            href="{{ route('produto.edit', ['produto' => $saida_produto->id]) }}"><i
                                                class="icofont-pen-alt-1"></i>
                                        </a>
                                            <a class="btn btn-sm-template btn-danger mx-1 @can('user') disabled @endcan" href="#"><i
                                                    class="icofont-close-squared-alt"></i>
                                            </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        <tr class="th-title">
                            <td colspan="3"></td>
                            <td>Total</td>
                            <td>{{$total}}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                   {{$produtos_obra->appends($request)->links()}} 
                </div>

            </div>


        </div>

@endsection
