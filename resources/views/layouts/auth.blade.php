<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Authentification') — {{ config('app.name', 'Application') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cinzel:400,500,600,700|inter:300,400,500,600&display=swap" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/auth.js'])
</head>
<body class="auth-body">

<div class="auth-wrapper">

    {{-- Panneau décoratif gauche --}}
    <aside class="auth-panel">
        <div class="auth-panel__inner">

            <a href="{{ url('/') }}" class="auth-panel__logo">
                {{ config('app.name', 'Application') }}
            </a>

            <div class="auth-panel__content">
                <h2 class="auth-panel__headline">@yield('panel_headline', 'Bienvenue')</h2>
                <p class="auth-panel__sub">@yield('panel_sub', 'Accédez à votre espace de gestion.')</p>
            </div>

            <footer class="auth-panel__footer">
                &copy; {{ date('Y') }} {{ config('app.name', 'Application') }}
            </footer>

        </div>
    </aside>

    {{-- Zone formulaire --}}
    <main class="auth-main">
        <div class="auth-form-wrap">
            @yield('content')
        </div>
    </main>

</div>

</body>
</html>
