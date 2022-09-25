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
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <div class="div-op">
                                        <a class="btn btn-sm-template btn-primary mx-1"
                                            href="{{ route('user.show', ['user' => $user->id]) }}"><i
                                                class="icofont-eye-alt"></i></a>
                                        <a class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan"
                                            href="{{ route('user.edit', ['user' => $user->id]) }}"><i
                                                class="icofont-pen-alt-1"></i></a>
                                        <form id="form_{{ $user->id }}" method="post"
                                            action="{{ route('user.destroy', ['user' => $user->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <a class="btn btn-sm-template btn-danger mx-1 @can('user') disabled @endcan" href="#"
                                                onclick="document.getElementById('form_{{ $user->id }}').submit()"><i
                                                    class="icofont-close-squared-alt"></i></a>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>


        </div>

@endsection
