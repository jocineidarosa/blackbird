<div class="card">
    <div class="card-header-template">
        <div><i class="icofont-list mr-2"></i>LISTAGEM DE ABASTECIMENTOS</div>
    </div>
    <div class="card-body">
        <table style="width: 100%">
            <thead>
                <tr style="border=1px solid #0a0a0a;">
                    <th style="width: 10%; align=left; border=1px solid #0a0a0a;">Id</th>
                    <th style="width:30%; align=left; border=1px solid #0a0a0a;" >Equipamento</th>
                    <th style="width: 20%; border=1px solid #0a0a0a;">Produto</th>
                    <th style="width: 20px; border=1px solid #0a0a0a;">quantidade</th>
                    <th style="width: 20px; border=1px solid #0a0a0a;">Data</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($abastecimentos as $abastecimento)
                    <tr>
                        <th >{{ $abastecimento->id }}</td>
                        <td>{{ $abastecimento->equipamento }}</td>
                        <td>{{ $abastecimento->produto }}</td>
                        <td>{{ $abastecimento->quantidade }}</td>
                        <td>{{ $abastecimento->data }}</td>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>
