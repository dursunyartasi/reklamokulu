<section class="section">
    <div class="container">
        <div class="section-header">
            <h1>Kurumsal Eğitimler</h1>
            <p>Şirketinize ozel dijital pazarlama eğitimleri</p>
        </div>

        <div class="corporate-features">
            <div class="advantage-card">
                <div class="advantage-icon"><i class="fas fa-building"></i></div>
                <h3>Ofisinizde Yüz Yüze</h3>
                <p>Eğitmenlerimiz sirketinize gelerek yüz yüze eğitim verir</p>
            </div>
            <div class="advantage-card">
                <div class="advantage-icon"><i class="fas fa-laptop"></i></div>
                <h3>Online Eğitimler</h3>
                <p>Uzaktan çalışanlarınız için online eğitim seçeneği</p>
            </div>
            <div class="advantage-card">
                <div class="advantage-icon"><i class="fas fa-puzzle-piece"></i></div>
                <h3>Özel Müfredat</h3>
                <p>İhtiyaçlarınıza gore özelleşmiş eğitim programlari</p>
            </div>
        </div>

        <div class="corporate-form-section">
            <h2>Kurumsal Eğitim Talebi</h2>
            <form action="<?= url('kurumsal-basvuru') ?>" method="POST" class="contact-form">
                <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Adınız</label>
                        <input type="text" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label>Soyadınız</label>
                        <input type="text" name="last_name" required>
                    </div>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Firma Adı</label>
                        <input type="text" name="company" required>
                    </div>
                    <div class="form-group">
                        <label>E-Posta</label>
                        <input type="email" name="email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Telefon</label>
                    <input type="tel" name="phone">
                </div>

                <div class="form-group">
                    <label>Mesajınız</label>
                    <textarea name="message" rows="4"></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-lg">Talep Gönder</button>
            </form>
        </div>
    </div>
</section>