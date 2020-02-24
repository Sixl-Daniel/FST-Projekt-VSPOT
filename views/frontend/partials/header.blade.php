<header>
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container">

            <a class="navbar-brand" href="{{ url('/') }}">
                <span id="topbar-brand">{{ config('app.name') }}</span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- navbar left -->
                <div class="navbar-nav mr-auto">
                    <a class="nav-item nav-link {{ activeMenu('') }}" href="{{ url('/') }}">Home</a>
                    <a class="nav-item nav-link {{ activeMenu('produkt') }}" href="{{ url('/produkt') }}">Produkt</a>
                    <a class="nav-item nav-link {{ activeMenu('downloads') }}" href="{{ url('/downloads') }}">Downloads</a>
                    <a class="nav-item nav-link {{ activeMenu('impressum') }}" href="{{ url('/impressum') }}">Impressum</a>
                    <a class="nav-item nav-link {{ activeMenu('datenschutz') }}" href="{{ url('/datenschutz') }}">Datenschutz</a>
                </div>

                <!-- navbar right -->
                <div class="navbar-nav ml-auto">
                    <div class="nav-item dropdown">
                        @auth
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle fa-fw"></i> {{ auth()->user()->name }}</a>
                        @else
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle fa-fw"></i> Account</a>
                        @endauth
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @auth
                                <a class="dropdown-item" href="{{ url('/dashboard') }}"><i class="fas fa-tools fa-fw"></i> {{ __('Administration') }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt fa-fw"></i> {{ __('Logout') }}</a>
                                <form id="logout-form" class="hidden-form" action="{{ route('logout') }}" method="POST">@csrf</form>
                            @else
                                <a class="dropdown-item" href="{{ route('login') }}"><i class="fas fa-sign-in-alt fa-fw"></i> {{ __('Login') }}</a>
                                <a class="dropdown-item" href="{{ route('register') }}"><i class="fas fa-user-plus fa-fw"></i> {{ __('Register') }}</a>
                            @endauth
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </nav>
</header>
