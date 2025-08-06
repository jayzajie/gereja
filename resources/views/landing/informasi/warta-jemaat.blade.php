@extends('layouts.landing')

@section('title', 'Warta Jemaat - Gereja Toraja Eben-Haezer Selili')

@push('styles')
<style>
    /* Warta Jemaat Header */
    .warta-header {
        background: linear-gradient(135deg, #997939 0%, #b59756 100%);
        padding: 120px 0 80px;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
        margin-top: 85px;
    }

    .warta-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('{{ asset('images/gereja-toraja.jpg') }}');
        background-size: cover;
        background-position: center;
        opacity: 0.2;
        z-index: 1;
    }

    .warta-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(153, 121, 57, 0.8) 0%, rgba(181, 151, 86, 0.8) 100%);
        z-index: 2;
    }

    .warta-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 3;
    }

    .warta-title {
        font-size: 3rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .warta-subtitle {
        font-size: 1.2rem;
        margin-top: 15px;
        opacity: 0.9;
    }

    /* Filter Section */
    .filter-section {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin: 40px 0;
    }

    .filter-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        align-items: center;
    }

    .search-box {
        flex: 1;
        position: relative;
    }

    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #997939;
    }

    .search-box input {
        width: 100%;
        padding: 12px 15px 12px 45px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .search-box input:focus {
        border-color: #997939;
        outline: none;
        box-shadow: 0 0 0 3px rgba(153, 121, 57, 0.1);
    }

    .year-filter select {
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 1rem;
        background: white;
        min-width: 150px;
    }

    .stats-info {
        text-align: center;
        color: #666;
    }

    .total-count {
        font-size: 1.1rem;
    }

    .total-count strong {
        color: #997939;
    }

    /* Warta Grid - Card Style */
    .warta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
        padding: 40px 0;
    }

    .warta-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        border: 1px solid #f0f0f0;
    }

    .warta-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #997939, #b59756);
    }

    .warta-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .warta-header-card {
        padding: 25px 25px 15px;
        border-bottom: 1px solid #f0f0f0;
    }

    .warta-name {
        font-size: 1.3rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .warta-date {
        display: flex;
        align-items: center;
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 8px;
    }

    .warta-date i {
        margin-right: 8px;
        color: #997939;
    }

    .warta-desc {
        color: #666;
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 0;
    }

    .warta-actions {
        padding: 20px 25px;
        display: flex;
        gap: 12px;
    }

    .warta-btn {
        flex: 1;
        padding: 12px 20px;
        border: none;
        border-radius: 10px;
        text-decoration: none;
        text-align: center;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .view-btn {
        background: #997939;
        color: white;
    }

    .view-btn:hover {
        background: #785d2d;
        color: white;
        transform: translateY(-2px);
    }

    .download-btn {
        background: #f8f9fa;
        color: #997939;
        border: 2px solid #997939;
    }

    .download-btn:hover {
        background: #997939;
        color: white;
        transform: translateY(-2px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #666;
    }

    .empty-icon {
        font-size: 4rem;
        color: #997939;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: #333;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .warta-title {
            font-size: 2rem;
        }

        .filter-row {
            flex-direction: column;
            gap: 15px;
        }

        .year-filter select {
            width: 100%;
        }

        .warta-grid {
            grid-template-columns: 1fr;
            gap: 20px;
            padding: 20px 0;
        }

        .warta-actions {
            flex-direction: column;
        }
    }
</style>
@endpush

@section('content')
    <!-- Warta Jemaat Header -->
    <div class="warta-header">
        <div class="warta-container">
            <h1 class="warta-title">Warta Mingguan</h1>
            <p class="warta-subtitle">Akses koleksi warta mingguan Gereja Toraja Eben-Haezer Selili</p>
        </div>
    </div>

    <!-- Filter Section -->
    @if($wartaMingguan->count() > 0)
    <div class="warta-container">
        <div class="filter-section">
            <div class="filter-row">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchWarta" placeholder="Cari warta berdasarkan nama atau deskripsi...">
                </div>
                <div class="year-filter">
                    <select id="yearFilter">
                        <option value="">Semua Tahun</option>
                        @foreach($wartaByYear->keys()->sort()->reverse() as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="stats-info">
                <span class="total-count">Total: <strong>{{ $wartaMingguan->count() }}</strong> warta tersedia</span>
            </div>
        </div>
    </div>
    @endif

    <!-- Warta Jemaat Content -->
    <div class="warta-container">
        @if($wartaMingguan->count() > 0)
            <div class="warta-grid">
                @foreach($wartaMingguan as $warta)
                <div class="warta-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="warta-header-card">
                        <div class="warta-name">{{ $warta->nama_warta }}</div>
                        <div class="warta-date">
                            <i class="fas fa-calendar"></i>
                            {{ $warta->tanggal }} {{ $warta->bulan_nama }} {{ $warta->tahun }}
                        </div>
                        @if($warta->deskripsi)
                        <p class="warta-desc">{{ Str::limit($warta->deskripsi, 100) }}</p>
                        @endif
                    </div>
                    <div class="warta-actions">
                        <a href="{{ route('warta-mingguan.view', $warta->id) }}" target="_blank" class="warta-btn view-btn" title="Lihat PDF">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('warta-mingguan.download', $warta->id) }}" class="warta-btn download-btn" title="Unduh PDF">
                            <i class="fas fa-download"></i> Unduh
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <h3>Belum Ada Warta Tersedia</h3>
                <p>Warta mingguan akan segera tersedia. Silakan kembali lagi nanti.</p>
            </div>
        @endif
    </div>

    <script>
        // Search functionality
        document.getElementById('searchWarta').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.warta-card');
            
            cards.forEach(card => {
                const name = card.querySelector('.warta-name').textContent.toLowerCase();
                const desc = card.querySelector('.warta-desc')?.textContent.toLowerCase() || '';
                
                if (name.includes(searchTerm) || desc.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Year filter functionality
        document.getElementById('yearFilter').addEventListener('change', function() {
            const selectedYear = this.value;
            const cards = document.querySelectorAll('.warta-card');
            
            cards.forEach(card => {
                const dateText = card.querySelector('.warta-date').textContent;
                
                if (selectedYear === '' || dateText.includes(selectedYear)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
@endsection
