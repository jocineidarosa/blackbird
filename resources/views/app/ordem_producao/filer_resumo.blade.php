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
            <form action="{{ route('ordem-producao.filter-resumo') }}" method="get">
                <div class="row mb-1">
                    <label for="obra_id" class="col-md-4 col-form-label text-md-end text-right">Produto</label>
                    <div class="col-md-6">
                        <select name="obra_id" id="" class="form-control-template">
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


            @if (isset($resumo_producao))
                <table class="table-template table-hover">
                    <tr>
                        <td class="th-title-main text-center">Resumo de Produção</td>
                        <td colspan="3" class="th-title-main text-center">{{ $nome_obra }}</td>
                    </tr>
                    <tr>
                        <td class="th-title text-center">Produção Total</td>
                        <td colspan="3" class="th-title text-center">{{ str_replace(',','.',number_format($total_producao,0)) }}</td>
                    </tr>
                    <tr>
                        <td class="text-center th-title pr-2">Produto</td>
                        <td class="text-center th-title pr-2">quantidade</td>
                        <td class="text-center th-title pr-2">Teor</td>
                        <td class="text-center th-title pr-2">Valor Total</td>
                    </tr>
                    @foreach ($resumo_producao as $resumo)
                        <tr>
                            <td class="text-center">{{ $resumo->nome }}</td>
                            <td class="text-center">{{ str_replace(',','.',number_format($resumo->total,0)) }}</td>
                            <td class="text-center">{{ number_format($resumo->teor,2)}}</td>
                            <td class="text-center">R$ {{ str_replace(',','.',number_format($resumo->v_total, 2)) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="text-center" colspan="3">GASTO TOTAL DA OBRA</td>
                        <td class="text-center">R$ {{ str_replace(',','.',number_format($v_total_obra, 2)) }}</td>
                    </tr>
                </table>
            @endif

        </div>

    </div>

@endsection


{{-- ------------------------------------------------- --}}
