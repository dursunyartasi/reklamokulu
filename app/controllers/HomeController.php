<?php

class HomeController
{
    public function index(): void
    {
        require_once __DIR__ . '/../models/Course.php';
        require_once __DIR__ . '/../models/Setting.php';

        $courseModel = new Course();
        $settingModel = new Setting();

        $courses = $courseModel->getPublished();
        $settings = $settingModel->getAll();

        $pageTitle = $settings['site_name'] ?? 'Reklam Okulu';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/home/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function about(): void
    {
        require_once __DIR__ . '/../models/Setting.php';
        $settings = (new Setting())->getAll();
        $pageTitle = 'Neden Biz? - ' . ($settings['site_name'] ?? 'Reklam Okulu');
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/pages/about.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function faq(): void
    {
        $db = Database::connect();
        $faqs = $db->query('SELECT * FROM faqs WHERE is_active = 1 ORDER BY sort_order ASC')->fetchAll();
        $pageTitle = 'Sikca Sorulan Sorular';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/pages/faq.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function contact(): void
    {
        $pageTitle = 'Iletisim';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/pages/contact.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function contactSubmit(): void
    {
        if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
            setFlash('error', 'Gecersiz istek.');
            redirect('iletisim');
        }

        $db = Database::connect();
        $stmt = $db->prepare(
            'INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)'
        );
        $stmt->execute([
            trim($_POST['name'] ?? ''),
            trim($_POST['email'] ?? ''),
            trim($_POST['phone'] ?? ''),
            trim($_POST['subject'] ?? ''),
            trim($_POST['message'] ?? ''),
        ]);

        setFlash('success', 'Mesajiniz basariyla gonderildi. En kisa surede donus yapacagiz.');
        redirect('iletisim');
    }

    public function corporateSubmit(): void
    {
        if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
            setFlash('error', 'Gecersiz istek.');
            redirect('kurumsal-egitimler');
        }

        $db = Database::connect();
        $stmt = $db->prepare(
            'INSERT INTO corporate_requests (first_name, last_name, company, email, phone, message) VALUES (?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([
            trim($_POST['first_name'] ?? ''),
            trim($_POST['last_name'] ?? ''),
            trim($_POST['company'] ?? ''),
            trim($_POST['email'] ?? ''),
            trim($_POST['phone'] ?? ''),
            trim($_POST['message'] ?? ''),
        ]);

        setFlash('success', 'Kurumsal egitim talebiniz alindi. En kisa surede donus yapacagiz.');
        redirect('kurumsal-egitimler');
    }

    public function corporate(): void
    {
        $pageTitle = 'Kurumsal Egitimler';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/pages/corporate.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function freeEducation(): void
    {
        $pageTitle = 'Ucretsiz Egitim - Dijital Pazarlama Dersleri';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/pages/free-education.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function terms(): void
    {
        $pageTitle = 'Kullanim Kosullari';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/pages/terms.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function kvkk(): void
    {
        $pageTitle = 'KVKK Aydinlatma Metni';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/pages/kvkk.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function refund(): void
    {
        $pageTitle = 'Iptal ve Iade Politikasi';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/pages/refund.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }
}