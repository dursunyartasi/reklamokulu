<section class="auth-section">
    <div class="container">
        <div class="auth-card">
            <h1>Giris Yap</h1>
            <p>Ogrenci panelinize erisim icin giris yapin</p>

            <form action="<?= url('giris') ?>" method="POST" class="auth-form">
                <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

                <div class="form-group">
                    <label for="email">E-Posta Adresi</label>
                    <input type="email" id="email" name="email" required placeholder="ornek@email.com">
                </div>

                <div class="form-group">
                    <label for="password">Sifre</label>
                    <input type="password" id="password" name="password" required placeholder="Sifreniz">
                </div>

                <div class="form-row">
                    <a href="<?= url('sifremi-unuttum') ?>" class="forgot-link">Sifremi Unuttum</a>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg">Giris Yap</button>
            </form>

            <div class="auth-footer">
                <p>Hesabiniz yok mu? <a href="<?= url('kayit') ?>">Kayit Olun</a></p>
            </div>
        </div>
    </div>
</section>