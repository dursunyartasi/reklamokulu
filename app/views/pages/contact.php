<section class="section">
    <div class="container">
        <div class="section-header">
            <h1>İletişim</h1>
            <p>Sorularınız icin bize ulaşın</p>
        </div>

        <div class="contact-layout">
            <form action="<?= url('iletisim') ?>" method="POST" class="contact-form">
                <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Adınız Soyadınız</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>E-Posta</label>
                        <input type="email" name="email" required>
                    </div>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Telefon</label>
                        <input type="tel" name="phone">
                    </div>
                    <div class="form-group">
                        <label>Konu</label>
                        <input type="text" name="subject">
                    </div>
                </div>

                <div class="form-group">
                    <label>Mesajınız</label>
                    <textarea name="message" rows="5" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-lg">Gönder</button>
            </form>

            <div class="contact-info-box">
                <div class="contact-info-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <h4>E-Posta</h4>
                        <p>info@reklamokulu.com</p>
                    </div>
                </div>
                <div class="contact-info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <h4>Adres</h4>
                        <p>Istanbul, Türkiye</p>
                    </div>
                </div>
                <div class="contact-info-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <h4>Çalışma Saatleri</h4>
                        <p>Pazartesi - Cuma: 09:00 - 18:00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>