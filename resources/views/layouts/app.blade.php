<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('files.index') }}"><i class="bi bi-cloud"></i> {{ config('app.name') }}</a>
        @auth
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('files.index') }}">Files</a></li>
                @if(auth()->user()->hasRole('super_admin'))
                    <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                @endif
            </ul>
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person-fill"></i> {{ auth()->user()->name }}
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-link nav-link">Logout</button>
                    </form>
                </li>
            </ul>
        @endauth
    </div>
</nav>

<main class="container bg-white shadow-sm py-4 mt-0" style="min-height: calc(100vh - 56px); max-width: 900px;">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @yield('content')
</main>
</body>
</html>
