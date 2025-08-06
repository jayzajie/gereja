<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Gereja Toraja Eben-Haezer Selili')</title>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="@yield('body-class')"

    <!-- Enhanced Floating Shapes -->
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
    <div class="shape shape-4"></div>
    <div class="shape shape-5"></div>

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

                <!-- OIG -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link">OIG <i class="fas fa-chevron-down"></i></a>
                    <div class="dropdown-content">
                        <!-- PKBGT -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link">PKBGT <i class="fas fa-chevron-right"></i></a>
                            <div class="dropdown-content right">
                                <a href="{{ route('pengurus-pkbgt') }}">Pengurus PKBGT</a>
                                <a href="{{ route('program-kerja-pkbgt') }}">Program Kerja PKBGT</a>
                                <a href="{{ route('kegiatan-pkbgt') }}">Kegiatan PKBGT</a>
                            </div>
                        </div>

                        <!-- PWGT -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link">PWGT <i class="fas fa-chevron-right"></i></a>
                            <div class="dropdown-content right">
                                <a href="{{ route('pengurus-pwgt') }}">Pengurus PWGT</a>
                                <a href="{{ route('program-kerja-pwgt') }}">Program Kerja PWGT</a>
                                <a href="{{ route('kegiatan-pwgt') }}">Kegiatan PWGT</a>
                            </div>
                        </div>

                        <!-- PPGT -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link">PPGT <i class="fas fa-chevron-right"></i></a>
                            <div class="dropdown-content right">
                                <a href="{{ route('pengurus-ppgt') }}">Pengurus PPGT</a>
                                <a href="{{ route('program-kerja-ppgt') }}">Program Kerja PPGT</a>
                                <a href="{{ route('kegiatan-ppgt') }}">Kegiatan PPGT</a>
                            </div>
                        </div>

                        <!-- SMGT -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link">SMGT <i class="fas fa-chevron-right"></i></a>
                            <div class="dropdown-content right">
                                <a href="{{ route('pengurus-smgt') }}">Pengurus SMGT</a>
                                <a href="{{ route('program-kerja-smgt') }}">Program Kerja SMGT</a>
                                <a href="{{ route('kegiatan-smgt') }}">Kegiatan SMGT</a>
                            </div>
                        </div>
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
                    <a href="#" class="nav-link">Contact <i class="fas fa-chevron-down"></i></a>
                    <div class="dropdown-content">
                        <a href="{{ route('pengelolaan-surat-nikah') }}">pengelolaan Surat Nikah</a>
                        <a href="{{ route('pengelolaan-baptis') }}">pengelolaan Baptis</a>
                        <a href="{{ route('daftar-anggota') }}">Daftar Anggota</a>
                        <a href="{{ route('saran') }}">Saran</a>
                    </div>
                </div>

                <div class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">Login <i class="fas fa-sign-in-alt"></i></a>
                </div>
            </div>

            <div class="hamburger" id="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    @include('partials.footer')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
    <script src="{{ asset('js/landing.js') }}"></script>
    @stack('scripts')
</body>
</html>
