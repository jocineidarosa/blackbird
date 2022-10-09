@extends('app.layouts.app')

@section('content')
        <div class="card">
            <div class="card-header-template mb-1">
                <div>
                    <i class="icofont-filter mr-1"></i></i>
                    FILTRAR SAÍDA DE PRODUTO X OBRA
                </div>
                <div>
                    <a class="btn btn-primary btn-sm mr-2" href="{{ route('saida-produto-obra.index') }}">
                        <i class="icofont-circled-left mr-1"></i>VOLTAR
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('saida-produto-obra.filter') }}" method="get">
                    <div class="row mb-1">
                        <label for="data_inicial" class="col-md-4 col-form-label text-md-end text-right">Data
                            Inicial</label>
                        <div class="col-md-6">
                            <input id="data" type="date" class="form-control-template" name="data_inicial">
                            {{ $errors->has('data_inicial') ? $errors->first('data_inicial') : '' }}
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="data_final" class="col-md-4 col-form-label text-md-end text-right">Data Final</label>
                        <div class="col-md-6">
                            <input id="data" type="date" class="form-control-template" name="data_final">
                            {{ $errors->has('data_final') ? $errors->first('data_final') : '' }}
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="produto" class="col-md-4 col-form-label text-md-end text-right">Produto</label>
                        <div class="col-md-6">
                            <select name="produto" id="" class="form-control-template">
                                <option value="">Selecione o produto</option>
                                @foreach ($produtos as $produto)
                                    <option value="{{ $produto->id }}">
                                        {{ $produto->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="obra" class="col-md-4 col-form-label text-md-end text-right">Obra</label>
                        <div class="col-md-6">
                            <select name="obra" id="" class="form-control-template">
                                <option value="">Selecione a obra</option>
                                @foreach ($obras as $obra)
                                    <option value="{{ $obra->id }}">{{ $obra->nome }}</option>
                                @endforeach
                            </select>
                            {{ $errors->has('obra') ? $errors->first('obra') : '' }}
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

@endsection


{{-- ------------------------------------------------- --}}
