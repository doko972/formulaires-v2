document.addEventListener('DOMContentLoaded', () => {
    initPasswordToggles();
    initPasswordStrength();
    initPasswordConfirm();
    initFormSubmit();
});

function initPasswordToggles() {
    document.querySelectorAll('.auth-input-toggle').forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.dataset.target;
            const input = document.getElementById(targetId);
            if (!input) return;

            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';

            const eyeIcon    = btn.querySelector('.icon-eye');
            const eyeOffIcon = btn.querySelector('.icon-eye-off');
            if (eyeIcon)    eyeIcon.style.display    = isHidden ? 'none' : '';
            if (eyeOffIcon) eyeOffIcon.style.display = isHidden ? ''     : 'none';

            btn.setAttribute('aria-label', isHidden ? 'Masquer le mot de passe' : 'Afficher le mot de passe');
        });
    });
}

function initPasswordStrength() {
    const passwordInput = document.querySelector('[data-strength="true"]');
    if (!passwordInput) return;

    const widget = document.getElementById('password-strength');
    if (!widget) return;

    const label  = widget.querySelector('.password-strength__label');
    const levels = ['', 'Faible', 'Moyen', 'Fort', 'Excellent'];

    passwordInput.addEventListener('input', () => {
        const val   = passwordInput.value;
        const score = getPasswordScore(val);

        if (val.length === 0) {
            widget.classList.remove('is-active');
            widget.removeAttribute('data-strength');
        } else {
            widget.classList.add('is-active');
            widget.setAttribute('data-strength', score);
            if (label) label.textContent = levels[score] ?? '';
        }
    });
}

function getPasswordScore(password) {
    if (!password || password.length < 4) return 1;
    let score = 0;
    if (password.length >= 8)                                          score++;
    if (password.length >= 12)                                         score++;
    if (/[A-Z]/.test(password) && /[a-z]/.test(password))             score++;
    if (/[0-9]/.test(password))                                        score++;
    if (/[^A-Za-z0-9]/.test(password))                                 score++;

    if (score <= 1) return 1;
    if (score <= 2) return 2;
    if (score <= 3) return 3;
    return 4;
}

function initPasswordConfirm() {
    const password = document.getElementById('password');
    const confirm  = document.getElementById('password_confirmation');
    if (!password || !confirm) return;

    confirm.addEventListener('input', () => {
        if (confirm.value.length === 0) {
            confirm.classList.remove('auth-input--match', 'auth-input--mismatch');
            return;
        }
        const matches = confirm.value === password.value;
        confirm.classList.toggle('auth-input--match',    matches);
        confirm.classList.toggle('auth-input--mismatch', !matches);
    });
}

function initFormSubmit() {
    document.querySelectorAll('.auth-card__form').forEach(form => {
        form.addEventListener('submit', () => {
            const btn  = form.querySelector('.auth-btn--primary');
            if (!btn) return;
            btn.disabled = true;
            const span = btn.querySelector('span');
            if (span) span.textContent = 'Chargement…';
        });
    });
}
