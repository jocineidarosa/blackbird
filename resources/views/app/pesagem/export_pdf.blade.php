<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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
                <th style="width:15%;">Parceiro</th>
                <th>Produto</th>
                <th>Motorista</th>
                <th>Peso Tara</th>
                <th>Peso Bruto</th>
                <th>Peso Líquido</th>
                <th>Tipo</th>
                <th>Situação</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($pesagens as $pesagem)
                <tr>
                    <td> {{ $pesagem->id }}</td>
                    <td>{{ Carbon\Carbon::parse($pesagem->data)->format('d/m/Y') }}</td>
                    <td>{{ $pesagem->placa }}</td>
                    <td>{{ $pesagem->sequencia }}</td>
                    <td >{{ $pesagem->parceiro }}</td>
                    <td>{{ $pesagem->produto }}</td>
                    <td>{{ $pesagem->motorista   }}</td>
                    <td>{{str_replace(',','.',number_format($pesagem->peso_tara, 0)) }}</td>
                    <td>{{str_replace(',','.',number_format($pesagem->peso_bruto, 0)) }}</td>
                    <td>{{str_replace(',','.',number_format($pesagem->peso_liquido, 0)) }}</td>
                    <td>{{ $pesagem->movimentacao}}</td>
                    <td>{{ $pesagem->situacao   }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

</body>

</html>
