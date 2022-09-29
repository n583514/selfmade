<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '自作') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/ajaxfavo.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('stylesheet')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light p-4 border-bottom">
            <div class="container center">
                <a class="navbar-brand" href="{{ url('/') }}">
                    ？
                </a>
            </div>
            <div class="my-navbar-control">
            @if(Auth::check())
                <a class="my-navbar-item mr-5 text-dark" href="{{ route( 'my.page', ['id' => Auth::user()->id])}}">マイページ</a>
                <span class="my-navbar-item text-dark">{{ Auth::user()->nickname}}</span>
                /
                <a href="#" id="logout" class="my-navbar-item text-dark">ログアウト</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                   @csrf
                </form>
                <script>
                    document.getElementById('logout').addEventListener('click', function(event) {
                    event.preventDefault();
                    document.getElementById('logout-form').submit();   
                });
                </script>
            @else
                <a class="my-navbar-item text-dark" href="{{ route('login') }}">ログイン</a>
                /
                <a class="my-navbar-item text-dark" href="{{ route('register') }}">会員登録</a>
            @endif
            </div>
        </nav>
        @yield('content')
    </div>
</body>
</html>