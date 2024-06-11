<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0/dist/css/bootstrap-select.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" />
    


    <link rel="stylesheet" href="{{ asset('css/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/start_card_modal.css') }}">


    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-crosshair@1.2.0/dist/chartjs-plugin-crosshair.min.js"></script>{{-- linha que corre com o mouse --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>{{--###GERAÇÃO DE GRÁFICO DE PRODUÇÃO --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>{{-- gráfico da google --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.1.0/autoNumeric.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script> --}}
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script src="{{ asset('js/maskedit.js') }}"></script>
    <title>DBMAXIS</title>
</head>

<body>
    <div id="modalx" class="modalx">
        <div class="modalx-content">
            <span class="close-button" id="close-button">&times;</span>
            <h3>Mensagem Informativa: Testes de Monitoramento na Britagem</h3>
            <p>Prezados Colaboradores,</p>
            <p>Gostaríamos de informá-los que estamos implementando novos testes de monitoramento no setor de britagem. Estas mudanças visam otimizar nosso sistema e aumentar a eficiência operacional. Os seguintes parâmetros estão sendo monitorados:</p>
            <ul>
                <li><strong>Horímetros:</strong> Controle do tempo de operação das máquinas.</li>
                <li><strong>Total de Energia Gasta:</strong> Monitoramento do consumo energético durante o processo de britagem.</li>
                <li><strong>Produção por Hora:</strong> Avaliação da quantidade de material processado a cada hora.</li>
                <li><strong>Produção Total:</strong> Medição do volume total de produção ao longo do período de testes.</li>
            </ul>
            <p>Esses testes são fundamentais para identificar oportunidades de melhoria e garantir que nossos processos sejam mais eficientes e sustentáveis. Agradecemos a colaboração de todos e contamos com o apoio de cada um para o sucesso desta iniciativa.</p>
            <p>Atenciosamente,</p>
            <p>Jocinei da Rosa</p>
        </div>
    </div>

    @include('app.layouts.topbar')
    @include('app.layouts.sidebar')
    @include('app.layouts.components.logout_modal')

    <main class="mt-5 pt-3">
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>

    
    {{-- <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('js/innout.js') }}"></script>

</body>


</html>