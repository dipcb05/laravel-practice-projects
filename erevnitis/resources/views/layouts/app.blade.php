<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="userId" content="{{ \Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::id() : '' }}">
    <title>{{ config('app.name', 'ExplorerHub') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
<body>
<div id="app">
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
                    @guest
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        </li>
                        @if(Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('register') }}">
                                    {{ __('Register') }}
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <form class="form-inline my-2 my-lg-0"
                                  method = "POST"
                                  action = "{{ route('search') }}">
                                <input
                                    name="search"
                                    class="form-control mr-sm-2"
                                    type="search"
                                    placeholder="Search"
                                    aria-label="Search">
                                <button
                                    class="btn btn-outline-success my-2 my-sm-0"
                                    type="submit">Search</button>
                                @csrf
                            </form>
                        </li>
                        @if(Route::current()->getName() == 'home')
                            @if((\Illuminate\Support\Facades\Auth::user()->role) == 2)
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('admin') }}">
                                        {{ __('Admin Dashboard') }}
                                    </a>
                                </li>
                            @endif
                                @if((\Illuminate\Support\Facades\Auth::user()->role) == 3)
                                    <li class="nav-item">
                                        <a class="nav-link"
                                           href="{{ route('noreviews') }}">
                                            {{ __('No reviews') }}
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle"
                                       href="#" id="navbarDropdown"
                                       role="button" data-toggle="dropdown"
                                       aria-haspopup="true"
                                       aria-expanded="false">
                                        Browse
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="DropDown">
                                        <a class="dropdown-item" href="#"></a>
                                        <a class="dropdown-item" href="{{ route('query.show', 'subject') }}">By Subject</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('query.show', 'author') }}">By Author</a>
                                    </div>
                                </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('profile.show', Auth::user()->id) }}">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('discussion') }}">
                                    {{ __('Discussion') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('paper.req') }}">
                                    {{ __('New Paper Request to admin') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'profile.show')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('discussion') }}">
                                    {{ __('Discussion') }}
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle"
                                   id="pro_edit"
                                   role="button"
                                   data-toggle="dropdown"
                                   aria-haspopup="true"
                                aria-expanded="false">
                                    Profile Settings
                                </a>
                                <div class="dropdown-menu"
                                     aria-labelledby="pro_edit">
                                    <a class="dropdown-item"
                                       href="{{ route('profile.edit', Auth::user()->id) }}">
                                        Edit Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('password.request') }}">
                                        Change Password</a>
                                </div>
                            </li>

                        @elseif(Route::current()->getName() == 'profile.edit')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('profile.show', $user) }}">
                                    {{ __('Back to Profile') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'posts.reviews')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('profile.show', Auth::user()->id) }}">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="#">
                                    {{ __('Settings') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'posts.create')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('profile.show', Auth::user()->id) }}">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'reviews.show')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('posts.reviews', $review->posts_id) }}">
                                    {{ __('Post') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('profile.show', Auth::user()->id) }}">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'reviews.editget')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('reviews.show', [$review->posts_id, $review->users_id, $review->id]) }}">
                                    {{ __('Reviews') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('posts.reviews', $review->posts_id) }}">
                                    {{ __('Post') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('profile.show', Auth::user()->id) }}">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'message.person')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('profile.show', \Illuminate\Support\Facades\Auth::id()) }}">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'discussion')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'admin')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('home') }}">
                                    {{ __('User Dashboard') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('profile.show', Auth::user()->id) }}">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'admin')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('admin.profile') }}">
                                    {{ __('Admin Profile') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'check_paper_req')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('admin') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'check_edit_req')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('admin') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'admin.stat')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('admin') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                            @elseif(Route::current()->getName() == 'home.search')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'paper.req')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'dis.show')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('discussion') }}">
                                    {{ __('Discussions') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'search')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('discussion') }}">
                                    {{ __('Discussions') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'query.show')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('discussion') }}">
                                    {{ __('Discussions') }}
                                </a>
                            </li>
                        @elseif(Route::current()->getName() == 'noreviews')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('discussion') }}">
                                    {{ __('Discussions') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('profile.show', \Illuminate\Support\Facades\Auth::id()) }}">
                                    {{ __('profile') }}
                                </a>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown"
                               class="nav-link dropdown-toggle"
                               href="#"
                               role="button"
                               data-toggle="dropdown"
                               aria-haspopup="true"
                               aria-expanded="false" v-pre>
                                {{ Auth::user()->username }}
                                <span class="caret">
                                    </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right"
                                 aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"
                                   href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form"
                                      action="{{ route('logout') }}"
                                      method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                </ul>
            </div>
        </nav>
    </div>
    <main class="py-4">
        @yield('content')
        @yield('script')
    </main>
</div>
@livewireStyles
</body>
<footer>
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="#"> ExplorerTech</a>
    </div>
</footer>
</html>
