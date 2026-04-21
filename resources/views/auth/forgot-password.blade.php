@extends('layouts.auth')

@section('title', 'Mot de passe oublié')
@section('panel_headline', 'Réinitialisation')
@section('panel_sub', 'Nous vous enverrons un lien sécurisé pour choisir un nouveau mot de passe.')

@section('content')

<div class="auth-card">

    <div class="auth-card__header">
        <h1 class="auth-card__title">Mot de passe oublié</h1>
        <p class="auth-card__subtitle">
            Renseignez votre adresse e-mail et nous vous enverrons un lien de réinitialisation.
        </p>
    </div>

    @if (session('status'))
        <div class="auth-status auth-status--success" style="margin-bottom: 20px;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="auth-card__form" novalidate>
        @csrf

        <div class="auth-field">
            <label for="email" class="auth-label">Adresse e-mail</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="auth-input{{ $errors->has('email') ? ' auth-input--error' : '' }}"
                required
                autofocus
                autocomplete="email"
                placeholder="nom@exemple.com"
            >
            @error('email')
                <span class="auth-error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="auth-btn auth-btn--primary">
            <span>Envoyer le lien</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
            </svg>
        </button>

        <p class="auth-card__switch">
            <a href="{{ route('login') }}" class="auth-link">Retour à la connexion</a>
        </p>

    </form>

</div>

@endsection
