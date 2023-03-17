            @if (isset($entrada_produto->id))
                <form action="{{ route('entrada-produto.update', ['entrada_produto' => $entrada_produto->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                @else
                    <form action="{{ route('entrada-produto.store') }}" method="POST">
                    @csrf
            @endif

            <div class="row mb-1">
                <label for="produto_id" class="col-md-4 col-form-label text-md-end text-right">Produto</label>
                <div class="col-md-6">
                    <select name="produto_id" id="" class="form-control">
                        <option value=""> --Selecione o Produto--</option>
                        @foreach ($produtos as $produto)
                            <option value="{{ $produto->id }}"
                                {{($produto_selected ?? $entrada_produto->produto_id ?? old('produto_id'))== $produto->id ? 'selected' : ''}}>{{ $produto->nome }}
                            </option>
                        @endforeach
                    </select>
                    {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="fornecedor_id" class="col-md-4 col-form-label text-md-end text-right">Fornecedor</label>
                <div class="col-md-6">
                    <select name="fornecedor_id" id="" class="form-control">
                        <option value=""> --Selecione o fornecedor--</option>
                        @foreach ($fornecedores as $fornecedor)
                            <option value="{{ $fornecedor->id }}"
                                {{ ($entrada_produto->fornecedor_id ?? old('fornecedor_id')) == $fornecedor->id ? 'selected' : '' }}>
                                {{ $fornecedor->nome_fantasia}}</option>
                        @endforeach
                    </select>
                    {{ $errors->has('fornecedor_id') ? $errors->first('fornecedor_id') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="quantidade" class="col-md-4 col-form-label text-md-end text-right">Quantidade</label>
                <div class="col-md-6">
                    <input name="quantidade" id="quantidade" type="text" class="form-control "
                        value="{{ $entrada_produto->quantidade ?? old('quantidade') }}">
                    {{ $errors->has('quantidade') ? $errors->first('quantidade') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="nota_fiscal" class="col-md-4 col-form-label text-md-end text-right">Nota Fiscal</label>
                <div class="col-md-6">
                    <input name="nota_fiscal" id="nota_fiscal" type="text" class="form-control "
                        value="{{ $entrada_produto->nota_fiscal ?? old('nota_fiscal') }}">
                    {{ $errors->has('nota_fiscal') ? $errors->first('nota_fiscal') : '' }}
                </div>
            </div>

            <div class="row mb-3">
                <label for="data" class="col-md-4 col-form-label text-md-end text-right">Data</label>
                <div class="col-md-6">
                    <input name="data" id="data" type="date" class="form-control "
                        value="{{ $entrada_produto->data ?? old('data') }}">
                    {{ $errors->has('data') ? $errors->first('data') : '' }}
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($entrada_produto->id) ? 'Atualizar' : 'Cadastrar' }}
                    </button>
                </div>
            </div>
            </form>
