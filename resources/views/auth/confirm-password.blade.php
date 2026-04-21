@extends('layouts.auth')

@section('title', 'Confirmer le mot de passe')
@section('panel_headline', 'Zone sécurisée')
@section('panel_sub', 'Confirmez votre identité avant de continuer.')

@section('content')

<div class="auth-card">

    <div class="auth-card__header">
        <h1 class="auth-card__title">Confirmer le mot de passe</h1>
        <p class="auth-card__subtitle">
            Cette section est protégée. Veuillez confirmer votre mot de passe pour continuer.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="auth-card__form" novalidate>
        @csrf

        <div class="auth-field">
            <label for="password" class="auth-label">Mot de passe</label>
            <div class="auth-input-wrap">
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="auth-input{{ $errors->has('password') ? ' auth-input--error' : '' }}"
                    required
                    autofocus
                    autocomplete="current-password"
                    placeholder="••••••••"
                >
                <button type="button" class="auth-input-toggle" data-target="password" aria-label="Afficher le mot de passe">
                    <svg class="icon-eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg class="icon-eye-off" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <span class="auth-error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="auth-btn auth-btn--primary">
            <span>Confirmer</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
        </button>

    </form>

</div>

@endsection
