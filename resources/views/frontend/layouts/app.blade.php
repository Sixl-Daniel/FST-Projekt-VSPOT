<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@hasSection('pageTitle')@yield('pageTitle') – @endif{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,900&display=swap">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css-top')
    @yield('js-top')
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body id="vspot" class="view-{{ str_replace('.', '-', $view_name) }}">

    @section('header')
        @include('frontend.partials.header')
    @show

    @yield('content')

    @section('footer')
        @include('frontend.partials.footer')
    @show

    @yield('css-bottom')

    @yield('js-bottom')

</body>
</html>
