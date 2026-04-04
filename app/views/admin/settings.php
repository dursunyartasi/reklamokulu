<h1>Site Ayarlari</h1>

<form action="<?= url('admin/ayarlar') ?>" method="POST" class="admin-form">
    <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

    <h3>Genel</h3>
    <div class="form-row-2">
        <div class="form-group">
            <label>Site Adi</label>
            <input type="text" name="site_name" value="<?= e($settings['site_name'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label>Site Aciklamasi</label>
            <input type="text" name="site_description" value="<?= e($settings['site_description'] ?? '') ?>">
        </div>
    </div>

    <div class="form-row-2">
        <div class="form-group">
            <label>E-Posta</label>
            <input type="email" name="site_email" value="<?= e($settings['site_email'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label>Telefon</label>
            <input type="text" name="site_phone" value="<?= e($settings['site_phone'] ?? '') ?>">
        </div>
    </div>

    <div class="form-group">
        <label>Adres</label>
        <input type="text" name="site_address" value="<?= e($settings['site_address'] ?? '') ?>">
    </div>

    <h3>Sosyal Medya</h3>
    <div class="form-row-2">
        <div class="form-group">
            <label>Instagram</label>
            <input type="url" name="instagram" value="<?= e($settings['instagram'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label>LinkedIn</label>
            <input type="url" name="linkedin" value="<?= e($settings['linkedin'] ?? '') ?>">
        </div>
    </div>
    <div class="form-group">
        <label>YouTube</label>
        <input type="url" name="youtube" value="<?= e($settings['youtube'] ?? '') ?>">
    </div>

    <h3>Analytics</h3>
    <div class="form-row-2">
        <div class="form-group">
            <label>Google Analytics ID</label>
            <input type="text" name="google_analytics" value="<?= e($settings['google_analytics'] ?? '') ?>" placeholder="G-XXXXXXXXXX">
        </div>
        <div class="form-group">
            <label>Facebook Pixel ID</label>
            <input type="text" name="facebook_pixel" value="<?= e($settings['facebook_pixel'] ?? '') ?>">
        </div>
    </div>

    <h3>Kampanya Geri Sayim</h3>
    <div class="form-row-2">
        <div class="form-group">
            <label>Geri Sayim Tarihi</label>
            <input type="datetime-local" name="countdown_date" value="<?= e($settings['countdown_date'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label>Geri Sayim Metni</label>
            <input type="text" name="countdown_text" value="<?= e($settings['countdown_text'] ?? '') ?>">
        </div>
    </div>

    <h3>Ana Sayfa</h3>
    <div class="form-group">
        <label>Hero Baslik</label>
        <input type="text" name="hero_title" value="<?= e($settings['hero_title'] ?? '') ?>">
    </div>
    <div class="form-group">
        <label>Hero Alt Baslik</label>
        <input type="text" name="hero_subtitle" value="<?= e($settings['hero_subtitle'] ?? '') ?>">
    </div>

    <button type="submit" class="btn btn-primary btn-lg">Kaydet</button>
</form>