-- Reklam Okulu Demo Verileri
-- Coolify Terminal'den çalıştırın: mysql -u mysql -p default < /var/www/html/database/seed.sql

-- Meetings tablosunu oluştur (henüz yoksa)
CREATE TABLE IF NOT EXISTS meetings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    preferred_date DATE NOT NULL,
    preferred_time VARCHAR(10) NOT NULL,
    duration INT DEFAULT 30,
    notes TEXT DEFAULT NULL,
    meeting_link VARCHAR(500) DEFAULT NULL,
    status ENUM('pending','approved','completed','cancelled') DEFAULT 'pending',
    admin_notes TEXT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
) ENGINE=InnoDB;

-- Kategoriler
INSERT INTO categories (name, slug, description, sort_order) VALUES
('Dijital Pazarlama', 'dijital-pazarlama', 'Dijital pazarlama eğitimleri', 1),
('Sosyal Medya', 'sosyal-medya', 'Sosyal medya yönetimi ve reklamcılık', 2),
('SEO', 'seo', 'Arama motoru optimizasyonu', 3),
('İçerik Üretimi', 'icerik-uretimi', 'İçerik üretimi ve video düzenleme', 4),
('Tasarım', 'tasarim', 'Grafik tasarım ve görsel içerik', 5),
('Yapay Zeka', 'yapay-zeka', 'Yapay zeka araçları ve uygulamaları', 6)
ON DUPLICATE KEY UPDATE name=VALUES(name);

