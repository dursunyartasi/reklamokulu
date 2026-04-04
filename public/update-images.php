<?php
if (($_GET['key'] ?? '') !== 'reklamokulu2026') die('Yetkisiz');

require_once __DIR__ . '/../app/config/app.php';
require_once __DIR__ . '/../app/config/database.php';
loadEnv(__DIR__ . '/../.env');

$db = Database::connect();
echo "<pre>\n=== GORSEL GUNCELLEME ===\n\n";

// Kurs gorselleri
$courseImages = [
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
foreach ($courseImages as $slug => $img) {
    $stmt->execute([$img, $slug]);
    echo "Kurs: $slug -> $img\n";
}

// Egitmen gorselleri
$instructorImages = [
    'ahmet@reklamokulu.com' => 'uploads/instructors/ahmet.jpg',
    'zeynep@reklamokulu.com' => 'uploads/instructors/zeynep.jpg',
    'mehmet@reklamokulu.com' => 'uploads/instructors/mehmet.jpg',
    'elif@reklamokulu.com' => 'uploads/instructors/elif.jpg',
];

foreach ($instructorImages as $email => $img) {
    $stmt = $db->prepare("UPDATE users SET avatar = ? WHERE email = ?");
    $stmt->execute([$img, $email]);
    echo "Egitmen: $email -> $img\n";
}

echo "\n=== TAMAMLANDI ===\n</pre>";
