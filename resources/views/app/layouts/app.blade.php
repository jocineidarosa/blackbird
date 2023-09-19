<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.1.0/autoNumeric.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    {{-- <link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css"> --}}

{{--     <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script> --}}
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script src="{{asset('js/maskedit.js')}}"></script>
    <title>DBMAXIS</title>
</head>

<body>
    @include('app.layouts.topbar')
    @include('app.layouts.sidebar')
    @include('app.layouts.components.logout_modal')

    <main class="mt-5 pt-3">
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>
    <script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/innout.js') }}"></script>
    {{-- <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script> --}}

</body>

</html>
