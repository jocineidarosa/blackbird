@extends('app.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header-template">
            <div> LISTAGEM DE ENTRADA DE PRODUTOS</div>
            <form id="formSearchingProducts" action="{{route('entrada-produto.index')}}" method="get">
                <!--input box filtro buscar produto--------->
                <input type="text" id="query" name="filtro_produto" placeholder="Buscar produto..." aria-label="Search through site content">
                <button type="submit" class="button-search">
                    <i class="icofont-search"></i>
                </button>
            </form>
            <div>
                <a href="{{ route('entrada-produto.create') }}" class="btn btn-sm btn-primary">
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
                        <th scope="col" class="th-title">Preço</th>
                        <th class="th-title">Operações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entradas_produtos as $entrada_produto)
                        <tr>
                            <th scope="row">{{ $entrada_produto->id }}</td>
                            <td>{{ Carbon\Carbon::parse($entrada_produto->data)->format('d/m/Y') }}</td>
                            <td>{{ $entrada_produto->produto }}</td>
                            <td>{{ $entrada_produto->quantidade }}</td>
                            <td>R$ {{ $entrada_produto->preco }}</td>
                            <td>
                                <div {{-- class="div-op" --}} class="btn-group btn-group-actions visible-on-hover">
                                    <a class="btn btn-sm-template btn-outline-primary"
                                        href="{{ route('entrada-produto.show', ['entrada_produto' => $entrada_produto->id]) }}"><i
                                            class="icofont-eye-alt"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-success  @can('user') disabled @endcan"
                                        href="{{ route('entrada-produto.edit', ['entrada_produto' => $entrada_produto->id]) }}">
                                        <i class="icofont-ui-edit"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-danger @can('user') disabled @endcan"
                                        href="#" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-id="{{ $entrada_produto->id }}">
                                        <i class="icofont-ui-delete"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @endforeach


                </tbody>
            </table>
            @component('app.shared.modal_delete')
                {{ route('entrada-produto.destroy') }}
            @endcomponent
            <div class="d-flex justify-content-center">
                {{ $entradas_produtos->appends($request)->links() }}
            </div>


        </div>


    </div>
@endsection
