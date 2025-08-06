<?php

namespace Database\Seeders;

use App\Models\Information;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $homeSettings = [
            [
                'title' => 'Hero Section - Beranda',
                'content' => '<h1>Selamat Datang di Gereja Toraja Eben-Haezer Selili</h1>
<p>Melayani dengan kasih dan ketulusan untuk kemuliaan Tuhan. Bergabunglah dengan keluarga besar kami dalam perjalanan iman.</p>
<div class="hero-buttons">
    <a href="#about" class="btn btn-primary">Tentang Kami</a>
    <a href="#contact" class="btn btn-outline-light">Hubungi Kami</a>
</div>',
                'category' => 'home-setting',
                'subcategory' => 'hero',
                'status' => 'published',
                'priority' => 'high',
                'publish_date' => now(),
                'notes' => 'Created by: Admin - Hero section untuk halaman utama'
            ],
            [
                'title' => 'About Section - Tentang Kami',
                'content' => '<h2>Tentang Gereja Kami</h2>
<p>Gereja Toraja Eben-Haezer Selili adalah komunitas iman yang berkomitmen untuk melayani Tuhan dan sesama. Kami percaya bahwa setiap orang berharga di mata Tuhan dan memiliki tujuan yang mulia.</p>
<div class="about-features">
    <div class="feature">
        <h4>🙏 Ibadah Bermakna</h4>
        <p>Ibadah yang penuh makna dan menyentuh hati</p>
    </div>
    <div class="feature">
        <h4>👥 Komunitas Hangat</h4>
        <p>Keluarga besar yang saling mendukung</p>
    </div>
    <div class="feature">
        <h4>📚 Pembelajaran Alkitab</h4>
        <p>Mempelajari firman Tuhan bersama-sama</p>
    </div>
</div>',
                'category' => 'home-setting',
                'subcategory' => 'about',
                'status' => 'published',
                'priority' => 'high',
                'publish_date' => now(),
                'notes' => 'Created by: Admin - About section untuk halaman utama'
            ],
            [
                'title' => 'Contact Section - Kontak',
                'content' => '<h2>Hubungi Kami</h2>
<div class="contact-info">
    <div class="contact-item">
        <h4>📍 Alamat</h4>
        <p>Jl. Lumba-Lumba, Selili, Kec. Samarinda Ilir, Samarinda, Kalimantan Timur 75251</p>
    </div>
    <div class="contact-item">
        <h4>📞 Telepon</h4>
        <p>08135009713</p>
    </div>
    <div class="contact-item">
        <h4>✉️ Email</h4>
        <p>ebenhaezerSelili@gmail.com</p>
    </div>
</div>',
                'category' => 'home-setting',
                'subcategory' => 'contact',
                'status' => 'published',
                'priority' => 'medium',
                'publish_date' => now(),
                'notes' => 'Created by: Admin - Contact section untuk halaman utama'
            ],
            [
                'title' => 'Footer Section - Footer',
                'content' => '<div class="footer-content">
    <div class="footer-section">
        <h4>Gereja Toraja Eben-Haezer Selili</h4>
        <p>Melayani dengan kasih dan ketulusan untuk kemuliaan Tuhan. Bergabunglah dengan keluarga besar kami dalam perjalanan iman.</p>
    </div>
    <div class="footer-section">
        <h4>Navigasi</h4>
        <ul>
            <li><a href="#home">Beranda</a></li>
            <li><a href="#about">Tentang</a></li>
            <li><a href="#services">Pelayanan</a></li>
            <li><a href="#contact">Kontak</a></li>
        </ul>
    </div>
    <div class="footer-section">
        <h4>Organisasi</h4>
        <ul>
            <li><a href="#">PKBGT</a></li>
            <li><a href="#">PWGT</a></li>
            <li><a href="#">PPGT</a></li>
            <li><a href="#">SMGT</a></li>
        </ul>
    </div>
</div>
<div class="footer-bottom">
    <p>&copy; 2025 Gereja Toraja Eben-Haezer Selili. Semua hak dilindungi.</p>
</div>',
                'category' => 'home-setting',
                'subcategory' => 'footer',
                'status' => 'published',
                'priority' => 'low',
                'publish_date' => now(),
                'notes' => 'Created by: Admin - Footer section untuk halaman utama'
            ]
        ];

        foreach ($homeSettings as $setting) {
            Information::create($setting);
        }
    }
}
