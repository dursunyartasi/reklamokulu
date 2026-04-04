</main>

<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <span class="logo-text footer-logo">Reklam<strong>Okulu</strong></span>
                <p>Dijital pazarlama alaninda uzman egitmenlerle, pratik odakli egitimlerle kariyerinizi bir ust seviyeye tasiyin.</p>
                <div class="social-links">
                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Kurumsal</h4>
                <a href="<?= url('egitimler') ?>">Egitimler</a>
                <a href="<?= url('egitmenler') ?>">Egitmenler</a>
                <a href="<?= url('neden-biz') ?>">Neden Biz?</a>
                <a href="<?= url('kurumsal-egitimler') ?>">Kurumsal Egitim</a>
            </div>

            <div class="footer-col">
                <h4>Destek</h4>
                <a href="<?= url('sss') ?>">Sikca Sorulan Sorular</a>
                <a href="<?= url('blog') ?>">Blog</a>
                <a href="<?= url('iletisim') ?>">Iletisim</a>
            </div>

            <div class="footer-col">
                <h4>Iletisim</h4>
                <p><i class="fas fa-envelope"></i> info@reklamokulu.com</p>
                <p><i class="fas fa-map-marker-alt"></i> Istanbul, Turkiye</p>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-legal">
                <a href="<?= url('kullanim-kosullari') ?>">Kullanim Kosullari</a>
                <a href="<?= url('kvkk') ?>">KVKK</a>
                <a href="<?= url('iptal-iade') ?>">Iptal & Iade</a>
            </div>
            <p>&copy; <?= date('Y') ?> Reklam Okulu. Tum haklari saklidir.</p>
        </div>
    </div>
</footer>

<script src="<?= url('js/app.js') ?>"></script>
</body>
</html>