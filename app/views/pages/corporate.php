<section class="section">
    <div class="container">
        <div class="section-header">
            <h1>Kurumsal Egitimler</h1>
            <p>Sirketinize ozel dijital pazarlama egitimleri</p>
        </div>

        <div class="corporate-features">
            <div class="advantage-card">
                <div class="advantage-icon"><i class="fas fa-building"></i></div>
                <h3>Ofisinizde Yuz Yuze</h3>
                <p>Egitmenlerimiz sirketinize gelerek yuz yuze egitim verir</p>
            </div>
            <div class="advantage-card">
                <div class="advantage-icon"><i class="fas fa-laptop"></i></div>
                <h3>Online Egitimler</h3>
                <p>Uzaktan calisanlariniz icin online egitim secenegi</p>
            </div>
            <div class="advantage-card">
                <div class="advantage-icon"><i class="fas fa-puzzle-piece"></i></div>
                <h3>Ozel Mufredat</h3>
                <p>Ihtiyaclariniza gore ozellesmis egitim programlari</p>
            </div>
        </div>

        <div class="corporate-form-section">
            <h2>Kurumsal Egitim Talebi</h2>
            <form action="<?= url('kurumsal-basvuru') ?>" method="POST" class="contact-form">
                <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Adiniz</label>
                        <input type="text" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label>Soyadiniz</label>
                        <input type="text" name="last_name" required>
                    </div>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Firma Adi</label>
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
                    <label>Mesajiniz</label>
                    <textarea name="message" rows="4"></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-lg">Talep Gonder</button>
            </form>
        </div>
    </div>
</section>