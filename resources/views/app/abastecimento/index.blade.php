@extends('app.layouts.app')
@section('titulo', 'Produtos')

@section('content')
    <div class="card">
        <div class="card-header-template">
            <div><i class="icofont-list mr-2"></i>LISTAGEM DE ABASTECIMENTOS</div>
            <form id="formSearchingProducts" action="{{route('abastecimento.index')}}" method="get">
                <!--input box filtro buscar produto--------->
                <input type="text" id="query" name="filtro_equipamento" placeholder="Buscar Equipamento..." aria-label="Search through site content">
                <button type="submit" class="button-search">
                    <i class="icofont-search"></i>
                </button>
            </form>
        </div>


        <div class="card-header-template">
            <div>
                <a @can('admin') href="{{ route('abastecimento.create') }}"
                @elsecan('user')data-bs-toggle="modal" data-bs-target="#modal_msg"  @endcan 
                class="btn btn-sm btn-primary mb-1">
                    <i class="icofont-plus-circle pr-2"></i>NOVO
                </a>
                <a href="{{ route('abastecimento.index') }}" class="btn btn-sm btn-primary mb-1">
                    <i class="icofont-page pr-2"></i>TODOS
                </a>
                <a href="{{ route('abastecimento.consulta_avancada') }}" class="btn btn-sm btn-primary mb-1">
                    <i class="icofont-filter"></i>CONSULTA AVANÇADA
                </a>
                <a href="{{ route('abastecimento.pdf_export')}}{{$filtros ? $filtros : ''}}" class="btn btn-sm btn-primary m-b1">
                    <i class="icofont-file-pdf pr-2"></i>PDF
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
                        <th scope="col" class="th-title">quantidade</th>
                        <th scope="col" class="th-title">Data</th>
                        <th scope="col" class="th-title">Operaçoes</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($abastecimentos as $abastecimento)
                        <tr>
                            <th scope="row">{{ $abastecimento->id }}</td>
                            <td>{{ $abastecimento->equipamento }}</td>
                            <td>{{ $abastecimento->produto}}</td>
                            <td>{{ $abastecimento->quantidade }}</td>
                            <td>{{ Carbon\Carbon::parse($abastecimento->data)->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-actions visible-on-hover">
                                    <a class="btn btn-sm-template btn-outline-primary"
                                        href="{{ route('abastecimento.show', ['abastecimento' => $abastecimento->id]) }}"><i
                                            class="icofont-eye-alt"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-success" 
                                        @can('admin') href="{{ route('abastecimento.edit', ['abastecimento' => $abastecimento->id]) }}"
                                        @elsecan('user') data-bs-toggle="modal" data-bs-target="#modal_msg" @endcan>
                                        <i class="icofont-ui-edit"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-danger" 
                                        href="#" @can('admin') data-bs-toggle="modal" data-bs-target="#deleteModal" @endcan
                                        @can('user') data-bs-toggle="modal" data-bs-target="#modal_msg" @endcan
                                        data-id="{{ $abastecimento->id }}">
                                        <i class="icofont-ui-delete"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            @component('app.shared.modal_delete')
                {{ route('abastecimento.destroy') }}
            @endcomponent
            @component('app.shared.modal_msg_no_permission')
            @endcomponent
            <div class="d-flex justify-content-center">
                {{ $abastecimentos->appends($request)->links() }}
            </div>

        </div>


    </div>

@endsection
