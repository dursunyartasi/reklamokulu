<section class="auth-section">
    <div class="container">
        <div class="auth-card">
            <h1>Kayit Ol</h1>
            <p>Ücretsiz hesap olusturun ve eğitim almaya başlayın</p>

            <form action="<?= url('kayit') ?>" method="POST" class="auth-form">
                <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

                <div class="form-row-2">
                    <div class="form-group">
                        <label for="first_name">Adınız</label>
                        <input type="text" id="first_name" name="first_name" required placeholder="Adınız">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Soyadınız</label>
                        <input type="text" id="last_name" name="last_name" required placeholder="Soyadınız">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">E-Posta Adresi</label>
                    <input type="email" id="email" name="email" required placeholder="ornek@email.com">
                </div>

                <div class="form-group">
                    <label for="password">Şifre</label>
                    <input type="password" id="password" name="password" required minlength="6" placeholder="En az 6 karakter">
                </div>

                <div class="form-group">
                    <label for="password_confirm">Şifre Tekrar</label>
                    <input type="password" id="password_confirm" name="password_confirm" required placeholder="Şifrenizi tekrar girin">
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg">Kayıt Ol</button>
            </form>

            <div class="auth-footer">
                <p>Zaten hesabınız var mı? <a href="<?= url('giris') ?>">Giriş Yapin</a></p>
            </div>
        </div>
    </div>
</section>