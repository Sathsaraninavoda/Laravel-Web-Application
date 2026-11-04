<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Thambapanni Sobha')</title>

    {{-- CSRF Token for security --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- External CSS Libraries --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    {{-- Custom Stylesheet using Laravel's asset helper --}}
    <link rel="stylesheet" href="{{ asset('css/create_account.css') }}">
</head>
<body>
    {{-- Navigation Bar --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><i class="fas fa-gem me-2"></i>Thambapanni Sobha</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ url('/') }}">Home</a>
                <a class="nav-link" href="#">Products</a>
                <a class="nav-link" href="#">About</a>
                {{-- Example of using Laravel's route helper for authentication links --}}
                @guest
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    @endif
                @else
                    <a class="nav-link" href="#">My Account</a>
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <main class="main-container">
        {{-- Content section that will be filled by child views --}}
        @yield('content')
    </main>

    {{-- External JavaScript Libraries --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    {{-- Custom Script using Laravel's asset helper --}}
    <script src="{{ asset('js/create_account.js') }}"></script>
</body>
</html>
