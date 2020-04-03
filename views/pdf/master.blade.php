<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>VSPOT Digital Signage Solution</title>
<style type="text/css" media="all">
    body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif; }
    table { width: 100%; }
    tr, th { text-align: left; }
    .text-left { text-align: left; }
    .text-center { text-align: center; }
    .text-right { text-align: right; }
    .float-left { float: left; }
    .float-right { float: right; }
    .lighter { font-weight: lighter; }
    .bolder { font-weight: bolder; }
    footer {
        margin-top: 3em;
        border-top: 1px solid black;
    }
    @stack('top_css')
</style>
</head>
<body>
<main>@yield('content')</main>
<footer>
@section('footer')
    <p class="copyright"><small>&copy; {{ $year }} Daniel Sixl / <a href="mailto:info@vspot.eu">info@vspot.eu</a></small> <small class="float-right">Stand vom {{ $date }}, {{ $time }} Uhr</small></p>
@show
</footer>
</body>
</html>
