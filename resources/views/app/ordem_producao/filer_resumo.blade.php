@extends('app.layouts.app')

@section('content')
        <div class="card">
            <div class="card-header-template mb-1">
                <div>
                    <i class="icofont-filter mr-1"></i></i>
                    RESUMO DE PRODUÇÃO
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
                        <label for="equipamento" class="col-md-4 col-form-label text-md-end text-right">Produto</label>
                        <div class="col-md-6">
                            <select name="produto_id" id="" class="form-control-template">
                                <option value=""> --Selecione a obra--</option>
                                @foreach ($obras as $obra)
                                    <option value="{{ $obra->id }}">{{ $obra->nome }}</option>
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

@endsection


{{-- ------------------------------------------------- --}}
