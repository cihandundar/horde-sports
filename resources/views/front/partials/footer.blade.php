<footer class="footer">
    <div class="footer-container">
        <!-- Footer Üst Bölümü - Logo ve Kategoriler -->
        <div class="footer-top">
            <div class="footer-logo-section">
                <a href="{{ url('/') }}" class="footer-logo-link">
                    <img src="{{ asset('front/assets/images/logo.png') }}" alt="Horde Sports Logo" class="footer-logo-image">
                </a>
                <p class="footer-description">Spor dünyasının nabzını tutan, en güncel haberler ve analizler.</p>
                <div class="footer-social">
                    <a href="#" class="social-link" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <div class="footer-links-section">
                <div class="footer-links-column">
                    <p class="footer-column-title">Kategoriler</p>
                    <ul class="footer-links-list">
                        <li><a href="#" class="footer-link">Futbol</a></li>
                        <li><a href="#" class="footer-link">Basketbol</a></li>
                        <li><a href="#" class="footer-link">Voleybol</a></li>
                        <li><a href="#" class="footer-link">Tenis</a></li>
                        <li><a href="#" class="footer-link">Formula 1</a></li>
                    </ul>
                </div>

                <div class="footer-links-column">
                    <p class="footer-column-title">Kurumsal</p>
                    <ul class="footer-links-list">
                        <li><a href="#" class="footer-link">Hakkımızda</a></li>
                        <li><a href="#" class="footer-link">İletişim</a></li>
                        <li><a href="#" class="footer-link">Gizlilik Politikası</a></li>
                        <li><a href="#" class="footer-link">Kullanım Şartları</a></li>
                        <li><a href="#" class="footer-link">Reklam</a></li>
                    </ul>
                </div>

                <div class="footer-links-column">
                    <p class="footer-column-title">Popüler</p>
                    <ul class="footer-links-list">
                        <li><a href="#" class="footer-link">Son Dakika</a></li>
                        <li><a href="#" class="footer-link">Maç Özetleri</a></li>
                        <li><a href="#" class="footer-link">Transfer Haberleri</a></li>
                        <li><a href="#" class="footer-link">Analiz</a></li>
                        <li><a href="#" class="footer-link">Video</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-newsletter-section">
                <p class="footer-column-title">Bülten</p>
                <p class="newsletter-description">En son haberlerden haberdar olmak için bültenimize abone olun.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="E-posta adresiniz" class="newsletter-input" required>
                    <button type="submit" class="newsletter-button">
                        <i class="fas fa-paper-plane"></i>
                        Abone Ol
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer Alt Bölümü - Copyright -->
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p class="footer-copyright">
                    &copy; {{ date('Y') }} Horde Sports. Tüm hakları saklıdır.
                </p>
                <div class="footer-bottom-links">
                    <a href="#" class="footer-bottom-link">Gizlilik</a>
                    <span class="footer-separator">|</span>
                    <a href="#" class="footer-bottom-link">Şartlar</a>
                    <span class="footer-separator">|</span>
                    <a href="#" class="footer-bottom-link">İletişim</a>
                </div>
            </div>
        </div>
    </div>
</footer>

