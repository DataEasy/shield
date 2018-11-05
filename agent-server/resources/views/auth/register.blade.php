{{--@extends('layouts.app')--}}
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
                    <h22>SHIELD - Registro</h22>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <input type="text" id="name" class="fadeIn second" name="name" placeholder="Nome" value="{{ old('name') }}" required autofocus>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" id="email" class="fadeIn second" name="email" placeholder="EMail" value="{{ old('email') }}" required autofocus>
                        </div>



                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" id="" class="fadeIn second" name="password" placeholder="Senha" required>
                        </div>

                        <div class="form-group{{ $errors->has('password-confirm') ? ' has-error' : '' }}">
                            <input type="password" id="password-confirm" class="fadeIn second" name="password_confirmation" placeholder="Confirme a Senha" required>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <input type="submit" class="fadeIn fourth" value="Registrar">
                                <input type="button" class="fadeIn fourth" value="Voltar" onclick="goBack()">
                            </div>
                        </div>

                        @if ($errors->has('name'))
                            <div class="alert alert-warning">
                                {{ $errors->first('name') }}
                            </div>
                        @endif

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
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

@endsection
