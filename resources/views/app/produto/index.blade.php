@extends('app.layouts.app')
@section('titulo', 'Produtos')

@section('content')
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
                        <th scope="col" class="th-title">Id</th>
                        <th scope="col" class="th-title">Nome</th>
                        <th scope="col" class="th-title">Marca</th>
                        <th scope="col" class="th-title">Categoria</th>
                        <th scope="col" class="th-title">Estoque</th>
                        <th scope="col" class="th-title">Operaçoes</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($produtos as $produto)
                        <tr>
                            <th scope="row">{{ $produto->id }}</td>
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->marca->nome }}</td>
                            <td>{{ $produto->categoria->nome }}</td>
                            <td>{{ str_replace(',', '.', number_format($produto->estoque_atual, 0)) }}</td>
                            <td>
                                <div {{-- class="div-op" --}} class="btn-group btn-group-actions visible-on-hover">
                                    <a class="btn btn-sm-template btn-outline-primary"
                                        href="{{ route('produto.show', ['produto' => $produto->id]) }}"><i
                                        class="icofont-eye-alt"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-success  @can('user') disabled @endcan"
                                        href="{{ route('produto.edit', ['produto' => $produto->id]) }}">
                                        <i class="icofont-ui-edit"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-danger @can('user') disabled @endcan" 
                                        href="#" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $produto->id }}">
                                        <i class="icofont-ui-delete"></i>
                                        </a>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            @component('app.shared.modal_delete')
            {{route('produto.destroy')}}
        @endcomponent
            <div class="d-flex justify-content-center">
                {{ $produtos->appends($request)->links() }}
            </div>

        </div>


    </div>

@endsection