-- Eğitmenler (kullanıcılar)
INSERT INTO users (first_name, last_name, email, password, role, is_active) VALUES
('Ahmet', 'Yılmaz', 'ahmet@reklamokulu.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'instructor', 1),
('Zeynep', 'Kaya', 'zeynep@reklamokulu.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'instructor', 1),
('Mehmet', 'Demir', 'mehmet@reklamokulu.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'instructor', 1),
('Elif', 'Çelik', 'elif@reklamokulu.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'instructor', 1)
ON DUPLICATE KEY UPDATE first_name=VALUES(first_name);

-- Eğitmen profilleri
INSERT INTO instructors (user_id, title, bio, expertise, sort_order)
SELECT u.id,
    CASE u.email
        WHEN 'ahmet@reklamokulu.com' THEN 'Dijital Pazarlama Uzmanı'
        WHEN 'zeynep@reklamokulu.com' THEN 'Sosyal Medya Uzmanı'
        WHEN 'mehmet@reklamokulu.com' THEN 'SEO ve Google Ads Uzmanı'
        WHEN 'elif@reklamokulu.com' THEN 'İçerik ve Tasarım Uzmanı'
    END,
    CASE u.email
        WHEN 'ahmet@reklamokulu.com' THEN '10 yılı aşkın dijital pazarlama deneyimine sahip. Meta Business, Google Ads ve dijital strateji konularında uzmanlaşmıştır. Yüzlerce markaya danışmanlık vermiştir.'
        WHEN 'zeynep@reklamokulu.com' THEN 'Sosyal medya yönetimi ve içerik stratejisi konusunda 8 yıllık deneyime sahip. Instagram, TikTok ve YouTube büyüme stratejileri konusunda uzmandır.'
        WHEN 'mehmet@reklamokulu.com' THEN 'SEO ve arama motoru pazarlaması alanında 7 yıllık tecrübeye sahip. Google Ads sertifikalı uzman. Birçok e-ticaret sitesinin organik trafiğini katlamıştır.'
        WHEN 'elif@reklamokulu.com' THEN 'Grafik tasarım ve video içerik üretimi konusunda uzman. Canva, CapCut ve Adobe araçlarıyla profesyonel içerikler üretmektedir.'
    END,
    CASE u.email
        WHEN 'ahmet@reklamokulu.com' THEN 'Dijital Pazarlama, Meta Business, Google Ads'
        WHEN 'zeynep@reklamokulu.com' THEN 'Instagram, TikTok, Sosyal Medya Yönetimi'
        WHEN 'mehmet@reklamokulu.com' THEN 'SEO, Google Ads, Analytics'
        WHEN 'elif@reklamokulu.com' THEN 'Canva, CapCut, İçerik Üretimi'
    END,
    CASE u.email
        WHEN 'ahmet@reklamokulu.com' THEN 1
        WHEN 'zeynep@reklamokulu.com' THEN 2
        WHEN 'mehmet@reklamokulu.com' THEN 3
        WHEN 'elif@reklamokulu.com' THEN 4
    END
FROM users u
WHERE u.email IN ('ahmet@reklamokulu.com','zeynep@reklamokulu.com','mehmet@reklamokulu.com','elif@reklamokulu.com')
AND NOT EXISTS (SELECT 1 FROM instructors i WHERE i.user_id = u.id);

-- ============================================
-- EĞİTİMLER
-- ============================================

-- 1. Dijital Pazarlama Temel Eğitimi (Ücretsiz)
INSERT INTO courses (instructor_id, category_id, title, slug, description, short_description, price, sale_price, duration, level, is_published, is_free, sort_order, last_updated)
SELECT i.id, c.id,
    'Dijital Pazarlama Temel Eğitimi',
    'dijital-pazarlama-temel-egitimi',
    'Bu eğitimde dijital pazarlamanın temellerini öğreneceksiniz. İnternetin tarihinden sosyal medya stratejilerine, web sitesi yönetiminden içerik pazarlamasına kadar geniş bir perspektif kazanacaksınız.',
    'Dijital pazarlamaya sıfırdan başlayın. Temel kavramları öğrenin ve dijital dünyada ilk adımlarınızı atın.',
    0, NULL, '10 saat 25 dakika', 'beginner', 1, 1, 1, NOW()
FROM instructors i
JOIN users u ON i.user_id = u.id
JOIN categories c ON c.slug = 'dijital-pazarlama'
WHERE u.email = 'ahmet@reklamokulu.com'
AND NOT EXISTS (SELECT 1 FROM courses WHERE slug = 'dijital-pazarlama-temel-egitimi');

-- 2. Meta Business Eğitimi
INSERT INTO courses (instructor_id, category_id, title, slug, description, short_description, price, sale_price, duration, level, is_published, is_free, sort_order, last_updated)
SELECT i.id, c.id,
    'Bire Bir Destekli Meta Business Eğitimi',
    'birebir-destekli-meta-business-egitimi',
    'Facebook ve Instagram reklamcılığını A''dan Z''ye öğrenin. Meta Business panel kurulumu, piksel ve dönüşüm kurulumu, kampanya türleri, hedef kitle stratejileri ve daha fazlası.',
    'Meta Business ile Facebook ve Instagram reklamcılığını en iyi şekilde öğrenin. Bire bir eğitmen desteği dahil.',
    15000, 9750, '58 saat 22 dakika', 'intermediate', 1, 0, 2, NOW()
FROM instructors i
JOIN users u ON i.user_id = u.id
JOIN categories c ON c.slug = 'sosyal-medya'
WHERE u.email = 'ahmet@reklamokulu.com'
AND NOT EXISTS (SELECT 1 FROM courses WHERE slug = 'birebir-destekli-meta-business-egitimi');

-- 3. Google Ads Eğitimi
INSERT INTO courses (instructor_id, category_id, title, slug, description, short_description, price, sale_price, duration, level, is_published, is_free, sort_order, last_updated)
SELECT i.id, c.id,
    'Bire Bir Destekli Google Ads Eğitimi',
    'birebir-destekli-google-ads-egitimi',
    'Google Ads ile arama ağı, görüntülü reklam ağı, YouTube reklamları ve alışveriş kampanyalarını öğrenin. Gerçek kampanya optimizasyonları ile pratik yapın.',
    'Google Ads reklamcılığında uzmanlaşın. Arama, görüntülü ve video kampanyalarını yönetin.',
    10000, 6000, '33 saat 25 dakika', 'intermediate', 1, 0, 3, NOW()
FROM instructors i
JOIN users u ON i.user_id = u.id
JOIN categories c ON c.slug = 'dijital-pazarlama'
WHERE u.email = 'mehmet@reklamokulu.com'
AND NOT EXISTS (SELECT 1 FROM courses WHERE slug = 'birebir-destekli-google-ads-egitimi');

-- 4. SEO Eğitimi
INSERT INTO courses (instructor_id, category_id, title, slug, description, short_description, price, sale_price, duration, level, is_published, is_free, sort_order, last_updated)
SELECT i.id, c.id,
    'Sıfırdan İleri Seviyeye SEO Eğitimi',
    'sifirdan-ileri-seviyeye-seo-egitimi',
    'Arama motoru optimizasyonunu sıfırdan ileri seviyeye kadar öğrenin. Teknik SEO, içerik SEO, backlink stratejileri ve Google Analytics ile performans takibi.',
    'SEO ile web sitenizi Google''da üst sıralara taşıyın. Organik trafiğinizi katlayın.',
    6000, 3900, '30 saat 52 dakika', 'beginner', 1, 0, 4, NOW()
FROM instructors i
JOIN users u ON i.user_id = u.id
JOIN categories c ON c.slug = 'seo'
WHERE u.email = 'mehmet@reklamokulu.com'
AND NOT EXISTS (SELECT 1 FROM courses WHERE slug = 'sifirdan-ileri-seviyeye-seo-egitimi');

-- 5. Canva Eğitimi
INSERT INTO courses (instructor_id, category_id, title, slug, description, short_description, price, sale_price, duration, level, is_published, is_free, sort_order, last_updated)
SELECT i.id, c.id,
    'A''dan Z''ye Canva Eğitimi',
    'adan-zye-canva-egitimi',
    'Canva ile profesyonel görseller, sosyal medya postları, sunumlar ve videolar oluşturmayı öğrenin. Canva Pro özellikleri dahil.',
    'Canva ile tasarım yapmayı öğrenin. Sosyal medya görselleri, sunumlar ve daha fazlası.',
    3000, 1500, '12 saat 8 dakika', 'beginner', 1, 0, 5, NOW()
FROM instructors i
JOIN users u ON i.user_id = u.id
JOIN categories c ON c.slug = 'tasarim'
WHERE u.email = 'elif@reklamokulu.com'
AND NOT EXISTS (SELECT 1 FROM courses WHERE slug = 'adan-zye-canva-egitimi');

-- 6. Reels Eğitimi
INSERT INTO courses (instructor_id, category_id, title, slug, description, short_description, price, sale_price, duration, level, is_published, is_free, sort_order, last_updated)
SELECT i.id, c.id,
    'Kapsamlı Reels Eğitimi',
    'kapsamli-reels-egitimi',
    'Instagram Reels ve TikTok videoları oluşturmayı, düzenlemeyi ve viral stratejileri öğrenin. Trend analizi, ses kullanımı, geçiş efektleri ve büyüme taktikleri.',
    'Reels ve kısa video içerik üretiminde uzmanlaşın. Viral olma stratejilerini öğrenin.',
    4500, 2275, '14 saat 59 dakika', 'beginner', 1, 0, 6, NOW()
FROM instructors i
JOIN users u ON i.user_id = u.id
JOIN categories c ON c.slug = 'icerik-uretimi'
WHERE u.email = 'zeynep@reklamokulu.com'
AND NOT EXISTS (SELECT 1 FROM courses WHERE slug = 'kapsamli-reels-egitimi');

-- 7. Yapay Zeka Eğitimi
INSERT INTO courses (instructor_id, category_id, title, slug, description, short_description, price, sale_price, duration, level, is_published, is_free, sort_order, last_updated)
SELECT i.id, c.id,
    'Yapay Zeka Farkındalık Eğitimi',
    'yapay-zeka-farkindalik-egitimi',
    'ChatGPT, Midjourney, Claude ve diğer yapay zeka araçlarını dijital pazarlamada nasıl kullanacağınızı öğrenin. İçerik üretimi, görsel oluşturma, analiz ve otomasyon.',
    'Yapay zeka araçlarını dijital pazarlamada etkili şekilde kullanmayı öğrenin.',
    1500, 720, '13 saat 52 dakika', 'beginner', 1, 0, 7, NOW()
FROM instructors i
JOIN users u ON i.user_id = u.id
JOIN categories c ON c.slug = 'yapay-zeka'
WHERE u.email = 'ahmet@reklamokulu.com'
AND NOT EXISTS (SELECT 1 FROM courses WHERE slug = 'yapay-zeka-farkindalik-egitimi');

-- 8. WordPress Eğitimi
INSERT INTO courses (instructor_id, category_id, title, slug, description, short_description, price, sale_price, duration, level, is_published, is_free, sort_order, last_updated)
SELECT i.id, c.id,
    'Adım Adım WordPress Eğitimi',
    'adim-adim-wordpress-egitimi',
    'WordPress ile profesyonel web siteleri oluşturmayı öğrenin. Tema seçimi, eklenti kurulumu, SEO ayarları, WooCommerce ile e-ticaret ve performans optimizasyonu.',
    'WordPress ile web sitesi kurmayı ve yönetmeyi sıfırdan öğrenin.',
    3500, 1800, '15 saat 26 dakika', 'beginner', 1, 0, 8, NOW()
FROM instructors i
JOIN users u ON i.user_id = u.id
JOIN categories c ON c.slug = 'dijital-pazarlama'
WHERE u.email = 'mehmet@reklamokulu.com'
AND NOT EXISTS (SELECT 1 FROM courses WHERE slug = 'adim-adim-wordpress-egitimi');

-- ============================================
-- BÖLÜMLER VE DERSLER (YouTube Embed URL'leri)
-- ============================================

-- Dijital Pazarlama Temel Eğitimi - Bölümler
INSERT INTO course_sections (course_id, title, sort_order)
SELECT c.id, 'Temel Kavramlar', 1
FROM courses c WHERE c.slug = 'dijital-pazarlama-temel-egitimi'
AND NOT EXISTS (SELECT 1 FROM course_sections cs WHERE cs.course_id = c.id AND cs.title = 'Temel Kavramlar');

INSERT INTO course_sections (course_id, title, sort_order)
SELECT c.id, 'Sosyal Medya Pazarlama', 2
FROM courses c WHERE c.slug = 'dijital-pazarlama-temel-egitimi'
AND NOT EXISTS (SELECT 1 FROM course_sections cs WHERE cs.course_id = c.id AND cs.title = 'Sosyal Medya Pazarlama');

INSERT INTO course_sections (course_id, title, sort_order)
SELECT c.id, 'İçerik Pazarlama', 3
FROM courses c WHERE c.slug = 'dijital-pazarlama-temel-egitimi'
AND NOT EXISTS (SELECT 1 FROM course_sections cs WHERE cs.course_id = c.id AND cs.title = 'İçerik Pazarlama');

-- Dersler - Bölüm 1: Temel Kavramlar
INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order)
SELECT cs.id, '1. Dijital Pazarlamaya Giriş', 'dijital-pazarlamaya-giris',
    'https://www.youtube.com/embed/bixR-KIJKYM', 480, 1, 1
FROM course_sections cs
JOIN courses c ON cs.course_id = c.id
WHERE c.slug = 'dijital-pazarlama-temel-egitimi' AND cs.title = 'Temel Kavramlar'
AND NOT EXISTS (SELECT 1 FROM lessons l WHERE l.section_id = cs.id AND l.slug = 'dijital-pazarlamaya-giris');

INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order)
SELECT cs.id, '2. Dijital Pazarlama Kanalları', 'dijital-pazarlama-kanallari',
    'https://www.youtube.com/embed/WYbMViYBbMg', 720, 1, 2
FROM course_sections cs
JOIN courses c ON cs.course_id = c.id
WHERE c.slug = 'dijital-pazarlama-temel-egitimi' AND cs.title = 'Temel Kavramlar'
AND NOT EXISTS (SELECT 1 FROM lessons l WHERE l.section_id = cs.id AND l.slug = 'dijital-pazarlama-kanallari');

INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order)
SELECT cs.id, '3. Hedef Kitle Belirleme', 'hedef-kitle-belirleme',
    'https://www.youtube.com/embed/oR6dUJ7CpOQ', 540, 0, 3
FROM course_sections cs
JOIN courses c ON cs.course_id = c.id
WHERE c.slug = 'dijital-pazarlama-temel-egitimi' AND cs.title = 'Temel Kavramlar'
AND NOT EXISTS (SELECT 1 FROM lessons l WHERE l.section_id = cs.id AND l.slug = 'hedef-kitle-belirleme');

INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order)
SELECT cs.id, '4. Dijital Pazarlama Stratejisi Oluşturma', 'dijital-pazarlama-stratejisi',
    'https://www.youtube.com/embed/RSkASPgtIBc', 660, 0, 4
FROM course_sections cs
JOIN courses c ON cs.course_id = c.id
WHERE c.slug = 'dijital-pazarlama-temel-egitimi' AND cs.title = 'Temel Kavramlar'
AND NOT EXISTS (SELECT 1 FROM lessons l WHERE l.section_id = cs.id AND l.slug = 'dijital-pazarlama-stratejisi');

-- Dersler - Bölüm 2: Sosyal Medya Pazarlama
INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order)
SELECT cs.id, '5. Sosyal Medya Nedir?', 'sosyal-medya-nedir',
    'https://www.youtube.com/embed/QAL9MhUgYVs', 360, 0, 1
