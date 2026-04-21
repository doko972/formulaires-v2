@extends('layouts.auth')

@section('title', 'Vérification e-mail')
@section('panel_headline', 'Vérifiez votre e-mail')
@section('panel_sub', 'Une étape de plus avant d'accéder à votre compte.')

@section('content')

<div class="auth-card">

    <div class="auth-verify">

        <div class="auth-verify__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
            </svg>
        </div>

        <div class="auth-card__header" style="margin-bottom: 0;">
            <h1 class="auth-card__title">Vérifiez votre adresse e-mail</h1>
        </div>

        <p class="auth-verify__text">
            Merci pour votre inscription. Avant de commencer, veuillez vérifier votre adresse
            e-mail en cliquant sur le lien que nous venons de vous envoyer. Si vous n'avez pas
            reçu l'e-mail, nous pouvons vous en envoyer un autre.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="auth-status auth-status--success" style="margin-bottom: 20px;">
                Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
            </div>
        @endif

        <div class="auth-verify__actions">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="auth-btn auth-btn--primary">
                    <span>Renvoyer l'e-mail de vérification</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
                    </svg>
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="auth-btn auth-btn--ghost">
                    <span>Se déconnecter</span>
                </button>
            </form>
        </div>

    </div>

</div>

@endsection
