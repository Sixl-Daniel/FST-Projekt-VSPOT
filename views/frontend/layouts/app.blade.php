<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@section('head')
    @include('frontend.partials.head')
@show
@section('body')
<body id="vspot" class="view-{{ str_replace('.', '-', $view_name) }}@yield('body-class')">
    @section('header')
        @include('frontend.partials.header')
    @show
    <main>@yield('content')</main>
    @section('footer')
        @include('frontend.partials.footer')
    @show
    @stack('html-bottom')
    @stack('js-bottom')
    @include('frontend.partials.js.flash-message')
    @section('cookie-consent')
        @include('cookieConsent::index')
    @show
</body>
@show
</html>
