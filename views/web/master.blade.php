<!doctype html>
<html lang="de">
<head>
<meta charset="utf-8">
<title>VSPOT - Digital Signage Solution</title>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name="google" content="notranslate">
<meta name="author" content="Daniel Sixl">
@yield('top_info')
@stack('top_stylesheets_stack')
@section('top_css')
<link rel="stylesheet" href="{{ asset('css/web-access.css') }}">
@show
@stack('top_scripts_stack')
</head>
<body class="fadeIn">
@yield('content')
@yield('bottom_scripts')
</body>
</html>
