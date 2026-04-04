<?php

class CourseController
{
    public function index(): void
    {
        require_once __DIR__ . '/../models/Course.php';
        $courseModel = new Course();
        $courses = $courseModel->getPublished();

        $pageTitle = 'Egitimler';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/courses/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function show(string $slug): void
    {
        require_once __DIR__ . '/../models/Course.php';
        $courseModel = new Course();
        $course = $courseModel->findBySlug($slug);

        if (!$course) {
            http_response_code(404);
            require __DIR__ . '/../views/layouts/404.php';
            return;
        }

        $sections = $courseModel->getSectionsWithLessons($course['id']);
        $isEnrolled = isLoggedIn() ? $courseModel->isEnrolled(currentUserId(), $course['id']) : false;

        // Benzer kurslar
        $allCourses = $courseModel->getPublished();
        $relatedCourses = array_filter($allCourses, fn($c) => $c['id'] !== $course['id']);
        $relatedCourses = array_slice($relatedCourses, 0, 4);

        $pageTitle = $course['title'];
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/courses/detail.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function addToCart(string $slug): void
    {
        require_once __DIR__ . '/../models/Course.php';
        $courseModel = new Course();
        $course = $courseModel->findBySlug($slug);

        if (!$course) {
            redirect('egitimler');
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $_SESSION['cart'][$course['id']] = [
            'id' => $course['id'],
            'title' => $course['title'],
            'slug' => $course['slug'],
            'price' => $course['sale_price'] ?? $course['price'],
            'thumbnail' => $course['thumbnail'],
        ];

        setFlash('success', $course['title'] . ' sepete eklendi.');
        redirect('sepet');
    }

    public function cart(): void
    {
        $cart = $_SESSION['cart'] ?? [];
        $total = array_sum(array_column($cart, 'price'));

        $pageTitle = 'Sepet';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/courses/cart.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function removeFromCart(string $id): void
    {
        unset($_SESSION['cart'][(int) $id]);
        setFlash('success', 'Urun sepetten cikarildi.');
        redirect('sepet');
    }

    public function checkout(): void
    {
        if (!isLoggedIn()) {
            setFlash('error', 'Odeme yapmak icin giris yapmaniz gerekiyor.');
            redirect('giris');
        }

        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            redirect('sepet');
        }

        $total = array_sum(array_column($cart, 'price'));
        $pageTitle = 'Odeme';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/courses/checkout.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function processPayment(): void
    {
        if (!isLoggedIn()) redirect('giris');
        if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
            setFlash('error', 'Gecersiz istek.');
            redirect('odeme');
        }

        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) redirect('sepet');

        require_once __DIR__ . '/../models/Order.php';
        require_once __DIR__ . '/../models/Course.php';

        $orderModel = new Order();
        $courseModel = new Course();

        $total = array_sum(array_column($cart, 'price'));

        // Kupon kontrolu
        $discount = 0;
        $couponCode = trim($_POST['coupon_code'] ?? '');
        if ($couponCode) {
            $coupon = $orderModel->verifyCoupon($couponCode);
            if ($coupon) {
                $discount = $coupon['discount_type'] === 'percent'
                    ? $total * ($coupon['discount_value'] / 100)
                    : $coupon['discount_value'];
            }
        }

        $finalTotal = max(0, $total - $discount);

        // Siparis olustur
        $orderId = $orderModel->create(currentUserId(), $finalTotal, $couponCode ?: null, $discount);

        foreach ($cart as $item) {
            $orderModel->addItem($orderId, $item['id'], $item['price']);
            // Kursa kaydet
            $courseModel->enroll(currentUserId(), $item['id'], $item['price'], 'credit_card');
        }

        // Odeme basarili (gercek projede iyzico entegrasyonu yapilacak)
        $orderModel->updateStatus($orderId, 'completed', 'DEMO-' . time());

        // Sepeti temizle
        unset($_SESSION['cart']);

        setFlash('success', 'Odeme basarili! Egitimlerinize panelden erisebilirsiniz.');
        redirect('panel');
    }
}