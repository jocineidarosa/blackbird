<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/comum.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <title>STRATUS ERP - Login</title>
</head>
<body style="background-image: url('{{asset('img/site/fundo3.jpg')}}');  background-size: cover; 
background-position: center; ">

    <form action="{{ route('login') }}" method="POST" class="form-login">
        @csrf
        <div class="login-card bg-secondary">
            <div class="card-header">
               {{--  <span class="font-wheight-light">DBMAXIS SOLUTIONS</span> --}}
                <img src="{{asset('img/site/logo_dbmaxis.png')}}" alt="">
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control " placeholder="Informe seu e-mail"
                        autofocus value="">
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Informe sua senha">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Mantenha-me Conectado') }}
                        </label>

                    </div>

                    <div class="card-footer">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Esqueceu a senha?') }}
                            </a>
                        @endif
                        <button class="btn btn-lg btn-primary">Entrar</button>
                    </div>

                </div>

    </form>


</body>

</html>
