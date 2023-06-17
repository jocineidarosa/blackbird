@extends('app.layouts.app')

@section('titulo', 'Marcas')

@section('content')
    @php
        if (!isset($tab_active)) {
            $tab_active = '';
        }
    @endphp

    <div class="card">
        <div class="card-header-template">
            <div>
                Cadastro de Ordem de Ordem de Produção
            </div>
            <div>
                <a class="btn btn-primary btn-sm" href="{{ route('ordem-producao.index') }}">LISTAGEM</a>
            </div>
        </div>
        <div class="card-body">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="#dados_principais" class="nav-link {{ $tab_active == '' ? 'active' : '' }} mr-1"
                        id="dados_principais_tab" data-bs-toggle="tab" role="tab" aria-controls="dados_principais">Dados
                        Principais</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#recursos"
                        class="nav-link {{ $tab_active == 'recursos' ? 'active' : '' }} mr-1 {{ isset($ordem_producao) ? '' : 'disabled' }}"
                        id="recursos_tab" data-bs-toggle="tab" role="tab" aria-controls="recursos">Recursos</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#paradas_equip"
                        class="nav-link {{ $tab_active == 'stop' ? 'active' : '' }} mr-1 {{ isset($active_stop) ? $active_stop : '' }} {{ isset($ordem_producao) ? '' : 'disabled' }}"
                        id="paradas_equip_tab" data-bs-toggle="tab" role="tab" aria-controls="paradas_equip">
                        Paradas de
                        Equipamentos</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a href="#produto_obra"
                        class="nav-link {{ $tab_active == 'product' ? 'active' : '' }} mr-1 {{ isset($active_exit) ? $active_exit : '' }} {{ isset($ordem_producao) ? '' : 'disabled' }}"
                        id="produto_obra_tab" data-bs-toggle="tab" role="tab" aria-controls="produto_obra">Saída de
                        Produto para Obra</a>
                </li>
            </ul>
            {{-- ####abaixo totod os includes dos views das abas --}}
            {{-- -----------------includes------------------ --}}
            {{-- ORDEM DE PRODUÇÃO --}}
            @include('app.ordem_producao._components.create_principal')
            {{-- ----------------------------------------------------------------------------- --}}
            {{-- RECURSOS --}}
            @include('app.ordem_producao._components.create_recurso')
            {{-- ---------------------------------------------------------------------------------- --}}
            {{-- PARADAS --}}
            {{-- Paradas de Equipamento --}}
            @include('app.ordem_producao._components.create_parada_equipamento')

            {{-- --------------------------------------------------------------------------------------------------- --}}
            {{-- MATERIAIS --}}
            {{-- Saida Materiais --}}
            @include('app.ordem_producao._components.create_saida_material')
        </div>

    </div>

    </div>



    <script>
        $(function() {
            //Ajax: busca o estoque final de produto pela medida em cm.
            $('#medida_final').change(function() {
                var equipamento_id = $("#equipamento_recursos option:selected").val();
                var medida_final = $('#medida_final').val();
                var ajax_ok = false;
                $.ajax({
                    url: "{{ route('utils.get-estoque-final') }}",
                    type: "get",
                    data: {
                        'equipamento_id': equipamento_id,
                        'medida_final': medida_final,
                        'table': 'medidas_tanques'
                    },
                    dataType: "json",
                    success: function(response) {
                        var estoque_final = JSON.stringify(response.estoque_final);
                        $("#estoque_final").val(estoque_final);
                        ajax_ok = true
                    }
                });

            });
            /* calcula o consumo após ter o estoque final */
            $('#bt_calcula_consumo').click(function() {
                var estoque_atual = $('#estoque_atual').val();
                var estoque_final = $('#estoque_final').val();
                if (estoque_atual > 0 && estoque_final > 0) {
                    var quantidade_utilizada = estoque_atual - estoque_final;
                    $('#quantidade').val(quantidade_utilizada);
                }
            })

            /* Busca o estoque atual do produto */
     /*        $('#produto_id').change(function() {
                var produto_id = $('#produto_id option:selected').val();
                var table = 'produtos';
                $.ajax({
                    url: "{{ route('utils.get-estoque-atual') }}",
                    type: "get",
                    data: {
                        "produto_id": produto_id,
                        "table": table
                    },
                    dataType: "json",
                    success: function(response) {
                        var estoque_atual = JSON.stringify(response.estoque_atual);
                        $("#estoque_atual").val(estoque_atual);
                    }
                })

            }) */




            /* Busca o o estoque do tanque de combustivel do equipamento */
            $('#equipamento_recursos').change(function() {
                var equipamento_id = $('#equipamento_recursos option:selected').val();
                var table = 'equipamentos';
                $.ajax({
                    url: "{{ route('utils.get-quant-tanque') }}",
                    type: "get",
                    data: {
                        "equipamento_id": equipamento_id,
                        "table": table
                    },
                    dataType: "json",
                    success: function(response) {
                        var quant_tanque = JSON.stringify(response.quant_tanque);
                        $("#estoque_atual").val(quant_tanque);
                    }
                })

            })

            /* Busca o horímetro inicial do equipamento principal*/
            $('#equipamento_id').change(function() {
                var equipamento_id = $("#equipamento_id option:selected").val();
                $("#horimetro_inicial").val('');//limpa horímetro inicial
                $.ajax({
                    url: "{{ route('utils.get-horimetro-inicial') }}",
                    type: "get",
                    data: {
                        'equipamento_id': equipamento_id,
                        'table': 'ordens_producoes',
                        'field': 'horimetro_final'
                    },
                    dataType: "json",
                    success: function(response) {
                        $("#horimetro_inicial").val(response);
                    }
                })

            });
            /* Busca o horímetro inicial do equipamento em recursos de produção */
            $('#equipamento_recursos').change(function() {
                var equipamento_id = $("#equipamento_recursos option:selected").val();
                $("#horimetro_inicial_recursos").val('');
                $.ajax({
                    url: "{{ route('utils.get-horimetro-inicial') }}",
                    type: "get",
                    data: {
                        'equipamento_id': equipamento_id,
                        'table': 'recursos_producao',
                        'field': 'horimetro_final'
                    },
                    dataType: "json",
                    success: function(response) {
                        $("#horimetro_inicial_recursos").val(response);
                    }
                })
            });


            /* Calcula o total de horas apartir do horímetro */
            $('#horimetro_final').change(function() {
                var horimetro_inicial = $('#horimetro_inicial').val();
                var horimetro_final = $('#horimetro_final').val();
                var total_horimetro = (horimetro_final - horimetro_inicial).toFixed(2);
                $('#total_horimetro').val(total_horimetro);
            });

            /* Calcula a produção por hora */
            $('#quantidade_producao, #horimetro_final').change(function() {
                var total_horimetro = $('#total_horimetro').val();
                var quant_producao = $('#quantidade_producao').val();
                if (quant_producao > 0 && total_horimetro > 0) {
                    var producao_hora = (quant_producao / total_horimetro).toFixed(0);
                    $('#producao_hora').val(producao_hora);
                }
            });

        });

        // executa quando a pagina é carregada
        /* Busca a data atual */
        window.onload = function() {
            let data_atual = new Date();
            var dia = String(data_atual.getDate()).padStart(2, '0');
            var mes = String(data_atual.getMonth() + 1).padStart(2, '0');
            var ano = data_atual.getFullYear();
            data_atual = ano + '-' + mes + '-' + dia;
            var submit = document.getElementById("btCadPrincipal").innerHTML
            submit = submit.trim();
            if (submit == 'Cadastrar') { //se estiver cadastrando traz a data atual, senão traz a data do registro.
                document.getElementById("data").value = data_atual;
            }

        }
        $(document).ready(function() {
        //principal
        $('#equipamento_id').select2();
        $('#produto_id_principal').select2();
        $('#situacao').select2();
        //recursos
        $('#equipamento_recursos').select2();
    });
    </script>

@endsection
{{-- -------------- --}}
