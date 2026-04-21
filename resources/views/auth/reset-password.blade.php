@extends('layouts.auth')

@section('title', 'Nouveau mot de passe')
@section('panel_headline', 'Nouveau mot de passe')
@section('panel_sub', 'Choisissez un mot de passe sécurisé pour protéger votre compte.')

@section('content')

<div class="auth-card">

    <div class="auth-card__header">
        <h1 class="auth-card__title">Nouveau mot de passe</h1>
        <p class="auth-card__subtitle">Choisissez un mot de passe fort pour sécuriser votre compte</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="auth-card__form" novalidate>
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="auth-field">
            <label for="email" class="auth-label">Adresse e-mail</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                class="auth-input{{ $errors->has('email') ? ' auth-input--error' : '' }}"
                required
                autofocus
                autocomplete="username"
                placeholder="nom@exemple.com"
            >
            @error('email')
                <span class="auth-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-field">
            <label for="password" class="auth-label">Nouveau mot de passe</label>
            <div class="auth-input-wrap">
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="auth-input{{ $errors->has('password') ? ' auth-input--error' : '' }}"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                    data-strength="true"
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
            <div class="password-strength" id="password-strength">
                <div class="password-strength__bar">
                    <div class="password-strength__fill"></div>
                </div>
                <span class="password-strength__label"></span>
            </div>
            @error('password')
                <span class="auth-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-field">
            <label for="password_confirmation" class="auth-label">Confirmer le mot de passe</label>
            <div class="auth-input-wrap">
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="auth-input"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                >
                <button type="button" class="auth-input-toggle" data-target="password_confirmation" aria-label="Afficher le mot de passe">
                    <svg class="icon-eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg class="icon-eye-off" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>
            @error('password_confirmation')
                <span class="auth-error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="auth-btn auth-btn--primary">
            <span>Réinitialiser le mot de passe</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
            </svg>
        </button>

    </form>

</div>

@endsection
