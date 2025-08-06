@extends('layouts.landing')

@section('title', 'Lupa Password - Gereja Toraja Eben-Haezer Selili')

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

    .btn-reset {
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
        margin-top: 10px;
    }

    .btn-reset::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-reset:hover::before {
        left: 100%;
    }

    .btn-reset:hover {
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

    .alert {
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        border: none;
    }

    .alert-success {
        background: rgba(40, 167, 69, 0.1);
        color: #155724;
        border-left: 4px solid #28a745;
    }

    .alert-error {
        background: rgba(220, 53, 69, 0.1);
        color: #721c24;
        border-left: 4px solid #dc3545;
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
                    <i class="fas fa-key"></i>
                </div>
                <h1 class="auth-title">Lupa Password?</h1>
                <p class="auth-subtitle">Tidak masalah! Masukkan email Anda dan kami akan mengirimkan link untuk reset password.</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
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

                <button type="submit" class="btn-reset">
                    <i class="fas fa-paper-plane" style="margin-right: 8px;"></i>
                    Kirim Link Reset Password
                </button>
            </form>

            <div class="auth-footer">
                <p>Ingat password Anda? <a href="{{ route('login') }}">Kembali ke Login</a></p>
            </div>
        </div>
    </div>
</section>
@endsection
