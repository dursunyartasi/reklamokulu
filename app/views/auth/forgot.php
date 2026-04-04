<section class="auth-section">
    <div class="container">
        <div class="auth-card">
            <h1>Şifremi Unuttum</h1>
            <p>E-posta adresinizi girin, şifre sifirlama baglantisi gonderelim</p>

            <form action="<?= url('şifremi-unuttum') ?>" method="POST" class="auth-form">
                <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

                <div class="form-group">
                    <label for="email">E-Posta Adresi</label>
                    <input type="email" id="email" name="email" required placeholder="ornek@email.com">
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg">Sıfırlama Baglantisi Gönder</button>
            </form>

            <div class="auth-footer">
                <p><a href="<?= url('giris') ?>">Giriş sayfasına dön</a></p>
            </div>
        </div>
    </div>
</section>