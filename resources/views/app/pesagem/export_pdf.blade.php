<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        table {
            border: 0.2px solid #c7c7c7;
            border-collapse: collapse;
            width: 100%;
        }

        th {
            border: 0.2px solid #aeaeae;
            background-color: #ebebeb;
        }

        td {
            border: 0.2px solid #b2a7a7;
        }

        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #ececec;
        }
    </style>
</head>

<body>

    <table class="table-striped">
        <thead>
            <th colspan="12">ABASTECIMENTOS</th>
        </thead>
        <thead>
            <tr>
                <th>Id</th>
                <th>Data</th>
                <th>Placa</th>
                <th>Seq.</th>
                <th>Parceiro</th>
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
                    <th scope="row">{{ $pesagem->id }}</td>
                    <td>{{ $pesagem->data }}</td>
                    <td>{{ $pesagem->placa }}</td>
                    <td>{{ $pesagem->sequencia }}</td>
                    <td>{{ $pesagem->parceiro }}</td>
                    <td>{{ $pesagem->produto }}</td>
                    <td>{{ $pesagem->motorista   }}</td>
                    <td>{{ $pesagem->peso_tara }}</td>
                    <td>{{ $pesagem->peso_bruto }}</td>
                    <td>{{ $pesagem->peso_liquido }}</td>
                    <td>{{ $pesagem->movimentacao}}</td>
                    <td>{{ $pesagem->situacao   }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

</body>

</html>
