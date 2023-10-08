@extends('app.layouts.app')
@section('titulo', 'Produtos')

@section('content')
        <div class="card">
            <div class="card-header-template">
                <div>LISTAGEM DE USUÁRIOS</div>
                <div>
                    <a href="{{ route('register') }}" class="btn btn-sm btn-primary">
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
                            <th scope="col" class="th-title">Email</th>
                            <th scope="col" class="th-title">Email Verificado</th>
                            <th scope="col" class="th-title">Criado Em</th>
                            <th scope="col" class="th-title">Operações</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->email_verified_at }}</td>
                                <td>{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
                                <td>
                                    <div class="btn-group btn-group-actions visible-on-hover">
                                        <a class="btn btn-sm-template btn-outline-primary"
                                            href="{{ route('user.show', ['user' => $user->id])}}">
                                            <i class="icofont-eye-alt"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-outline-success" 
                                            @can('admin') href="{{ route('user.edit', ['user' => $user->id]) }}"
                                            @elsecan('user') data-bs-toggle="modal" data-bs-target="#modal_msg" @endcan>
                                            <i class="icofont-ui-edit"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-outline-danger" 
                                            href="#" @can('admin') data-bs-toggle="modal" data-bs-target="#deleteModal" @endcan
                                            @can('user') data-bs-toggle="modal" data-bs-target="#modal_msg" @endcan
                                            data-id="{{ $user->id }}">
                                            <i class="icofont-ui-delete"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>


        </div>

@endsection
