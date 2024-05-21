<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>


    <style>
        * {
            margin: 5;
        }

        header.header {
            /*position: relative;*/
            position: sticky;
            top: 0;
            max-height: 100px;
            grid-area: header;
            display: flex;
            background-color: #a2b3ff;
            align-items: center;
            z-index: 10;
        }

        header.header .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #20313d;
            font-size: 1.5rem;
            flex-basis: 250px;
            height: 100%;
        }

        header.header .menu-toggle {
            color: #20313d;
            cursor: pointer;
        }

        header.header .spacer {
            flex-grow: 1;

        }

        header.header .dropdown {
            position: relative;
        }

        header.header .dropdown-button {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            font-size: 1.1rem;
            color: #20313d;
            cursor: pointer;

        }

        header.header .dropdown-content {
            display: none;
            position: absolute;
            min-width: 100%;
            background-color: #c9dacc;
            padding: 3px 0px 10px;
            z-index: 100;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, .2);

        }

        header.header .dropdown:hover .dropdown-content {
            transition-delay: 10s;
            display: block;


        }

        header.header .dropdown-content ul {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }

        header.header .dropdown-content a {
            align-items: center;
            display: flex;
            text-decoration: none;
            color: #20313d;
            padding: 5px;
            font-size: 1.1rem;
        }

        header.header .dropdown-content a:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        header.header .dropdown:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        header.header .avatar {
            height: 2rem;
            /*era pra ser height 80% mas não deu certo*/
            border-radius: 50%;
            margin-left: 10px;

        }


        aside.sidebar {
            grid-area: sidebar;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #6698ca;

        }

        aside.sidebar .menu {
            width: 100%;
            flex-grow: 1;

        }

        aside.sidebar .menu ul.nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        aside.sidebar .menu li.nav-item {
            padding: 8px 0px 8px 25px;
            margin: 0;
        }

        aside.sidebar .menu li.nav-item a {
            font-size: 0.95rem;
            text-decoration: none;
            color: #20313d;

        }

        body.hide-sidebar aside.sidebar {
            display: none;
        }

        aside.sidebar .icon {
            font-size: 3.2rem;
            margin: 2px 10px 2px 0px;

        }

        aside.sidebar .sidebar-widget .info {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .division {
            widows: 80%;
            /* width: 80%; */
            border: solid 1px #eee;
        }

        aside.sidebar .info .main {
            font-size: 2rem;
        }


        aside.sidebar .menu li.nav-item:hover {
            background-color: #0000001a;

        }

        main.content .content-title {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding-bottom: 15px;
        }

        main.content .content-title h1 {
            color: #444;
            font-size: 1rem;
            font-weight: 300;
            margin: 0;
        }

        main.content .content-title h2 {
            color: #888;
            font-size: 1.2rem;
            font-weight: 300;
            margin: 0;
        }

        footer.footer {
            grid-area: footer;
            display: flex;
            background-color: #1976d2;
            background-color: #6698ca;
            color: rgb(44, 44, 44);
            align-items: center;
            justify-content: flex-end;
            padding-right: 20px;
            font-size: 15px;
        }

        .record {
            font-size: 1.8rem;
        }



        .card-header-template {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            color: #37373b;
            padding: 5px 15px;
            margin-bottom: 0;
            background-color: #9fc1cc;
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            font-size: 18px;
        }

        .card-header-template>div i {
            font-size: 22px;
        }

        .card-header-template>div>a>i {
            font-size: 18px;
        }

        .card-body-template {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
        }

        .table-template {
            width: 100%;
            margin-bottom: .2rem;
            background-color: transparent;
            text-transform: uppercase;
            border: 1px solid #939397;
        }

        .table-template td,
        .table-template th {
            padding: .2rem;
            border: 1px solid #bfbfc2;
        }

        table td {
            font-size: small;
            font-weight: 400;
        }

        .th-title {
            background-color: #c9d0da;
            font-weight: 400;
            font-size: 11px;
        }

        .th-normal {
            font-size: 11px;
        }

        .th-title-main {
            background-color: #96acc2;
            font-weight: 400;
            font-size: 12px;
        }

        .form-control-template {
            display: block;
            width: 100%;
            height: calc(2.25rem + 1px);
            padding: .1rem .75rem;
            font-size: 0.9rem;
            line-height: 0.8;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .1rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out
        }

        .form-control-disabled {
            display: block;
            width: 100%;
            height: calc(2.25rem + 1px);
            padding: .1rem .75rem;
            font-size: 0.9rem;
            line-height: 0.8;
            color: rgb(21, 18, 205);
            background-color: rgb(209, 209, 209);
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .1rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out
        }

        .btn-sm-template {
            padding: .1rem .5rem;
            font-size: .8rem;
            font-weight: 400;
            line-height: 1.5;
            border-radius: .2rem
        }

        .card-group {
            display: block;
        }

        .div-op {
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: row;
            width: 80px;
        }

        .btn-filter {
            color: #fff;
            background-color: #c77e1f;
            border-color: #c77e1f;
        }

        .btn-filter:hover {
            color: #fff;
            background-color: #f59210;
            border-color: #f59210;
        }

        .card-header-filter {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            color: #37373b;
            padding: 5px 15px;
            margin-bottom: 0;
            background-color: #ffff;
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            font-size: 18px;
        }

        .painel-estoque-dashboard {
            display: flex;
            flex-direction: row;
            border: solid 1px #cfd4d6;
            border-radius: 3px;
            background: #0928961a;
            padding: 10px;
            margin: 10px auto;
        }

        .field-dash {
            background: #1a308b1a;
            width: 30%;
            margin: auto 5px;
            padding: 10px;
            color: #1879e0;
        }

        .sidebar-brand-icon {
            font-size: 2rem;
            color: #d4d7e0;
            margin-right: 1rem;
        }

        .img-profile {
            height: 1.5rem;
            width: 1.5rem;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .d-lg-inline {
            display: inline !important;
        }

        .shadow {
            box-shadow: 0px 11px 19px 10px rgba(0, 0, 0, 0.932);
        }

        .dropdown-menu-right {
            right: 0;
            left: auto;
        }

        .dropdown-menu-template {
            position: absolute;
            top: 100%;
            z-index: 1000;
            display: none;
            min-width: 10rem;
            padding: .5rem 0;
            margin: 0;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .15);
            border-radius: .25rem;
            box-shadow: 0px 11px 19px 10px rgba(56, 56, 56, 0.8);
        }

        /* slider */
        .container-fluid {
            padding: 0;
        }

        .alert-error {
            position: relative;
            padding: 0.6 rem;
            margin-bottom: 0.3rem;
            border: 1px solid transparent;
            border-radius: .25rem
        }

        table {
            border: 0.2px solid #2c2b2b;
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
    </style>
</head>

<body>

    <table>
        <tr>
            <th colspan="16" class="th-title-main text-center">INFORMAÇÕES SOBRE FUNCIONAMENTO -
                {{ $ordem_producao->equipamento->nome }}</th>
        </tr>
        <tr>

            <td class="text-right th-title pr-2" colspan="2">CÓDIGO</td>
            <td class="pl-2 th-normal" colspan="2">{{ $ordem_producao->id }}</td>
            <td class="text-right th-title pr-2" colspan="2">DATA</td>
            <td class="pl-2 th-normal" colspan="2">{{ Carbon\Carbon::parse($ordem_producao->data)->format('d/m/Y') }}
            </td>
            <td class="th-title pr-2 text-right" colspan="2">SITUAÇÃO</td>
            <td class="pl-2 th-normal" colspan="6">{{ $ordem_producao->status->nome }}</td>
        </tr>

        <tr>
            <td class="text-center th-title" colspan="4">HORÁRIO OPERAÇÃO</td>
            <td class="text-center th-title" colspan="4">HORÍMETRO</td>
            <td colspan="2" class="text-left th-title">PRODUTO</td>
            <td colspan="6" class="th-normal">{{ $ordem_producao->produto->nome }}</td>

        </tr>


        <tr>
            <td class="text-right pr-2 th-title" colspan="2">Início</td>
            <td class="pl-2 th-normal" colspan="2">{{ $ordem_producao->hora_inicio }}</td>
            <td class="text-right pr-2 th-title" colspan="2">Início</td>
            <td class="pl-2 th-normal" colspan="2">{{ number_format($op_horimetro_inicial, 2) }}</td>
            <td class="text-right th-title pr-2" colspan="2">QUANTIDADE</td>
            <td class="pr-2 th-normal" colspan="6">
                {{ str_replace(',', '.', number_format($ordem_producao->quantidade_producao, 0)) }}
                {{ $ordem_producao->produto->unidade_medida->nome }}</td>
        </tr>


        <tr>
            <td class="text-right th-title pr-2" colspan="2">Término</td>
            <td class="pl-2 th-normal" colspan="2">{{ $ordem_producao->hora_fim }}</td>
            <td class="text-right th-title pr-2" colspan="2">Término</td>
            <td class="pl-2 th-normal" colspan="2">{{ number_format($ordem_producao->horimetro_final, 2) }}</td>
            <td class="text-right th-title pr-2" colspan="2">PRODUÇÃO/H</td>
            <td class="pl-2 th-normal" colspan="6">{{ str_replace(',', '.', number_format($producao_por_hora, 0)) }}
            </td>
        </tr>

        <tr>
            <td class="text-right th-title pr-2" colspan="2">Total</td>
            <td class="pl-2 th-normal" colspan="2">{{ $total_horas_equipamento }}</td>
            <td class="text-right th-title pr-2" colspan="2">Total</td>
            <td class="pl-2 th-normal" colspan="2">{{ number_format($total_horimetro, 2) }}</td>
            <td class="th-title" colspan="8"></td>
        </tr>

        <tr>
            <td colspan="16"></td>
        </tr>
        <tr>
            <td colspan="16" class="th-title">Observações</td>
        </tr>

        <tr>
            <td colspan="16" class="th-normal">{{ $ordem_producao->observacao }}</td>
        </tr>
        <tr>
            <td colspan="16"></td>
        </tr>

        <tr>
            <td colspan="16" class="th-title-main">INFORMAÇÕES SOBRE RECURSOS UTILIZADOS</td>
        </tr>
        <tr>
            <td colspan="3" class="th-title">Equipamento</td>
            <td class="th-title" colspan="3">Produto</td>
            <td class="th-title">Consumo</td>
            <td class="th-title">Hm.Inicio</td>
            <td class="th-title">HM.FIM</td>
            <td class="th-title">TOTAL</td>
            <td class="th-title">HR INICIO</td>
            <td class="th-title">HR FIM</td>
            <td class="th-title">TOTAL</td>
            <td class="th-title">CONSUMO/H</td>
            <td class="th-title">CONSUMO/T</td>
            <td class="th-title">Estoque</td>
        </tr>


        @foreach ($recursos_producao as $recurso)
            <tr>
                <td colspan="3" class="th-normal" >{{ $recurso->equipamento }}</td>
                <td colspan="3" class="th-normal" >{{ $recurso->produto }}</td>
                <td class="th-normal">{{ $recurso->quantidade }}</td>
                <td class="th-normal">{{ $recurso->horimetro_inicial }}</td>
                <td class="th-normal">{{ $recurso->horimetro_final }}</td>
                <td class="th-normal">{{ $recurso->total_horimetro }}</td>
                <td class="th-normal">{{ $recurso->hora_inicio }}</td>
                <td class="th-normal">{{ $recurso->hora_fim }}</td>
                <td class="th-normal">{{ $recurso->total_hora }}</td>
                <td class="th-normal">{{ number_format($recurso->consumo_hora, 2) }}</td>
                <td class="th-normal">{{ number_format($recurso->consumo_quant, 2) }}</td>
                <td class="th-normal">{{ number_format($recurso->estoque_final, 2) }}</td>
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
</body>

</html>
