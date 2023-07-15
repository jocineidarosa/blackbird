<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

   {{--  <style>
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
    </style> --}}
</head>

<body>

    <table class="table-striped">
        <thead>
            <th colspan="5">ABASTECIMENTOS</th>
        </thead>
        <thead>
            <tr>
                <th>Cod</th>
                <th>Equipamento</th>
                <th>Produto</th>
                <th>quantidade</th>
                <th>Data</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($abastecimentos as $abastecimento)
                <tr>
                    <th scope="row">{{ $abastecimento->id }}</td>
                    <td>{{ $abastecimento->equipamento }}</td>
                    <td>{{ $abastecimento->produto }}</td>
                    <td>{{ $abastecimento->quantidade }}</td>
                    <td>{{date('d/m/Y', strtotime($abastecimento->data)) }}</td>
                </tr>
            @endforeach
            <tr style="background-color: #92989c; color:rgb(1, 1, 1);">
                <td colspan="2"></td>
                <td >TOTAL</td>
                <td >{{$total_quant}}</td>
                <td ></td>
            </tr>
        </tbody>
    </table>

</body>

</html>
