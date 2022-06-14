<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <link rel="shortcut icon" href="{{asset('template/img/logo/logo.png')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Wado Reporters') }} - @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    @include('admin.template.styles')

    @yield('stylesheet')
</head>
<body>
    <div class="main-wrapper">
        @guest
         @yield('content')
        @else
            @include('admin.template.topnav')
            @include('admin.template.sidenav')
            <div class="page-wrapper">
                @yield('content')
            </div>
        @endguest
    </div>


    @include('admin.template.scripts')
    @yield('script')    
</body>
</html>
