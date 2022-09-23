@extends('app.layouts.app')

@section('content')
        <div class="card">
            <div class="card-header-template">
                <div>LISTAGEM DE CATEGORIAS</div>
                <div>
                    <a href="{{route('category.create')}}" class="btn btn-sm-template btn-primary">
                        NOVO
                    </a>
                </div>

            </div>
            
            <div class="card-body">
                <table class="table-template table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="th-title">Id</th>
                            <th scope="col" class="th-title">Nome</th>
                            <th scope="col" class="th-title">Operações</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <th scope="row" class="th-title">{{ $categoria->id }}</td>
                                <td>{{ $categoria->nome }}</td>
                               

                                <td>
                                    <div class="div-op">
                                        <a class="btn btn-sm-template btn-primary mx-1"
                                            href="{{-- {{ route('produto.show', ['produto' => $produto->id]) }} --}}"><i
                                                class="icofont-eye-alt"></i></a>
                                        <a class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan"
                                            href="{{-- {{ route('produto.edit', ['produto' => $produto->id]) }} --}}"><i
                                                class="icofont-pen-alt-1"></i></a>
                                        <form id="form_{{ $categoria->id }}" method="post"
                                            action="{{ route('category.destroy', ['category' => $categoria->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <a class="btn btn-sm-template btn-danger mx-1 @can('user') disabled @endcan" href="#"
                                                onclick="document.getElementById('form_{{ $categoria->id }}').submit()"><i
                                                    class="icofont-close-squared-alt"></i></a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{$categorias->appends($request)->links()}}
                </div>


            </div>


        </div>

@endsection
