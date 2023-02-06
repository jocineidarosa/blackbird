<div class="tab-pane fade {{$tab_active == 'product'? 'show active' : ''}}" id="produto_obra" role="tabpanel" aria-labelledby="produto_obra_tab">
    <form
        action="{{ isset($ordem_producao) ? route('ordem-producao.store-produto-obra', ['ordem_producao' => $ordem_producao]) : '#' }}"
        method="POST">
        @csrf


        <div class="row mb-1">
            <label for="quant_producao" class="col-md-4 col-form-label text-md-end text-right">Produção do dia</label>
            <div class="col-md-6">
                <input name="quant_producao" id="quant_producao" type="text" class="form-control-disabled"
                    value="{{isset($ordem_producao) ? $ordem_producao->quantidade_producao : '' }}" disabled>
            </div>
        </div>

        <div class="row mb-1">
            <label for="obra_id" class="col-md-4 col-form-label text-md-end text-right">Obra</label>
            <div class="col-md-6">
                <select name="obra_id" id="obra_id" class="form-control-template" required autofocus>
                    <option value=""> --Selecione a Obra--</option>
                    @foreach ($obras as $obra)
                        <option value="{{ $obra->id }}"
                            {{ ($ordem_producao->obra_id ?? old('obra_id')) == $obra->id ? 'selected' : '' }}>
                            {{ $obra->nome ?? old('obra_id') }}
                        </option>
                    @endforeach
                </select>
                {{ $errors->has('obra_id') ? $errors->first('obra_id') : '' }}
            </div>
        </div>

        <div class="row mb-1">
            <label for="produto_id" class="col-md-4 col-form-label text-md-end text-right">Produto</label>
            <div class="col-md-6">
                <select name="produto_id" id="produto_id" class="form-control-template" required autofocus>
                    <option value=""> --Selecione o Produto--</option>
                    @foreach ($produtos as $produto)
                        <option value="{{ $produto->id }}"
                            {{ ($ordem_producao->produto_id ?? old('produto_id')) == $produto->id ? 'selected' : '' }}>
                            {{ $produto->nome ?? old('produto_id') }}
                        </option>
                    @endforeach
                </select>
                {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}
            </div>
        </div>

        <div class="row mb-1">
            <label for="quantidade" class="col-md-4 col-form-label text-md-end text-right">Quantidade</label>
            <div class="col-md-6">
                <input name="quantidade" id="quantidade" type="text" class="form-control">
            </div>
        </div>

        <div class="row mb-1">
            <label for="qtde_cargas" class="col-md-4 col-form-label text-md-end text-right">Qtde
                Cargas</label>
            <div class="col-md-6">
                <input name="qtde_cargas" id="qtde_cargas" type="text" class="form-control">
            </div>
        </div>

        <div class="row mb-1">
            <label for="transportadora_id" class="col-md-4 col-form-label text-md-end text-right">Transportadora</label>
            <div class="col-md-6">
                <select name="transportadora_id" id="transportadora_id" class="form-control-template" required
                    autofocus>
                    <option value=""> --Selecione o Produto--</option>
                    @foreach ($transportadoras as $transportadora)
                        <option value="{{ $transportadora->id }}"
                            {{ ($ordem_producao->transportadora_id ?? old('transportadora_id')) == $transportadora->id ? 'selected' : '' }}>
                            {{ $transportadora->nome ?? old('transportadora_id') }}
                        </option>
                    @endforeach
                </select>
                {{ $errors->has('transportadora_id') ? $errors->first('transportadora_id') : '' }}
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
            <div>SAIDA DE MATERIAL PARA OBRA</div>
        </div>
        <div class="card-body">
            <table class="table-template table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="th-title">OBRA</th>
                        <th scope="col" class="th-title">PRODUTO</th>
                        <th scope="col" class="th-title">QUANTIDADE</th>
                        <th scope="col" class="th-title">QTDE CARGAS</th>
                        <th scope="col" class="th-title">TRANSPORTADORA</th>
                        <th scope="col" class="th-title">OPERAÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($produtos_obra)
                        @foreach ($produtos_obra as $produto_obra)
                            <tr>
                                <td>{{ $produto_obra->obra->nome }}</td>
                                <td>{{ $produto_obra->produto->nome }}</td>
                                <td>{{ $produto_obra->quantidade }}</td>
                                <td>{{ $produto_obra->qtde_cargas }}</td>
                                <td>{{ $produto_obra->transportadora->nome ?? '' }}</td>
                                <td>
                                    <div class="btn-group btn-group-actions visible-on-hover">
                                        <a class="btn btn-sm-template btn-outline-primary" href="#"><i
                                                class="icofont-eye-alt"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-outline-success"
                                            href="#">
                                            <i class="icofont-ui-edit"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-outline-danger" href="#"
                                            onclick="document.getElementById('form_{{ $produto_obra->id }}').submit()">
                                            <i class="icofont-ui-delete"></i>
                                        </a>
                                        <form id="form_{{ $produto_obra->id }}" method="post"
                                            action="{{ route('ordem-producao.destroy-produto-obra', [
                                                'produto_obra' => $produto_obra->id,
                                                'ordem_producao' => $ordem_producao->id,
                                            ]) }}">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
