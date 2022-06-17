<!--Classe principal do menu left-->
<aside class="sidebar">
    <nav class="menu mt-3">

        <ul class="accordion-menu">
            <li>
                <div class="dropdownlink">
                    <div>
                        <i class="icofont-layout mr-2"></i>Suprimentos
                    </div>
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </div>
                <ul class="submenuItems">
                    <li class="item-menu"><a href="{{route('produto.index')}}">Produtos</a></li>
                    <li class="item-menu"><a href="{{route('marca.index')}}">Marcas</a></li>
                    <li class="item-menu"><a href="{{route('category.index')}}">Categorias</a></li>
                    <li class="item-menu"><a href="{{route('unidade-medida.index')}}">Unidade de Medida</a></li>
                    <li class="item-menu"><a href="{{route('entrada-produto.index')}}">Entrada de Produtos</a></li>
                    <li class="item-menu"><a href="{{route('saida-produto.index')}}">Saída de Produtos</a></li>
                    <li class="item-menu"><a href="{{route('produto-fornecedor.create')}}">Produto por Fornecedor</a></li>
                </ul>
            </li>

            <li>
                <div class="dropdownlink">
                    <div>
                        <i class="icofont-server mr-2"></i>Cadastro Geral
                    </div>
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </div>
                <ul class="submenuItems">
                    <li class="item-menu "><a href="{{route('empresa.index')}}">Empresas</a></li>
                    <li class="item-menu "><a href="{{route('fornecedor.index')}}">Fornecedores</a></li>
                    <li class="item-menu "><a href="{{route('cliente.index')}}">Clientes</a></li>
                    <li class="item-menu "><a href="{{route('obra.index')}}">Obras</a></li>
                </ul>
            </li>

            <li>
                <div class="dropdownlink">
                    <div>
                        <i class="icofont-industries-4 mr-2"></i>Produção
                    </div>
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </div>
                <ul class="submenuItems">
                    <li class="item-menu"><a href="{{route('ordem-producao.index')}}">Ordem de Produção</a></li>
                    <li class="item-menu"><a href="{{route('recursos-producao.index')}}">Operação de equipamentos</a></li>
                </ul>
            </li>

            <li>
                <div class="dropdownlink">
                    <div>
                        <i class="icofont-vehicle-crane mr-2"></i>Equipamentos
                    </div>
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </div>
                <ul class="submenuItems">
                    <li class="item-menu"><a href="{{route('equipamento.index')}}">Cadastro de Equipamentos</a></li>
                    <li class="item-menu"><a href="#">paradas de equipamentos</a></li>
                </ul>
            </li>

            <li>
                <div class="dropdownlink">
                    <div>
                        <i class="icofont-repair mr-2" ></i>Manutenção
                    </div>
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </div>
                <ul class="submenuItems">
                    <li class="item-menu"><a href="#">Manutenções Agendadas</a></li>
                    <li class="item-menu"><a href="#">paradas de equipamentos</a></li>
                </ul>
            </li>

            <li>
                <div class="dropdownlink">
                    <div>
                        <i class="icofont-gear mr-2"></i>Configuraçoes
                    </div>
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </div>
                <ul class="submenuItems">
                    <li class="item-menu"><a href="{{route('register')}}">Cadastro de Usuários</a></li>
                </ul>
            </li>

     
        </ul>

       
    </nav>

</aside>
