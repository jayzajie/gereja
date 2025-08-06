<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $churchProfile->name }} - Detail Profil Gereja</title>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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

        .back-button {
            display: inline-flex;
            align-items: center;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 30px;
            transition: color 0.3s ease;
        }

        .back-button:hover {
            color: var(--primary-dark);
        }

        .back-button i {
            margin-right: 8px;
        }

        .profile-header {
            background: white;
            border-radius: 15px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }

        .profile-logo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
            border: 4px solid var(--primary-color);
        }

        .profile-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .profile-status {
            color: #28a745;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .profile-content {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .content-section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0e0e0;
        }

        .content-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #333;
            text-align: justify;
        }

        .content-text p {
            margin-bottom: 20px;
        }

        .profile-meta {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .meta-item {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid var(--primary-color);
        }

        .meta-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .meta-value {
            color: #666;
        }

        @media (max-width: 768px) {
            .profile-header,
            .profile-content,
            .profile-meta {
                padding: 20px;
            }

            .profile-title {
                font-size: 2rem;
            }

            .meta-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
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
                <a href="{{ route('sejarah.profiles') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Daftar Profil
                </a>

                <!-- Profile Header -->
                <div class="profile-header" data-aos="fade-up" data-aos-delay="100">
                    @if($churchProfile->logo)
                        <img src="{{ $churchProfile->logo_url }}" alt="Logo {{ $churchProfile->name }}" class="profile-logo">
                    @else
                        <div class="profile-logo" style="background: var(--primary-color); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-church" style="color: white; font-size: 3rem;"></i>
                        </div>
                    @endif
                    <h1 class="profile-title">{{ $churchProfile->name }}</h1>
                    <div class="profile-status">
                        <i class="fas fa-check-circle"></i> Profil Aktif
                    </div>
                </div>

                <!-- Profile Description -->
                @if($churchProfile->description)
                <div class="profile-content" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="content-section-title">
                        <i class="fas fa-info-circle"></i> Deskripsi
                    </h2>
                    <div class="content-text">
                        {!! nl2br(e($churchProfile->description)) !!}
                    </div>
                </div>
                @endif

                <!-- Profile History -->
                @if($churchProfile->history)
                <div class="profile-content" data-aos="fade-up" data-aos-delay="300">
                    <h2 class="content-section-title">
                        <i class="fas fa-history"></i> Sejarah
                    </h2>
                    <div class="content-text">
                        {!! nl2br(e($churchProfile->history)) !!}
                    </div>
                </div>
                @endif

                <!-- Profile Meta Information -->
                <div class="profile-meta" data-aos="fade-up" data-aos-delay="400">
                    <h2 class="content-section-title">
                        <i class="fas fa-info"></i> Informasi Profil
                    </h2>
                    <div class="meta-grid">
                        <div class="meta-item">
                            <div class="meta-label">Status</div>
                            <div class="meta-value">
                                @if($churchProfile->is_active)
                                    <span style="color: #28a745;"><i class="fas fa-check-circle"></i> Aktif</span>
                                @else
                                    <span style="color: #dc3545;"><i class="fas fa-times-circle"></i> Tidak Aktif</span>
                                @endif
                            </div>
                        </div>
                        <div class="meta-item">
                            <div class="meta-label">Tanggal Dibuat</div>
                            <div class="meta-value">{{ $churchProfile->created_at->format('d F Y') }}</div>
                        </div>
                        <div class="meta-item">
                            <div class="meta-label">Terakhir Diperbarui</div>
                            <div class="meta-value">{{ $churchProfile->updated_at->format('d F Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

    <script src="{{ asset('js/landing.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    </script>
</body>
</html>
