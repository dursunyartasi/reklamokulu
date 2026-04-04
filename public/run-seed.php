<?php
/**
 * Demo veri yükleyici - Tek seferlik çalıştırılacak
 * URL: /run-seed.php?key=reklamokulu2026
 */

if (($_GET['key'] ?? '') !== 'reklamokulu2026') {
    die('Yetkisiz erisim');
}

require_once __DIR__ . '/../app/config/app.php';
require_once __DIR__ . '/../app/config/database.php';
loadEnv(__DIR__ . '/../.env');

$db = Database::connect();

echo "<pre>\n";
echo "=== REKLAM OKULU SEED BAŞLIYOR ===\n\n";

try {
    // Meetings tablosu
    $db->exec("CREATE TABLE IF NOT EXISTS meetings (
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
    ) ENGINE=InnoDB");
    echo "✓ Meetings tablosu oluşturuldu\n";

    // Kategoriler
    $categories = [
        ['Dijital Pazarlama', 'dijital-pazarlama', 1],
        ['Sosyal Medya', 'sosyal-medya', 2],
        ['SEO', 'seo', 3],
        ['İçerik Üretimi', 'icerik-uretimi', 4],
        ['Tasarım', 'tasarim', 5],
        ['Yapay Zeka', 'yapay-zeka', 6],
    ];
    $stmt = $db->prepare("INSERT INTO categories (name, slug, sort_order) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE name=VALUES(name)");
    foreach ($categories as $cat) {
        $stmt->execute($cat);
    }
    echo "✓ 6 kategori eklendi\n";

    // Eğitmenler
    $instructors = [
        ['Ahmet', 'Yılmaz', 'ahmet@reklamokulu.com', 'Dijital Pazarlama Uzmanı', '10 yılı aşkın dijital pazarlama deneyimine sahip.', 'Dijital Pazarlama, Meta Business, Google Ads'],
        ['Zeynep', 'Kaya', 'zeynep@reklamokulu.com', 'Sosyal Medya Uzmanı', 'Sosyal medya yönetimi ve içerik stratejisi konusunda 8 yıllık deneyim.', 'Instagram, TikTok, Sosyal Medya Yönetimi'],
        ['Mehmet', 'Demir', 'mehmet@reklamokulu.com', 'SEO ve Google Ads Uzmanı', 'SEO ve arama motoru pazarlaması alanında 7 yıllık tecrübe.', 'SEO, Google Ads, Analytics'],
        ['Elif', 'Çelik', 'elif@reklamokulu.com', 'İçerik ve Tasarım Uzmanı', 'Grafik tasarım ve video içerik üretimi konusunda uzman.', 'Canva, CapCut, İçerik Üretimi'],
    ];
    $hash = password_hash('password', PASSWORD_DEFAULT);
    foreach ($instructors as $inst) {
        $stmt = $db->prepare("INSERT INTO users (first_name, last_name, email, password, role, is_active) VALUES (?,?,?,?,'instructor',1) ON DUPLICATE KEY UPDATE first_name=VALUES(first_name)");
        $stmt->execute([$inst[0], $inst[1], $inst[2], $hash]);
        $userId = $db->lastInsertId() ?: $db->query("SELECT id FROM users WHERE email='{$inst[2]}'")->fetchColumn();

        $check = $db->prepare("SELECT COUNT(*) FROM instructors WHERE user_id=?");
        $check->execute([$userId]);
        if ($check->fetchColumn() == 0) {
            $stmt2 = $db->prepare("INSERT INTO instructors (user_id, title, bio, expertise, sort_order) VALUES (?,?,?,?,?)");
            $stmt2->execute([$userId, $inst[3], $inst[4], $inst[5], array_search($inst, $instructors) + 1]);
        }
    }
    echo "✓ 4 eğitmen eklendi\n";

    // Eğitimler
    $courses = [
        ['Dijital Pazarlama Temel Eğitimi', 'dijital-pazarlama-temel-egitimi', 'ahmet@reklamokulu.com', 'dijital-pazarlama',
         'Bu eğitimde dijital pazarlamanın temellerini öğreneceksiniz.', 'Dijital pazarlamaya sıfırdan başlayın.',
         0, null, '10 saat 25 dakika', 'beginner', 1, 1],

        ['Bire Bir Destekli Meta Business Eğitimi', 'birebir-destekli-meta-business-egitimi', 'ahmet@reklamokulu.com', 'sosyal-medya',
         'Facebook ve Instagram reklamcılığını A\'dan Z\'ye öğrenin.', 'Meta Business ile reklamcılığı en iyi şekilde öğrenin.',
         15000, 9750, '58 saat 22 dakika', 'intermediate', 0, 0],

        ['Bire Bir Destekli Google Ads Eğitimi', 'birebir-destekli-google-ads-egitimi', 'mehmet@reklamokulu.com', 'dijital-pazarlama',
         'Google Ads ile arama ağı, görüntülü reklam ağı kampanyalarını öğrenin.', 'Google Ads reklamcılığında uzmanlaşın.',
         10000, 6000, '33 saat 25 dakika', 'intermediate', 0, 0],

        ['Sıfırdan İleri Seviyeye SEO Eğitimi', 'sifirdan-ileri-seviyeye-seo-egitimi', 'mehmet@reklamokulu.com', 'seo',
         'Arama motoru optimizasyonunu sıfırdan ileri seviyeye kadar öğrenin.', 'SEO ile web sitenizi üst sıralara taşıyın.',
         6000, 3900, '30 saat 52 dakika', 'beginner', 0, 0],

        ['A\'dan Z\'ye Canva Eğitimi', 'adan-zye-canva-egitimi', 'elif@reklamokulu.com', 'tasarim',
         'Canva ile profesyonel görseller oluşturmayı öğrenin.', 'Canva ile tasarım yapmayı öğrenin.',
         3000, 1500, '12 saat 8 dakika', 'beginner', 0, 0],

        ['Kapsamlı Reels Eğitimi', 'kapsamli-reels-egitimi', 'zeynep@reklamokulu.com', 'icerik-uretimi',
         'Instagram Reels ve TikTok videoları oluşturmayı öğrenin.', 'Reels ve kısa video içerik üretiminde uzmanlaşın.',
         4500, 2275, '14 saat 59 dakika', 'beginner', 0, 0],

        ['Yapay Zeka Farkındalık Eğitimi', 'yapay-zeka-farkindalik-egitimi', 'ahmet@reklamokulu.com', 'yapay-zeka',
         'ChatGPT, Midjourney ve diğer AI araçlarını öğrenin.', 'Yapay zeka araçlarını dijital pazarlamada kullanın.',
         1500, 720, '13 saat 52 dakika', 'beginner', 0, 0],

        ['Adım Adım WordPress Eğitimi', 'adim-adim-wordpress-egitimi', 'mehmet@reklamokulu.com', 'dijital-pazarlama',
         'WordPress ile profesyonel web siteleri oluşturmayı öğrenin.', 'WordPress ile web sitesi kurmayı sıfırdan öğrenin.',
         3500, 1800, '15 saat 26 dakika', 'beginner', 0, 0],
    ];

    foreach ($courses as $c) {
        $check = $db->prepare("SELECT COUNT(*) FROM courses WHERE slug=?");
        $check->execute([$c[1]]);
        if ($check->fetchColumn() > 0) continue;

        $instId = $db->query("SELECT i.id FROM instructors i JOIN users u ON i.user_id=u.id WHERE u.email='{$c[2]}'")->fetchColumn();
        $catId = $db->query("SELECT id FROM categories WHERE slug='{$c[3]}'")->fetchColumn();

        $stmt = $db->prepare("INSERT INTO courses (instructor_id, category_id, title, slug, description, short_description, price, sale_price, duration, level, is_free, is_published, sort_order, last_updated) VALUES (?,?,?,?,?,?,?,?,?,?,?,1,?,NOW())");
        $stmt->execute([$instId, $catId, $c[0], $c[1], $c[4], $c[5], $c[6], $c[7], $c[8], $c[9], $c[10], array_search($c, $courses) + 1]);
    }
    echo "✓ 8 eğitim eklendi\n";

    // Bölümler ve Dersler
    $curriculum = [
        'dijital-pazarlama-temel-egitimi' => [
            'Temel Kavramlar' => [
                ['1. Dijital Pazarlamaya Giriş', 'dijital-pazarlamaya-giris', 'https://www.youtube.com/embed/bixR-KIJKYM', 480, 1],
                ['2. Dijital Pazarlama Kanalları', 'dijital-pazarlama-kanallari', 'https://www.youtube.com/embed/WYbMViYBbMg', 720, 1],
                ['3. Hedef Kitle Belirleme', 'hedef-kitle-belirleme', 'https://www.youtube.com/embed/oR6dUJ7CpOQ', 540, 0],
                ['4. Strateji Oluşturma', 'strateji-olusturma', 'https://www.youtube.com/embed/RSkASPgtIBc', 660, 0],
            ],
            'Sosyal Medya Pazarlama' => [
                ['5. Sosyal Medya Nedir?', 'sosyal-medya-nedir', 'https://www.youtube.com/embed/QAL9MhUgYVs', 360, 0],
                ['6. Instagram İşletme Hesabı', 'instagram-isletme-hesabi', 'https://www.youtube.com/embed/Qu3RNfkNlz4', 900, 0],
                ['7. Facebook Sayfa Yönetimi', 'facebook-sayfa-yonetimi', 'https://www.youtube.com/embed/PDD4JNmm8iY', 780, 0],
            ],
            'İçerik Pazarlama' => [
                ['8. İçerik Pazarlama Temelleri', 'icerik-pazarlama-temelleri', 'https://www.youtube.com/embed/L8ypSXwyBds', 600, 0],
                ['9. Blog Yazarlığı ve SEO', 'blog-yazarligi-seo', 'https://www.youtube.com/embed/DvwS7cV9GmQ', 840, 0],
            ],
        ],
        'birebir-destekli-meta-business-egitimi' => [
            '1. Meta Business Paneline Giriş' => [
                ['1. Meta Business Paneli Tanıtım', 'meta-business-tanitim', 'https://www.youtube.com/embed/o4LZ1Fl1F6Q', 420, 1],
                ['2. Hesap Kurulumu', 'meta-hesap-kurulumu', 'https://www.youtube.com/embed/mD3kGkMJZWU', 780, 0],
            ],
            '2. Kampanya Türleri' => [
                ['3. Facebook Kampanya Türleri', 'facebook-kampanya-turleri', 'https://www.youtube.com/embed/Y0ByXLgxCzk', 960, 0],
                ['4. Instagram Reklam Oluşturma', 'instagram-reklam-olusturma', 'https://www.youtube.com/embed/DhlOEgIshF0', 1080, 0],
            ],
        ],
        'birebir-destekli-google-ads-egitimi' => [
            '1. Google Ads Temelleri' => [
                ['1. Google Ads Nedir?', 'google-ads-nedir', 'https://www.youtube.com/embed/oQw8pn-xgZY', 540, 1],
                ['2. Hesap Açma', 'google-ads-hesap-acma', 'https://www.youtube.com/embed/yNLoH2Fp1V4', 720, 0],
            ],
        ],
        'sifirdan-ileri-seviyeye-seo-egitimi' => [
            '1. SEO Temelleri' => [
                ['1. SEO Nedir?', 'seo-nedir', 'https://www.youtube.com/embed/rOSHk6IBIXY', 600, 1],
                ['2. Anahtar Kelime Araştırması', 'anahtar-kelime-arastirmasi', 'https://www.youtube.com/embed/OYRkIGaP80M', 900, 0],
            ],
        ],
    ];

    foreach ($curriculum as $courseSlug => $sections) {
        $courseId = $db->query("SELECT id FROM courses WHERE slug='$courseSlug'")->fetchColumn();
        if (!$courseId) continue;

        $sectionOrder = 1;
        foreach ($sections as $sectionTitle => $lessons) {
            $check = $db->prepare("SELECT id FROM course_sections WHERE course_id=? AND title=?");
            $check->execute([$courseId, $sectionTitle]);
            $sectionId = $check->fetchColumn();

            if (!$sectionId) {
                $stmt = $db->prepare("INSERT INTO course_sections (course_id, title, sort_order) VALUES (?,?,?)");
                $stmt->execute([$courseId, $sectionTitle, $sectionOrder]);
                $sectionId = $db->lastInsertId();
            }
            $sectionOrder++;

            foreach ($lessons as $lesson) {
                $check2 = $db->prepare("SELECT COUNT(*) FROM lessons WHERE section_id=? AND slug=?");
                $check2->execute([$sectionId, $lesson[1]]);
                if ($check2->fetchColumn() > 0) continue;

                $stmt = $db->prepare("INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order) VALUES (?,?,?,?,?,?,?)");
                $stmt->execute([$sectionId, $lesson[0], $lesson[1], $lesson[2], $lesson[3], $lesson[4], array_search($lesson, $lessons) + 1]);
            }
        }
    }
    echo "✓ Bölümler ve dersler eklendi (YouTube embed URL'leri ile)\n";

    // SSS
    $faqs = [
        ['Eğitimler nasıl veriliyor?', 'Tüm eğitimler web sitesi üzerinden online olarak verilmektedir. Satın aldığınız eğitime ömür boyu erişim hakkınız vardır.'],
        ['Eğitimler sertifikalı mı?', 'Evet, tüm kurslarımız tamamlandığında katılım sertifikası verilmektedir.'],
        ['Eğitim sonrası destek var mı?', 'Evet, düzenli canlı yayınlar, bire bir görüşmeler ve topluluk grupları ile sürekli destek sağlıyoruz.'],
        ['Eğitimlere ne kadar süre erişebilirim?', 'Satın aldığınız tüm eğitimlere ömür boyu erişim hakkınız vardır. Süre sınırı yoktur.'],
        ['Taksit imkanı var mı?', 'Evet, peşin fiyatına 3 taksit imkanımız mevcuttur.'],
        ['İade politikanız nedir?', 'Satın alma tarihinden itibaren 14 gün içinde, eğitimin %30\'undan fazlasını izlemediyseniz tam iade yapılır.'],
    ];
    $stmt = $db->prepare("INSERT INTO faqs (question, answer, sort_order, is_active) VALUES (?,?,?,1)");
    $order = 1;
    foreach ($faqs as $faq) {
        try {
            $stmt->execute([$faq[0], $faq[1], $order++]);
        } catch (Exception $e) {
            // zaten varsa atla
        }
    }
    echo "✓ 6 SSS eklendi\n";

    echo "\n=== SEED TAMAMLANDI ===\n";
    echo "\nBu dosyayı silmeyi unutmayın! (güvenlik için)\n";

} catch (Exception $e) {
    echo "HATA: " . $e->getMessage() . "\n";
}
echo "</pre>";
