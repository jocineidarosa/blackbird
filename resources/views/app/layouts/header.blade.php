<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/comum.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/icofont.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/template.css')}}">
    <link rel="stylesheet" href="{{asset('css/menu-left.css')}}">
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    
    <title>BlackBirds - ERP Industrial</title>
</head>

<body>
    <header class="header">
        <div class="menu-toggle mx-3">
            <i class="icofont-navigation-menu"></i>
        </div>

        <div class="logo">
            <i class="icofont-birds mr-2 text-dark"></i>
            <span class="font-wheight-light">BlackBirds</span>
        </div>
        <div class="spacer"></div>

        <div class="dropdown">
            <div class="dropdown-button">
                {{ Auth::user()->name }}
                <span class="ml-3">
                </span>
                <i class="icofont-simple-down mx-2"></i>
            </div>


            <div class="dropdown-content">
                <ul class="nav-item">
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('form_logout').submit();">
                            Sair
                        </a>
                        <form action="{{ route('logout') }}" method="POST" id="form_logout">
                            @csrf
                        </form>
                    </li>

                </ul>
            </div>

        </div>

    </header>
