@extends('app.layouts.app')

@section('content')
    <main class="content">
        <div class="card">
            <div class="card-header-template mb-1">
                <div>
                    <i class="icofont-filter mr-1"></i></i>
                    FILTRAR ORDEM DE PRODUÇÃO
                </div>
                <div>
                    <a class="btn btn-primary btn-sm mr-2" href="{{ route('ordem-producao.index') }}">
                        <i class="icofont-circled-left mr-1"></i>VOLTAR
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('ordem-producao.filter') }}" method="get">
                    <div class="row mb-1">
                        <label for="data_inicial" class="col-md-4 col-form-label text-md-end text-right">Data
                            Inicial</label>
                        <div class="col-md-6">
                            <input id="data" type="date" class="form-control-template" name="data_inicial">
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="data_final" class="col-md-4 col-form-label text-md-end text-right">Data Final</label>
                        <div class="col-md-6">
                            <input id="data" type="date" class="form-control-template" name="data_final">
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="equipamento_id" class="col-md-4 col-form-label text-md-end text-right">Equipamento</label>
                        <div class="col-md-6">
                            <select name="equipamento_id" id="" class="form-control-template">
                                <option value=""> --Selecione o equipamento--</option>
                                @foreach ($equipamentos as $equipamento)
                                    <option value="{{ $equipamento->id }}"
                                        {{ ($equipamento->equipamento ?? old('equipamento')) == $equipamento->id ? 'selected' : '' }}>
                                        {{ $equipamento->nome }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="equipamento" class="col-md-4 col-form-label text-md-end text-right">Produto</label>
                        <div class="col-md-6">
                            <select name="produto_id" id="" class="form-control-template">
                                <option value=""> --Selecione o produto--</option>
                                @foreach ($produtos as $produto)
                                    <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                                @endforeach
                            </select>
                            {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-filter">
                                <i class="icofont-filter mr-2"></i></i>Filtrar
                            </button>
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </main>
@endsection


{{-- ------------------------------------------------- --}}
