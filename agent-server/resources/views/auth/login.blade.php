@extends('layout.login')

@section('content')


    <div class="body"></div>
    <div class="grad"></div>
    <div class="header">
        <div class="login-box">
            <div>
                <img src="{{ asset('img/logo/logo.png') }}">
                <span> SHIELD </span>
            </div>
        </div>
    </div>

    <div class="login">
        <input type="text" placeholder="username" name="user"><br>
        <input type="password" placeholder="password" name="password"><br>
        <input type="button" value="Login">
    </div>

@endsection
