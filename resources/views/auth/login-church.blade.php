@extends('layouts.landing')

@section('title', 'Login - Gereja Toraja Eben-Haezer Selili')

@push('styles')
<style>
    .auth-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg,
            rgba(153, 121, 57, 0.9) 0%,
            rgba(44, 24, 16, 0.95) 100%),
            url('{{ asset("images/church-bg.jpg") }}') center/cover;
        position: relative;
        padding: 120px 20px 60px;
    }

    .auth-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at center,
            rgba(153, 121, 57, 0.1) 0%,
            rgba(44, 24, 16, 0.3) 100%);
        z-index: 1;
    }

    .auth-container {
        position: relative;
        z-index: 2;
        max-width: 450px;
        width: 100%;
    }

    .auth-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 25px;
        padding: 50px 40px;
        box-shadow:
            0 25px 50px rgba(0, 0, 0, 0.2),
            0 0 0 1px rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(153, 121, 57, 0.2);
        animation: slideInUp 0.8s ease-out;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .auth-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .auth-logo {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 10px 30px rgba(153, 121, 57, 0.3);
    }

    .auth-logo i {
        font-size: 2.5rem;
        color: white;
    }

    .auth-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 10px;
    }

    .auth-subtitle {
        color: #666;
        font-size: 1rem;
        line-height: 1.5;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #e1e5e9;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(153, 121, 57, 0.1);
        background: white;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 5px;
    }

    .password-toggle {
        position: relative;
    }

    .password-toggle-btn {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #666;
        cursor: pointer;
        padding: 5px;
        transition: color 0.3s ease;
    }

    .password-toggle-btn:hover {
        color: var(--primary);
    }

    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        font-size: 0.9rem;
    }

    .form-check {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-check input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--primary);
    }

    .forgot-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .forgot-link:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    .btn-login {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-login:hover::before {
        left: 100%;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(153, 121, 57, 0.4);
    }

    .auth-footer {
        text-align: center;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #e1e5e9;
    }

    .auth-footer a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
    }

    .auth-footer a:hover {
        text-decoration: underline;
    }

    .back-to-home {
        position: absolute;
        top: 30px;
        left: 30px;
        z-index: 3;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 12px 20px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .back-to-home:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
    }

    .back-to-home i {
        margin-right: 8px;
    }

    @media (max-width: 768px) {
        .auth-card {
            padding: 40px 30px;
            margin: 20px;
        }

        .auth-title {
            font-size: 1.75rem;
        }

        .back-to-home {
            top: 20px;
            left: 20px;
            padding: 10px 15px;
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@section('content')
<section class="auth-section">
    <a href="{{ route('home') }}" class="back-to-home">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Beranda
    </a>

    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-logo">
                    <i class="fas fa-church"></i>
                </div>
                <h1 class="auth-title">Selamat Datang</h1>
                <p class="auth-subtitle">Silakan masuk ke akun Anda untuk mengakses sistem Gereja Toraja Eben-Haezer Selili</p>

                @if(app()->environment('local'))
                <div style="background: rgba(153, 121, 57, 0.1); padding: 15px; border-radius: 10px; margin-top: 20px; border-left: 4px solid var(--primary);">
                    <h4 style="color: var(--primary); margin-bottom: 10px; font-size: 0.9rem;">
                        <i class="fas fa-info-circle"></i> Kredensial Admin (Development)
                    </h4>
                    <div style="font-size: 0.8rem; color: #666;">
                        <p style="margin: 5px 0;"><strong>Email:</strong> admin@gerejatoraja.com</p>
                        <p style="margin: 5px 0;"><strong>Password:</strong> admin123</p>
                        <hr style="margin: 8px 0; border-color: rgba(153, 121, 57, 0.2);">
                        <p style="margin: 5px 0;"><strong>Email:</strong> admin@eben-haezer.com</p>
                        <p style="margin: 5px 0;"><strong>Password:</strong> gereja2024</p>
                    </div>
                </div>
                @endif
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email Anda"
                        required
                        autofocus
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-toggle">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukkan password Anda"
                            required
                        >
                        <button type="button" class="password-toggle-btn" onclick="togglePassword()">
                            <i class="fas fa-eye" id="password-icon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-options">
                    <div class="form-check">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Ingat saya</label>
                    </div>
                    {{-- @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                    @endif --}}
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>
                    Masuk
                </button>
            </form>


        </div>
    </div>
</section>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const passwordIcon = document.getElementById('password-icon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        passwordIcon.classList.remove('fa-eye-slash');
        passwordIcon.classList.add('fa-eye');
    }
}
</script>
@endsection
