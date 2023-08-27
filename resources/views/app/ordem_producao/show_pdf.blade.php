
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        table {
            border: 0.2px solid #b2a7a7;
            border-collapse: collapse;
            width: 100%;
        }

        th {
            border: 0.2px solid #b2a7a7;
            background-color: #e9e2e2;
        }

        td {
            border: 0.2px solid #b2a7a7;
        }

        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #ece5e5;
        }
    </style>
</head>

<body>
        <div>
            Visualizar Ordem de Produção
        </div>

    <div>
        <table>
            <tr>
                <th colspan="16" >INFORMAÇÕES SOBRE FUNCIONAMENTO -
                    {{ $ordem_producao->equipamento->nome }}</th>
            </tr>
            <tr>

                <td >CÓDIGO</td>
                <td  colspan="2">{{ $ordem_producao->id }}</td>
                <td colspan="2">Data</td>
                <td colspan="2">
                    {{ Carbon\Carbon::parse($ordem_producao->data)->format('d/m/Y') }}</td>
                <td colspan="2">Estado da Ordem</td>
                <td>{{ $ordem_producao->status->nome }}</td>
                <td colspan="4" ></td>
            </tr>

            <tr>
                <td  colspan="4">HORÁRIO OPERAÇÃO</td>
                <td  colspan="4">HORÍMETRO</td>
                <td colspan="8" >PRODUÇÃO</td>
            </tr>

            <tr>
                <td  colspan="2">Início</td>
                <td  colspan="2">{{ $ordem_producao->hora_inicio }}</td>
                <td  colspan="2">Início</td>
                <td  colspan="2">{{ number_format($op_horimetro_inicial, 2) }}
                </td>
                <td   colspan="2">PRODUTO</td>
                <td  colspan="2">{{ $ordem_producao->produto->nome }}</td>
                <td colspan="2">QUANTIDADE</td>
                <td colspan="2">
                    {{ str_replace(',', '.', number_format($ordem_producao->quantidade_producao, 0)) }}
                    {{ $ordem_producao->produto->unidade_medida->nome }}</td>
            </tr>

            <tr>
                <td  colspan="2">Término</td>
                <td colspan="2">{{ $ordem_producao->hora_fim }}</td>
                <td class="text-right th-title pr-2" colspan="2">Término</td>
                <td colspan="2">{{ number_format($ordem_producao->horimetro_final, 2) }}</td>
                <td class="text-right th-title pr-2" colspan="2">PRODUÇÃO</td>
                <td colspan="2">{{ str_replace(',', '.', number_format($producao_por_hora, 0)) }}
                    {{ $ordem_producao->produto->unidade_medida->nome }}/h</td>
                <td  colspan="2"></td>
                <td  colspan="2"></td>

            </tr>

            <tr>
                <td  colspan="2">Total</td>
                <td colspan="2">{{ $total_horas_equipamento }}</td>
                <td  colspan="2">Total</td>
                <td colspan="2">{{ number_format($total_horimetro, 2) }}</td>
                <td  colspan="8"></td>
            </tr>
            <tr>
                <td colspan="16"></td>
            </tr>
            <tr>
                <td colspan="16" >Observações</td>
            </tr>

            <tr>
                <td colspan="16">{{ $ordem_producao->observacao }}</td>
            </tr>
            <td colspan="16"></td>

            <tr>
                <td colspan="16" >INFORMAÇÕES SOBRE RECURSOS UTILIZADOS</td>
            </tr>
            <tr>
                <td colspan="3" >Equipamento</td>
                <td  colspan="3">Produto</td>
                <td >CONSUMO</td>
                <td >HM.inicial</td>
                <td >Hm.final</td>
                <td >Tot.Hm</td>
                <td >Hora Inicial</td>
                <td >Hora Final</td>
                <td >Tot. H.</td>
                <td >Consumo/h</td>
                <td >Consm/ton</td>
                <td >Estoque Final</td>
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
                    <td>{{ $recurso->estoque_final }}</td>
                </tr>
            @endforeach


            <tr>
                <td colspan="16"></td>
            </tr>

            <tr>
                <td colspan="16" >REGISTRO DE PARADAS DE EQUIPAMENTOS</td>
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
                <td colspan="16" >Saída de Materiais para Obra</td>
            </tr>

            <tr>
                <td colspan="4" >Produto</th>
                <td colspan="2" >Qtde</th>
                <td colspan="2" >Qtde Cargas</th>
                <td colspan="4" >Obra</th>
                <td colspan="4" >Transportadora</th>
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

</body>
</html>
