<h1>📋 Proje Durumu</h1>
<p class="text-muted">Son güncelleme: <?= date('d.m.Y H:i') ?></p>

<!-- Tamamlanan İşler -->
<div class="admin-section">
    <h2>✅ Tamamlanan İşler</h2>

    <div class="status-card status-done">
        <h3>1. UI/UX Tasarım Revizyonu (Ahmetbalat Akademi Benzeri)</h3>
        <ul>
            <li>✅ Renk paleti: Kırmızı (#E63946) → Turuncu/Amber (#E8922E, #F5A623)</li>
            <li>✅ Header redesign: Üst bar (arama + sepet + kullanıcı) + ana nav + "Öğrenci Paneli" CTA</li>
            <li>✅ Hero bölümü: Turuncu arka plan, sol metin + sağ istatistik kartları (glassmorphism)</li>
            <li>✅ 6 avantaj kartı: Farklı pastel arka planlar (sarı, yeşil, mor, mavi, pembe, krem)</li>
            <li>✅ Eğitim kartları: 4'lü grid, fiyat + "Satın Al →" link yapısı</li>
            <li>✅ Testimonials bölümü: 3'lü yorum kartları (Sizden Gelenler)</li>
            <li>✅ Kurumsal CTA: Mavi-mor gradient banner</li>
            <li>✅ Dark mode toggle korundu</li>
            <li>✅ Sticky header</li>
        </ul>
    </div>

    <div class="status-card status-done">
        <h3>2. Eğitim Detay Sayfası</h3>
        <ul>
            <li>✅ Breadcrumb navigasyon</li>
            <li>✅ Gradient hero (turuncu → mor)</li>
            <li>✅ Feature badge'ler: Bire Bir Destek, Soru Cevap, Canlı Yayınlar</li>
            <li>✅ 4 Tab yapısı: Avantajlar | Kurs İçeriği | SSS | Eğitmen</li>
            <li>✅ Sticky sidebar: Fiyat kartı + CTA + meta bilgiler</li>
            <li>✅ Kampanya badge, kilit ikonu</li>
            <li>✅ İlgili eğitimler 4'lü grid</li>
            <li>✅ Accordion müfredat (bölüm/ders yapısı)</li>
        </ul>
    </div>

    <div class="status-card status-done">
        <h3>3. Öğrenci Paneli (Ahmetbalat Tarzı)</h3>
        <ul>
            <li>✅ Koyu hero header (profil fotoğrafı + kullanıcı adı + istatistikler)</li>
            <li>✅ Sol sidebar: Pano, Profil, Eğitimler, Katılım Belgeleri, Siparişler, Bire Bir Görüşme, Ayarlar, Çıkış</li>
            <li>✅ Dashboard stat kartları (mor/mavi): Devam Eden + Tamamlanan eğitim sayısı</li>
            <li>✅ Aktif/Tamamlanan eğitim tabları</li>
            <li>✅ Eğitim kartları: Kapak görseli + başlık + eğitmen + ilerleme yüzdesi + progress bar</li>
            <li>✅ Ortak _sidebar.php ve _panel_header.php partial dosyaları</li>
        </ul>
    </div>

    <div class="status-card status-done">
        <h3>4. Siparişler Sayfası (/panel/siparisler)</h3>
        <ul>
            <li>✅ Sipariş kartları: Sipariş no, tarih, durum badge'i</li>
            <li>✅ Sipariş detayları: Ürün listesi + fiyatlar</li>
            <li>✅ Durum renkleri: Tamamlandı (yeşil), Beklemede (sarı), Başarısız (kırmızı), İade (mavi)</li>
        </ul>
    </div>

    <div class="status-card status-done">
        <h3>5. Bire Bir Görüşme Modülü (/panel/gorusme)</h3>
        <ul>
            <li>✅ meetings tablosu (MySQL): user_id, course_id, preferred_date, preferred_time, duration, notes, status</li>
            <li>✅ Görüşme talebi formu: Eğitim seçimi, tarih, saat, süre, konu</li>
            <li>✅ Geçmiş görüşmeler listesi: Tarih badge + eğitim adı + durum</li>
            <li>✅ Bilgilendirme kartı: Hak bilgisi</li>
            <li>✅ Route: /panel/gorusme (GET) + /panel/gorusme-talebi (POST)</li>
        </ul>
    </div>

    <div class="status-card status-done">
        <h3>6. Demo İçerikler</h3>
        <ul>
            <li>✅ 4 eğitmen profili (Ahmet, Zeynep, Mehmet, Elif) + avatar görselleri</li>
            <li>✅ 6 kategori (Dijital Pazarlama, Sosyal Medya, SEO, İçerik Üretimi, Tasarım, Yapay Zeka)</li>
            <li>✅ 8 eğitim (1 ücretsiz + 7 ücretli, indirimli fiyatlar)</li>
            <li>✅ Bölümler ve dersler (YouTube embed URL'leri ile)</li>
            <li>✅ 8 kurs kapak görseli (800x450)</li>
            <li>✅ 6 SSS verisi</li>
        </ul>
    </div>

    <div class="status-card status-done">
        <h3>7. PWA (Progressive Web App) Desteği</h3>
        <ul>
            <li>✅ manifest.json: App adı, tema rengi (#E8922E), ikonlar, shortcuts</li>
            <li>✅ sw.js: Cache-first statik dosyalar, network-first sayfalar</li>
            <li>✅ Header meta tags: apple-mobile-web-app, theme-color</li>
            <li>✅ Service worker registration (footer)</li>
            <li>✅ 8 PWA ikonu (72px - 512px)</li>
        </ul>
    </div>

    <div class="status-card status-done">
        <h3>8. Mobil Uyumluluk</h3>
        <ul>
            <li>✅ Responsive grid'ler (1/2/4 sütun breakpoint'leri)</li>
            <li>✅ Mobil bottom navigation bar: Ana Sayfa, Eğitimler, Sepet, Panelim</li>
            <li>✅ Hamburger menü</li>
            <li>✅ Top bar mobilde gizleniyor</li>
            <li>✅ Hero, kartlar, panel mobil uyumlu</li>
        </ul>
    </div>

    <div class="status-card status-done">
        <h3>9. Türkçe Karakter Düzeltmeleri</h3>
        <ul>
            <li>✅ 33+ dosyada ç, ğ, ı, İ, ö, ş, ü karakterleri düzeltildi</li>
            <li>✅ URL path'lerdeki Türkçe karakterler ASCII'ye çevrildi (22 dosya)</li>
            <li>✅ Admin panel Türkçe label'lar düzeltildi</li>
            <li>✅ Footer, auth, course, student view'ları düzeltildi</li>
        </ul>
    </div>

    <div class="status-card status-done">
        <h3>10. Teknik Altyapı</h3>
        <ul>
            <li>✅ CSS cache-busting (?v= parametresi)</li>
            <li>✅ Dockerfile: Cache bust ARG, Apache mod_rewrite</li>
            <li>✅ Coolify: Webhook deploy, force deploy (without cache)</li>
            <li>✅ .gitignore: uploads klasörü demo görseller için açıldı</li>
            <li>✅ Güvenlik: Seed/helper script'ler silindi</li>
        </ul>
    </div>
</div>

<!-- Yapılacaklar -->
<div class="admin-section">
    <h2>📌 Yapılacaklar (Öncelik Sırasına Göre)</h2>

    <div class="status-card status-priority-high">
        <h3>🔴 ÖNCELİK 1 - Kısa Vade (1-3 Hafta)</h3>

        <h4>1.1 Gamification Sistemi</h4>
        <ul>
            <li>⬜ Rozet sistemi: "SEO Uzmanı", "Reklam Gurusu", "Analytics Master" vb.</li>
            <li>⬜ Puan sistemi: Ders bitirme, quiz çözme, forum katılımı</li>
            <li>⬜ Liderlik tablosu: Haftalık/aylık en aktif öğrenciler</li>
            <li>⬜ Streak sistemi: Ardışık gün öğrenme serisi (Duolingo benzeri)</li>
            <li>⬜ Seviye sistemi: Bronz → Gümüş → Altın → Platin → Elmas</li>
            <li>⬜ DB tabloları: badges, user_badges, user_points, streaks</li>
        </ul>

        <h4>1.2 Kurs İçi Q&A / Forum</h4>
        <ul>
            <li>⬜ Her ders altında soru-cevap bölümü</li>
            <li>⬜ Genel dijital pazarlama forumu</li>
            <li>⬜ Eğitmen yanıt sistemi</li>
            <li>⬜ Upvote / beğeni mekanizması</li>
            <li>⬜ DB tabloları: discussions, discussion_replies, discussion_votes</li>
        </ul>

        <h4>1.3 Push Notification</h4>
        <ul>
            <li>⬜ Web push API entegrasyonu</li>
            <li>⬜ Yeni ders eklendi bildirimi</li>
            <li>⬜ İndirim/kampanya bildirimi</li>
            <li>⬜ Canlı yayın hatırlatma</li>
        </ul>

        <h4>1.4 İyzico Ödeme Entegrasyonu</h4>
        <ul>
            <li>⬜ iyzico API key/secret (.env)</li>
            <li>⬜ Kredi kartı ödeme formu</li>
            <li>⬜ 3D Secure desteği</li>
            <li>⬜ Taksit seçenekleri</li>
            <li>⬜ Ödeme başarılı/başarısız callback</li>
        </ul>
    </div>

    <div class="status-card status-priority-medium">
        <h3>🟡 ÖNCELİK 2 - Orta Vade (1-2 Ay)</h3>

        <h4>2.1 AI Destekli Özellikler</h4>
        <ul>
            <li>⬜ AI Quiz oluşturucu (OpenAI API): Her ders sonunda otomatik quiz</li>
            <li>⬜ AI chatbot asistan: Öğrenci sorularına anında cevap</li>
            <li>⬜ Kişiselleştirilmiş ders önerisi</li>
            <li>⬜ Yanlış cevaplara göre tekrar önerileri</li>
        </ul>

        <h4>2.2 Canlı Yayın / Webinar Entegrasyonu</h4>
        <ul>
            <li>⬜ Haftalık ücretsiz webinar sayfası</li>
            <li>⬜ Canlı Q&A oturumları</li>
            <li>⬜ YouTube/Zoom live embed</li>
            <li>⬜ Kayıt arşivi (kursa otomatik ekleme)</li>
            <li>⬜ Webinar takvimi</li>
        </ul>

        <h4>2.3 Gelişmiş Admin Panel</h4>
        <ul>
            <li>⬜ Ana sayfa bölümlerini admin'den yönetme (hero, avantajlar, testimonials)</li>
            <li>⬜ Eğitmen yönetimi (CRUD)</li>
            <li>⬜ Kategori yönetimi</li>
            <li>⬜ Kupon kodu yönetimi</li>
            <li>⬜ Bire bir görüşme talepleri yönetimi</li>
            <li>⬜ Grafik/chart dashboard (Chart.js)</li>
            <li>⬜ E-posta template yönetimi</li>
        </ul>

        <h4>2.4 E-posta Sistemi</h4>
        <ul>
            <li>⬜ Kayıt hoşgeldin e-postası</li>
            <li>⬜ Sipariş onay e-postası</li>
            <li>⬜ Şifre sıfırlama (gerçek e-posta)</li>
            <li>⬜ Yeni ders bildirimi</li>
            <li>⬜ SMTP entegrasyonu (Gmail / SendGrid)</li>
        </ul>
    </div>

    <div class="status-card status-priority-low">
        <h3>🟢 ÖNCELİK 3 - Uzun Vade (2-6 Ay)</h3>

        <h4>3.1 Pratik Proje Portföyü</h4>
        <ul>
            <li>⬜ Her kurs sonunda gerçek bir proje</li>
            <li>⬜ Eğitmen değerlendirmesi ve geri bildirim</li>
            <li>⬜ Halka açık portföy sayfası</li>
            <li>⬜ İş verenlere gösterilecek sertifika + portföy</li>
        </ul>

        <h4>3.2 Dijital Badge Sistemi</h4>
        <ul>
            <li>⬜ Credly veya Open Badges entegrasyonu</li>
            <li>⬜ LinkedIn'e eklenebilir dijital sertifikalar</li>
            <li>⬜ QR kodlu doğrulama sistemi</li>
        </ul>

        <h4>3.3 Sektör Ortaklıkları</h4>
        <ul>
            <li>⬜ Google, Meta, HubSpot sertifika hazırlık kursları</li>
            <li>⬜ Dijital ajanslarla staj/iş bağlantısı</li>
            <li>⬜ İş ilanları panosu</li>
            <li>⬜ Mezun ağı ve networking</li>
        </ul>

        <h4>3.4 White-Label / Franchise</h4>
        <ul>
            <li>⬜ Kurumsal müşterilere özel markalı eğitim portalı</li>
            <li>⬜ API ile dış sistemlere entegrasyon</li>
            <li>⬜ Multi-tenant altyapı</li>
        </ul>
    </div>
</div>

<!-- Rakip Analizi Özeti -->
<div class="admin-section">
    <h2>📊 Rakip Analizi Özeti</h2>
    <p>Detaylı rapor: <code>RAKIP_ANALIZI.md</code> (repo kök dizini)</p>

    <table class="admin-table">
        <thead>
            <tr><th>Platform</th><th>Tip</th><th>Fiyat</th><th>Avantaj</th><th>Dezavantaj</th></tr>
        </thead>
        <tbody>
            <tr><td>Udemy</td><td>Marketplace</td><td>12-30€/kurs</td><td>Devasa içerik, düşük fiyat</td><td>Kalite tutarsız, etkileşim yok</td></tr>
            <tr><td>BTK Akademi</td><td>Devlet</td><td>Ücretsiz</td><td>Resmi sertifika</td><td>Eski UX, pasif içerik</td></tr>
            <tr><td>Coursera</td><td>Akademik</td><td>$49/ay</td><td>Üniversite sertifikası</td><td>Pahalı, Türkçe yok</td></tr>
            <tr><td>HubSpot</td><td>Ücretsiz</td><td>Ücretsiz</td><td>Sektörce tanınan</td><td>Dar kapsam</td></tr>
            <tr><td>Kajabi</td><td>All-in-one</td><td>$179-499/ay</td><td>AI, topluluk, mobil</td><td>Çok pahalı</td></tr>
            <tr><td>BilgeAdam</td><td>Geleneksel</td><td>3-15K TL</td><td>25+ yıl deneyim</td><td>Pahalı, eski model</td></tr>
        </tbody>
    </table>

    <h3 style="margin-top: 1.5rem;">ReklamOkulu'nun Benzersiz Değer Önerisi:</h3>
    <div class="status-card" style="background: var(--primary-light, #FFF8F0); border-left: 4px solid var(--primary);">
        <p style="font-size: 1.1rem; font-weight: 600; margin: 0;">
            "Türkiye'nin ilk AI destekli, pratik odaklı ve topluluk gücü ile desteklenmiş dijital pazarlama eğitim platformu"
        </p>
    </div>

    <h4>Neden bu UVP çalışır:</h4>
    <ul>
        <li><strong>Ücretsiz platformlardan farkımız:</strong> İnteraktif, AI destekli, pratik odaklı</li>
        <li><strong>Udemy'den farkımız:</strong> Dijital pazarlamaya odaklı, bire bir destek</li>
        <li><strong>Global platformlardan farkımız:</strong> Tamamen Türkçe, yerel pazar</li>
        <li><strong>Tüm rakiplerden farkımız:</strong> PWA + Gamification + AI + Topluluk (hiçbir Türk rakipte yok)</li>
    </ul>
</div>

<!-- Teknik Bilgiler -->
<div class="admin-section">
    <h2>⚙️ Teknik Bilgiler</h2>
    <table class="admin-table">
        <tbody>
            <tr><td><strong>Backend</strong></td><td>PHP 8.3 (Vanilla MVC)</td></tr>
            <tr><td><strong>Veritabanı</strong></td><td>MySQL 8</td></tr>
            <tr><td><strong>Frontend</strong></td><td>Vanilla CSS + JavaScript, Inter font, Font Awesome 6</td></tr>
            <tr><td><strong>Deploy</strong></td><td>Coolify (Docker, Dockerfile build)</td></tr>
            <tr><td><strong>Repo</strong></td><td>github.com/dursunyartasi/reklamokulu</td></tr>
            <tr><td><strong>Domain</strong></td><td>dursunyartasi.com/reklamokulu</td></tr>
            <tr><td><strong>Toplam Commit</strong></td><td>~20 commit (bu oturum)</td></tr>
            <tr><td><strong>Değişen Dosya</strong></td><td>50+ dosya, 3000+ satır kod</td></tr>
        </tbody>
    </table>
</div>
