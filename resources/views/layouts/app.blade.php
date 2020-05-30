<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <style>
        .background-color{
            background-image:url('/img/BG.jpg');
            background-repeat: no-repeat;
            background-size: 100%;
        }
        .background-color2{
            background-image:url('/img/BG-home.jpg');
            background-repeat: no-repeat;
            background-size: 100%;
        }
    </style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Home') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="adminlte/bower_components/font-awesome/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="{{ Request::path() == '/'  ? '' : 'background-color' }}">
    <div id="app" >
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color:midnightblue;" >
            <div class="container" >
                <a style="color:white;" class="navbar-brand" href="{{ url('/') }}">
                    <!-- {{ config('app.name', 'Home') }} -->
                    <i class="fa fa-fw fa-home"></i>โปรแกรมทัวร์
                </a>
                <a style="color:white;" class="navbar-brand" href="{{ url('home/') }}">
                    <!-- {{ config('app.name', 'Home') }} -->
                    <i class="fa fa-fw fa-users"></i>สำหรับมัคคุเทศน์
                </a>
                <a style="color:white;" class="navbar-brand" href="{{ url('/home') }}">
                    <!-- {{ config('app.name', 'Home') }} -->
                    <i class="fa fa-fw fa-user"></i>สำหรับคนจัดการ
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <!-- <a style="color:white;" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> -->
                                <!-- <a style="color:white;" class="nav-link" href="{{ route('login') }}">เข้าสู่ระบบ</a> -->
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <!-- <a style="color:white;" class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> -->
                                    <a style="color:white;" class="nav-link" href="{{ route('register') }}">สมัครสมาชิก</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4" >
            @yield('content')
        </main>
    </div>
</body>
</html>
