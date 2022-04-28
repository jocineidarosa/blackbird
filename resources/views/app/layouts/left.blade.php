<!--Classe principal do menu left-->
<aside class="sidebar">
    <nav class="menu mt-3">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="{{route('produto.index')}}">
                    <i class="icofont-flask"></i>
                    PRODUTOS
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('entrada-produto.index')}}">
                    <i class="icofont-basket"></i>
                    ENTRADA DE PRODUTOS
                </a>
            </li>

            <li class="nav-item">
            <a href="{{route('saida-produto.index')}}">
                <i class="icofont-delete"></i>
                    SAÍDA DE PRODUTOS
                </a>
            </li>

            <li class="nav-item">
                <a href="#">
                    <i class="icofont-chart-histogram mr-2"></i>
                    Relatório Gerencial
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('marca.index')}}">
                    <i class="icofont-copyright"></i>
                    MARCAS 
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('ordem-producao.index')}}">
                    <i class="icofont-layout"></i>
                    ORDEM DE PRODUÇÃO
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('register')}}">
                    <i class="icofont-users mr-2"></i>
                    Usuários 
                </a>
            </li>

            
        </ul>
    </nav>

</aside>