FROM course_sections cs
JOIN courses c ON cs.course_id = c.id
WHERE c.slug = 'dijital-pazarlama-temel-egitimi' AND cs.title = 'Sosyal Medya Pazarlama'
AND NOT EXISTS (SELECT 1 FROM lessons l WHERE l.section_id = cs.id AND l.slug = 'sosyal-medya-nedir');

INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order)
SELECT cs.id, '6. Instagram İşletme Hesabı Kurulumu', 'instagram-isletme-hesabi',
    'https://www.youtube.com/embed/Qu3RNfkNlz4', 900, 0, 2
FROM course_sections cs
JOIN courses c ON cs.course_id = c.id
WHERE c.slug = 'dijital-pazarlama-temel-egitimi' AND cs.title = 'Sosyal Medya Pazarlama'
AND NOT EXISTS (SELECT 1 FROM lessons l WHERE l.section_id = cs.id AND l.slug = 'instagram-isletme-hesabi');

INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order)
SELECT cs.id, '7. Facebook Sayfa Yönetimi', 'facebook-sayfa-yonetimi',
    'https://www.youtube.com/embed/PDD4JNmm8iY', 780, 0, 3
FROM course_sections cs
JOIN courses c ON cs.course_id = c.id
WHERE c.slug = 'dijital-pazarlama-temel-egitimi' AND cs.title = 'Sosyal Medya Pazarlama'
AND NOT EXISTS (SELECT 1 FROM lessons l WHERE l.section_id = cs.id AND l.slug = 'facebook-sayfa-yonetimi');

