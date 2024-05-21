@extends('app.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header-template">
            <div>
                Visualizar Ordem de Produção
            </div>
            <div>
                <a class="btn btn-primary btn-sm mr-2" href="{{ route('ordem-producao.create') }}">
                    <i class="icofont-plus-circle pr-2"></i>NOVO
                </a>
                <a class="btn btn-primary btn-sm" href="{{ route('ordem-producao.index') }}">
                    <i class="icofont-page pr-2"></i>LISTAGEM
                </a>

                <a class="btn btn-danger btn-sm" href="{{ route('ordem-producao.pdf-export', ['ordem_producao'=>$ordem_producao->id]) }}" target="_blank">
                    <i class="icofont-file-pdf pr-2"></i>PDF
                </a>
            </div>
        </div>

        <div class="card-body-template mt-1">
            <table class="table-template table-hover">
                <tr>
                    <th colspan="16" class="th-title-main text-center">INFORMAÇÕES SOBRE FUNCIONAMENTO -
                        {{ $ordem_producao->equipamento->nome }}</th>
                </tr>
                <tr>

                    <td class="text-right th-title pr-2" style="width: 6rem;" colspan="2">CÓDIGO</td>
                    <td class="pl-2" style="width: 6rem;" colspan="2">{{ $ordem_producao->id }}</td>
                    <td class="text-right th-title pr-2" style="width: 6rem;" colspan="2">Data</td>
                    <td class="pl-2" style="width: 5px;" colspan="2">
                        {{ Carbon\Carbon::parse($ordem_producao->data)->format('d/m/Y') }}</td>
                    <td class="th-title pr-2 text-right" colspan="2">Estado da Ordem</td>
                    <td class="pl-2" colspan="2">{{ $ordem_producao->status->nome }}</td>
                    <td colspan="4" class="th-title"></td>
                </tr>

                <tr>
                    <td class="text-center th-title" colspan="4">HORÁRIO OPERAÇÃO</td>
                    <td class="text-center th-title" colspan="4">HORÍMETRO</td>
                    <td colspan="8" class="text-left th-title">PRODUÇÃO</td>
                </tr>

                <tr>
                    <td class="text-right pr-2 th-title" colspan="2">Início</td>
                    <td class="pl-2" colspan="2">{{ $ordem_producao->hora_inicio }}</td>
                    <td class="text-right pr-2 th-title" style="width: 6rem;" colspan="2">Início</td>
                    <td class="pl-2" style="width: 6rem;" colspan="2">{{ number_format($op_horimetro_inicial, 2) }}</td>
                    <td class="text-right th-title pr-2" style="width: 10rem;" colspan="2">PRODUTO</td>
                    <td class="pl-2" colspan="2">{{ $ordem_producao->produto->nome }}</td>
                    <td class="text-right th-title pr-2" colspan="2">QUANTIDADE</td>
                    <td class="pl-2" colspan="2">
                        {{ str_replace(',', '.', number_format($ordem_producao->quantidade_producao, 0)) }}
                        {{ $ordem_producao->produto->unidade_medida->nome }}</td>
                </tr>

                <tr>
                    <td class="text-right th-title pr-2" colspan="2">Término</td>
                    <td class="pl-2" colspan="2">{{ $ordem_producao->hora_fim }}</td>
                    <td class="text-right th-title pr-2" colspan="2">Término</td>
                    <td class="pl-2" colspan="2">{{ number_format($ordem_producao->horimetro_final, 2) }}</td>
                    <td class="text-right th-title pr-2" colspan="2">PRODUÇÃO</td>
                    <td class="pl-2" colspan="2">{{ str_replace(',', '.', number_format($producao_por_hora, 0)) }}
                        {{ $ordem_producao->produto->unidade_medida->nome }}/h</td>
                    <td class="th-title" colspan="2"></td>
                    <td class="th-title" colspan="2"></td>

                </tr>

                <tr>
                    <td class="text-right th-title pr-2" colspan="2">Total</td>
                    <td class="pl-2" colspan="2">{{ $total_horas_equipamento }}</td>
                    <td class="text-right th-title pr-2" colspan="2">Total</td>
                    <td class="pl-2" colspan="2">{{ number_format($total_horimetro, 2) }}</td>
                    <td class="th-title" colspan="8"></td>
                </tr>
                <tr>
                    <td colspan="16"></td>
                </tr>
                <tr>
                    <td colspan="16" class="th-title">Observações</td>
                </tr>

                <tr>
                    <td colspan="16">{{ $ordem_producao->observacao }}</td>
                </tr>
                <td colspan="16"></td>

                <tr>
                    <td colspan="16" class="th-title-main">INFORMAÇÕES SOBRE RECURSOS UTILIZADOS</td>
                </tr>
                <tr>
                    <td colspan="3" class="th-title">Equipamento</td>
                    <td class="th-title" colspan="3">Produto</td>
                    <td class="th-title">CONSUMO</td>
                    <td class="th-title">HM.inicial</td>
                    <td class="th-title">Hm.final</td>
                    <td class="th-title">Tot.Hm</td>
                    <td class="th-title">Hora Inicial</td>
                    <td class="th-title">Hora Final</td>
                    <td class="th-title">Tot. H.</td>
                    <td class="th-title">Consumo/h</td>
                    <td class="th-title">Consm/ton</td>
                    <td class="th-title">Estoque Final</td>
                </tr>

                @foreach ($recursos_producao as $recurso)
                    <tr>
                        <td colspan="3">{{ $recurso->equipamento }}</td>
                        <td colspan="3">{{ $recurso->produto }}</td>
                        <td>{{ $recurso->quantidade }}</td>
                        <td>{{ $recurso->horimetro_inicial }}</td>
                        <td>{{ $recurso->horimetro_final }}</td>
                        <td>{{ $recurso->total_horimetro }}</td>
                        <td>{{ $recurso->hora_inicio }}</td>
                        <td>{{ $recurso->hora_fim }}</td>
                        <td>{{ $recurso->total_hora }}</td>
                        <td>{{ number_format($recurso->consumo_hora, 2) }}</td>
                        <td>{{ number_format($recurso->consumo_quant, 2) }}</td>
                        <td>{{ number_format($recurso->estoque_final, 2) }}</td>
                    </tr>
                @endforeach


                <tr>
                    <td colspan="16"></td>
                </tr>

                <tr>
                    <td colspan="16" class="th-title-main">REGISTRO DE PARADAS DE EQUIPAMENTOS</td>
                </tr>

                @if (isset($paradas) && $paradas->count() > 0)
                    <tr>
                        <td class="text-center th-title pr-2" colspan="2">Hora Inicial</td>
                        <td class="text-center th-title pr-2" colspan="2">Hora Final</td>
                        <td class="text-center th-title pr-2" colspan="2">Total</td>
                        <td class="text-center th-title pr-2" colspan="10">Descrição das Ocorências</td>
                    </tr>
                    @foreach ($paradas as $parada)
                        <tr>
                            <td class="text-center" colspan="2">{{ $parada->hora_inicio }}</td>
                            <td class="text-center" colspan="2">{{ $parada->hora_fim }}</td>
                            <td class="text-center" colspan="2">{{ $parada->total_hora }}</td>
                            <td colspan="10">{{ $parada->descricao }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="16" class="text-center"> Não houve paradas de equipamentos</td>
                    </tr>
                @endif

                <tr>
                    <td colspan="16"></td>
                </tr>
                <tr>
                    <td colspan="16" class="th-title-main">Saída de Materiais para Obra</td>
                </tr>

                <tr>
                    <td colspan="4" class="th-title">Produto</th>
                    <td colspan="2" class="th-title">Qtde</th>
                    <td colspan="2" class="th-title">Qtde Cargas</th>
                    <td colspan="4" class="th-title">Obra</th>
                    <td colspan="4" class="th-title">Transportadora</th>
                </tr>
                @foreach ($produtos_obra as $produto_obra)
                    <tr>
                        <td colspan="4">{{ $produto_obra->produto->nome }}</td>
                        <td colspan="2">{{ $produto_obra->quantidade }}</td>
                        <td colspan="2">{{ $produto_obra->qtde_cargas }}</td>
                        <td colspan="4">{{ $produto_obra->obra->nome }}</td>
                        <td colspan="4">{{ $produto_obra->transportadora->nome ?? '' }}</td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
@endsection
