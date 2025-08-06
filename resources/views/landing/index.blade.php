@extends('layouts.landing')

@section('title', 'Gereja Toraja Eben-Haezer Selili')

@section('content')

    <!-- Hero Section with Enhanced Slider -->
    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="slider-container">
            <div class="slide active">
                <img src="https://yt3.googleusercontent.com/ytc/AIdro_lRx1ia74HxekPVmHKcqg6Rvyn61CmQtAowwYOEWRHEfg=s900-c-k-c0x00ffffff-no-rj" alt="Gereja 1">
                <div class="slide-content">
                    <div class="hero-badge">
                        <i class="fas fa-church"></i>
                        <span>Gereja Toraja</span>
                    </div>
                    <h1 class="hero-title">Selamat Datang di Gereja Toraja Eben-Haezer Selili</h1>
                    <p class="hero-subtitle">Rumah bagi semua orang yang mencari kedamaian dan kasih Tuhan</p>
                    <div class="hero-buttons">
                        <a href="#about" class="btn-primary">
                            <i class="fas fa-info-circle"></i>
                            Tentang Kami
                        </a>
                        <a href="#schedule" class="btn-secondary">
                            <i class="fas fa-calendar-alt"></i>
                            Jadwal Ibadah
                        </a>
                    </div>
                </div>
            </div>
            <div class="slide">
                <img src="https://images.unsplash.com/photo-1590939662308-a8cbfd98c5ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Gereja 2">
                <div class="slide-content">
                    <div class="hero-badge">
                        <i class="fas fa-users"></i>
                        <span>Komunitas</span>
                    </div>
                    <h1 class="hero-title">Bersatu dalam Iman dan Kasih</h1>
                    <p class="hero-subtitle">Mari bersama membangun komunitas yang kuat dalam Kristus</p>
                    <div class="hero-buttons">
                        <a href="#community" class="btn-primary">
                            <i class="fas fa-hands-helping"></i>
                            Bergabung
                        </a>
                        <a href="#events" class="btn-secondary">
                            <i class="fas fa-calendar-check"></i>
                            Kegiatan
                        </a>
                    </div>
                </div>
            </div>
            <div class="slide">
                <img src="https://images.unsplash.com/photo-1542887800-faca0261c9e1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Gereja 3">
                <div class="slide-content">
                    <div class="hero-badge">
                        <i class="fas fa-heart"></i>
                        <span>Pelayanan</span>
                    </div>
                    <h1 class="hero-title">Pelayanan yang Berkesinambungan</h1>
                    <p class="hero-subtitle">Melayani dengan hati yang tulus untuk kemuliaan Tuhan</p>
                    <div class="hero-buttons">
                        <a href="#services" class="btn-primary">
                            <i class="fas fa-praying-hands"></i>
                            Pelayanan
                        </a>
                        <a href="#contact" class="btn-secondary">
                            <i class="fas fa-envelope"></i>
                            Kontak
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slider Navigation -->
        <div class="slider-nav">
            <button class="prev-btn" onclick="changeSlide(-1)"><i class="fas fa-chevron-left"></i></button>
            <button class="next-btn" onclick="changeSlide(1)"><i class="fas fa-chevron-right"></i></button>
        </div>

        <!-- Slider Indicators -->
        <div class="slider-indicators">
            <span class="indicator active" onclick="currentSlide(1)"></span>
            <span class="indicator" onclick="currentSlide(2)"></span>
            <span class="indicator" onclick="currentSlide(3)"></span>
        </div>
        <div class="scroll-indicator"></div>
    </section>

    <!-- Enhanced Quick Info Section -->
    <section class="quick-info" id="about" data-aos="fade-up">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Mengapa Memilih Kami?</h2>
                <p class="section-subtitle">Kami berkomitmen untuk melayani dengan sepenuh hati</p>
            </div>
            <div class="info-grid">
                <div class="modern-card pulsing" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-icon">
                        <i class="fas fa-cross"></i>
                    </div>
                    <div class="card-content">
                        <h3>Pelayanan Rohani</h3>
                        <p>Melayani dengan kasih dan ketulusan untuk pertumbuhan iman jemaat dalam kehidupan sehari-hari</p>
                        <div class="card-stats">
                            <span class="stat-number">24/7</span>
                            <span class="stat-label">Pelayanan</span>
                        </div>
                    </div>
                    <div class="card-overlay"></div>
                </div>
                <div class="modern-card pulsing" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <div class="card-content">
                        <h3>Komunitas Solid</h3>
                        <p>Membangun persekutuan yang kuat dalam Kristus dengan berbagai kegiatan bersama</p>
                        <div class="card-stats">
                            <span class="stat-number">500+</span>
                            <span class="stat-label">Anggota</span>
                        </div>
                    </div>
                    <div class="card-overlay"></div>
                </div>
                <div class="modern-card pulsing" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="card-content">
                        <h3>Pelayanan Sosial</h3>
                        <p>Berbagi kasih dengan sesama melalui berbagai program sosial dan kemanusiaan</p>
                        <div class="card-stats">
                            <span class="stat-number">50+</span>
                            <span class="stat-label">Program</span>
                        </div>
                    </div>
                    <div class="card-overlay"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Schedule Section -->
    <section class="schedule" id="schedule" data-aos="fade-up">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Jadwal Ibadah</h2>
                <p class="section-subtitle">Bergabunglah dengan kami dalam ibadah dan persekutuan</p>
            </div>
            <div class="schedule-grid">
                @if(isset($worshipSchedules) && $worshipSchedules->count() > 0)
                    @foreach($worshipSchedules as $index => $schedule)
                        @php
                            $delay = ($index + 1) * 100;
                            $animation = $index == 0 ? 'fade-right' : ($index == 1 ? 'fade-up' : 'fade-left');
                            $centerClass = $schedule->is_featured ? 'center featured' : '';
                        @endphp
                        <div class="schedule-item {{ $centerClass }}" data-aos="{{ $animation }}" data-aos-delay="{{ $delay }}">
                            <div class="schedule-icon">
                                <i class="fas {{ $schedule->icon }}"></i>
                            </div>
                            <div class="schedule-time">
                                <h3>{{ $schedule->name }}</h3>
                                <div class="time-display">
                                    <span class="time">{{ $schedule->formatted_time }}</span>
                                    <span class="period">WITA</span>
                                </div>
                                <p class="schedule-day">{{ $schedule->day }}</p>
                                
                                @php
                                    $specialNotes = $schedule->special_notes ? json_decode($schedule->special_notes, true) : [];
                                @endphp
                                @if($specialNotes && is_array($specialNotes) && count($specialNotes) > 0)
                                    <div class="special-note">
                                        @foreach($specialNotes as $note)
                                            <div class="note-item">
                                                <i class="fas fa-star"></i>
                                                <span>{{ $note }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                
                                <div class="schedule-details">
                                    @if($schedule->duration)
                                        <span class="detail-item">
                                            <i class="fas fa-clock"></i>
                                            {{ $schedule->duration }} Menit
                                        </span>
                                    @endif
                                    <span class="detail-item">
                                        <i class="fas fa-users"></i>
                                        {{ $schedule->target_audience }}
                                    </span>
                                </div>
                                
                                @if($schedule->description)
                                    <p class="schedule-description">{{ $schedule->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback jika tidak ada data -->
                    <div class="schedule-item" data-aos="fade-up">
                        <div class="schedule-icon">
                            <i class="fas fa-church"></i>
                        </div>
                        <div class="schedule-time">
                            <h3>Jadwal Ibadah</h3>
                            <p>Belum ada jadwal ibadah yang tersedia</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="events" data-aos="fade-up">
        <div class="container">
            <h2>Kegiatan Mendatang</h2>
            <div class="events-grid">
                @if(isset($upcomingEvents) && $upcomingEvents && $upcomingEvents->count() > 0)
                    @foreach($upcomingEvents as $index => $event)
                        @php
                            // Tentukan warna berdasarkan index atau kategori
                            $colors = ['red', 'blue', 'green'];
                            $color = $colors[$index % 3];
                        @endphp
                        <div class="event-card" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                            <div class="event-date {{ $color }}">
                                <span class="day">{{ $event->event_date->format('d') }}</span>
                                <span class="month">{{ strtoupper($event->month_name) }}</span>
                            </div>
                            <div class="event-details">
                                <h3>{{ $event->title }}</h3>
                                <p>{{ $event->description ?: 'Kegiatan gereja yang akan datang' }}</p>
                                @if($event->event_time)
                                    <span class="event-time"><i class="far fa-clock"></i> {{ $event->formatted_time }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Default events jika tidak ada data dari database -->
                    {{-- <div class="event-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="event-date">
                            <span class="day">25</span>
                            <span class="month">Dec</span>
                        </div>
                        <div class="event-details">
                            <h3>Perayaan Natal</h3>
                            <p>Ibadah Natal bersama seluruh jemaat dalam suasana penuh sukacita</p>
                            <span class="event-time"><i class="far fa-clock"></i> 09:30 WITA</span>
                        </div>
                    </div>
                    <div class="event-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="event-date">
                            <span class="day">31</span>
                            <span class="month">Dec</span>
                        </div>
                        <div class="event-details">
                            <h3>Ibadah Tutup Tahun</h3>
                            <p>Ibadah syukur akhir tahun dengan refleksi dan doa bersama</p>
                            <span class="event-time"><i class="far fa-clock"></i> 19:00 WITA</span>
                        </div>
                    </div>
                    <div class="event-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="event-date">
                            <span class="day">1</span>
                            <span class="month">Jan</span>
                        </div>
                        <div class="event-details">
                            <h3>Ibadah Tahun Baru</h3>
                            <p>Menyambut tahun yang baru dengan puji-pujian dan harapan</p>
                            <span class="event-time"><i class="far fa-clock"></i> 09:30 WITA</span>
                        </div>
                    </div> --}}
                @endif
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery">
        <div class="container">
            <h2>Galeri Gereja</h2>
            <div class="gallery-grid">
                <a href="{{ route('kegiatan-jemaat') }}" class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1601926245593-7ebc136c8323?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Interior Gereja">
                    <div class="gallery-overlay">
                        <h3>Interior Gereja</h3>
                    </div>
                </a>
                <a href="{{ route('kegiatan-jemaat') }}" class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1590939662308-a8cbfd98c5ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Altar">
                    <div class="gallery-overlay">
                        <h3>Altar Gereja</h3>
                    </div>
                </a>
                <a href="{{ route('kegiatan-jemaat') }}" class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1542887800-faca0261c9e1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Eksterior">
                    <div class="gallery-overlay">
                        <h3>Eksterior Gereja</h3>
                    </div>
                </a>
                <a href="{{ route('kegiatan-jemaat') }}" class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1543159821-9a76bc1c7bfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Baptisan">
                    <div class="gallery-overlay">
                        <h3>Tempat Baptisan</h3>
                    </div>
                </a>
                <a href="{{ route('kegiatan-jemaat') }}" class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1602526432604-029a709e131c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Ruang Doa">
                    <div class="gallery-overlay">
                        <h3>Ruang Doa</h3>
                    </div>
                </a>
                <a href="{{ route('kegiatan-jemaat') }}" class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1547036967-23d11aacaee0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Taman Gereja">
                    <div class="gallery-overlay">
                        <h3>Taman Gereja</h3>
                    </div>
                </a>
            </div>
        </div>
    </section>
@endsection
