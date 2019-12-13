<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title> {{ config('app.name') }} - {{ config('config.version') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet"/>
    <!--  Paper Dashboard core CSS    -->
    <link href="{{ asset('css/paper-dashboard.css') }}" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet" />
    <!--  Fonts and icons     -->
    {{--<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/themify-icons.css') }}" rel="stylesheet">

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="black" data-active-color="danger">

        <!--
            Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
            Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
        -->
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.dataeasy.com.br" class="simple-text">
                    <img src="{{ asset('img/logo/logo.png') }}">
                    DataEasy
                </a>
            </div>

            @php($menu = '/' . Request::path('/'))

            <ul class="nav">
                @if ($menu == "/api/dashboard")
                    <li class="active">
                        <a href="/dashboard">
                            <i class="fa fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="/client">
                            <i class="fa fa-user-shield"></i>
                            <p>Client Config</p>
                        </a>
                    </li>

                @elseif($menu == "/api/client")

                    <li>
                        <a href="/dashboard">
                            <i class="fa fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="/client">
                            <i class="fa fa-user-shield"></i>
                            <p>Client Config</p>
                        </a>
                    </li>

                @else
                    <li>
                        <a href="/dashboard">
                            <i class="fa fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="/client">
                            <i class="fa fa-user-shield"></i>
                            <p>Client Config</p>
                        </a>
                    </li>

            @endif

                @if ( \Illuminate\Support\Facades\Auth::user()->id == "1" )
                        <li>
                            <a href="/register">
                                <i class="fa fa-user-plus"></i>
                                <p>Adicionar Usuário</p>
                            </a>
                        </li>
                @endif


                <li>
                    <a href="/logout">
                        <i class="fa fa-power-off"></i>
                        <p>LOGOUT</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1">fff</span>
                        <span class="icon-bar bar2">ggg</span>
                        <span class="icon-bar bar3">hhh</span>
                    </button>
                    <a class="navbar-brand" href="#">Docflow - Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <span class="fa fa-user-circle"></span>
                        {{{ \Illuminate\Support\Facades\Auth::user()->name }}}
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

    </div>

</div>

<div class="footer">
    <footer class="footer">
        <div class="container-fluid">
            <div class="copyright pull-right">
                SHIELD {{ config('config.version')}} | 
                &copy; <script>document.write(new Date().getFullYear())</script> by <a href="http://www.dataeasy.com.br">DataEasy <img width="8%" src="{{ asset('img/logo/logo.png') }}"></img></a>
            </div>
        </div>
    </footer>
</div>    


</body>

<!--   Core JS Files   -->
<script src="{{ asset('js/jquery-1.10.2.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="{{ asset('js/bootstrap-checkbox-radio.js') }}"></script>

<!--  Charts Plugin -->
<script src="{{ asset('js/chartist.min.js') }}"></script>

<!--  Notifications Plugin    -->
<script src="{{ asset('js/bootstrap-notify.js') }}"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="{{ asset('js/paper-dashboard.js') }}"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('js/dedash.js') }}"></script>

@yield('content-script')

</html>
