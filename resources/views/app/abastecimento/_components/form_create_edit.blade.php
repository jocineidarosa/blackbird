@if (isset($abastecimento->id))
    <form id="frmDados" action="{{ route('abastecimento.update', ['abastecimento' => $abastecimento->id]) }}"
        method="POST">
        @csrf
        @method('PUT')
    @else
        <form id="frmDados" action="{{ route('abastecimento.store') }}" method="POST">
            @csrf
@endif

<div class="row mb-1 disabled">
    <label for="equipamento_id" class="col-md-4 col-form-label text-md-end text-right">Equipamento</label>
    <div class="col-md-6">
        <select name="equipamento_id" id="equipamento_id" class="form-control-template" autofocus>
            <option value=""> --equipamento--</option>
            @foreach ($equipamentos as $equipamento)
                <option value="{{ $equipamento->id }}"
                    {{ ($abastecimento->equipamento_id ?? old('equipamento_id')) == $equipamento->id ? 'selected' : '' }}>
                    {{ $equipamento->nome . '    |    ' . $equipamento->cod_operacao }}</option>
            @endforeach
        </select>
        @if ($errors->has('equipamento_id'))
            <div class="alert-error alert-danger">
                {{ $errors->first('equipamento_id') }}
            </div>
        @endif
    </div>
</div>

<div class="row mb-1">
    <label for="produto_id" class="col-md-4 col-form-label text-md-end text-right">Produto</label>

    <div class="col-md-6">
        <select name="produto_id" id="produto_id" class="form-control-template">
            <option value=""> --Selecione o produto--</option>
            @foreach ($produtos as $produto)
                <option value="{{ $produto->id }}"
                    {{ ($abastecimento->produto_id ?? old('produto_id')) == $produto->id ? 'selected' : '' }}>
                    {{ $produto->nome }}</option>
            @endforeach
        </select>
        @if ($errors->has('produto_id'))
            <div class="alert-error alert-danger">
                {{ $errors->first('produto_id') }}
            </div>
        @endif
    </div>
</div>

<div class="row mb-1">
    <label for="data" class="col-md-4 col-form-label text-md-end text-right">Data</label>
    <div class="col-md-6">
        <input id="data" name="data" type="date" class="form-control-template"
            value="{{ $abastecimento->data ?? old('data') }}">
        @if ($errors->has('data'))
            <div class="alert-error alert-danger">
                {{ $errors->first('data') }}
            </div>
        @endif
    </div>
</div>

<div class="row mb-1">
    <label for="medidor_inicial" class="col-md-4 col-form-label text-md-end text-right">Medidor Inicial</label>
    <div class="col-md-6">
        <input id="medidor_inicial" name="medidor_inicial" type="text" class="form-control-disabled" readonly
            value="{{ $abastecimento->medidor_inicial ?? '' }}">
    </div>
</div>

<div class="row mb-1">
    <label for="medidor_final" class="col-md-4 col-form-label text-md-end text-right">Medidor Final</label>
    <div class="col-md-6">
        <input id="medidor_final" name="medidor_final" type="text" class="form-control-template"
            value="{{ $abastecimento->medidor_final ?? old('medidor_final') }}">
    </div>
</div>

<div class="row mb-1">
    <label for="quantidade" class="col-md-4 col-form-label text-md-end text-right">Quantidade</label>
    <div class="col-md-6">
        <input id="quantidade" type="text" class="form-control-template" name="quantidade"
            placeholder="Calcula automático (opcional)" value="{{ $abastecimento->quantidade ?? old('quantidade') }}">
        @if ($errors->has('quantidade'))
            <div class="alert-error alert-danger">
                {{ $errors->first('quantidade') }}
            </div>
        @endif
    </div>
</div>

<div class="row mb-1">
    <label for="horimetro_inicial" class="col-md-4 col-form-label text-md-end text-right">Horímetro Inicial</label>
    <div class="col-md-6">
        <input id="horimetro_inicial" name="horimetro_inicial" type="text" class="form-control-disabled" disabled
            value="{{ $abastecimento->horimetro_inicial ?? old('horimetro_inicial') }}">
    </div>
</div>
<div class="row mb-1">
    <label for="horimetro" class="col-md-4 col-form-label text-md-end text-right">Horímetro Final</label>
    <div class="col-md-6">
        <input id="horimetro_final" name="horimetro" type="text" class="form-control-template"
            value="{{ $abastecimento->horimetro ?? old('horimetro') }}">
        {{ $errors->has('horimetro') ? $errors->first('horimetro') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="qtde_horimetro" class="col-md-4 col-form-label text-md-end text-right">Quantidade de Horas</label>
    <div class="col-md-6">
        <input id="qtde_horimetro" name="qtde_horimetro" type="text" class="form-control-disabled" disabled
            value="{{ $total_horimetro ?? old('qtde_horimetro') }}">
        {{ $errors->has('qtde_horimetro') ? $errors->first('qtde_horimetro') : '' }}
    </div>
</div>

<div class="row mb-1">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary" id="submit">
            {{ isset($abastecimento) ? 'Atualizar [F5]' : 'Cadastrar [F5]' }}
        </button>
    </div>
</div>
</form>

<script>
    $(document).ready(function() {
        $('#equipamento_id').select2();
        $('#produto_id').select2();
    });

    document.addEventListener("keypress", function(e) {
        if (event.ctrlKey && event.key == "Enter") {
            document.querySelector('#submit').click();
        }

    });

    $(function() {
        $('#produto_id').change(function() {
            var produto_id = $("#produto_id option:selected").val();
            $("#medidor_inicial").val(''); //limpa horímetro inicial
            $.ajax({
                url: "{{ route('abastecimento.busca_contador_inicial') }}",
                type: "get",
                data: {
                    'table': 'abastecimentos',
                    'produto_id': produto_id
                },
                dataType: "json",
                success: function(response) {
                    $("#medidor_inicial").val(response);
                }
            })
        });

        $('#medidor_final').change(function() {
            var medidor_inicial = $('#medidor_inicial').val();
            var medidor_final = $('#medidor_final').val();
            if (medidor_inicial > 0 && medidor_final > 0) {
                var quantidade = medidor_final - medidor_inicial;
                $('#quantidade').val(quantidade);
            }
        });

        //busca Horímetro inicial
        $('#data').change(function() {
            var equipamento_id = $("#equipamento_id option:selected").val();
            var vdata = $("#data").val();
            $("#horimetro_inicial").val(''); //limpa horímetro inicial
            $.ajax({
                url: "{{ route('utils-get-horimetro-inicial-by-data') }}",
                type: "get",
                data: {
                    'equipamento_id': equipamento_id,
                    'data': vdata
                },
                dataType: "json",
                success: function(response) {
                    $("#horimetro_inicial").val(response);
                }
            })
        });

        // se o horímetro final for menor que o inicial da uma mensagem de erro
        $('#horimetro_final').change(function() {
            var horimetro_inicial = $('#horimetro_inicial').val();
            var horimetro_final = $('#horimetro_final').val();
            var total_horas = horimetro_final - horimetro_inicial;
            total_horas = total_horas.toFixed(2);
            if (total_horas > 0) {
                $('#qtde_horimetro').val(total_horas);
            } else {
                alert('O Horímetro Final deve ser maior que o horímeto inicial');
                $('#horimetro_final').val('');
                $('#horimetro_final').focus();
            }
        })

    });
</script>
