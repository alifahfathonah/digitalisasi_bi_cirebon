<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background: #005496">
    @isset(Auth::user()->id)
        <script type="text/javascript">
            const BASE_URL = '{{url("/")}}';
            const AUTH_LOGIN_ID =  {{ Auth::user()->id }} ;
            const AUTH_USER_NAME = '{{ Auth::user()->username }}' ;
            const AUTH_NAME = '{{ Auth::user()->name }}' ;
            const APP_BASE = '{{ env('APP_BASE') }}'
        </script>
    @endisset

    @yield('content')

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>
