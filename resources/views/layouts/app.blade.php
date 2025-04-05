<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SampleName</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header, footer {
            background: #f4f4f4;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        nav {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex: 1;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        main {
            flex: 1;
            padding: 2rem;
        }
    </style>
</head>
<body>

<div class="wrapper">

    {{-- Header --}}
    <header>
        <div class="logo">
            <a href="{{ route('dashboard') }}" style="text-decoration: none; color: inherit;">
                <img src="https://via.placeholder.com/40" alt="Logo" style="height: 40px;">
                <strong>SampleName</strong>
            </a>
        </div>

        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="#">Plans</a>
            @auth
            @if(auth()->user()->isAdmin())
            <a href="#">Users</a>
            @endif
            @endauth
        </nav>

        <div class="auth-buttons">
            @guest
            <a href="{{ route('register') }}">Register</a>
            <a href="{{ route('login') }}">Login</a>
            @else
            <span>{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit">Sign out</button>
            </form>
            @endguest
        </div>
    </header>

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer>
        <span>&copy; {{ date('Y') }} SampleName</span>
    </footer>

</div>

</body>
</html>
