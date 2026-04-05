<?php

/**
 * Reklam Okulu - Front Controller
 */

// Config yukle
require_once __DIR__ . '/../app/config/app.php';
require_once __DIR__ . '/../app/config/database.php';

// Env dosyasini yukle
loadEnv(__DIR__ . '/../.env');

// Session baslat
initSession();

// Router yukle
require_once __DIR__ . '/../app/Router.php';

$router = new Router();

// ========================
// PUBLIC ROUTES
// ========================

// Ana Sayfa
$router->get('/', 'HomeController', 'index');

// Egitimler
$router->get('/egitimler', 'CourseController', 'index');
$router->get('/egitim/{slug}', 'CourseController', 'show');

// Sepet
$router->post('/sepete-ekle/{slug}', 'CourseController', 'addToCart');
$router->get('/sepet', 'CourseController', 'cart');
$router->get('/sepetten-cikar/{id}', 'CourseController', 'removeFromCart');
$router->get('/odeme', 'CourseController', 'checkout');
$router->post('/odeme-yap', 'CourseController', 'processPayment');

// Auth
$router->get('/giris', 'AuthController', 'loginForm');
$router->post('/giris', 'AuthController', 'login');
$router->get('/kayit', 'AuthController', 'registerForm');
$router->post('/kayit', 'AuthController', 'register');
$router->get('/cikis', 'AuthController', 'logout');
$router->get('/sifremi-unuttum', 'AuthController', 'forgotForm');
$router->post('/sifremi-unuttum', 'AuthController', 'forgot');

// Blog
$router->get('/blog', 'BlogController', 'index');
$router->get('/blog/{slug}', 'BlogController', 'show');

// Egitmenler
$router->get('/egitmenler', 'InstructorController', 'index');
$router->get('/egitmen/{slug}', 'InstructorController', 'show');

// Sayfalar
$router->get('/neden-biz', 'HomeController', 'about');
$router->get('/sss', 'HomeController', 'faq');
$router->get('/iletisim', 'HomeController', 'contact');
$router->post('/iletisim', 'HomeController', 'contactSubmit');
$router->get('/kurumsal-egitimler', 'HomeController', 'corporate');
$router->post('/kurumsal-basvuru', 'HomeController', 'corporateSubmit');

// Ucretsiz Egitim / Ornek Dersler
$router->get('/ucretsiz-egitim', 'HomeController', 'freeEducation');

// Yasal Sayfalar
$router->get('/kullanim-kosullari', 'HomeController', 'terms');
$router->get('/kvkk', 'HomeController', 'kvkk');
$router->get('/iptal-iade', 'HomeController', 'refund');

// ========================
// STUDENT ROUTES
// ========================
$router->get('/panel', 'StudentController', 'dashboard');
$router->get('/panel/kurs/{slug}', 'StudentController', 'watchCourse');
$router->post('/panel/ders-tamamla', 'StudentController', 'completeLesson');
$router->get('/panel/sertifikalar', 'StudentController', 'certificates');
$router->get('/panel/siparisler', 'StudentController', 'orders');
$router->get('/panel/gorusme', 'StudentController', 'meetings');
$router->post('/panel/gorusme-talebi', 'StudentController', 'meetingRequest');
$router->get('/panel/profil', 'StudentController', 'profile');
$router->post('/panel/profil', 'StudentController', 'updateProfile');

// ========================
// ADMIN ROUTES
// ========================
$router->get('/admin', 'AdminController', 'dashboard');

// Kurslar
$router->get('/admin/kurslar', 'AdminController', 'courses');
$router->get('/admin/kurslar/ekle', 'AdminController', 'courseCreate');
$router->post('/admin/kurslar/kaydet', 'AdminController', 'courseStore');
$router->get('/admin/kurslar/{id}/duzenle', 'AdminController', 'courseEdit');
$router->post('/admin/kurslar/{id}/guncelle', 'AdminController', 'courseUpdate');
$router->get('/admin/kurslar/{id}/sil', 'AdminController', 'courseDelete');

// Bolum & Ders
$router->post('/admin/bolum-ekle', 'AdminController', 'sectionStore');
$router->post('/admin/ders-ekle', 'AdminController', 'lessonStore');

// Kullanicilar
$router->get('/admin/kullanicilar', 'AdminController', 'users');

// Siparisler
$router->get('/admin/siparisler', 'AdminController', 'orders');

// Blog
$router->get('/admin/blog', 'AdminController', 'blogPosts');
$router->get('/admin/blog/ekle', 'AdminController', 'blogCreate');
$router->post('/admin/blog/kaydet', 'AdminController', 'blogStore');

// Mesajlar
$router->get('/admin/mesajlar', 'AdminController', 'messages');

// Ayarlar
$router->get('/admin/ayarlar', 'AdminController', 'settings');
$router->post('/admin/ayarlar', 'AdminController', 'settingsUpdate');

// ========================
// DISPATCH
// ========================

// Base path cikar
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$uri = $_SERVER['REQUEST_URI'];

// Base path'i cikar
if ($basePath && str_starts_with($uri, $basePath)) {
    $uri = substr($uri, strlen($basePath));
}

$router->dispatch($uri, $_SERVER['REQUEST_METHOD']);