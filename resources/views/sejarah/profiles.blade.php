@extends('layouts.landing')

@section('title', 'Profil Gereja - Gereja Toraja Eben-Haezer Selili')

@push('styles')
<style>
        .content-section {
            margin-top: 120px;
            padding: 40px 0;
            background-color: var(--bg-light);
        }

        .content-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .page-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 40px;
        }

        .profiles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .profile-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #e0e0e0;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
            border: 3px solid var(--primary-color);
        }

        .profile-info h3 {
            color: var(--primary-color);
            font-size: 1.3rem;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .profile-info .status {
            color: #28a745;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .profile-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .profile-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .profile-date {
            color: #999;
            font-size: 0.9rem;
        }

        .view-detail-btn {
            background: var(--primary-color);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .view-detail-btn:hover {
            background: var(--primary-dark);
            color: white;
        }

        .no-profiles {
            text-align: center;
            color: #666;
            font-size: 1.1rem;
            margin-top: 60px;
        }

        @media (max-width: 768px) {
            .profiles-grid {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 2rem;
            }

            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-logo {
                margin-right: 0;
                margin-bottom: 15px;
            }
        }
    </style>
@endpush

@section('content')
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="nav-logo">
                <i class="fas fa-church"></i>
                <span>Gereja Toraja Eben-Haezer Selili</span>
            </a>

            <div class="nav-menu" id="nav-menu">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link">Profil Gereja <i class="fas fa-chevron-down"></i></a>
                    <div class="dropdown-content">
                        <a href="{{ route('sejarah.gereja') }}">Sejarah Gereja</a>
                        <a href="{{ route('anggota-jemaat') }}">Anggota Jemaat</a>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link">Informasi <i class="fas fa-chevron-down"></i></a>
                    <div class="dropdown-content">
                        <a href="{{ route('pendeta-jemaat') }}">Pendeta Jemaat</a>
                        <a href="{{ route('kegiatan-jemaat') }}">Kegiatan Jemaat</a>
                        <a href="{{ route('warta-jemaat') }}">Warta Jemaat</a>
                        <a href="{{ route('program-kerja') }}">Program Kerja</a>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link">OIG <i class="fas fa-chevron-down"></i></a>
                    <div class="dropdown-content">
                        <a href="{{ route('pkbgt') }}">PKBGT</a>
                        <a href="{{ route('pwgt') }}">PWGT</a>
                        <a href="{{ route('ppgt') }}">PPGT</a>
                        <a href="{{ route('smgt') }}">SMGT</a>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link">Contact <i class="fas fa-chevron-down"></i></a>
                    <div class="dropdown-content">
                        <a href="{{ route('pengelolaan-surat-nikah') }}">Pengelolaan Surat Nikah</a>
                        <a href="{{ route('pengelolaan-baptis') }}">Pengelolaan Baptis</a>
                        <a href="{{ route('daftar-anggota') }}">Daftar Anggota</a>
                        <a href="{{ route('saran') }}">Saran</a>
                    </div>
                </div>
            </div>

            <div class="hamburger" id="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <div class="content-container" data-aos="fade-up">
                <h2 class="page-title">Profil Gereja</h2>

                @if($churchProfiles && $churchProfiles->count() > 0)
                    <div class="profiles-grid">
                        @foreach($churchProfiles as $profile)
                            <div class="profile-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <div class="profile-header">
                                    @if($profile->logo)
                                        <img src="{{ $profile->logo_url }}" alt="Logo {{ $profile->name }}" class="profile-logo">
                                    @else
                                        <div class="profile-logo" style="background: var(--primary-color); display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-church" style="color: white; font-size: 2rem;"></i>
                                        </div>
                                    @endif
                                    <div class="profile-info">
                                        <h3>{{ $profile->name }}</h3>
                                        <div class="status">
                                            <i class="fas fa-check-circle"></i> Aktif
                                        </div>
                                    </div>
                                </div>

                                <div class="profile-description">
                                    {{ Str::limit($profile->description ?? 'Profil gereja ini belum memiliki deskripsi.', 150) }}
                                </div>

                                <div class="profile-meta">
                                    <div class="profile-date">
                                        <i class="fas fa-calendar"></i>
                                        {{ $profile->created_at->format('d M Y') }}
                                    </div>
                                    <a href="{{ route('sejarah.profile-detail', $profile->id) }}" class="view-detail-btn">
                                        <i class="fas fa-eye"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="no-profiles">
                        <i class="fas fa-info-circle" style="font-size: 3rem; color: #ccc; margin-bottom: 20px;"></i>
                        <p>Belum ada profil gereja yang tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection
