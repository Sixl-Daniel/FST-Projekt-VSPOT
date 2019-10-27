<!doctype html>
<html lang="de">
<head>
<meta charset="utf-8">
<title>VSPOT - Digital Signage Solution</title>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name="author" content="Daniel Sixl">
@stack('top_stylesheets')
@stack('top_scripts')
@yield('top_info')
@section('top_css')
@include('web.includes.base_css')
@show
</head>
<body class="fadeIn">
@yield('content')
@yield('bottom_scripts')
</body>
</html>
