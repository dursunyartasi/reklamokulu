<?php
if (($_GET['key'] ?? '') !== 'reklamokulu2026') die('Yetkisiz');

echo "<pre>\n=== GORSEL INDIRME VE GUNCELLEME ===\n\n";

$uploadDir = __DIR__ . '/uploads/';
@mkdir($uploadDir . 'courses', 0755, true);
@mkdir($uploadDir . 'instructors', 0755, true);

// Kurs gorselleri indir
$courseImages = [
    'dijital-pazarlama.jpg' => 'https://picsum.photos/seed/digitalmarketing/800/450',
    'meta-business.jpg' => 'https://picsum.photos/seed/metabusiness/800/450',
    'google-ads.jpg' => 'https://picsum.photos/seed/googleads2024/800/450',
    'seo.jpg' => 'https://picsum.photos/seed/seoanalytics/800/450',
    'canva.jpg' => 'https://picsum.photos/seed/designcanva/800/450',
    'reels.jpg' => 'https://picsum.photos/seed/reelsvideo/800/450',
    'yapay-zeka.jpg' => 'https://picsum.photos/seed/artificialintel/800/450',
    'wordpress.jpg' => 'https://picsum.photos/seed/wordpressdev/800/450',
];

foreach ($courseImages as $file => $url) {
    $path = $uploadDir . 'courses/' . $file;
    if (!file_exists($path) || filesize($path) < 1000) {
        $data = @file_get_contents($url);
        if ($data) {
            file_put_contents($path, $data);
            echo "Indirildi: courses/$file (" . strlen($data) . " bytes)\n";
        } else {
            echo "HATA: $file indirilemedi\n";
        }
    } else {
        echo "Zaten var: courses/$file\n";
    }
}

// Egitmen gorselleri indir
$instructorImages = [
    'ahmet.jpg' => 'https://i.pravatar.cc/400?img=12',
    'zeynep.jpg' => 'https://i.pravatar.cc/400?img=5',
    'mehmet.jpg' => 'https://i.pravatar.cc/400?img=11',
    'elif.jpg' => 'https://i.pravatar.cc/400?img=9',
];

foreach ($instructorImages as $file => $url) {
    $path = $uploadDir . 'instructors/' . $file;
    if (!file_exists($path) || filesize($path) < 1000) {
        $data = @file_get_contents($url);
        if ($data) {
            file_put_contents($path, $data);
            echo "Indirildi: instructors/$file (" . strlen($data) . " bytes)\n";
        } else {
            echo "HATA: $file indirilemedi\n";
        }
    } else {
        echo "Zaten var: instructors/$file\n";
    }
}

// Veritabani guncelle
require_once __DIR__ . '/../app/config/app.php';
require_once __DIR__ . '/../app/config/database.php';
loadEnv(__DIR__ . '/../.env');
$db = Database::connect();

$courseMap = [
    'dijital-pazarlama-temel-egitimi' => 'uploads/courses/dijital-pazarlama.jpg',
    'birebir-destekli-meta-business-egitimi' => 'uploads/courses/meta-business.jpg',
    'birebir-destekli-google-ads-egitimi' => 'uploads/courses/google-ads.jpg',
    'sifirdan-ileri-seviyeye-seo-egitimi' => 'uploads/courses/seo.jpg',
    'adan-zye-canva-egitimi' => 'uploads/courses/canva.jpg',
    'kapsamli-reels-egitimi' => 'uploads/courses/reels.jpg',
    'yapay-zeka-farkindalik-egitimi' => 'uploads/courses/yapay-zeka.jpg',
    'adim-adim-wordpress-egitimi' => 'uploads/courses/wordpress.jpg',
];

$stmt = $db->prepare("UPDATE courses SET thumbnail = ? WHERE slug = ?");
foreach ($courseMap as $slug => $img) {
    $stmt->execute([$img, $slug]);
}
echo "\nKurs gorselleri DB'de guncellendi\n";

$instMap = [
    'ahmet@reklamokulu.com' => 'uploads/instructors/ahmet.jpg',
    'zeynep@reklamokulu.com' => 'uploads/instructors/zeynep.jpg',
    'mehmet@reklamokulu.com' => 'uploads/instructors/mehmet.jpg',
    'elif@reklamokulu.com' => 'uploads/instructors/elif.jpg',
];

$stmt = $db->prepare("UPDATE users SET avatar = ? WHERE email = ?");
foreach ($instMap as $email => $img) {
    $stmt->execute([$img, $email]);
}
echo "Egitmen gorselleri DB'de guncellendi\n";

// Dosya var mi kontrol
echo "\n=== DOSYA KONTROL ===\n";
echo "courses/ dizini: " . (is_dir($uploadDir . 'courses') ? 'VAR' : 'YOK') . "\n";
foreach (glob($uploadDir . 'courses/*.jpg') as $f) {
    echo basename($f) . " - " . filesize($f) . " bytes\n";
}
echo "\ninstructors/ dizini: " . (is_dir($uploadDir . 'instructors') ? 'VAR' : 'YOK') . "\n";
foreach (glob($uploadDir . 'instructors/*.jpg') as $f) {
    echo basename($f) . " - " . filesize($f) . " bytes\n";
}

echo "\n=== TAMAMLANDI ===\n</pre>";
