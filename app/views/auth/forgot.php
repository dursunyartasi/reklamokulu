<section class="auth-section">
    <div class="container">
        <div class="auth-card">
            <h1>Sifremi Unuttum</h1>
            <p>E-posta adresinizi girin, sifre sifirlama baglantisi gonderelim</p>

            <form action="<?= url('sifremi-unuttum') ?>" method="POST" class="auth-form">
                <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

                <div class="form-group">
                    <label for="email">E-Posta Adresi</label>
                    <input type="email" id="email" name="email" required placeholder="ornek@email.com">
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg">Sifirlama Baglantisi Gonder</button>
            </form>

            <div class="auth-footer">
                <p><a href="<?= url('giris') ?>">Giris sayfasina don</a></p>
            </div>
        </div>
    </div>
</section>