@extends('layouts.landing')

@section('title', 'PPGT - Gereja Toraja Eben-Haezer Selili')

@push('styles')
<style>
        /* Tambahan CSS untuk halaman OIG */
        .oig-header {
            background-color: #f8f9fa;
            padding: 2rem 0;
            text-align: center;
            position: relative;
            margin-top: 90px; /* Kurangi margin untuk navbar fixed */
        }

        .oig-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .oig-title {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: #333;
            text-align: center;
        }

        .oig-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .oig-card {
            background: #f5f5f5;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            margin-bottom: 1.5rem;
        }

        .oig-card:hover {
            transform: translateY(-5px);
        }

        .oig-img-container {
            height: 200px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #eee;
        }

        .oig-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .oig-info {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .oig-name {
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .oig-desc {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .contact-info {
            margin-top: 3rem;
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .contact-icon {
            font-size: 1.2rem;
            margin-right: 1rem;
            color: #007bff;
        }

        @media (max-width: 992px) {
            .oig-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .oig-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <style>
        .oig-subnavbar {
            margin: 1.5rem 0;
            text-align: center;
        }
        .oig-subnav-link {
            display: inline-block;
            margin: 0 1rem;
            padding: 0.5rem 1.5rem;
            background: #b08a3a;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.2s;
        }
        .oig-subnav-link:hover, .oig-subnav-link.active {
            background: #8a6d2f;
            color: #fff;
        }
    </style>
    <style>
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
                        <!-- PKBGT -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link">PKBGT <i class="fas fa-chevron-right"></i></a>
                            <div class="dropdown-content right">
                                <a href="{{ route('pengurus-pkbgt') }}">Pengurus PKBGT</a>
                                <a href="{{ route('program-kerja-pkbgt') }}">Program Kerja PKBGT</a>
                                <a href="{{ route('program-kerja-pwgt') }}">Kegiatan PKBGT</a>
                            </div>
                        </div>

                        <!-- PWGT -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link">PWGT <i class="fas fa-chevron-right"></i></a>
                            <div class="dropdown-content right">
                                <a href="{{ route('pengurus-pwgt') }}">Pengurus PWGT</a>
                                <a href="{{ route('program-kerja-pwgt') }}">Program Kerja PWGT</a>
                                <a href="{{ route('program-kerja-pwgt') }}">Kegiatan PWGT</a>
                            </div>
                        </div>

                        <!-- PPGT -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link">PPGT <i class="fas fa-chevron-right"></i></a>
                            <div class="dropdown-content right">
                                <a href="{{ route('pengurus-ppgt') }}">Pengurus PPGT</a>
                                <a href="{{ route('program-kerja-ppgt') }}">Program Kerja PPGT</a>
                                <a href="{{ route('program-kerja-pwgt') }}">Kegiatan PPGT</a>
                            </div>
                        </div>

                        <!-- SMGT -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link">SMGT <i class="fas fa-chevron-right"></i></a>
                            <div class="dropdown-content right">
                                <a href="{{ route('pengurus-smgt') }}">Pengurus SMGT</a>
                                <a href="{{ route('program-kerja-smgt') }}">Program Kerja SMGT</a>
                                <a href="{{ route('program-kerja-pwgt') }}">Kegiatan SMGT</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link">Contact <i class="fas fa-chevron-down"></i></a>
                    <div class="dropdown-content">
                        <a href="{{ route('pengelolaan-surat-nikah') }}">pengelolaan Surat Nikah</a>
                        <a href="{{ route('pengelolaan-baptis') }}">pengelolaan Baptis</a>
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

    <!-- OIG Header -->
    <div class="oig-header">
        <div class="oig-container">
            <h1 class="oig-title">Kegiatan OIG Tahun 2025</h1>
            <!-- Sub Navbar OIG -->
            <div class="oig-subnavbar">
                <a href="{{ route('program-kerja-ppgt') }}" class="oig-subnav-link{{ request()->routeIs('program-kerja-ppgt') ? ' active' : '' }}">Program Kerja</a>
                <a href="{{ route('pengurus-ppgt') }}" class="oig-subnav-link{{ request()->routeIs('pengurus-ppgt') ? ' active' : '' }}">Pengurus</a>
            </div>
        </div>
    </div>

    <!-- OIG Content -->
    <div class="oig-container">
        <div class="oig-grid">
            <!-- Kegiatan 1 -->
            <div class="oig-card">
                <div class="oig-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Kegiatan 1" class="oig-img">
                </div>
                <div class="oig-info">
                    <div class="oig-name">1. Nama Kegiatan</div>
                    <div class="oig-desc">Deskripsi singkat tentang kegiatan ini. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                </div>
            </div>

            <!-- Kegiatan 2 -->
            <div class="oig-card">
                <div class="oig-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Kegiatan 2" class="oig-img">
                </div>
                <div class="oig-info">
                    <div class="oig-name">2. Nama Kegiatan</div>
                    <div class="oig-desc">Deskripsi singkat tentang kegiatan ini. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                </div>
            </div>

            <!-- Kegiatan 3 -->
            <div class="oig-card">
                <div class="oig-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Kegiatan 3" class="oig-img">
                </div>
                <div class="oig-info">
                    <div class="oig-name">3. Nama Kegiatan</div>
                    <div class="oig-desc">Deskripsi singkat tentang kegiatan ini. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                </div>
            </div>

            <!-- Kegiatan 4 -->
            <div class="oig-card">
                <div class="oig-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Kegiatan 4" class="oig-img">
                </div>
                <div class="oig-info">
                    <div class="oig-name">4. Nama Kegiatan</div>
                    <div class="oig-desc">Deskripsi singkat tentang kegiatan ini. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                </div>
            </div>

            <!-- Kegiatan 5 -->
            <div class="oig-card">
                <div class="oig-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Kegiatan 5" class="oig-img">
                </div>
                <div class="oig-info">
                    <div class="oig-name">5. Nama Kegiatan</div>
                    <div class="oig-desc">Deskripsi singkat tentang kegiatan ini. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                </div>
            </div>

            <!-- Kegiatan 6 -->
            <div class="oig-card">
                <div class="oig-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Kegiatan 6" class="oig-img">
                </div>
                <div class="oig-info">
                    <div class="oig-name">6. Nama Kegiatan</div>
                    <div class="oig-desc">Deskripsi singkat tentang kegiatan ini. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                </div>
            </div>
        </div>


    </div>

@endsection
