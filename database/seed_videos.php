<?php
/**
 * Kurs gorsel ve video seed script
 * - Tum kurslara thumbnail ekler
 * - Eksik kurslara (Canva, Reels, Yapay Zeka, WordPress) bolum ve dersler ekler
 * - Tum derslere ornek YouTube videolari ekler
 *
 * Kullanim: php /var/www/html/database/seed_videos.php
 */

// .env yukle
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_starts_with(trim($line), '#') || !str_contains($line, '=')) continue;
        [$key, $value] = explode('=', $line, 2);
        putenv(trim($key) . '=' . trim($value, " \t\n\r\0\x0B\"'"));
    }
}

$host = getenv('DB_HOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: '3306';
$db   = getenv('DB_NAME') ?: 'default';
$user = getenv('DB_USER') ?: 'mysql';
$pass = getenv('DB_PASS') ?: '';

try {
    $pdo = new PDO("mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    echo "Veritabanina baglanildi.\n";
} catch (PDOException $e) {
    die("Veritabani baglanti hatasi: " . $e->getMessage() . "\n");
}

// ============================================
// 1. KURS THUMBNAIL'LERINI GUNCELLE
// ============================================
echo "\n--- Kurs thumbnail'leri guncelleniyor ---\n";

$thumbnails = [
    'dijital-pazarlama-temel-egitimi'       => 'uploads/courses/dijital-pazarlama.jpg',
    'birebir-destekli-meta-business-egitimi' => 'uploads/courses/meta-business.jpg',
    'birebir-destekli-google-ads-egitimi'    => 'uploads/courses/google-ads.jpg',
    'sifirdan-ileri-seviyeye-seo-egitimi'    => 'uploads/courses/seo.jpg',
    'adan-zye-canva-egitimi'                 => 'uploads/courses/canva.jpg',
    'kapsamli-reels-egitimi'                 => 'uploads/courses/reels.jpg',
    'yapay-zeka-farkindalik-egitimi'         => 'uploads/courses/yapay-zeka.jpg',
    'adim-adim-wordpress-egitimi'            => 'uploads/courses/wordpress.jpg',
];

$stmtUpdate = $pdo->prepare('UPDATE courses SET thumbnail = ? WHERE slug = ?');
foreach ($thumbnails as $slug => $thumb) {
    $stmtUpdate->execute([$thumb, $slug]);
    echo "  [OK] {$slug} -> {$thumb}\n";
}

// ============================================
// 2. CANVA EGITIMI - BOLUMLER VE DERSLER
// ============================================
echo "\n--- Canva Egitimi dersleri ekleniyor ---\n";

$courseId = $pdo->query("SELECT id FROM courses WHERE slug = 'adan-zye-canva-egitimi'")->fetchColumn();
if ($courseId) {
    $existingSections = $pdo->prepare("SELECT COUNT(*) FROM course_sections WHERE course_id = ?");
    $existingSections->execute([$courseId]);

    if ($existingSections->fetchColumn() == 0) {
        // Bolumler
        $pdo->prepare("INSERT INTO course_sections (course_id, title, sort_order) VALUES (?, ?, ?)")
            ->execute([$courseId, '1. Canva\'ya Giris', 1]);
        $sec1 = $pdo->lastInsertId();

        $pdo->prepare("INSERT INTO course_sections (course_id, title, sort_order) VALUES (?, ?, ?)")
            ->execute([$courseId, '2. Sosyal Medya Gorselleri', 2]);
        $sec2 = $pdo->lastInsertId();

        $pdo->prepare("INSERT INTO course_sections (course_id, title, sort_order) VALUES (?, ?, ?)")
            ->execute([$courseId, '3. Ileri Seviye Tasarim', 3]);
        $sec3 = $pdo->lastInsertId();

        // Dersler - Bolum 1
        $stmtLesson = $pdo->prepare("INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmtLesson->execute([$sec1, '1. Canva Nedir? Nasil Kayit Olunur?', 'canva-nedir', 'https://www.youtube.com/embed/nM3jR5Y0L8s', 420, 1, 1]);
        $stmtLesson->execute([$sec1, '2. Canva Arayuz Tanitimi', 'canva-arayuz', 'https://www.youtube.com/embed/7QFE0VHp5E8', 540, 1, 2]);
        $stmtLesson->execute([$sec1, '3. Canva Free vs Pro Farklari', 'canva-free-pro', 'https://www.youtube.com/embed/CnGCv5bfR5M', 480, 0, 3]);

        // Dersler - Bolum 2
        $stmtLesson->execute([$sec2, '4. Instagram Post Tasarimi', 'instagram-post-tasarimi', 'https://www.youtube.com/embed/2xbfR0s8Dlk', 720, 0, 1]);
        $stmtLesson->execute([$sec2, '5. Instagram Story Tasarimi', 'instagram-story-tasarimi', 'https://www.youtube.com/embed/s_-wEFp9jgA', 600, 0, 2]);
        $stmtLesson->execute([$sec2, '6. Facebook Kapak Foto Tasarimi', 'facebook-kapak-foto', 'https://www.youtube.com/embed/7OgUxOzNda0', 540, 0, 3]);

        // Dersler - Bolum 3
        $stmtLesson->execute([$sec3, '7. Canva ile Video Duzenleme', 'canva-video-duzenleme', 'https://www.youtube.com/embed/sQfk6aGYhPc', 900, 0, 1]);
        $stmtLesson->execute([$sec3, '8. Sunum Hazirlama', 'canva-sunum', 'https://www.youtube.com/embed/zNPHEH_G00Q', 780, 0, 2]);
        $stmtLesson->execute([$sec3, '9. Logo ve Marka Kimlik Tasarimi', 'logo-marka-kimlik', 'https://www.youtube.com/embed/FOJBjwMdiHk', 660, 0, 3]);

        echo "  [OK] 3 bolum, 9 ders eklendi.\n";
    } else {
        echo "  [SKIP] Canva kursu zaten bolum iceriyor.\n";
    }
}

// ============================================
// 3. REELS EGITIMI - BOLUMLER VE DERSLER
// ============================================
echo "\n--- Reels Egitimi dersleri ekleniyor ---\n";

$courseId = $pdo->query("SELECT id FROM courses WHERE slug = 'kapsamli-reels-egitimi'")->fetchColumn();
if ($courseId) {
    $existingSections = $pdo->prepare("SELECT COUNT(*) FROM course_sections WHERE course_id = ?");
    $existingSections->execute([$courseId]);

    if ($existingSections->fetchColumn() == 0) {
        $pdo->prepare("INSERT INTO course_sections (course_id, title, sort_order) VALUES (?, ?, ?)")
            ->execute([$courseId, '1. Reels\'e Giris', 1]);
        $sec1 = $pdo->lastInsertId();

        $pdo->prepare("INSERT INTO course_sections (course_id, title, sort_order) VALUES (?, ?, ?)")
            ->execute([$courseId, '2. Video Cekimi ve Kurgu', 2]);
        $sec2 = $pdo->lastInsertId();

        $pdo->prepare("INSERT INTO course_sections (course_id, title, sort_order) VALUES (?, ?, ?)")
            ->execute([$courseId, '3. Viral Olma Stratejileri', 3]);
        $sec3 = $pdo->lastInsertId();

        $stmtLesson = $pdo->prepare("INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Bolum 1
        $stmtLesson->execute([$sec1, '1. Instagram Reels Nedir?', 'reels-nedir', 'https://www.youtube.com/embed/6pIEv0FD-lQ', 360, 1, 1]);
        $stmtLesson->execute([$sec1, '2. Reels Algoritma Mantigi', 'reels-algoritma', 'https://www.youtube.com/embed/Nqz4YXVBWRI', 480, 1, 2]);
        $stmtLesson->execute([$sec1, '3. Icerik Planlama', 'reels-icerik-planlama', 'https://www.youtube.com/embed/PplhnPfOqLw', 540, 0, 3]);

        // Bolum 2
        $stmtLesson->execute([$sec2, '4. Telefon ile Video Cekimi', 'telefon-video-cekimi', 'https://www.youtube.com/embed/w_9swPsfX0M', 720, 0, 1]);
        $stmtLesson->execute([$sec2, '5. CapCut ile Reels Duzenleme', 'capcut-reels-duzenleme', 'https://www.youtube.com/embed/1xc_fiMm0Uw', 900, 0, 2]);
        $stmtLesson->execute([$sec2, '6. Gecis Efektleri ve Trendler', 'gecis-efektleri', 'https://www.youtube.com/embed/a3ICNMQK_Ck', 660, 0, 3]);

        // Bolum 3
        $stmtLesson->execute([$sec3, '7. Trend Analizi Nasil Yapilir?', 'trend-analizi', 'https://www.youtube.com/embed/FUfF33FRQf0', 540, 0, 1]);
        $stmtLesson->execute([$sec3, '8. Hashtag ve Aciklama Stratejisi', 'hashtag-stratejisi', 'https://www.youtube.com/embed/7LqRSi5Ib-I', 480, 0, 2]);
        $stmtLesson->execute([$sec3, '9. TikTok ve Reels Karsilastirma', 'tiktok-reels-karsilastirma', 'https://www.youtube.com/embed/DHUwOHaFmR4', 600, 0, 3]);

        echo "  [OK] 3 bolum, 9 ders eklendi.\n";
    } else {
        echo "  [SKIP] Reels kursu zaten bolum iceriyor.\n";
    }
}

// ============================================
// 4. YAPAY ZEKA EGITIMI - BOLUMLER VE DERSLER
// ============================================
echo "\n--- Yapay Zeka Egitimi dersleri ekleniyor ---\n";

$courseId = $pdo->query("SELECT id FROM courses WHERE slug = 'yapay-zeka-farkindalik-egitimi'")->fetchColumn();
if ($courseId) {
    $existingSections = $pdo->prepare("SELECT COUNT(*) FROM course_sections WHERE course_id = ?");
    $existingSections->execute([$courseId]);

    if ($existingSections->fetchColumn() == 0) {
        $pdo->prepare("INSERT INTO course_sections (course_id, title, sort_order) VALUES (?, ?, ?)")
            ->execute([$courseId, '1. Yapay Zekaya Giris', 1]);
        $sec1 = $pdo->lastInsertId();

        $pdo->prepare("INSERT INTO course_sections (course_id, title, sort_order) VALUES (?, ?, ?)")
            ->execute([$courseId, '2. ChatGPT ve Metin Araclari', 2]);
        $sec2 = $pdo->lastInsertId();

        $pdo->prepare("INSERT INTO course_sections (course_id, title, sort_order) VALUES (?, ?, ?)")
            ->execute([$courseId, '3. Gorsel Uretim ve Otomasyon', 3]);
        $sec3 = $pdo->lastInsertId();

        $stmtLesson = $pdo->prepare("INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Bolum 1
        $stmtLesson->execute([$sec1, '1. Yapay Zeka Nedir?', 'yapay-zeka-nedir', 'https://www.youtube.com/embed/ad79nYk2keg', 420, 1, 1]);
        $stmtLesson->execute([$sec1, '2. Dijital Pazarlamada AI Kullanimi', 'dijital-pazarlamada-ai', 'https://www.youtube.com/embed/hVOg4RbKzEE', 540, 1, 2]);
        $stmtLesson->execute([$sec1, '3. AI Araclari Genel Bakis', 'ai-araclari-genel', 'https://www.youtube.com/embed/X7MnPsLDrPQ', 480, 0, 3]);

        // Bolum 2
        $stmtLesson->execute([$sec2, '4. ChatGPT Kullanim Kilavuzu', 'chatgpt-kilavuz', 'https://www.youtube.com/embed/sTeoEFzVNSc', 900, 0, 1]);
        $stmtLesson->execute([$sec2, '5. Prompt Muhendisligi', 'prompt-muhendisligi', 'https://www.youtube.com/embed/v2gDkGz3Fvk', 780, 0, 2]);
        $stmtLesson->execute([$sec2, '6. AI ile Icerik Uretimi', 'ai-icerik-uretimi', 'https://www.youtube.com/embed/_ZvnD96BVyA', 660, 0, 3]);

        // Bolum 3
        $stmtLesson->execute([$sec3, '7. Midjourney ile Gorsel Uretme', 'midjourney-gorsel', 'https://www.youtube.com/embed/Asg1e_IYzR8', 840, 0, 1]);
        $stmtLesson->execute([$sec3, '8. AI Otomasyon Araclari', 'ai-otomasyon', 'https://www.youtube.com/embed/IKpl1fn1DOo', 720, 0, 2]);
        $stmtLesson->execute([$sec3, '9. Gelecekte Yapay Zeka', 'gelecekte-yapay-zeka', 'https://www.youtube.com/embed/YwBceClEb8Y', 600, 0, 3]);

        echo "  [OK] 3 bolum, 9 ders eklendi.\n";
    } else {
        echo "  [SKIP] Yapay Zeka kursu zaten bolum iceriyor.\n";
    }
}

// ============================================
// 5. WORDPRESS EGITIMI - BOLUMLER VE DERSLER
// ============================================
echo "\n--- WordPress Egitimi dersleri ekleniyor ---\n";

$courseId = $pdo->query("SELECT id FROM courses WHERE slug = 'adim-adim-wordpress-egitimi'")->fetchColumn();
if ($courseId) {
    $existingSections = $pdo->prepare("SELECT COUNT(*) FROM course_sections WHERE course_id = ?");
    $existingSections->execute([$courseId]);

    if ($existingSections->fetchColumn() == 0) {
        $pdo->prepare("INSERT INTO course_sections (course_id, title, sort_order) VALUES (?, ?, ?)")
            ->execute([$courseId, '1. WordPress Kurulumu', 1]);
        $sec1 = $pdo->lastInsertId();

        $pdo->prepare("INSERT INTO course_sections (course_id, title, sort_order) VALUES (?, ?, ?)")
            ->execute([$courseId, '2. Tema ve Eklentiler', 2]);
        $sec2 = $pdo->lastInsertId();

        $pdo->prepare("INSERT INTO course_sections (course_id, title, sort_order) VALUES (?, ?, ?)")
            ->execute([$courseId, '3. SEO ve Performans', 3]);
        $sec3 = $pdo->lastInsertId();

        $stmtLesson = $pdo->prepare("INSERT INTO lessons (section_id, title, slug, video_url, video_duration, is_free_preview, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Bolum 1
        $stmtLesson->execute([$sec1, '1. WordPress Nedir?', 'wordpress-nedir', 'https://www.youtube.com/embed/jl8F4WglM3I', 480, 1, 1]);
        $stmtLesson->execute([$sec1, '2. Hosting ve Domain Secimi', 'hosting-domain', 'https://www.youtube.com/embed/H6cL2JnNICk', 600, 1, 2]);
        $stmtLesson->execute([$sec1, '3. WordPress Kurulumu Adim Adim', 'wordpress-kurulumu', 'https://www.youtube.com/embed/jSCyKETg4LQ', 720, 0, 3]);

        // Bolum 2
        $stmtLesson->execute([$sec2, '4. Tema Secimi ve Yukleme', 'tema-secimi', 'https://www.youtube.com/embed/RIRXUyVLzBs', 660, 0, 1]);
        $stmtLesson->execute([$sec2, '5. Gerekli Eklentiler', 'gerekli-eklentiler', 'https://www.youtube.com/embed/AjG7589sMwg', 780, 0, 2]);
        $stmtLesson->execute([$sec2, '6. Elementor ile Sayfa Tasarimi', 'elementor-sayfa-tasarimi', 'https://www.youtube.com/embed/E15iQUo7HhQ', 900, 0, 3]);

        // Bolum 3
        $stmtLesson->execute([$sec3, '7. WordPress SEO Ayarlari', 'wordpress-seo', 'https://www.youtube.com/embed/MYE6T_gd7H0', 840, 0, 1]);
        $stmtLesson->execute([$sec3, '8. Site Hizi Optimizasyonu', 'site-hizi', 'https://www.youtube.com/embed/K8YELRmUb5o', 720, 0, 2]);
        $stmtLesson->execute([$sec3, '9. WooCommerce ile E-Ticaret', 'woocommerce-eticaret', 'https://www.youtube.com/embed/Qu_rEjjF8Ks', 960, 0, 3]);

        echo "  [OK] 3 bolum, 9 ders eklendi.\n";
    } else {
        echo "  [SKIP] WordPress kursu zaten bolum iceriyor.\n";
    }
}

// ============================================
// 6. KURS PREVIEW VIDEO'LARINI GUNCELLE
// ============================================
echo "\n--- Kurs onizleme videolari guncelleniyor ---\n";

$previewVideos = [
    'dijital-pazarlama-temel-egitimi'       => 'https://www.youtube.com/watch?v=bixR-KIJKYM',
    'birebir-destekli-meta-business-egitimi' => 'https://www.youtube.com/watch?v=o4LZ1Fl1F6Q',
    'birebir-destekli-google-ads-egitimi'    => 'https://www.youtube.com/watch?v=oQw8pn-xgZY',
    'sifirdan-ileri-seviyeye-seo-egitimi'    => 'https://www.youtube.com/watch?v=rOSHk6IBIXY',
    'adan-zye-canva-egitimi'                 => 'https://www.youtube.com/watch?v=nM3jR5Y0L8s',
    'kapsamli-reels-egitimi'                 => 'https://www.youtube.com/watch?v=6pIEv0FD-lQ',
    'yapay-zeka-farkindalik-egitimi'         => 'https://www.youtube.com/watch?v=ad79nYk2keg',
    'adim-adim-wordpress-egitimi'            => 'https://www.youtube.com/watch?v=jl8F4WglM3I',
];

$stmtPreview = $pdo->prepare('UPDATE courses SET preview_video = ? WHERE slug = ?');
foreach ($previewVideos as $slug => $video) {
    $stmtPreview->execute([$video, $slug]);
    echo "  [OK] {$slug} preview video eklendi.\n";
}

echo "\n=== TAMAMLANDI ===\n";
echo "Toplam: 8 kurs thumbnail, 4 yeni kurs icerigi (12 bolum, 36 ders), 8 preview video guncellendi.\n";
