<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pesagem</title>

    <style>
        td, th{
            text-align: left;
            white-space: nowrap;

        }
    </style>
</head>

<body>

    <table style="font-size: 10px; width:100%;" >
        <thead>
            <th colspan="12">Relatório de Pesagens</th>
        </thead>
        <thead style="border-bottom: solid 0.5px #737373">
            <tr>
                <th>Ticket</th>
                <th>Data</th>
                <th>Placa</th>
                <th>Seq.</th>
                <th colspan="2">Parceiro</th>
                <th colspan="2">Produto</th>
                <th colspan="2">Motorista</th>
                <th colspan="3">Peso Tara</th>
                <th colspan="3">Peso Bruto</th>
                <th>Peso Líquido</th>
                <th>Tp.</th>
                <th>St.</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($pesagens as $pesagem)
                <tr>
                    <td> {{ $pesagem->id }}</td>
                    <td>{{ Carbon\Carbon::parse($pesagem->data)->format('d/m/Y') }}</td>
                    <td>{{ $pesagem->placa }}</td>
                    <td>{{ $pesagem->sequencia }}</td>
                    <td>{{ $pesagem->parceiro_id }}</td>
                    <td >{{ $pesagem->parceiro }}</td>
                    <td>{{ $pesagem->produto_id }}</td>
                    <td>{{ $pesagem->produto }}</td>
                    <td>{{ $pesagem->motorista_id}}</td>
                    <td>{{ $pesagem->motorista}}</td>
                    <td>{{str_replace(',','.',number_format($pesagem->peso_tara, 0)) }}</td>
                    <td>{{ $pesagem->data_tara}}</td>
                    <td>{{ $pesagem->hora_tara}}</td>
                    <td>{{str_replace(',','.',number_format($pesagem->peso_bruto, 0)) }}</td>
                    <td>{{ $pesagem->data_bruto}}</td>
                    <td>{{ $pesagem->hora_bruto}}</td>
                    <td>{{str_replace(',','.',number_format($pesagem->peso_liquido, 0)) }}</td>
                    <td>{{ $pesagem->movimentacao}}</td>
                    <td>{{ $pesagem->situacao   }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="12" style="border-top:0.5px solid #666; height:10px;"></td>
            </tr>  
            <tr>
                <td colspan="9"></td>
                <td colspan="3"> Total de Cargas: {{$total_cargas}}</td>
            </tr>

        </tbody>
    </table>

</body>

</html>
