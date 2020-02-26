<footer class="footer">
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="{{ url('/') }}"><b>VSPOT</b> Digital&nbsp;Signage&nbsp;Solution</a>
            </div>
            <div class="navbar-nav">
                <a class="nav-item nav-link email" href="mailto:{{ env('APP_MAIL') }}">{{ env('APP_MAIL') }}</a>
            </div>
            <div class="navbar-nav">
                <a class="nav-item nav-link copyright" href="https://sixl.org" rel="noopener noreferrer" target="_blank">&copy;@php echo date('Y') @endphp Daniel Sixl</a>
            </div>
        </div>
    </nav>
</footer>
