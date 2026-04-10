<?php

class AuthController
{
    public function loginForm(): void
    {
        if (isLoggedIn()) redirect('panel');
        $pageTitle = 'Giris Yap';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/auth/login.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function login(): void
    {
        if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
            setFlash('error', 'Gecersiz istek.');
            redirect('giris');
        }

        // Rate limiting - 5 deneme / 5 dakika
        if (!rateLimit('login', 5, 300)) {
            setFlash('error', 'Cok fazla basarisiz giris denemesi. Lutfen 5 dakika bekleyin.');
            redirect('giris');
        }

        require_once __DIR__ . '/../models/User.php';
        $userModel = new User();

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            setFlash('error', 'E-posta veya sifre hatali.');
            redirect('giris');
        }

        if (!$user['is_active']) {
            setFlash('error', 'Hesabiniz aktif degil.');
            redirect('giris');
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user'] = [
            'id' => $user['id'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'avatar' => $user['avatar'],
        ];

        session_regenerate_id(true);

        if ($user['role'] === 'admin') {
            redirect('admin');
        }
        redirect('panel');
    }

    public function registerForm(): void
    {
        if (isLoggedIn()) redirect('panel');
        $pageTitle = 'Kayit Ol';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/auth/register.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function register(): void
    {
        if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
            setFlash('error', 'Gecersiz istek.');
            redirect('kayit');
        }

        $firstName = trim($_POST['first_name'] ?? '');
        $lastName = trim($_POST['last_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        // Validasyon
        $errors = [];
        if (empty($firstName)) $errors[] = 'Ad alani zorunludur.';
        if (empty($lastName)) $errors[] = 'Soyad alani zorunludur.';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Gecerli bir e-posta adresi girin.';
        if (strlen($password) < 6) $errors[] = 'Sifre en az 6 karakter olmalidir.';
        if ($password !== $passwordConfirm) $errors[] = 'Sifreler eslemiyor.';

        if (!empty($errors)) {
            setFlash('error', implode('<br>', $errors));
            redirect('kayit');
        }

        require_once __DIR__ . '/../models/User.php';
        $userModel = new User();

        if ($userModel->findByEmail($email)) {
            setFlash('error', 'Bu e-posta adresi zaten kayitli.');
            redirect('kayit');
        }

        $userId = $userModel->create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => $password,
        ]);

        $_SESSION['user_id'] = $userId;
        $_SESSION['user_role'] = 'student';
        $_SESSION['user'] = [
            'id' => $userId,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'role' => 'student',
            'avatar' => null,
        ];

        session_regenerate_id(true);
        setFlash('success', 'Hosgeldiniz! Basariyla kayit oldunuz.');
        redirect('panel');
    }

    public function logout(): void
    {
        session_destroy();
        redirect('giris');
    }

    public function forgotForm(): void
    {
        $pageTitle = 'Sifremi Unuttum';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/auth/forgot.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function forgot(): void
    {
        if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
            setFlash('error', 'Gecersiz istek.');
            redirect('sifremi-unuttum');
        }

        // Basit implementasyon - gercek projede email gonderilmeli
        setFlash('success', 'Sifre sifirlama baglantisi e-posta adresinize gonderildi.');
        redirect('sifremi-unuttum');
    }
}