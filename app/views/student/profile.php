<?php $activePanel = 'profil'; ?>
<?php require __DIR__ . '/_panel_header.php'; ?>

<section class="section panel-section">
    <div class="container">
        <div class="panel-layout">
            <?php require __DIR__ . '/_sidebar.php'; ?>

            <div class="panel-main">
                <h3 class="panel-title">Profil</h3>

                <form action="<?= url('panel/profil') ?>" method="POST" class="profile-form">
                    <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

                    <div class="form-row-2">
                        <div class="form-group">
                            <label>Adınız</label>
                            <input type="text" name="first_name" value="<?= e($user['first_name']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Soyadınız</label>
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
                    <h3>Şifre Degistir</h3>

                    <div class="form-group">
                        <label>Mevcut Şifre</label>
                        <input type="password" name="current_password">
                    </div>

                    <div class="form-group">
                        <label>Yeni Şifre</label>
                        <input type="password" name="new_password" minlength="6">
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg">Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</section>
