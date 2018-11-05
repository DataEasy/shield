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
                <div>
                    <h21>SHIELD</h21>
                </div>

            </div>

            <!-- Login Form -->
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="text" id="login" class="fadeIn second" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                    </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" id="password" class="fadeIn third" name="password" placeholder="Senha" required>


                </div>

                <div class="form-group">
                    <input type="submit" class="fadeIn fourth" value="Acessar">
                </div>

            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="mailto:infraestrutura@dataeasy.com.br">Perdeu a senha? Entre em contato</a>
            </div>


            @if ($errors->has('email'))
                <div class="alert alert-warning">
                    {{ $errors->first('email') }}
                </div>
            @endif

            @if ($errors->has('password'))
                <div class="alert alert-warning">
                    {{ $errors->first('password') }}
                </div>
            @endif

        </div>
    </div>

@endsection
