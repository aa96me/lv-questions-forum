<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('meta_title',env('APP_NAME'))</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="@yield('meta_description', get_setting('meta_description') )" />
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords') )">
    <link rel="icon" href="{{ static_asset('assets/img/icon.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap">
    <link rel="stylesheet" href="{{ static_asset('assets/app.css') }}">

    <style>
        :root{
            --primary: #de4e07;
            --hov-primary: #de4e07;
            --soft-primary: {{ hex2rgba('#de4e07',.15) }};
        }
    </style>
</head>
<body>

<button onclick="add_question()" id="add_question_button" class="btn btn-primary mt-3">
    + Add a question
</button>

    <!-- maiin-wrapper -->
    <div class="maiin-wrapper d-flex flex-column">
        <!-- Header -->

<header class="z-1020 bg-white border-bottom shadow-sm">
    <div class="position-relative logo-bar-area">
        <div class="container">
            <div class="d-flex align-items-center" style="justify-content: space-between;">

                <div class="col-auto col-xl-3 pl-0 pr-3 d-flex align-items-center" style=" place-content: center; ">
                    <a class="d-block py-20px mr-3 ml-0" href="{{ route('home') }}">
                        <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" style=" height: 110px; ">
                    </a>

                </div>

                @auth
                    <div class="d-none d-lg-block ml-3 mr-0 nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center text-reset" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                            <i class="la la-user la-2x opacity-80"></i>
                            <span class="flex-grow-1 ml-1">
                                <span class="nav-box-text d-none d-xl-block opacity-70">{{ Auth::user()->name }}</span>
                            </span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                            <a class="dropdown-item" href="{{ route('user.my_questions') }}">My Questions</a>
                            @if(Auth::check() && Auth::user()->id == 1)
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </div>
                    </div>
                @else
                <div class="d-none d-lg-block ml-3 mr-0 nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center text-reset" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                        <i class="la la-user la-2x opacity-80"></i>
                        <span class="flex-grow-1 ml-1">
                            <span class="nav-box-text d-none d-xl-block opacity-70">My Account</span>
                        </span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('register') }}">Signup</a>
                    </div>
                </div>
                @endauth

            </div>
            <div class="d-lg-none text-center">
                @auth
                <a href="{{ route('profile') }}">Profile</a> /
                <a href="{{ route('user.my_questions') }}">My Questions</a> /
                @if(Auth::check() && Auth::user()->id == 1)
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a> /
                @endif
                <a href="{{ route('logout') }}">Logout</a>
                @else
                <a href="{{ route('login') }}">Login</a> /
                 <a href="{{ route('register') }}">Signup</a>
                @endauth
            </div>
        </div>
    </div>
</header>

        @yield('content')

    </div>

    @yield('modal')
    <script>var OBJ = OBJ || {};</script>

    <!-- SCRIPTS -->
    <script src="{{ static_asset('assets/app.js') }}"></script>
    <script src="{{ static_asset('assets/notify.js') }}"></script>



    <script>
        @foreach (session('flash_notification', collect())->toArray() as $message)
            OBJ.tools.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
        @endforeach
    </script>


    <script>

function add_question() {
    @if (Auth::check())
        window.location.href = '{{ route('question.add') }}';
    @else
        OBJ.tools.notify('success', 'You must login first to add a question.');
    @endif
}
    </script>

    @yield('script')

</body>
</html>
