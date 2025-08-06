@extends('layouts.landing')

@section('title', 'Navbar Submenu Kanan')

@push('styles')
<style>
body { font-family: sans-serif; background: #f9f9f9; }
nav { background: #6e4b3a; padding: 10px; }
.nav-container { display: flex; gap: 20px; }
.nav-item.dropdown { position: relative; }
.nav-link { color: #fff; text-decoration: none; padding: 8px; display: flex; align-items: center; gap: 5px; }
.dropdown-content {
    position: absolute;
    top: 100%; left: 0;
    background: #fff; min-width: 180px;
    display: none; flex-direction: column;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    z-index: 1000;
}
.nav-item.dropdown:hover > .dropdown-content {
    display: flex;
}
.dropdown-content a {
    color: #333; text-decoration: none;
    padding: 8px; border-bottom: 1px solid #ddd;
}
.dropdown-content a:hover { background: #eee; }

/* Dropdown kanan tanpa gap */
.dropdown-content.right {
    top: 0;
    left: calc(100% - 1px); /* overlap dikit biar ga ada gap */
    position: absolute;
    min-width: 180px;
    display: none;
    flex-direction: column;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    background: #fff;
}
.nav-item.dropdown .dropdown-content .nav-item.dropdown:hover > .dropdown-content.right {
    display: flex;
}

/* icon animasi */
.nav-link i { transition: transform 0.3s; }
.nav-item.dropdown:hover > .nav-link i { transform: translateX(3px); }
</style>
@endpush

@section('content')
<nav>
    <div class="nav-container">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link">OIG <i class="fas fa-chevron-down"></i></a>
            <div class="dropdown-content">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link">PKBGT <i class="fas fa-chevron-right"></i></a>
                    <div class="dropdown-content right">
                        <a href="/pengurus-pkbgt">Pengurus PKBGT</a>
                        <a href="/program-kerja-pkbgt">Program Kerja PKBGT</a>
                        <a href="/kegiatan-pkbgt">Kegiatan PKBGT</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link">PWGT <i class="fas fa-chevron-right"></i></a>
                    <div class="dropdown-content right">
                        <a href="/pengurus-pwgt">Pengurus PWGT</a>
                        <a href="/program-kerja-pwgt">Program Kerja PWGT</a>
                        <a href="/kegiatan-pwgt">Kegiatan PWGT</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link">SMGT <i class="fas fa-chevron-right"></i></a>
                    <div class="dropdown-content right">
                        <a href="/pengurus-smgt">Pengurus SMGT</a>
                        <a href="/program-kerja-smgt">Program Kerja SMGT</a>
                        <a href="/kegiatan-smgt">Kegiatan SMGT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
@endsection
