            @if (isset($saida_produto->id))
                <form action="{{ route('saida-produto.update', ['saida_produto' => $saida_produto->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                @else
                    <form action="{{ route('saida-produto.store') }}" method="POST">
                        @csrf
            @endif
            <div class="row mb-1">
                <label for="produto_id" class="col-md-4 col-form-label text-md-end text-right">Produto</label>
                <div class="col-md-6">
                    <select name="produto_id" id="" class="form-control">
                        <option value=""> --Selecione o Produto--</option>
                        @foreach ($produtos as $produto)
                            <option value="{{ $produto->id }}"
                                {{ ($saida_produto->produto_id ?? old('produto_id')) == $produto->id ? 'selected' : '' }}>
                                {{ $produto->nome }}</option>
                        @endforeach
                    </select>
                    {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="quantidade" class="col-md-4 col-form-label text-md-end text-right">Quantidade</label>
                <div class="col-md-6">
                    <input name="quantidade" id="quantidade" type="text" class="form-control "
                        value="{{ $saida_produto->quantidade ?? old('quantidade') }}">
                    {{ $errors->has('quantidade') ? $errors->first('quantidade') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="motivo" class="col-md-4 col-form-label text-md-end text-right">Tipo de Saida</label>
                <div class="col-md-6">
                    <select name="motivo" id="" class="form-control">
                        <option value=""> --Selecione o tipo de Saida--</option>
                        @foreach ($tipos_saida as $tipo_saida)
                            <option value="{{ $tipo_saida->id }}"
                                {{ ($saida_produto->motivo ?? old('motivo')) == $tipo_saida->id ? 'selected' : '' }}>
                                {{ $tipo_saida->motivo }}</option>
                        @endforeach
                    </select>
                    {{ $errors->has('motivo') ? $errors->first('motivo') : '' }}
                </div>
            </div>

            <div class="row mb-3">
                <label for="data" class="col-md-4 col-form-label text-md-end text-right">Data</label>
                <div class="col-md-6">
                    <input name="data" id="data" type="date" class="form-control "
                        value="{{ $saida_produto->data ?? old('data') }}">
                    {{ $errors->has('data') ? $errors->first('data') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="observacao"class="col-md-4 col-form-label text-md-end text-right">Observações</label>
                <div class="col-md-6">
                    <textarea class="form-control-template p-2" name="observacao" >
                        {{$saida_produto->observacao ?? old('observacao')}}
                    </textarea>
                </div>
            </div>


            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($saida_produto) ? 'Atualizar' : 'Cadastrar' }}
                    </button>
                </div>
            </div>
            </form>
