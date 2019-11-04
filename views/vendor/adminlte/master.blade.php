<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 2'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=001">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=001">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=001">
    <link rel="manifest" href="/site.webmanifest?v=001">
    <link rel="mask-icon" href="/safari-pinned-tab.svg?v=001" color="#c70038">
    <link rel="shortcut icon" href="/favicon.ico?v=001">
    <meta name="apple-mobile-web-app-title" content="VSPOT">
    <meta name="application-name" content="VSPOT">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png?v=001">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    {{--    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('vendor/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    @include('adminlte::plugins', ['type' => 'css'])
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app-backend.css') }}">
    @yield('adminlte_css')
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,900&display=swap">
</head>
<body class="vspot hold-transition @yield('body_class')">

@yield('body')

<script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

@include('adminlte::plugins', ['type' => 'js'])

@yield('adminlte_js')

@include('backend.partials.js.flash-message')

</body>
</html>
