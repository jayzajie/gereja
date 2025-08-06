@extends('layouts.landing')

@section('title', 'Sejarah Jemaat Eben-Haezer Selili - Gereja Toraja')

@push('styles')
<style>
    /* Header Section dengan gambar */
    .page-header {
        background: linear-gradient(135deg, #997939 0%, #b59756 100%);
        padding: 120px 0 80px;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
        margin-top: 85px;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('{{ asset('images/gereja-eben-haezer.jpg') }}');
        background-size: cover;
        background-position: center;
        opacity: 0.3;
        z-index: 1;
    }

    .page-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(153, 121, 57, 0.8) 0%, rgba(181, 151, 86, 0.8) 100%);
        z-index: 2;
    }

    .header-content {
        position: relative;
        z-index: 3;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .page-title {
        font-size: 3rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 0.8s ease-out;
    }

    .page-subtitle {
        font-size: 1.2rem;
        margin-top: 15px;
        opacity: 0.9;
        animation: fadeInUp 0.8s ease-out 0.2s both;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

        /* Tambahan untuk dropdown kanan */
.dropdown-content.right {
    left: 100%;
    top: 0;
    margin-left: 0.5rem;
    min-width: 180px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: var(--transition);
    display: none; /* Tambahkan ini untuk memastikan tidak terlihat */
}

.nav-item.dropdown .dropdown-content .nav-item.dropdown {
    position: relative;
}

/* Perbaikan untuk menampilkan dropdown hanya pada hover item spesifik */
.nav-item.dropdown .dropdown-content .nav-item.dropdown:hover > .dropdown-content.right {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    display: block; /* Tambahkan ini untuk memastikan terlihat saat hover */
}

/* Pastikan dropdown tidak menumpuk */
.nav-item.dropdown .dropdown-content .nav-item.dropdown > .dropdown-content.right a {
    display: block;
    width: 100%;
}

        .content-section {
            margin-top: 120px;
            padding: 40px 0;
            background-color: var(--bg-light);
        }

        .content-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        }

        .page-title {
            color: var(--primary);
            font-size: 2.5rem;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: var(--primary);
        }

        .nav-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .nav-tab {
            padding: 10px 20px;
            margin: 0 10px;
            color: var(--text-dark);
            text-decoration: none;
            border-radius: 5px;
            transition: var(--transition);
            position: relative;
        }

        .nav-tab.active {
            background: var(--primary);
            color: white;
        }

        .nav-tab:hover:not(.active) {
            background: rgba(153, 121, 57, 0.1);
        }

        .content-section h3 {
            color: var(--primary);
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .content-grid {
            display: flex;
            flex-direction: column;
            gap: 30px;
            margin-top: 30px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .content-image {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
            order: 1;
        }

        .content-image img {
            width: 100%;
            max-width: 500px;
            height: auto;
            display: block;
            margin: 0 auto;
            transition: transform 0.5s ease;
        }

        .content-image:hover img {
            transform: scale(1.05);
        }

        .content-text {
            order: 2;
            text-align: justify;
        }

        .content-text p {
            margin-bottom: 20px;
            line-height: 1.8;
            color: var(--text-dark);
        }

        .text-muted {
            color: #6c757d !important;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .content-grid {
                gap: 20px;
            }

            .content-image img {
                max-width: 100%;
            }
        }

        /* Footer styles */
        footer {
            background-color: #fff;
            border-top: 1px solid #eaeaea;
            padding: 20px 0;
            margin-top: 40px;
        }

        .footer-logo {
            max-width: 150px;
            margin-bottom: 10px;
        }

        .social-links {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .social-links a {
            color: #997939;
            font-size: 20px;
        }

        .footer-address {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }

        /* Local church info styles */
        .local-church-info {
            background: rgba(153, 121, 57, 0.1);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            border-left: 4px solid var(--primary);
        }

        .local-church-info h4 {
            color: var(--primary);
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .local-church-info h4 i {
            margin-right: 8px;
        }

        .local-church-info p {
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .local-church-info strong {
            color: var(--primary);
        }
    </style>
@endpush

@section('content')
    <!-- Page Header dengan gambar -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Sejarah Jemaat Eben-Haezer Selili</h1>
            <p class="page-subtitle">Perjalanan iman jemaat dalam melayani Tuhan dan sesama</p>
        </div>
    </div>

    <!-- Content Section -->
    <section class="content-section">
        <div class="content-container">
            <div class="nav-tabs">
                <a href="{{ route('sejarah.gereja') }}" class="nav-tab">Sejarah Gereja Toraja</a>
                <a href="{{ route('sejarah.jemaat') }}" class="nav-tab active">Sejarah Gereja Toraja Jemaat Eben-Haezer Selili</a>
            </div>

            <div class="content-body">
                @if($sejarahJemaat)
                    <h3>{{ $sejarahJemaat->title }}</h3>
                @else
                    <h3>Sejarah Gereja Toraja Jemaat Eben-Haezer Selili</h3>
                @endif

                <div class="content-grid">
                    <div class="content-image">
                        @if($sejarahJemaat && $sejarahJemaat->logo)
                            <img src="{{ $sejarahJemaat->logo_url }}" alt="Logo {{ $sejarahJemaat->title }}">
                        @elseif($sejarahJemaat && $sejarahJemaat->banner_image)
                            <img src="{{ $sejarahJemaat->banner_image_url }}" alt="Banner {{ $sejarahJemaat->title }}">
                        @else
                            <img src="{{ asset('images/gereja-eben-haezer.jpg') }}" alt="Gereja Toraja Jemaat Eben-Haezer Selili" class="w-full h-auto">
                        @endif
                    </div>

                    <div class="content-text">
                        @if($sejarahJemaat && $sejarahJemaat->content)
                            {!! nl2br(e($sejarahJemaat->content)) !!}
                        @else
                            <p class="text-muted">Belum ada konten sejarah jemaat. Silakan tambahkan melalui halaman admin.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
