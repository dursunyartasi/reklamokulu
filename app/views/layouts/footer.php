</main>

<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <span class="logo-text footer-logo">Reklam<strong>Okulu</strong></span>
                <p>Dijital pazarlama alanında uzman eğitmenlerle, pratik odaklı eğitimlerle kariyerinizi bir üst seviyeye taşıyın.</p>
                <div class="social-links">
                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Kurumsal</h4>
                <a href="<?= url('egitimler') ?>">Eğitimler</a>
                <a href="<?= url('egitmenler') ?>">Eğitmenler</a>
                <a href="<?= url('neden-biz') ?>">Neden Biz?</a>
                <a href="<?= url('kurumsal-egitimler') ?>">Kurumsal Eğitim</a>
            </div>

            <div class="footer-col">
                <h4>Destek</h4>
                <a href="<?= url('sss') ?>">Sıkça Sorulan Sorular</a>
                <a href="<?= url('blog') ?>">Blog</a>
                <a href="<?= url('iletisim') ?>">İletişim</a>
            </div>

            <div class="footer-col">
                <h4>İletişim</h4>
                <p><i class="fas fa-envelope"></i> info@reklamokulu.com</p>
                <p><i class="fas fa-map-marker-alt"></i> İstanbul, Türkiye</p>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-legal">
                <a href="<?= url('kullanim-kosullari') ?>">Kullanım Koşulları</a>
                <a href="<?= url('kvkk') ?>">KVKK</a>
                <a href="<?= url('iptal-iade') ?>">İptal & İade</a>
            </div>
            <p>&copy; <?= date('Y') ?> Reklam Okulu. Tüm hakları saklıdır.</p>
        </div>
    </div>
</footer>

<!-- Mobile Bottom Navigation -->
<nav class="mobile-bottom-nav">
    <a href="<?= url('') ?>"><i class="fas fa-home"></i> Ana Sayfa</a>
    <a href="<?= url('egitimler') ?>"><i class="fas fa-graduation-cap"></i> Eğitimler</a>
    <a href="<?= url('sepet') ?>"><i class="fas fa-shopping-cart"></i> Sepet</a>
    <?php if (isLoggedIn()): ?>
        <a href="<?= url('panel') ?>"><i class="fas fa-user"></i> Panelim</a>
    <?php else: ?>
        <a href="<?= url('giris') ?>"><i class="fas fa-user"></i> Giriş</a>
    <?php endif; ?>
</nav>

<script src="<?= url('js/app.js') ?>"></script>
<script>
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('<?= url('sw.js') ?>').catch(() => {});
}
</script>
</body>
</html>
