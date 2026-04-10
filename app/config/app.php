<?php

// Env dosyasini yukle
function loadEnv(string $path): void
{
    if (!file_exists($path)) return;

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_starts_with(trim($line), '#')) continue;
        if (!str_contains($line, '=')) continue;

        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value, " \t\n\r\0\x0B\"'");
        $_ENV[$key] = $value;
        putenv("{$key}={$value}");
    }
}

// Session baslat (guvenli ayarlarla)
function initSession(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => $isHttps,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        session_start();
    }
}

// Guvenlik headerlari gonder
function sendSecurityHeaders(): void
{
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    }
}

// Dosya yukleme dogrulama
function validateUpload(array $file, array $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'], int $maxSize = 5242880): ?string
{
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return 'Dosya yukleme hatasi.';
    }
    if ($file['size'] > $maxSize) {
        return 'Dosya boyutu cok buyuk. Maksimum: ' . round($maxSize / 1048576) . 'MB';
    }
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($file['tmp_name']);
    if (!in_array($mimeType, $allowedTypes, true)) {
        return 'Gecersiz dosya tipi. Izin verilen: ' . implode(', ', $allowedTypes);
    }
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    if (!in_array($ext, $allowedExts, true)) {
        return 'Gecersiz dosya uzantisi.';
    }
    return null;
}

// Rate limiting (basit, session tabanli)
function rateLimit(string $key, int $maxAttempts = 5, int $windowSeconds = 300): bool
{
    $now = time();
    $sessionKey = 'rate_limit_' . $key;
    $attempts = $_SESSION[$sessionKey] ?? [];
    $attempts = array_filter($attempts, fn($t) => $t > ($now - $windowSeconds));
    if (count($attempts) >= $maxAttempts) {
        return false;
    }
    $attempts[] = $now;
    $_SESSION[$sessionKey] = $attempts;
    return true;
}

// CSRF token olustur
function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// CSRF dogrula
function verifyCsrf(string $token): bool
{
    return hash_equals($_SESSION['csrf_token'] ?? '', $token);
}

// Flash mesaj
function setFlash(string $type, string $message): void
{
    $_SESSION['flash'][$type] = $message;
}

function getFlash(string $type): ?string
{
    $message = $_SESSION['flash'][$type] ?? null;
    unset($_SESSION['flash'][$type]);
    return $message;
}

// Auth kontrol
function isLoggedIn(): bool
{
    return !empty($_SESSION['user_id']);
}

function isAdmin(): bool
{
    return ($_SESSION['user_role'] ?? '') === 'admin';
}

function isInstructor(): bool
{
    return in_array($_SESSION['user_role'] ?? '', ['admin', 'instructor']);
}

function currentUserId(): ?int
{
    return $_SESSION['user_id'] ?? null;
}

function currentUser(): ?array
{
    return $_SESSION['user'] ?? null;
}

// URL helper
function url(string $path = ''): string
{
    $base = rtrim($_ENV['APP_URL'] ?? getenv('APP_URL') ?: '', '/');
    return $base . '/' . ltrim($path, '/');
}

function redirect(string $path): void
{
    header('Location: ' . url($path));
    exit;
}

// Guvenlik
function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function slugify(string $text): string
{
    $tr = ['ç' => 'c', 'ğ' => 'g', 'ı' => 'i', 'ö' => 'o', 'ş' => 's', 'ü' => 'u',
           'Ç' => 'c', 'Ğ' => 'g', 'İ' => 'i', 'Ö' => 'o', 'Ş' => 's', 'Ü' => 'u'];
    $text = strtr($text, $tr);
    $text = mb_strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

// Fiyat formatlama
function formatPrice(float $price): string
{
    if ($price == 0) return 'Ucretsiz';
    return number_format($price, 2, ',', '.') . ' ₺';
}

// Sure formatlama (saniye -> saat dakika)
function formatDuration(int $seconds): string
{
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $parts = [];
    if ($hours > 0) $parts[] = $hours . 's';
    if ($minutes > 0) $parts[] = $minutes . 'dk';
    return implode(' ', $parts) ?: '0dk';
}