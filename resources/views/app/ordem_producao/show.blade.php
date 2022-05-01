@extends('app.layouts.app')

@section('content')
    <main class="content">
        <div class="card">
            <div class="card-header-template">
                <div>
                    Visualizar Ordem de Produção
                </div>
                <div>
                    <a class="btn btn-primary btn-sm mr-2" href="{{ route('ordem-producao.create') }}">NOVO</a>
                    <a class="btn btn-primary btn-sm" href="{{ route('ordem-producao.index') }}">LISTAGEM</a>
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
                            {{ \Carbon\Carbon::parse($ordem_producao->data_inicio)->format('d/m/Y') }}</td>
                        <td class="th-title pr-2 text-right" colspan="2">Estado da Ordem</td>
                        <td class="pl-2" colspan="2">{{ $ordem_producao->status }}</td>
                    </tr>

                    <tr>
                        <td class="text-center th-title" colspan="4">HORÁRIO OPERAÇÃO</td>
                        <td class="text-center th-title" colspan="4">HORÍMETRO</td>
                        <td colspan="8" class="text-center th-title">PRODUÇÃO</td>
                    </tr>

                    <tr>
                        <td class="text-right pr-2 th-title" colspan="2">Início</td>
                        <td class="pl-2" colspan="2">{{ $ordem_producao->hora_inicio }}</td>
                        <td class="text-right pr-2 th-title" style="width: 6rem;" colspan="2">Início</td>
                        <td class="pl-2" style="width: 6rem;" colspan="2">{{ number_format($horimetro_inicial, 2) }}</td>
                        <td class="text-right th-title pr-2" style="width: 10rem;" colspan="2">PRODUTO</td>
                        <td class="pl-2" colspan="2">{{ $ordem_producao->produto->nome }}</td>
                        <td class="text-right th-title pr-2" colspan="2">QUANTIDADE</td>
                        <td class="pl-2" colspan="2">{{ number_format($ordem_producao->quantidade_producao, 0) }}
                            {{ $ordem_producao->produto->unidade_medida->nome }}</td>
                    </tr>

                    <tr>
                        <td class="text-right th-title pr-2" colspan="2">Término</td>
                        <td class="pl-2" colspan="2">{{ $ordem_producao->hora_fim }}</td>
                        <td class="text-right th-title pr-2" colspan="2">Término</td>
                        <td class="pl-2" colspan="2">{{ number_format($ordem_producao->horimetro_final, 2) }}</td>
                        <td class="text-right th-title pr-2" colspan="2">PRODUÇÃO POR HORA</td>
                        <td class="pl-2" colspan="2">{{ number_format($producao_por_hora) }}
                            {{ $ordem_producao->produto->unidade_medida->nome }} - POR HORA</td>
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
                        <td colspan="16" ></td>
                    </tr>

                    <tr>
                        <td colspan="16" class="th-title-main text-center">INFORMAÇÕES SOBRE RECURSOS UTILIZADOS</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="th-title">Equipamento</td>
                        <td class="th-title" colspan="3">Produto</td>
                        <td class="th-title">quant</td>
                        <td class="th-title">Horímetro Inicial</td>
                        <td class="th-title">Horímetro Final</td>
                        <td class="th-title">Tot.Hm</td>
                        <td class="th-title">Hora Inicial</td>
                        <td class="th-title">Hora Final</td>
                        <td class="th-title">Temp.OP</td>
                        <td class="th-title" colspan="2">cons/teor</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach ($recursos_producao as $recurso)
                        <tr>
                            <td colspan="4">{{ $recurso->equipamento    }}</td>
                            <td colspan="3">{{ $recurso->produto}}</td>
                            <td>{{ $recurso->quantidade }}</td>
                            <td>{{ $recurso->horimetro_inicial }}</td>
                            <td>{{ $recurso->horimetro_final }}</td>
                            <td>{{$recurso->total_horimetro}}</td>
                            <td>{{ $recurso->hora_inicio }}</td>
                            <td>{{ $recurso->hora_fim }}</td>
                            <td>{{$recurso->total_hora}}</td>
                            <td colspan="2"></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="16"></td>
                    </tr>

                    <tr>
                        <td colspan="16" class="th-title-main text-center">REGISTRO DE PARADAS DE EQUIPAMENTOS</td>
                    </tr>

                    @if (isset($paradas) && $paradas->count() > 0)
                        <tr>
                            <td class="text-right th-title pr-2" colspan="2">Hora Inicial</td>
                            <td class="text-right th-title pr-2" colspan="2">Hora Final</td>
                            <td class="text-center th-title pr-2" colspan="12">Descrição das Ocorências</td>
                        </tr>

                        @foreach ($paradas as $parada)
                            <tr>
                                <td class="text-center" colspan="2">{{ $parada->hora_inicio }}</td>
                                <td class="text-center" colspan="2">{{ $parada->hora_fim }}</td>
                                <td colspan="12">{{ $parada->descricao }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="16" class="text-center"> Não houve paradas de equipamentos</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>

    </main>
@endsection
