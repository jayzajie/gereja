@extends('layouts.landing')

@section('title', 'Pendeta Eben-Haezer Selili - Gereja Toraja Eben-Haezer Selili')

@push('styles')
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
        /* Tambahan CSS untuk halaman pendeta jemaat */
        :root {
            --primary-color: #997939; /* Warna utama emas/coklat keemasan */
            --secondary-color: #b8a369; /* Warna sekunder emas yang lebih terang */
            --accent-color: #d4c28f; /* Warna aksen emas yang lebih muda */
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark-color);
            background-color: #f9f9f9;
        }

        /* Header styling */
        .pendeta-header {
            background: linear-gradient(135deg, #997911, #693708);
            padding: 4rem 0;
            text-align: center;
            position: relative;
            color: white;
            margin-bottom: 3rem;
            margin-top: 90px; /* Kurangi margin untuk navbar fixed */
            border-radius: 0 0 30% 30% / 15%;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .pendeta-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .pendeta-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: white;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            letter-spacing: 1px;
            position: relative;
            display: inline-block;
        }

        .pendeta-title:after {
            content: '';
            position: absolute;
            width: 80px;
            height: 4px;
            background-color: #d4c28f; /* Warna garis bawah judul */
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .pendeta-subtitle {
            font-size: 1.2rem;
            margin-top: 1.5rem;
            color: rgba(255,255,255,0.9);
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Card grid styling */
        .pendeta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2.5rem;
            margin-top: 2rem;
        }

        .pendeta-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: var(--transition);
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .pendeta-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .pendeta-img-container {
            height: 300px;
            overflow: hidden;
            position: relative;
        }

        .pendeta-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .pendeta-card:hover .pendeta-img {
            transform: scale(1.05);
        }

        .pendeta-info {
            padding: 2rem;
            text-align: center;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .pendeta-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #997939; /* Warna nama pendeta */
        }

        .pendeta-year {
            color: #b8a369; /* Warna tahun menjabat */
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .pendeta-number {
            font-size: 3rem;
            font-weight: 800;
            margin-top: 1rem;
            color: #d4c28f; /* Warna nomor pendeta */
            opacity: 0.5;
            position: absolute;
            bottom: 10px;
            right: 20px;
        }

        /* Contact section styling */
        .contact-info {
            margin-top: 5rem;
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .contact-info h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #997939; /* Warna judul kontak */
            position: relative;
            display: inline-block;
        }

        .contact-info h2:after {
            content: '';
            position: absolute;
            width: 60px;
            height: 3px;
            background-color: #b8a369; /* Warna garis bawah judul kontak */
            bottom: -10px;
            left: 0;
            border-radius: 2px;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            padding: 1rem;
            border-radius: 10px;
            transition: var(--transition);
        }

        .contact-item:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }

        .contact-icon {
            font-size: 1.5rem;
            margin-right: 1.5rem;
            color: #997939; /* Warna ikon kontak */
            background-color: rgba(153, 121, 57, 0.1); /* Warna latar ikon kontak */
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .contact-item p {
            margin: 0;
            font-size: 1.1rem;
            line-height: 1.6;
            color: var(--dark-color);
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .pendeta-title {
                font-size: 2.5rem;
            }

            .pendeta-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .pendeta-header {
                padding: 3rem 0;
                border-radius: 0 0 15% 15% / 10%;
            }

            .pendeta-title {
                font-size: 2rem;
            }

            .pendeta-grid {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
                gap: 1.5rem;
            }

            .pendeta-img-container {
                height: 250px;
            }

            .contact-info {
                padding: 2rem;
            }
        }

        @media (max-width: 576px) {
            .pendeta-container {
                padding: 1.5rem;
            }

            .pendeta-grid {
                grid-template-columns: 1fr;
            }

            .pendeta-card {
                max-width: 350px;
                margin: 0 auto;
            }
        }
</style>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
@endpush

@section('content')



    <!-- Pendeta Jemaat Header -->
    <div class="pendeta-header" data-aos="fade-down">
        <div class="pendeta-container">
            <h1 class="pendeta-title">Pendeta Jemaat Eben-Haezer Selili</h1>
            <p class="pendeta-subtitle">Mengenal para pendeta yang telah melayani dan membimbing jemaat Gereja Toraja Eben-Haezer Selili</p>
        </div>
    </div>

    <!-- Pendeta Jemaat Content -->
    <div class="pendeta-container">
        <div class="pendeta-grid">
            @forelse($pastors as $index => $pastor)
            <!-- Pendeta Card {{ $index + 1 }} -->
            <div class="pendeta-card" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="pendeta-img-container">
                    @if($pastor->photo)
                        <img src="{{ asset('storage/' . $pastor->photo) }}" alt="{{ $pastor->name }}" class="pendeta-img">
                    @else
                        <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="{{ $pastor->name }}" class="pendeta-img">
                    @endif
                </div>
                <div class="pendeta-info">
                    <div>
                        <div class="pendeta-name">{{ $pastor->name }}</div>
                        <div class="pendeta-year">
                            @if($pastor->ordination_date)
                                {{ $pastor->ordination_date->format('Y') }} -
                                @if($pastor->status == 'active')
                                    {{ $pastor->end_date ? $pastor->end_date->format('Y') : date('Y') }}
                                @else
                                    {{ $pastor->end_date ? $pastor->end_date->format('Y') : date('Y') }}
                                @endif
                            @else
                                Tahun Menjabat
                            @endif
                        </div>
                    </div>
                    <div class="pendeta-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                </div>
            </div>
            @empty
            <!-- Default Card jika tidak ada data -->
            <div class="pendeta-card" data-aos="fade-up" data-aos-delay="100">
                <div class="pendeta-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Belum ada data" class="pendeta-img">
                </div>
                <div class="pendeta-info">
                    <div>
                        <div class="pendeta-name">Belum ada data pendeta</div>
                        <div class="pendeta-year">Silakan tambahkan melalui admin</div>
                    </div>
                    <div class="pendeta-number">--</div>
                </div>
            </div>
            @endforelse
        </div>
    </div>

@endsection
