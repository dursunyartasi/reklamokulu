<section class="section">
    <div class="container">
        <h1>Profilim</h1>

        <form action="<?= url('panel/profil') ?>" method="POST" class="profile-form">
            <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

            <div class="form-row-2">
                <div class="form-group">
                    <label>Adiniz</label>
                    <input type="text" name="first_name" value="<?= e($user['first_name']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Soyadiniz</label>
                    <input type="text" name="last_name" value="<?= e($user['last_name']) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label>E-Posta</label>
                <input type="email" value="<?= e($user['email']) ?>" disabled>
                <small>E-posta adresi degistirilemez</small>
            </div>

            <div class="form-group">
                <label>Telefon</label>
                <input type="tel" name="phone" value="<?= e($user['phone'] ?? '') ?>">
            </div>

            <hr>
            <h3>Sifre Degistir</h3>

            <div class="form-group">
                <label>Mevcut Sifre</label>
                <input type="password" name="current_password">
            </div>

            <div class="form-group">
                <label>Yeni Sifre</label>
                <input type="password" name="new_password" minlength="6">
            </div>

            <button type="submit" class="btn btn-primary btn-lg">Kaydet</button>
        </form>
    </div>
</section>
