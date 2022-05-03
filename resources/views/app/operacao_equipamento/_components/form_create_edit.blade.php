            @if (isset($produto->id))
                <form action="{{ route('recursos-producao.update', ['operacao' => $operacao->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                @else
                    <form action="{{ route('recursos-producao.store_avulso') }}" method="POST">
                        @csrf
            @endif
            <div class="card-body">
                <div class="row mb-1">
                    <label for="equipamento_id"
                        class="col-md-4 col-form-label text-md-end text-right">Equipamento</label>
                    <div class="col-md-6">
                        <select name="equipamento_id" id="equipamento_id" class="form-control" autofocus>
                            <option value=""> --Selecione o Equipamento--</option>
                            @foreach ($equipamentos as $equipamento)
                                <option value="{{ $equipamento->id }}">
                                    {{ $equipamento->nome }}</option>
                            @endforeach
                        </select>
                        {{ $errors->has('equipamento_id') ? $errors->first('equipamento_id') : '' }}
                    </div>
                </div>

                <div class="row mb-1">
                    <label for="produto" class="col-md-4 col-form-label text-md-end text-right">Material
                        Utilizado</label>

                    <div class="col-md-6">
                        <select name="produto_id" id="" class="form-control" required>
                            <option value=""> --Selecione o Material-</option>
                            @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}">
                                    {{ $produto->nome }}</option>
                            @endforeach
                        </select>
                        {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}
                    </div>
                </div>

                <div class="row mb-1">
                    <label for="quantidade" class="col-md-4 col-form-label text-md-end text-right">Qtde. Material
                        Utilizado</label>

                    <div class="col-md-6">
                        <input name="quantidade" id="quantidade" type="number" class="form-control "
                            quantidade="quantidade" value="{{ $produto->quantidade ?? old('quantidade') }}" required>
                        {{ $errors->has('quantidade') ? $errors->first('quantidade') : '' }}
                    </div>
                </div>

                <div class="row" style="width:60%;">
                    <div class="col mb-2">
                        <label for="horimetro_inicial">Horímetro Inicial</label>
                        <input name="horimetro_inicial" id="horimetro_inicial" class="form-control-disabled" disabled
                            horimetro_inicial="horimetro_inicial"
                            value="{{ $produto->horimetro_inicial ?? old('horimetro_inicial') }}">
                        {{ $errors->has('horimetro_inicial') ? $errors->first('horimetro_inicial') : '' }}
                    </div>

                    <div class="col mb-2">
                        <label for="horimetro_final">Horímetro Final</label>
                        <input name="horimetro_final" id="horimetro_final" step="0.01" type="number"
                            class="form-control" value="{{ $produto->horimetro_final ?? old('horimetro_final') }}"
                            onchange="calcHorimetro();">
                        {{ $errors->has('horimetro_final') ? $errors->first('horimetro_final') : '' }}
                    </div>

                    <div class="col mb-2">
                        <label for="total_horimetro">Total</label>
                        <input name="total_horimetro" id="total_horimetro" class="form-control" disabled>
                    </div>
                </div>



                <div class="row mb-1">
                    <label for="data_inicio" class="col-md-4 col-form-label text-md-end text-right">Data Inicial</label>

                    <div class="col-md-6">
                        <input name="data_inicio" id="data_inicio" type="date" class="form-control "
                            value="{{ old('data_inicio') }}">
                        {{ $errors->has('data_inicio') ? $errors->first('data_inicio') : '' }}
                    </div>
                </div>


                <div class="row mb-1">
                    <label for="data_fim" class="col-md-4 col-form-label text-md-end text-right">Data Final</label>

                    <div class="col-md-6">
                        <input name="data_fim" id="data_fim" type="date" class="form-control" data_fim="data_fim"
                            value="{{ $ordem_producao->data_fim ?? old('data_fim') }}">
                        {{ $errors->has('data_fim') ? $errors->first('data_fim') : '' }}

                    </div>
                </div>

                <div class="row mb-1">
                    <label for="hora_inicio" class="col-md-4 col-form-label text-md-end text-right">Hora Inicial</label>

                    <div class="col-md-6">
                        <input name="hora_inicio" id="hora_inicio" type="time" class="form-control"
                            hora_inicio="hora_inicio"
                            value="{{ $ordem_producao->hora_inicio ?? old('hora_inicio') }}">
                        {{ $errors->has('hora_inicio') ? $errors->first('hora_inicio') : '' }}

                    </div>
                </div>

                <div class="row mb-1">
                    <label for="hora_fim" class="col-md-4 col-form-label text-md-end text-right">Hora Final</label>

                    <div class="col-md-6">
                        <input name="hora_fim" id="hora_fim" type="time" class="form-control" hora_fim="hora_fim"
                            value="{{ $ordem_producao->hora_fim ?? old('hora_fim') }}">
                        {{ $errors->has('hora_fim') ? $errors->first('hora_fim') : '' }}

                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">Cadastrar </button>
                    </div>
                </div>
                </form>
            </div>

            <script>
                $(function() {
                    $('#equipamento_id').change(function() {
                        var equipamento_id = $("#equipamento_id option:selected").val();
                        $("#horimetro_inicial").val('');
                        $.ajax({
                            url: "{{ route('utils.get-horimetro-inicial') }}",
                            type: "get",
                            data: {
                                'equipamento_id': equipamento_id,
                                'table': 'recursos_producao'
                            },
                            dataType: "json",
                            success: function(response) {
                                $("#horimetro_inicial").val(response);
                            }
                        })

                    });


                });

                function calcHorimetro() {
                    var horimetro_inicial = document.getElementById('horimetro_inicial').value;
                    var horimetro_final = document.getElementById('horimetro_final').value;
                    var total_horimetro = horimetro_final - horimetro_inicial;
                    document.getElementById('total_horimetro').value = total_horimetro.toFixed(2);
                }

                window.onload = function() {
                    let data_atual = new Date();
                    var dia = String(data_atual.getDate()).padStart(2, '0');
                    var mes = String(data_atual.getMonth() + 1).padStart(2, '0');
                    var ano = data_atual.getFullYear();
                    data_atual = ano + '-' + mes + '-' + dia;
                    document.getElementById("data_inicio").value = data_atual;
                    document.getElementById("data_fim").value = data_atual;
                }
            </script>
