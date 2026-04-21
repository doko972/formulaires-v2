<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Application') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cinzel:400,500,600,700|inter:300,400,500,600&display=swap" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="welcome-body">

<div class="welcome-page">

    {{-- Navigation --}}
    <nav class="welcome-nav">
        <a href="{{ url('/') }}" class="welcome-nav__brand">
            {{ config('app.name', 'Application') }}
        </a>

        @if (Route::has('login'))
            <div class="welcome-nav__links">
                @auth
                    <a href="{{ url('/dashboard') }}" class="welcome-nav__link welcome-nav__link--primary">
                        Tableau de bord
                    </a>
                @else
                    <a href="{{ route('login') }}" class="welcome-nav__link">
                        Connexion
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="welcome-nav__link welcome-nav__link--primary">
                            Créer un compte
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    {{-- Hero --}}
    <main class="welcome-hero">

        <p class="welcome-hero__eyebrow">{{ config('app.name', 'Application') }}</p>

        <h1 class="welcome-hero__title">Gestion de formulaires</h1>

        <p class="welcome-hero__sub">
            Créez, gérez et archivez vos formulaires en toute simplicité depuis un espace centralisé et sécurisé.
        </p>

        <div class="welcome-hero__actions">
            @auth
                <a href="{{ url('/dashboard') }}" class="welcome-cta welcome-cta--primary">
                    <span>Accéder au tableau de bord</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>
            @else
                <a href="{{ route('login') }}" class="welcome-cta welcome-cta--primary">
                    <span>Se connecter</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="welcome-cta welcome-cta--secondary">
                        <span>Créer un compte</span>
                    </a>
                @endif
            @endauth
        </div>

    </main>

    {{-- Footer --}}
    <footer class="welcome-footer">
        <span class="welcome-footer__version">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} &nbsp;·&nbsp; PHP v{{ PHP_VERSION }}
        </span>
    </footer>

</div>

</body>
</html>