-- Dersler - Bölüm 3: İçerik Pazarlama
INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order)
SELECT cs.id, '8. İçerik Pazarlama Temelleri', 'icerik-pazarlama-temelleri',
    'https://www.youtube.com/embed/L8ypSXwyBds', 600, 0, 1
FROM course_sections cs
JOIN courses c ON cs.course_id = c.id
WHERE c.slug = 'dijital-pazarlama-temel-egitimi' AND cs.title = 'İçerik Pazarlama'
AND NOT EXISTS (SELECT 1 FROM lessons l WHERE l.section_id = cs.id AND l.slug = 'icerik-pazarlama-temelleri');

INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order)
SELECT cs.id, '9. Blog Yazarlığı ve SEO Uyumlu İçerik', 'blog-yazarligi-seo',
    'https://www.youtube.com/embed/DvwS7cV9GmQ', 840, 0, 2
FROM course_sections cs
JOIN courses c ON cs.course_id = c.id
WHERE c.slug = 'dijital-pazarlama-temel-egitimi' AND cs.title = 'İçerik Pazarlama'
AND NOT EXISTS (SELECT 1 FROM lessons l WHERE l.section_id = cs.id AND l.slug = 'blog-yazarligi-seo');

-- ============================================
-- Meta Business Eğitimi - Bölümler ve Dersler
-- ============================================
INSERT INTO course_sections (course_id, title, sort_order)
SELECT c.id, '1. Meta Business Paneline Giriş', 1
FROM courses c WHERE c.slug = 'birebir-destekli-meta-business-egitimi'
AND NOT EXISTS (SELECT 1 FROM course_sections cs WHERE cs.course_id = c.id AND cs.title = '1. Meta Business Paneline Giriş');

