<?php
// Blog seed runner - env vars'tan DB baglanir
$host = getenv('DB_HOST');
$name = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

try {
    $db = new PDO("mysql:host=$host;dbname=$name;charset=utf8mb4", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = file_get_contents(__DIR__ . '/seed_blog.sql');

    // Split by semicolons and execute each statement
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    $count = 0;
    foreach ($statements as $stmt) {
        if (!empty($stmt) && !str_starts_with($stmt, '--')) {
            $db->exec($stmt);
            $count++;
        }
    }

    echo "Blog seed tamamlandi. $count statement calistirildi.\n";

    // Verify
    $result = $db->query('SELECT COUNT(*) as cnt FROM blog_posts')->fetch();
    echo "Toplam blog yazisi: " . $result['cnt'] . "\n";
} catch (Exception $e) {
    echo "HATA: " . $e->getMessage() . "\n";
}
