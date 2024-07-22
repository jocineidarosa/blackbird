
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Pesagem</title>
    <link rel="stylesheet" href="{{asset('css/ticket.css')}}">
    <script>
        function printTicket() {
            window.print();
        }
    </script>
</head>

<body>

    <!-- ---------------------------- -->

    @for ($i = 0; $i < $quant_impress ; $i++)
    <table style="width: 695px; margin-bottom: 3px;">
        <tr class="td-bordered" style="background-color: rgb(183, 183, 183);">
            <td colspan="4" class="title">
                <div style="display: flex; padding: 4px;">
                    <div style="width: 30%;">
                        <div>Bresola Terraplanagem</div>
                        <div>Fone: (49)3541-0685</div>
                    </div>

                    <div style="width: 40%; text-align:center;" >
                        <p>TICKET DE PESAGEM</p>
                        
                    </div>
                    <div style="width:10%"></div>
                    <div style="width: 20%;">
                        Ticket No. {{$pesagem->id}}
                    </div>
                </div>
            </td>
        </tr>

        <tr class="td-bordered label">
            <td colspan="4">
                <div style="display: flex;">
                    <div style="width: 10%;">
                        <div class="div-label-right">Placa</div>
                        <div class="div-label-right">Parceiro</div>
                        <div class="div-label-right">Endereço</div>
                    </div>

                    <div style="width: 70%;">
                        <div class="div-label-left">{{$pesagem->placa}}</div>
                        <div class="div-label-left">{{$pesagem->parceiro_id}} - {{$pesagem->parceiro->nome}}</div>
                        <div class="div-label-left">{{$pesagem->parceiro->endereco}}</div>
                    </div>

                    <div style="width: 10%;">
                        <div class="div-label-right">Data</div>
                        <div class="div-label-right">Peso NF</div>
                        <div class="div-label-right">No NF</div>
                    </div>
                    <div style="width: 10%;">
                        <div class="div-label-left">{{Carbon\Carbon::parse($pesagem->data)->format('d/m/Y')}}</div>
                        <div class="div-label-left">{{$pesagem->peso_nf}}</div>
                        <div class="div-label-left">{{$pesagem->nota_fiscal}}</div>
                    </div>

                </div>
            </td>
        </tr>

        <tr class="td-bordered label">
            <td colspan="4">
                <div style="display: flex;">
                    <div style="width: 10%;">
                        <div class="div-label-right">Motorista</div>
                    </div>
                    <div style="width: 90%;">
                        <div class="div-label-left">{{$pesagem->motorista_id}} - {{$pesagem->motorista->nome}}</div>
                    </div>
                </div>

            </td>
        </tr>

        <tr class="td-bordered label">
            <td colspan="3" class="td-bordered">
                <div style="display: flex;">
                    <div style="width: 21%;">
                        <div class="div-label-right">Produto</div>
                    </div>
                    <div style="width: 90%;">
                        <div class="div-label-left">{{$pesagem->produto_id}} - {{$pesagem->placa}}</div>
                    </div>
                </div>
            </td>
            <td class="td-bordered">
                <div style="display: flex;">
                    <div style="width: 30%;">
                        <div class="div-label-right">Tipo</div>
                    </div>
                    <div style="width: 70%;">
                        <div class="div-label-left">{{$pesagem->movimentacao}}</div>
                    </div>
                </div>
            </td>
        </tr>

        <tr class="td-bordered" style="background-color: rgb(183, 183, 183);">
            <td colspan="4" style="text-align: center;">
                <div style="padding: 2px; font-size:14px; ">PESAGEM</div>
            </td>
        </tr>
        <tr class="label">
            <td class="td-bordered">
                <div style="display: flex;">
                    <div style="width: 50%;" class="div-label-right">Bruto</div>
                    <div style="width: 50%;" class="div-label-left">{{number_format($pesagem->peso_bruto, 0)}}</div>
                </div>
            </td>
            <td class="td-bordered">
                <div style="display: flex;">
                    <div style="width: 50%;" class="div-label-right">Data</div>
                    <div style="width: 50%;" class="div-label-left">{{Carbon\Carbon::parse($pesagem->data_bruto)->format('d/m/Y')}}</div>
                </div>
            </td>
            <td class="td-bordered">
                <div style="display: flex;">
                    <div style="width: 50%;" class="div-label-right">Hora</div>
                    <div style="width: 50%;" class="div-label-left">{{$pesagem->hora_bruto}}</div>
                </div>
            </td>

            <th class="td-bordered" rowspan="2">
                <div >
                    <div style=" font-size: 12;" >Peso Liquido</div>
                    <div style="font-size: 18px; font-weight: 300;" >{{$pesagem->peso_liquido}}</div>
                </div>
            </th>

        </tr>

        <tr class="label">
            <td class="td-bordered">
                <div style="display: flex;">
                    <div style="width: 50%;" class="div-label-right">Tara</div>
                    <div style="width: 50%;" class="div-label-left">{{$pesagem->peso_tara}}</div>
                </div>
            </td>
            <td class="td-bordered">
                <div style="display: flex;">
                    <div style="width: 50%;" class="div-label-right">Data</div>
                    <div style="width: 50%;" class="div-label-left">{{Carbon\Carbon::parse($pesagem->data_tara)->format('d/m/Y')}}</div>
                </div>
            </td>
            <td class="td-bordered">
                <div style="display: flex;">
                    <div style="width: 50%;" class="div-label-right">Hora</div>
                    <div style="width: 50%;" class="div-label-left">{{$pesagem->hora_tara}}</div>
                </div>
            </td>

        </tr>

        <tr >    
            <td class="td-bordered label" colspan="3" style="vertical-align:top; ">
                <div style="display:flex; flex-direction:column; justify-content:flex-start;height:100%;">
                    <div style="height:15px; width:10%" class="div-label-right">Obs.:</div>
                    <div style="height:30px;" >
                    </div>
                    <div style="height:20px;" >{{-- assinaturas --}}</div>
                    <div style="height:15px; display:flex;"  >
                        <div style="width:20px; "></div>
                        <div style="width:180px; border-top:#6f6b6b solid 1px;">Motorista</div>
                        <div style="width:80px"></div>
                        <div style="width:180px; border-top:#6f6b6b solid 1px;">Cliente</div>
                    </div>
                </div>
            </td>
            <td class="td-bordered" style="width: 175px; font-size:11px;">
                <div class="label-sm">Peso Ton</div>
                <div class="label-sm">Valor Unit Prod</div>
                <div class="label-sm">Valor Total Prod</div>
                <div class="label-sm">Valor frete(Km/Ton)</div>
                <div class="label-sm">Valor Total frete</div>
                <div class="label-sm">Total Geral.:</div>
            </td>

        </tr>

    </table>
    @endfor

    {{-- ---------------------------------------- --}}


</body>

</html>