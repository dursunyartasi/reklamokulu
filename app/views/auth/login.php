<section class="auth-section">
    <div class="container">
        <div class="auth-card">
            <h1>Giriş Yap</h1>
            <p>Öğrenci panelinize erisim icin giris yapin</p>

            <form action="<?= url('giris') ?>" method="POST" class="auth-form">
                <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

                <div class="form-group">
                    <label for="email">E-Posta Adresi</label>
                    <input type="email" id="email" name="email" required placeholder="ornek@email.com">
                </div>

                <div class="form-group">
                    <label for="password">Şifre</label>
                    <input type="password" id="password" name="password" required placeholder="Şifreniz">
                </div>

                <div class="form-row">
                    <a href="<?= url('şifremi-unuttum') ?>" class="forgot-link">Şifremi Unuttum</a>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg">Giriş Yap</button>
            </form>

            <div class="auth-footer">
                <p>Hesabınız yok mu? <a href="<?= url('kayit') ?>">Kayıt Olun</a></p>
            </div>
        </div>
    </div>
</section>