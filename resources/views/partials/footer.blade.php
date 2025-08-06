<!-- Enhanced Footer -->
<footer class="footer">
    <div class="footer-overlay"></div>
    <div class="container">
        <div class="footer-content">
            <!-- Logo & Description Section -->
            <div class="footer-section footer-main">
                <div class="footer-logo">
                    <i class="fas fa-church"></i>
                    <h3>Gereja Toraja<br>Eben-Haezer Selili</h3>
                </div>
                <p class="footer-description">
                    Melayani dengan kasih dan ketulusan untuk kemuliaan Tuhan. Bergabunglah dengan keluarga besar kami dalam perjalanan iman.
                </p>
                <div class="social-links">
                    <a href="#" class="social-link facebook" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link instagram" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link youtube" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <!-- Navigation Section -->
            <div class="footer-section">
                <h4><i class="fas fa-compass"></i> Navigasi</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('sejarah.gereja') }}"><i class="fas fa-history"></i> Sejarah Gereja</a></li>
                    <li><a href="{{ route('anggota-jemaat') }}"><i class="fas fa-users"></i> Anggota Jemaat</a></li>
                    <li><a href="{{ route('pendeta-jemaat') }}"><i class="fas fa-user-tie"></i> Pendeta Jemaat</a></li>
                    <li><a href="{{ route('kegiatan-jemaat') }}"><i class="fas fa-calendar-alt"></i> Kegiatan Jemaat</a></li>
                </ul>
            </div>

            <!-- Organization Section -->
            <div class="footer-section">
                <h4><i class="fas fa-sitemap"></i> Organisasi</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('pengurus-pkbgt') }}"><i class="fas fa-male"></i> PKBGT</a></li>
                    <li><a href="{{ route('pengurus-pwgt') }}"><i class="fas fa-female"></i> PWGT</a></li>
                    <li><a href="{{ route('pengurus-ppgt') }}"><i class="fas fa-child"></i> PPGT</a></li>
                    <li><a href="{{ route('pengurus-smgt') }}"><i class="fas fa-graduation-cap"></i> SMGT</a></li>
                </ul>
            </div>

            <!-- Contact Section -->
            <div class="footer-section">
                <h4><i class="fas fa-phone-alt"></i> Kontak Kami</h4>
                <div class="footer-contact">
                    <div class="contact-card">
                        <div class="contact-icon address">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">ALAMAT</span>
                            <span class="contact-value">Jl. Lumba-Lumba, Selili, Kec. Samarinda Ilir, Kota Samarinda, Kalimantan Timur 75251</span>
                        </div>
                    </div>
                    <div class="contact-card">
                        <div class="contact-icon phone">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">TELEPON</span>
                            <span class="contact-value contact-phone">08135009713</span>
                        </div>
                    </div>
                    <div class="contact-card">
                        <div class="contact-icon email">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">EMAIL</span>
                            <a href="mailto:ebenhaezerSelili@gmail.com" class="contact-value">ebenhaezerSelili@gmail.com</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <div class="footer-copyright">
                    <p>&copy; {{ date('Y') }} Gereja Toraja Eben-Haezer Selili. Semua hak dilindungi.</p>
                </div>
                <div class="footer-bottom-links">
                    <a href="#" class="footer-link">Kebijakan Privasi</a>
                    <span class="separator">|</span>
                    <a href="#" class="footer-link">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
/* Enhanced Footer Styles */
.footer {
    background: linear-gradient(135deg, #8B4513 0%, #A0522D 50%, #8B4513 100%);
    color: #fff;
    position: relative;
    overflow: hidden;
    margin-top: 60px;
    box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.2);
}

.footer-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.1);
    z-index: 1;
}

.footer .container {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.footer-content {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
    gap: 40px;
    padding: 50px 0 30px;
    align-items: start;
}

.footer-section h4 {
    color: #FFD700;
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 10px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    border-bottom: 2px solid rgba(255, 215, 0, 0.3);
    padding-bottom: 10px;
    letter-spacing: 0.3px;
    word-spacing: 1px;
}

.footer-section h4 i {
    font-size: 18px;
}

/* Logo Section */
.footer-main .footer-logo {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
}

.footer-main .footer-logo i {
    font-size: 40px;
    color: #FFD700;
    flex-shrink: 0;
}

.footer-main .footer-logo h3 {
    font-size: 24px;
    font-weight: 700;
    line-height: 1.2;
    margin: 0;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    letter-spacing: 0.5px;
    word-spacing: 2px;
}

.footer-description {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 30px;
    opacity: 0.95;
    max-width: 400px;
    text-align: left;
    letter-spacing: 0.3px;
    word-spacing: 1px;
}

/* Social Links */
.social-links {
    display: flex;
    gap: 15px;
    margin-top: 5px;
}

.social-link {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.15);
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.social-link:hover {
    background: #FFD700;
    color: #8B4513;
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
    border-color: #FFD700;
}

/* Footer Links */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 15px;
}

