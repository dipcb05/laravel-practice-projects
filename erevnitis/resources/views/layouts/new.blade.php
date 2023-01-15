<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('images/logo & icon/default_favicon.ico') }}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/front_page.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>ExplorerHub</title>
</head>
<body>
<div>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="/">
        <img src="{{ asset('images/logo & icon/explorerhub_logo.png') }}"
             alt="logo"
             style="width:300px;height:100px;">
    </a>
    <button class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link"
                   href="{{ route('home') }}">
                    Home
                    <span class="sr-only">
                        (current)
                    </span></a>
            </li>
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                       role="button" data-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false" v-pre>
                        logged in <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest

            <li class="nav-item">
                <a class="nav-link"
                   href="#">
                    About Us
                    <span class="sr-only">
                        (current)
                    </span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   href="#">
                    Contact Us
                    <span class="sr-only">
                        (current)
                    </span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   href="#">
                    Subscription
                    <span class="sr-only">
                        (current)
                    </span></a>
            </li>
        </ul>
    </div>
</nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
<footer>
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="#"> ExplorerTech</a>
    </div>
</footer>
</body>
</html>
