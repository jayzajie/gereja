@extends('layouts.landing')

@section('title', 'Anggota Jemaat - Gereja Toraja Eben-Haezer Selili')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .stat-label {
            color: #666;
            font-weight: 500;
        }

        .charts-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .chart-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .chart-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 20px;
            text-align: center;
        }

        .info-section {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .info-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0e0e0;
        }

        .info-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #333;
            text-align: justify;
        }

        @media (max-width: 768px) {
            .charts-section {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .page-title {
                font-size: 2rem;
            }

            .stat-number {
                font-size: 2rem;
            }
        }
</style>
@endpush

@section('content')

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <div class="content-container" data-aos="fade-up">
                <h2 class="page-title">Anggota Jemaat</h2>

                <!-- Statistics Cards -->
                <div class="stats-grid">
                    <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-icon">
                            <i class="fas fa-male"></i>
                        </div>
                        <div class="stat-number">{{ $totalLakiLaki ?? 0 }}</div>
                        <div class="stat-label">Laki-laki</div>
                    </div>

                    <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-icon">
                            <i class="fas fa-female"></i>
                        </div>
                        <div class="stat-number">{{ $totalPerempuan ?? 0 }}</div>
                        <div class="stat-label">Perempuan</div>
                    </div>

                    <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="stat-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="stat-number">{{ $totalKeluarga ?? 0 }}</div>
                        <div class="stat-label">Keluarga</div>
                    </div>

                    <div class="stat-card" data-aos="fade-up" data-aos-delay="400">
                        <div class="stat-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="stat-number">{{ $totalMenikah ?? 0 }}</div>
                        <div class="stat-label">Pernikahan</div>
                    </div>

                    <div class="stat-card" data-aos="fade-up" data-aos-delay="500">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-number">{{ $totalAnggota ?? 0 }}</div>
                        <div class="stat-label">Total Anggota</div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="charts-section">
                    <div class="chart-container" data-aos="fade-up" data-aos-delay="600">
                        <h3 class="chart-title">Distribusi Gender</h3>
                        <canvas id="genderChart"></canvas>
                    </div>

                    <div class="chart-container" data-aos="fade-up" data-aos-delay="700">
                        <h3 class="chart-title">Perkembangan Anggota</h3>
                        <canvas id="growthChart"></canvas>
                    </div>
                </div>

                <!-- Information Section -->
                <div class="info-section" data-aos="fade-up" data-aos-delay="800">
                    <h3 class="info-title">
                        <i class="fas fa-info-circle"></i> Tentang Anggota Jemaat
                    </h3>
                    <div class="info-text">
                        <p>Gereja Toraja Jemaat Eben-Haezer Selili memiliki anggota jemaat yang beragam, terdiri dari berbagai kalangan usia dan latar belakang. Jemaat ini terbentuk dari komunitas perantau Toraja yang berdomisili di Samarinda, Kalimantan Timur.</p>

                        <p>Setiap anggota jemaat memiliki peran penting dalam kehidupan bergereja dan pelayanan. Mereka aktif dalam berbagai kegiatan gereja seperti ibadah minggu, persekutuan, dan kegiatan sosial kemasyarakatan.</p>

                        <p>Data statistik di atas menunjukkan komposisi anggota jemaat yang seimbang antara laki-laki dan perempuan, serta pertumbuhan yang positif dari tahun ke tahun.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Gender Distribution Chart
        const genderCtx = document.getElementById('genderChart').getContext('2d');
        new Chart(genderCtx, {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [{{ $totalLakiLaki ?? 0 }}, {{ $totalPerempuan ?? 0 }}],
                    backgroundColor: ['#3498db', '#e74c3c'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Growth Chart
        const growthCtx = document.getElementById('growthChart').getContext('2d');
        new Chart(growthCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($dataGrafik['tahun'] ?? [2022, 2023, 2024]) !!},
                datasets: [{
                    label: 'Laki-laki',
                    data: {!! json_encode($dataGrafik['laki_laki'] ?? [45, 50, 55]) !!},
                    borderColor: '#3498db',
                    backgroundColor: 'rgba(52, 152, 219, 0.1)',
                    tension: 0.4
                }, {
                    label: 'Perempuan',
                    data: {!! json_encode($dataGrafik['perempuan'] ?? [40, 45, 50]) !!},
                    borderColor: '#e74c3c',
                    backgroundColor: 'rgba(231, 76, 60, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
</script>
@endpush
