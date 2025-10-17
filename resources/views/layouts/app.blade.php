<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title','WynajemAut — przewozy osobowe')</title>
    <meta name="description" content="@yield('meta_description','Transfery lotniskowe, przewozy 24/7, busy i limuzyny.')">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="WynajemAut" height="40">
            <span class="fw-bold">WynajemAut</span>
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
        <div id="nav" class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('services') }}">Usługi</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('fleet') }}">Flota</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('pricing') }}">Cennik</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('faq') }}">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Kontakt</a></li>
            </ul>
            <a class="btn btn-brand" href="{{ route('booking.form') }}">Rezerwacja</a>
        </div>
    </div>
</nav>

<main class="container py-4">
    @if (session('ok')) <div class="alert alert-success">{{ session('ok') }}</div> @endif
    @yield('content')
</main>

<footer class="border-top py-4">
    <div class="container text-muted small">© {{ date('Y') }} WynajemAut — tel. +48 600 000 000</div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