.footer-links a {
    color: #fff;
    text-decoration: none;
    font-size: 15px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
    opacity: 0.9;
    padding: 8px 0;
    border-radius: 5px;
    position: relative;
    letter-spacing: 0.2px;
    word-spacing: 0.5px;
    line-height: 1.4;
}

.footer-links a:hover {
    color: #FFD700;
    opacity: 1;
    transform: translateX(8px);
    background: rgba(255, 215, 0, 0.1);
    padding-left: 10px;
}

.footer-links a i {
    font-size: 14px;
    width: 20px;
    text-align: center;
}

/* Contact Section */
.footer-contact {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.contact-card {
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    padding: 18px;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.contact-card:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-2px);
    border-color: rgba(255, 255, 255, 0.3);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.contact-icon {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.contact-icon.address {
    background: #ff6b6b;
    color: white;
}

.contact-icon.phone {
    background: #4ecdc4;
    color: white;
}

.contact-icon.email {
    background: #45b7d1;
    color: white;
}

.contact-icon i {
    font-size: 18px;
}

.contact-details {
    display: flex;
    flex-direction: column;
    gap: 4px;
    flex: 1;
}

.contact-label {
    font-size: 11px;
    font-weight: 700;
    color: rgba(255, 255, 255, 0.8);
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
    word-spacing: 1px;
}

.contact-value {
    font-size: 14px;
    color: #fff;
    font-weight: 500;
    line-height: 1.3;
    letter-spacing: 0.2px;
    word-spacing: 0.5px;
}

.contact-value.contact-phone {
    font-family: 'Courier New', monospace;
    font-weight: 600;
}

.contact-details a.contact-value {
    text-decoration: none;
    color: #fff;
    transition: color 0.3s ease;
}

.contact-details a.contact-value:hover {
    color: #FFD700;
}

.contact-phone {
    font-family: 'Courier New', monospace;
    font-weight: 600;
}




/* Footer Bottom */
.footer-bottom {
    border-top: 2px solid rgba(255, 215, 0, 0.2);
    padding: 30px 0;
    background: rgba(0, 0, 0, 0.1);
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.footer-copyright p {
    margin: 0;
    font-size: 15px;
    opacity: 0.9;
    font-weight: 500;
    letter-spacing: 0.2px;
    word-spacing: 0.5px;
    line-height: 1.4;
}

.footer-bottom-links {
    display: flex;
    align-items: center;
    gap: 20px;
}

.footer-link {
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    opacity: 0.8;
    transition: all 0.3s ease;
    padding: 5px 10px;
    border-radius: 5px;
    letter-spacing: 0.2px;
    word-spacing: 0.5px;
}

.footer-link:hover {
    color: #FFD700;
    opacity: 1;
    background: rgba(255, 215, 0, 0.1);
}

.separator {
    color: rgba(255, 255, 255, 0.6);
    font-size: 14px;
    font-weight: bold;
}

/* Responsive Design */
@media (max-width: 992px) {
    .footer-content {
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        padding: 45px 0 25px;
    }

    .footer-main {
        grid-column: 1 / -1;
        text-align: center;
        margin-bottom: 20px;
    }

    .footer-main .footer-logo {
        justify-content: center;
    }

    .footer-description {
        max-width: 500px;
        margin: 0 auto 30px;
    }

    .social-links {
        justify-content: center;
    }

    .contact-card {
        justify-content: center;
        text-align: left;
    }
}

@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        gap: 35px;
        padding: 40px 0 25px;
        text-align: center;
    }

    .footer-main .footer-logo h3 {
        font-size: 22px;
    }

    .footer-main .footer-logo i {
        font-size: 36px;
    }

    .footer-section h4 {
        font-size: 18px;
        justify-content: center;
    }

    .footer-links a {
        justify-content: center;
        padding: 10px 15px;
    }

    .footer-links a:hover {
        transform: translateY(-2px);
        padding-left: 15px;
    }

    .footer-bottom-content {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
}

@media (max-width: 480px) {
    .footer .container {
        padding: 0 15px;
    }

    .footer-content {
        padding: 35px 0 20px;
        gap: 30px;
    }

    .footer-main .footer-logo {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }

    .footer-main .footer-logo h3 {
        font-size: 20px;
        line-height: 1.4;
    }

    .footer-main .footer-logo i {
        font-size: 32px;
    }

    .footer-description {
        font-size: 14px;
        margin-bottom: 25px;
    }

    .social-links {
        gap: 12px;
    }

    .social-link {
        width: 42px;
        height: 42px;
    }

    .footer-section h4 {
        font-size: 17px;
        margin-bottom: 20px;
    }

    .footer-links a {
        font-size: 14px;
        padding: 8px 12px;
    }

    .footer-bottom {
        padding: 25px 0;
    }

    .footer-copyright p {
        font-size: 13px;
    }

    .footer-link {
        font-size: 13px;
    }
}
</style>
