@extends('app.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header-template mb-1">
            <div>
                <i class="icofont-filter mr-1"></i></i>
                CONSULTA AVANÇADA
            </div>
            <div>
                <a class="btn btn-primary btn-sm mr-2" href="{{ route('pesagem.index') }}">
                    <i class="icofont-circled-left mr-1"></i>VOLTAR
                </a>
            </div>
        </div>

        
        <div class="card-body">
            <form action="{{ route('pesagem.index') }}" method="get">
                <div class="row mb-1">
                    <label for="data_inicial" class="col-md-4 col-form-label text-md-end text-right">Data Inicial</label>
                    <div class="col-md-6">
                        <input id="data_inicial" name="data_inicial" type="date" class="form-control-template"
                            value="{{ $abastecimento->data_inicial ?? old('data_inicial') }}">
                        {{ $errors->has('data_inicial') ? $errors->first('data_inicial') : '' }}
                    </div>
                </div>
        
                <div class="row mb-1">
                    <label for="data_final" class="col-md-4 col-form-label text-md-end text-right">Data Final</label>
                    <div class="col-md-6">
                        <input id="data_final" name="data_final" type="date" class="form-control-template"
                            value="{{ $abastecimento->data_final ?? old('data_final') }}">
                        {{ $errors->has('data_final') ? $errors->first('data_final') : '' }}
                    </div>
                </div>

                <div class="row mb-1">
                    <label for="motorista_id" class="col-md-4 col-form-label text-md-end text-right">Motorista</label>
                    <div class="col-md-6">
                        <select name="motorista_id" id="motorista_id" autofocus>
                            <option value=""> --Selecione o motorista--</option>
                            @foreach ($motoristas as $motorista)
                                <option value="{{ $motorista->id }}"
                                    {{ ($abastecimento->motorista_id ?? old('motorista_id')) == $motorista->id ? 'selected' : '' }}>
                                    {{ $motorista->nome }}</option>
                            @endforeach
                        </select>
                        {{ $errors->has('motorista_id') ? $errors->first('motorista_id') : '' }}
                    </div>
                </div>

                <div class="row mb-1">
                    <label for="produto_id" class="col-md-4 col-form-label text-md-end text-right">Produto</label>

                    <div class="col-md-6">
                        <select name="produto_id" id="produto_id" class="form-control-template">
                            <option value=""> --Selecione o produto--</option>
                            @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}"
                                    {{ ($abastecimento->produto_id ?? old('produto_id')) == $produto->id ? 'selected' : '' }}>
                                    {{ $produto->nome }}</option>
                            @endforeach
                        </select>
                        {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}
                    </div>
                </div>

                <div class="row mb-1">
                    <label for="parceiro_id" class="col-md-4 col-form-label text-md-end text-right">Parceiro</label>

                    <div class="col-md-6">
                        <select name="parceiro_id" id="parceiro_id" class="form-control-template">
                            <option value=""> --Selecione o parceiro--</option>
                            @foreach ($parceiros as $parceiro)
                                <option value="{{ $parceiro->id }}"
                                    {{ ($abastecimento->parceiro_id ?? old('parceiro_id')) == $parceiro->id ? 'selected' : '' }}>
                                    {{ $parceiro->nome }}</option>
                            @endforeach
                        </select>
                        {{ $errors->has('parceiro_id') ? $errors->first('parceiro_id') : '' }}
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

    <script>
        $(document).ready(function() {
            $('#motorista_id').select2();
            $('#parceiro_id').select2();
            $('#produto_id').select2();
        });
    </script>
@endsection




{{-- ------------------------------------------------- --}}
