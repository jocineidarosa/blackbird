     <!-- top navigation bar -->
     <header>
         <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
             <div class="container-fluid px-5">
                 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                     aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                 </button>
                 <a class="navbar-brand me-auto ms-lg-0 ms-3" href="{{ route('site.home') }}">
                     <img src="{{ asset('img/site/logo.png') }}" style="max-width:165px" alt="Bresola Terraplanagem" />
                 </a>
                 <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                     <ul class="navbar-nav">
                         <li class="nav-item mx-2">
                             <a class="nav-link" href="{{route('site.home')}}">Início</a>
                         </li>

                         <li class="nav-item mx-2">
                            <a class="nav-link" href="#">Empresa</a>
                        </li>
                         <li class="nav-item mx-2">
                            <a class="nav-link" href="#">Contato</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#">Trabalhe Conosco</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" target="_blank" href="https://webmail.bresola.com.br/?_task=logout&_token=i0ZcFlJzn1O4wdBYEWwmC5oEq40hEDOx">Webmail</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="{{route('app.home')}}">Área restrita</a>
                        </li>
                     </ul>
                 </div>
             </div>
         </nav>
     </header>
     <!-- top navigation bar -->