INSERT INTO course_sections (course_id, title, sort_order)
SELECT c.id, '2. Kampanya Türleri', 2
FROM courses c WHERE c.slug = 'birebir-destekli-meta-business-egitimi'
AND NOT EXISTS (SELECT 1 FROM course_sections cs WHERE cs.course_id = c.id AND cs.title = '2. Kampanya Türleri');

-- Meta Business Dersler
INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order)
SELECT cs.id, '1. Meta Business Paneli Tanıtım', 'meta-business-tanitim',
    'https://www.youtube.com/embed/o4LZ1Fl1F6Q', 420, 1, 1
FROM course_sections cs
JOIN courses c ON cs.course_id = c.id
WHERE c.slug = 'birebir-destekli-meta-business-egitimi' AND cs.title = '1. Meta Business Paneline Giriş'
AND NOT EXISTS (SELECT 1 FROM lessons l WHERE l.section_id = cs.id AND l.slug = 'meta-business-tanitim');

INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order)
SELECT cs.id, '2. Meta Business Hesap Kurulumu', 'meta-business-hesap-kurulumu',
    'https://www.youtube.com/embed/mD3kGkMJZWU', 780, 0, 2
FROM course_sections cs
JOIN courses c ON cs.course_id = c.id
WHERE c.slug = 'birebir-destekli-meta-business-egitimi' AND cs.title = '1. Meta Business Paneline Giriş'
AND NOT EXISTS (SELECT 1 FROM lessons l WHERE l.section_id = cs.id AND l.slug = 'meta-business-hesap-kurulumu');

INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order)
SELECT cs.id, '3. Facebook Reklam Kampanya Türleri', 'facebook-kampanya-turleri',
    'https://www.youtube.com/embed/Y0ByXLgxCzk', 960, 0, 1
FROM course_sections cs
JOIN courses c ON cs.course_id = c.id
WHERE c.slug = 'birebir-destekli-meta-business-egitimi' AND cs.title = '2. Kampanya Türleri'
AND NOT EXISTS (SELECT 1 FROM lessons l WHERE l.section_id = cs.id AND l.slug = 'facebook-kampanya-turleri');

INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order)
SELECT cs.id, '4. Instagram Reklam Oluşturma', 'instagram-reklam-olusturma',
    'https://www.youtube.com/embed/DhlOEgIshF0', 1080, 0, 2
FROM course_sections cs
JOIN courses c ON cs.course_id = c.id
WHERE c.slug = 'birebir-destekli-meta-business-egitimi' AND cs.title = '2. Kampanya Türleri'
AND NOT EXISTS (SELECT 1 FROM lessons l WHERE l.section_id = cs.id AND l.slug = 'instagram-reklam-olusturma');

-- ============================================
-- Google Ads - Bölümler ve Dersler
-- ============================================
INSERT INTO course_sections (course_id, title, sort_order)
SELECT c.id, '1. Google Ads Temelleri', 1
FROM courses c WHERE c.slug = 'birebir-destekli-google-ads-egitimi'
AND NOT EXISTS (SELECT 1 FROM course_sections cs WHERE cs.course_id = c.id AND cs.title = '1. Google Ads Temelleri');

INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order)
SELECT cs.id, '1. Google Ads Nedir?', 'google-ads-nedir',
    'https://www.youtube.com/embed/oQw8pn-xgZY', 540, 1, 1
FROM course_sections cs
JOIN courses c ON cs.course_id = c.id
WHERE c.slug = 'birebir-destekli-google-ads-egitimi' AND cs.title = '1. Google Ads Temelleri'
AND NOT EXISTS (SELECT 1 FROM lessons l WHERE l.section_id = cs.id AND l.slug = 'google-ads-nedir');

INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order)
SELECT cs.id, '2. Google Ads Hesap Açma', 'google-ads-hesap-acma',
    'https://www.youtube.com/embed/yNLoH2Fp1V4', 720, 0, 2
FROM course_sections cs
JOIN courses c ON cs.course_id = c.id
WHERE c.slug = 'birebir-destekli-google-ads-egitimi' AND cs.title = '1. Google Ads Temelleri'
AND NOT EXISTS (SELECT 1 FROM lessons l WHERE l.section_id = cs.id AND l.slug = 'google-ads-hesap-acma');

-- ============================================
-- SEO Eğitimi - Bölümler ve Dersler
-- ============================================
INSERT INTO course_sections (course_id, title, sort_order)
SELECT c.id, '1. SEO Temelleri', 1
FROM courses c WHERE c.slug = 'sifirdan-ileri-seviyeye-seo-egitimi'
AND NOT EXISTS (SELECT 1 FROM course_sections cs WHERE cs.course_id = c.id AND cs.title = '1. SEO Temelleri');

INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order)
SELECT cs.id, '1. SEO Nedir?', 'seo-nedir',
    'https://www.youtube.com/embed/rOSHk6IBIXY', 600, 1, 1
FROM course_sections cs
JOIN courses c ON cs.course_id = c.id
WHERE c.slug = 'sifirdan-ileri-seviyeye-seo-egitimi' AND cs.title = '1. SEO Temelleri'
AND NOT EXISTS (SELECT 1 FROM lessons l WHERE l.section_id = cs.id AND l.slug = 'seo-nedir');

INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order)
SELECT cs.id, '2. Anahtar Kelime Araştırması', 'anahtar-kelime-arastirmasi',
    'https://www.youtube.com/embed/OYRkIGaP80M', 900, 0, 2
FROM course_sections cs
JOIN courses c ON cs.course_id = c.id
WHERE c.slug = 'sifirdan-ileri-seviyeye-seo-egitimi' AND cs.title = '1. SEO Temelleri'
AND NOT EXISTS (SELECT 1 FROM lessons l WHERE l.section_id = cs.id AND l.slug = 'anahtar-kelime-arastirmasi');

-- SSS Verileri
INSERT INTO faqs (question, answer, sort_order, is_active) VALUES
('Eğitimler nasıl veriliyor?', 'Tüm eğitimler Reklam Okulu web sitesi üzerinden online olarak verilmektedir. Satın aldığınız eğitime ömür boyu erişim hakkınız vardır.', 1, 1),
('Eğitimler sertifikalı mı?', 'Evet, tüm kurslarımız tamamlandığında katılım sertifikası verilmektedir. Sertifika otomatik olarak panelinize eklenir.', 2, 1),
('Eğitim sonrası destek var mı?', 'Evet, düzenli canlı yayınlar, bire bir görüşmeler ve topluluk grupları ile sürekli destek sağlıyoruz.', 3, 1),
('Eğitimlere ne kadar süre erişebilirim?', 'Satın aldığınız tüm eğitimlere ömür boyu erişim hakkınız vardır. Süre sınırı yoktur.', 4, 1),
('Taksit imkanı var mı?', 'Evet, peşin fiyatına 3 taksit imkanımız mevcuttur. Kredi kartı ile taksitli ödeme yapabilirsiniz.', 5, 1),
('İade politikanız nedir?', 'Satın alma tarihinden itibaren 14 gün içinde, eğitimin %30''undan fazlasını izlemediyseniz tam iade yapılır.', 6, 1)
ON DUPLICATE KEY UPDATE question=VALUES(question);

-- ============================================
-- KURS THUMBNAIL VE PREVIEW VIDEO GUNCELLEME
-- ============================================
UPDATE courses SET thumbnail = 'uploads/courses/dijital-pazarlama.jpg', preview_video = 'https://www.youtube.com/watch?v=bixR-KIJKYM' WHERE slug = 'dijital-pazarlama-temel-egitimi' AND thumbnail IS NULL;
UPDATE courses SET thumbnail = 'uploads/courses/meta-business.jpg', preview_video = 'https://www.youtube.com/watch?v=o4LZ1Fl1F6Q' WHERE slug = 'birebir-destekli-meta-business-egitimi' AND thumbnail IS NULL;
UPDATE courses SET thumbnail = 'uploads/courses/google-ads.jpg', preview_video = 'https://www.youtube.com/watch?v=oQw8pn-xgZY' WHERE slug = 'birebir-destekli-google-ads-egitimi' AND thumbnail IS NULL;
UPDATE courses SET thumbnail = 'uploads/courses/seo.jpg', preview_video = 'https://www.youtube.com/watch?v=rOSHk6IBIXY' WHERE slug = 'sifirdan-ileri-seviyeye-seo-egitimi' AND thumbnail IS NULL;
UPDATE courses SET thumbnail = 'uploads/courses/canva.jpg', preview_video = 'https://www.youtube.com/watch?v=nM3jR5Y0L8s' WHERE slug = 'adan-zye-canva-egitimi' AND thumbnail IS NULL;
UPDATE courses SET thumbnail = 'uploads/courses/reels.jpg', preview_video = 'https://www.youtube.com/watch?v=6pIEv0FD-lQ' WHERE slug = 'kapsamli-reels-egitimi' AND thumbnail IS NULL;
UPDATE courses SET thumbnail = 'uploads/courses/yapay-zeka.jpg', preview_video = 'https://www.youtube.com/watch?v=ad79nYk2keg' WHERE slug = 'yapay-zeka-farkindalik-egitimi' AND thumbnail IS NULL;
UPDATE courses SET thumbnail = 'uploads/courses/wordpress.jpg', preview_video = 'https://www.youtube.com/watch?v=jl8F4WglM3I' WHERE slug = 'adim-adim-wordpress-egitimi' AND thumbnail IS NULL;
