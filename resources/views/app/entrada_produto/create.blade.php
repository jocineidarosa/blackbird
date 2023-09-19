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
        function formatarMoeda(numero) {
            numero = numero.replace(/\./g, '').replace(',', '.');
            if (numero === '' || isNaN(numero)) {
                return '';
            }
            var partes = numero.split(".");
            var parteInteira = partes[0];
            var parteDecimal = partes[1] || '00';
            parteInteira = parteInteira.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            return "R$ " + parteInteira + "," + (parteDecimal.length === 1 ? parteDecimal + '0' : parteDecimal);
        }

        function formatCurrency(input) {
            var valor = input.value;
            if (!valor.startsWith("R$ ")) {
                var numeroFormatado = formatarMoeda(valor);
                input.value = numeroFormatado;
            }
        }



        $(function(){
        $('#preco').maskMoney({
          prefix:'R$ ',
          allowNegative: true,
          thousands:'.', decimal:',',
          affixesStay: true});
    })
    </script>
@endsection
