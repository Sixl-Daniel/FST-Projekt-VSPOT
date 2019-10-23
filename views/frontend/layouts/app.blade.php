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
    @stack('js-top')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body id="vspot" class="view-{{ str_replace('.', '-', $view_name) }}">

    @section('header')
        @include('frontend.partials.header')
    @show

    <main>
        @yield('content')
    </main>

    @section('footer')
        @include('frontend.partials.footer')
    @show

    @stack('js-bottom')

    @include('frontend.partials.js.flash-message')

    @include('cookieConsent::index')
</body>
</html>
