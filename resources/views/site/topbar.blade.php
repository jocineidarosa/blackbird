     <!-- top navigation bar -->
     <header>
         <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
             <div class="container-fluid px-5">
                 <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
                     aria-controls="offcanvasExample">
                     <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
                 </button>
                 <a class="navbar-brand me-auto ms-lg-0 ms-3" href="{{ route('site.home') }}">
                     <img src="{{ asset('img/site/logo.png') }}" style="max-width:165px" alt="Bresola Terraplanagem" />
                 </a>
                 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar"
                     aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                 </button>
                 <ul class="navbar-nav">
                     <li class="nav-item dropdown">
                         <a class="nav-link ms-2" href="{{ route('site.home') }}">
                             Início
                         </a>
                     </li>


                     <li class="nav-item dropdown">
                         <a class="nav-link ms-2" href="#">
                             Obras
                         </a>
                     </li>

                     <li class="nav-item dropdown">
                         <a class="nav-link ms-2" href="">
                             Trabalhe Conosco
                         </a>
                     </li>

                     <li class="nav-item dropdown">
                         <a class="nav-link ms-2" href="{{ route('app.home') }}" target="_blank">
                             Área restrita
                         </a>
                     </li>

                 </ul>
             </div>
             </div>
         </nav>
     </header>
     <!-- top navigation bar -->
