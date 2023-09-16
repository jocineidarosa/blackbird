@extends('app.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header-template">
            <div>Entrada de Produtos</div>
            <div>
                <a href="{{ route('entrada-produto.index') }}" class="btn btn-sm btn-primary">
                    LISTAGEM
                </a>
            </div>
        </div>

        <div class="card-body">
            @component('app.entrada_produto._components.form_create_edit', [
                'produtos' => $produtos,
                'fornecedores' => $fornecedores,
                'produto_selected' => $produto_selected,
            ])
            @endcomponent
        </div>
    </div>
    <script>
         /* document.getElementById("preco").addEventListener("input", function() {
                // Obtém o valor atual do campo de entrada
                var valor = this.value;

                // Substitui todas as vírgulas por pontos
                valor = valor.replace(/\./g, ',');

                // Atualiza o valor do campo de entrada
                this.value = valor;
            }); */

            document.getElementById("preco").addEventListener("input", function() {
            // Obtém o valor atual do campo de entrada
            var valor = this.value;

            // Remove todos os caracteres não numéricos
            valor = valor.replace(/[^0-9,.]/g, '');

            // Substitui os pontos por vírgulas como separadores decimais
            valor = valor.replace(/\./g, ',');

            // Adiciona pontos como separadores de milhar
            valor = valor.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');

            // Atualiza o valor do campo de entrada
            this.value = valor;
        });
          
    </script>
@endsection
