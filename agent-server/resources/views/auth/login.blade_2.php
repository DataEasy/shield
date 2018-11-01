@extends('layout.login')

@section('content')


<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        {{--<h2 class="active"> Sign In </h2>--}}
        {{--<h2 class="inactive underlineHover">Sign Up </h2>--}}

        <!-- Icon -->
        <div class="img-rounded">
            <img src="{{ asset('img/logo/logo_login.png') }}" alt="DataEasy" id="icon" alt="User Icon" />
            <div class="bg-primary">
                <h1>SHIELD</h1>
            </div>

        </div>

        <!-- Login Form -->
        <form>
            <input type="text" id="login" class="fadeIn second" name="email" placeholder="Email">
            <input type="text" id="password" class="fadeIn third" name="password" placeholder="Senha">
            <input type="submit" class="fadeIn fourth" value="Acessar">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="mailto:infraestrutura@dataeasy.com.br">Perdeu a senha? Entre em contato</a>
        </div>

    </div>
</div>

@endsection
