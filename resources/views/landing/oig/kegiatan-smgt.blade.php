@extends('layouts.landing')

@section('title', 'Kegiatan SMGT 2025 - Gereja Toraja Eben-Haezer Selili')

@section('content')

    <!-- Kegiatan Header -->
    <div class="program-header">
        <div class="program-container">
            <h1 class="program-title">Kegiatan SMGT 2025</h1>
            <!-- Sub Navbar OIG -->
            <div class="oig-subnavbar">
                <a href="{{ route('program-kerja-smgt') }}" class="oig-subnav-link{{ request()->routeIs('program-kerja-smgt') ? ' active' : '' }}">Program Kerja</a>
                <a href="{{ route('kegiatan-smgt') }}" class="oig-subnav-link{{ request()->routeIs('kegiatan-smgt') ? ' active' : '' }}">Kegiatan</a>
                <a href="{{ route('pengurus-smgt') }}" class="oig-subnav-link{{ request()->routeIs('pengurus-smgt') ? ' active' : '' }}">Pengurus</a>
            </div>
        </div>
    </div>

    <!-- Kegiatan Content -->
    <div class="program-container">
        <!-- Kegiatan Grid -->
        <div class="kegiatan-grid">
            <!-- Kegiatan 1 -->
            <div class="kegiatan-card">
                <div class="kegiatan-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Retreat Sekolah Minggu" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">15 Maret 2025</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Retreat Sekolah Minggu</h3>
                    <p class="kegiatan-desc">Kegiatan retreat tahunan untuk anak-anak sekolah minggu yang bertujuan untuk memperkuat iman dan membangun karakter Kristen melalui permainan edukatif, ibadah anak, dan kegiatan outdoor yang menyenangkan.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Camp Toraja</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 50 Anak</span>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 2 -->
            <div class="kegiatan-card">
                <div class="kegiatan-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Festival Anak Kristen" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">22 April 2025</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Festival Anak Kristen</h3>
                    <p class="kegiatan-desc">Festival tahunan yang menampilkan berbagai lomba dan pertunjukan anak-anak seperti menyanyi rohani, drama alkitab, dan lomba hafalan ayat. Acara ini bertujuan untuk mengembangkan bakat dan kreativitas anak dalam nuansa rohani.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Aula Gereja</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 80 Anak</span>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 3 -->
            <div class="kegiatan-card">
                <div class="kegiatan-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Kamp Alkitab Anak" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">10 Juni 2025</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Kamp Alkitab Anak</h3>
                    <p class="kegiatan-desc">Program intensif pembelajaran Alkitab untuk anak-anak dengan metode yang menyenangkan melalui cerita, lagu, dan aktivitas kreatif. Kegiatan ini dirancang untuk memperdalam pengetahuan Alkitab anak-anak.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Ruang SM</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 40 Anak</span>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 4 -->
            <div class="kegiatan-card">
                <div class="kegiatan-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Bakti Sosial Anak" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">25 Agustus 2025</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Bakti Sosial Anak</h3>
                    <p class="kegiatan-desc">Kegiatan bakti sosial yang melibatkan anak-anak sekolah minggu untuk berbagi kasih kepada sesama melalui kunjungan ke panti asuhan dan pembagian sembako. Mengajarkan nilai-nilai kepedulian sosial sejak dini.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Panti Asuhan</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 35 Anak</span>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 5 -->
            <div class="kegiatan-card">
                <div class="kegiatan-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Perayaan Natal Anak" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">20 Desember 2025</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Perayaan Natal Anak</h3>
                    <p class="kegiatan-desc">Perayaan Natal khusus untuk anak-anak dengan pertunjukan drama kelahiran Yesus, paduan suara anak, dan pembagian hadiah. Acara ini menjadi momen spesial untuk merayakan kasih Tuhan bersama anak-anak.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Sanctuary</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 100 Anak</span>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 6 -->
            <div class="kegiatan-card">
                <div class="kegiatan-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Workshop Kreativitas Anak" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">Setiap Sabtu</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Workshop Kreativitas Anak</h3>
                    <p class="kegiatan-desc">Workshop rutin setiap bulan untuk mengembangkan kreativitas anak melalui kerajinan tangan, melukis, dan aktivitas seni lainnya dengan tema-tema rohani. Membantu anak mengekspresikan imannya melalui karya seni.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Ruang Kreatif</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 25 Anak</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .kegiatan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
        padding: 40px 0;
    }

    .kegiatan-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid #e5e7eb;
    }

    .kegiatan-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .kegiatan-img-container {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .kegiatan-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .kegiatan-card:hover .kegiatan-img {
        transform: scale(1.05);
    }

    .kegiatan-overlay {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(153, 121, 57, 0.9);
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .kegiatan-content {
        padding: 25px;
    }

    .kegiatan-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 15px;
        line-height: 1.3;
    }

    .kegiatan-desc {
        color: #6b7280;
        line-height: 1.6;
        margin-bottom: 20px;
        font-size: 0.95rem;
    }

    .kegiatan-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid #e5e7eb;
        font-size: 0.85rem;
    }

    .kegiatan-location,
    .kegiatan-participants {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #9ca3af;
        font-weight: 500;
    }

    .kegiatan-location i,
    .kegiatan-participants i {
        color: var(--primary, #997939);
        font-size: 0.8rem;
    }

    @media (max-width: 768px) {
        .kegiatan-grid {
            grid-template-columns: 1fr;
            gap: 20px;
            padding: 20px 0;
        }

        .kegiatan-card {
            margin: 0 10px;
        }

        .kegiatan-content {
            padding: 20px;
        }

        .kegiatan-title {
            font-size: 1.2rem;
        }

        .kegiatan-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
    }
    </style>
@endsection
