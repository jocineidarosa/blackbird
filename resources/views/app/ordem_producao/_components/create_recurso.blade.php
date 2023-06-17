<div class="tab-pane fade {{ $tab_active == 'recursos' ? 'show active' : '' }} mt-3" id="recursos" role="tabpanel"
    aria-labelledby="recursos-tab">
    <form
        action="{{ isset($ordem_producao) ? route('ordem-producao.store-recursos', ['ordem_producao' => $ordem_producao->id]) : '#' }}"
        method="POST">
        @csrf
        <div class="row mb-1">
            <label for="equipamento_id"
            class="col-md-4 col-form-label text-md-end text-right">Equipamento</label>
            <div class="col-md-6">
                <select name="equipamento_recursos" id="equipamento_recursos" class="form-control-template" autofocus>
                    <option value=""> --Selecione o Equipamento--</option>
                    @foreach ($equipamentos as $equipamento)
                        <option value="{{ $equipamento->id }}">
                            {{ $equipamento->nome }}</option>
                    @endforeach
                </select>
                {{ $errors->has('equipamento_recursos') ? $errors->first('equipamento_recursos') : '' }}
            </div>
        </div>

        <div class="row mb-1">
            <label for="produto" class="col-md-4 col-form-label text-md-end text-right">Material
                Utilizado</label>

            <div class="col-md-6">
                <select name="produto_id" id="produto_id" class="form-control" required>
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
            <label for="estoque_atual" class="col-md-4 col-form-label text-md-end text-right">Estoque
                Atual</label>
            <div class="col-md-6">
                <input name="estoque_atual" id="estoque_atual" type="text" class="form-control-disabled " disabled>
                {{ $errors->has('estoque_atual') ? $errors->first('estoque_atual') : '' }}
            </div>
        </div>

        <div class="row mb-1">
            <label for="medida_final" class="col-md-4 col-form-label text-md-end text-right">Medida
                Final</label>
            <div class="col-md-6">
                <input name="medida_final" id="medida_final" type="number" class="form-control "
                    value="{{ $recurso->medida_final ?? old('medida_final') }}">
                {{ $errors->has('medida_final') ? $errors->first('medida_final') : '' }}
            </div>
        </div>


        <div class="row mb-1">
            <label for="estoque_final" class="col-md-4 col-form-label text-md-end text-right">Estoque
                Final</label>
            <div class="col-md-6">
                <input name="estoque_final" id="estoque_final" type="text" class="form-control-disabled "
                    value="{{ $produto->estoque_final ?? old('estoque_final') }}" disabled>
                {{ $errors->has('estoque_final') ? $errors->first('estoque_final') : '' }}
            </div>
        </div>

        <div class="row mb-1">
            <label for="quantidade" class="col-md-4 col-form-label text-md-end text-right">Qtde.Material
                Utilizado</label>
            <div class="col-md-6">
                <input name="quantidade" id="quantidade" type="number" class="form-control" quantidade="quantidade"
                    value="{{ $produto->quantidade ?? old('quantidade') }}" required>
                {{ $errors->has('quantidade') ? $errors->first('quantidade') : '' }}

            </div>
            <button class="btn btn-secondary" id="bt_calcula_consumo" type="button">
                <i class="icofont-ui-calculator"></i>
            </button>
        </div>

        <div class="row mb-1">
            <label for="horimetro_inicial_recursos" class="col-md-4 col-form-label text-md-end text-right">Horímetro
                Inicial</label>
            <div class="col-md-6">
                <input name="horimetro_inicial_recursos" id="horimetro_inicial_recursos" type="text"
                    class="form-control-disabled" disabled>
            </div>
        </div>

        <div class="row mb-1">
            <label for="horimetro_final" class="col-md-4 col-form-label text-md-end text-right">Horímetro Final</label>
            <div class="col-md-6">
                <input name="horimetro_final" id="horimetro_final" type="text" class="form-control-template">
            </div>
        </div>

        <div class="row mb-1">
            <label for="total_horimetro" class="col-md-4 col-form-label text-md-end text-right">Horímetro Total</label>
            <div class="col-md-6">
                <input name="total_horimetro" id="total_horimetro" type="text" class="form-control-disabled"
                    disabled>
            </div>
        </div>

        <div class="row mb-1">
            <label for="data" class="col-md-4 col-form-label text-md-end text-right">Data</label>
            <div class="col-md-6">
                <input name="data" id="data" type="date" class="form-control"
                    value="{{ $ordem_producao->data ?? old('data') }}">
            </div>
        </div>

        <div class="row mb-1">
            <label for="hora_inicio" class="col-md-4 col-form-label text-md-end text-right">Hora
                Inicial</label>

            <div class="col-md-6">
                <input name="hora_inicio" id="hora_inicio" type="time" class="form-control"
                    hora_inicio="hora_inicio" value="{{ $ordem_producao->hora_inicio ?? old('hora_inicio') }}">
                {{ $errors->has('hora_inicio') ? $errors->first('hora_inicio') : '' }}

            </div>
        </div>

        <div class="row mb-1">
            <label for="hora_fim" class="col-md-4 col-form-label text-md-end text-right">Hora
                Final</label>

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

    <div class="card">
        <div class="card-header-template">
            <div>Recursos de Produção</div>
        </div>
        <div class="card-body">
            <table class="table-template table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="th-title">Id</th>
                        <th scope="col" class="th-title">Equipamento</th>
                        <th scope="col" class="th-title">Produto</th>
                        <th scope="col" class="th-title">Quant</th>
                        <th scope="col" class="th-title">Horm. Final</th>
                        <th scope="col" class="th-title">Operações</th>
                    </tr>
                </thead>

                <tbody>
                    @isset($recursos_producao)
                        @foreach ($recursos_producao as $recurso_producao)
                            <tr>
                                <th scope="row">{{ $recurso_producao->id }}</td>
                                <td>{{ $recurso_producao->equipamento->nome ?? '' }}</td>
                                <td>{{ $recurso_producao->produto->nome }}</td>
                                <td>{{ $recurso_producao->quantidade }}</td>
                                <td>{{ $recurso_producao->horimetro_final ?? '' }}</td>
                                <td>
                                    <div class="btn-group btn-group-actions visible-on-hover">
                                        <a class="btn btn-sm-template btn-outline-primary" href="#"><i
                                                class="icofont-eye-alt"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-outline-success  @can('user') disabled @endcan"
                                            href="#">
                                            <i class="icofont-ui-edit"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-outline-danger" href="#"
                                            onclick="document.getElementById('form_{{ $recurso_producao->id }}').submit()">
                                            <i class="icofont-ui-delete"></i>
                                        </a>
                                        <form id="form_{{ $recurso_producao->id }}" method="post"
                                            action="{{ route('ordem-producao.destroy-recurso-producao', [
                                                'recurso_producao' => $recurso_producao->id,
                                                'ordem_producao' => $ordem_producao->id,
                                            ]) }}">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </div>
                                </td>
                        @endforeach
                    @endisset
                </tbody>
            </table>

        </div>

    </div>
</div>
