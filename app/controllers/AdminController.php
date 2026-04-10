<?php

class AdminController
{
    public function __construct()
    {
        if (!isLoggedIn() || !isAdmin()) {
            redirect('giris');
        }
    }

    // ---- Dashboard ----
    public function dashboard(): void
    {
        require_once __DIR__ . '/../models/User.php';
        require_once __DIR__ . '/../models/Course.php';
        require_once __DIR__ . '/../models/Order.php';

        $stats = [
            'total_users' => (new User())->countAll(),
            'total_courses' => (new Course())->countAll(),
            'total_orders' => (new Order())->countAll(),
            'total_revenue' => (new Order())->getTotalRevenue(),
        ];

        $recentOrders = (new Order())->getAll(10);

        $pageTitle = 'Admin Panel';
        require __DIR__ . '/../views/admin/layout.php';
    }

    // ---- Kurslar ----
    public function courses(): void
    {
        require_once __DIR__ . '/../models/Course.php';
        $courses = (new Course())->getAll();
        $pageTitle = 'Kurslar';
        $view = 'courses';
        require __DIR__ . '/../views/admin/layout.php';
    }

    public function courseCreate(): void
    {
        $db = Database::connect();
        $instructors = $db->query('SELECT i.id, u.first_name, u.last_name FROM instructors i JOIN users u ON i.user_id = u.id ORDER BY u.first_name')->fetchAll();
        $categories = $db->query('SELECT * FROM categories ORDER BY name')->fetchAll();
        $pageTitle = 'Yeni Kurs';
        $view = 'course-form';
        require __DIR__ . '/../views/admin/layout.php';
    }

    public function courseStore(): void
    {
        if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
            setFlash('error', 'Gecersiz istek.');
            redirect('admin/kurslar/ekle');
        }

        require_once __DIR__ . '/../models/Course.php';
        $courseModel = new Course();

        $data = [
            'instructor_id' => (int) $_POST['instructor_id'],
            'category_id' => $_POST['category_id'] ?: null,
            'title' => trim($_POST['title']),
            'slug' => slugify(trim($_POST['title'])),
            'description' => trim($_POST['description'] ?? ''),
            'short_description' => trim($_POST['short_description'] ?? ''),
            'preview_video' => trim($_POST['preview_video'] ?? ''),
            'price' => (float) $_POST['price'],
            'sale_price' => $_POST['sale_price'] ? (float) $_POST['sale_price'] : null,
            'duration' => trim($_POST['duration'] ?? ''),
            'level' => $_POST['level'] ?? 'beginner',
            'is_published' => isset($_POST['is_published']) ? 1 : 0,
            'is_free' => isset($_POST['is_free']) ? 1 : 0,
        ];

        // Thumbnail yukleme (guvenli)
        if (!empty($_FILES['thumbnail']['name'])) {
            $uploadError = validateUpload($_FILES['thumbnail']);
            if ($uploadError) {
                setFlash('error', $uploadError);
                redirect('admin/kurslar/ekle');
            }
            $ext = strtolower(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION));
            $filename = $data['slug'] . '-' . time() . '.' . $ext;
            $target = __DIR__ . '/../../public/uploads/courses/' . $filename;
            @mkdir(dirname($target), 0755, true);
            if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target)) {
                $data['thumbnail'] = 'uploads/courses/' . $filename;
            }
        }

        $courseModel->create($data);
        setFlash('success', 'Kurs basariyla olusturuldu.');
        redirect('admin/kurslar');
    }

    public function courseEdit(string $id): void
    {
        require_once __DIR__ . '/../models/Course.php';
        $courseModel = new Course();
        $course = $courseModel->findById((int) $id);

        if (!$course) {
            setFlash('error', 'Kurs bulunamadi.');
            redirect('admin/kurslar');
        }

        $db = Database::connect();
        $instructors = $db->query('SELECT i.id, u.first_name, u.last_name FROM instructors i JOIN users u ON i.user_id = u.id ORDER BY u.first_name')->fetchAll();
        $categories = $db->query('SELECT * FROM categories ORDER BY name')->fetchAll();
        $sections = $courseModel->getSectionsWithLessons($course['id']);

        $pageTitle = 'Kurs Duzenle: ' . $course['title'];
        $view = 'course-form';
        require __DIR__ . '/../views/admin/layout.php';
    }

    public function courseUpdate(string $id): void
    {
        if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
            setFlash('error', 'Gecersiz istek.');
            redirect('admin/kurslar/' . $id . '/duzenle');
        }

        require_once __DIR__ . '/../models/Course.php';
        $courseModel = new Course();

        $data = [
            'instructor_id' => (int) $_POST['instructor_id'],
            'category_id' => $_POST['category_id'] ?: null,
            'title' => trim($_POST['title']),
            'slug' => slugify(trim($_POST['title'])),
            'description' => trim($_POST['description'] ?? ''),
            'short_description' => trim($_POST['short_description'] ?? ''),
            'preview_video' => trim($_POST['preview_video'] ?? ''),
            'price' => (float) $_POST['price'],
            'sale_price' => $_POST['sale_price'] ? (float) $_POST['sale_price'] : null,
            'duration' => trim($_POST['duration'] ?? ''),
            'level' => $_POST['level'] ?? 'beginner',
            'is_published' => isset($_POST['is_published']) ? 1 : 0,
            'is_free' => isset($_POST['is_free']) ? 1 : 0,
        ];

        if (!empty($_FILES['thumbnail']['name'])) {
            $uploadError = validateUpload($_FILES['thumbnail']);
            if ($uploadError) {
                setFlash('error', $uploadError);
                redirect('admin/kurslar/' . $id . '/duzenle');
            }
            $ext = strtolower(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION));
            $filename = $data['slug'] . '-' . time() . '.' . $ext;
            $target = __DIR__ . '/../../public/uploads/courses/' . $filename;
            @mkdir(dirname($target), 0755, true);
            if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target)) {
                $data['thumbnail'] = 'uploads/courses/' . $filename;
            }
        }

        $courseModel->update((int) $id, $data);
        setFlash('success', 'Kurs basariyla guncellendi.');
        redirect('admin/kurslar');
    }

    public function courseDelete(string $id): void
    {
        if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
            setFlash('error', 'Gecersiz istek.');
            redirect('admin/kurslar');
        }
        require_once __DIR__ . '/../models/Course.php';
        (new Course())->delete((int) $id);
        setFlash('success', 'Kurs silindi.');
        redirect('admin/kurslar');
    }

    // ---- Bolum & Ders Yonetimi ----
    public function sectionStore(): void
    {
        $db = Database::connect();
        $stmt = $db->prepare('INSERT INTO course_sections (course_id, title, sort_order) VALUES (?, ?, ?)');
        $stmt->execute([
            (int) $_POST['course_id'],
            trim($_POST['title']),
            (int) ($_POST['sort_order'] ?? 0),
        ]);
        setFlash('success', 'Bolum eklendi.');
        redirect('admin/kurslar/' . $_POST['course_id'] . '/duzenle');
    }

    public function lessonStore(): void
    {
        $db = Database::connect();
        $stmt = $db->prepare(
            'INSERT INTO lessons (section_id, title, video_url, video_duration, content, is_free_preview, sort_order)
             VALUES (?, ?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([
            (int) $_POST['section_id'],
            trim($_POST['title']),
            trim($_POST['video_url'] ?? ''),
            (int) ($_POST['video_duration'] ?? 0),
            trim($_POST['content'] ?? ''),
            isset($_POST['is_free_preview']) ? 1 : 0,
            (int) ($_POST['sort_order'] ?? 0),
        ]);

        // Course ID bul
        $section = $db->prepare('SELECT course_id FROM course_sections WHERE id = ?');
        $section->execute([(int) $_POST['section_id']]);
        $courseId = $section->fetchColumn();

        setFlash('success', 'Ders eklendi.');
        redirect('admin/kurslar/' . $courseId . '/duzenle');
    }

    // ---- Kullanicilar ----
    public function users(): void
    {
        require_once __DIR__ . '/../models/User.php';
        $users = (new User())->getAll(100);
        $pageTitle = 'Kullanicilar';
        $view = 'users';
        require __DIR__ . '/../views/admin/layout.php';
    }

    // ---- Siparisler ----
    public function orders(): void
    {
        require_once __DIR__ . '/../models/Order.php';
        $orders = (new Order())->getAll(100);
        $pageTitle = 'Siparisler';
        $view = 'orders';
        require __DIR__ . '/../views/admin/layout.php';
    }

    // ---- Blog ----
    public function blogPosts(): void
    {
        require_once __DIR__ . '/../models/Blog.php';
        $posts = (new Blog())->getAll();
        $pageTitle = 'Blog Yazilari';
        $view = 'blog-posts';
        require __DIR__ . '/../views/admin/layout.php';
    }

    public function blogCreate(): void
    {
        $pageTitle = 'Yeni Blog Yazisi';
        $view = 'blog-form';
        require __DIR__ . '/../views/admin/layout.php';
    }

    public function blogStore(): void
    {
        if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
            setFlash('error', 'Gecersiz istek.');
            redirect('admin/blog/ekle');
        }

        require_once __DIR__ . '/../models/Blog.php';
        $data = [
            'user_id' => currentUserId(),
            'title' => trim($_POST['title']),
            'slug' => slugify(trim($_POST['title'])),
            'content' => $_POST['content'] ?? '',
            'excerpt' => trim($_POST['excerpt'] ?? ''),
            'is_published' => isset($_POST['is_published']) ? 1 : 0,
        ];

        if (!empty($_FILES['thumbnail']['name'])) {
            $uploadError = validateUpload($_FILES['thumbnail']);
            if ($uploadError) {
                setFlash('error', $uploadError);
                redirect('admin/blog/ekle');
            }
            $ext = strtolower(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION));
            $filename = 'blog-' . $data['slug'] . '-' . time() . '.' . $ext;
            $target = __DIR__ . '/../../public/uploads/blog/' . $filename;
            @mkdir(dirname($target), 0755, true);
            if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target)) {
                $data['thumbnail'] = 'uploads/blog/' . $filename;
            }
        }

        (new Blog())->create($data);
        setFlash('success', 'Blog yazisi olusturuldu.');
        redirect('admin/blog');
    }

    public function blogEdit(string $id): void
    {
        require_once __DIR__ . '/../models/Blog.php';
        $post = (new Blog())->findById((int) $id);

        if (!$post) {
            setFlash('error', 'Blog yazisi bulunamadi.');
            redirect('admin/blog');
        }

        $pageTitle = 'Blog Duzenle: ' . $post['title'];
        $view = 'blog-form';
        require __DIR__ . '/../views/admin/layout.php';
    }

    public function blogUpdate(string $id): void
    {
        if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
            setFlash('error', 'Gecersiz istek.');
            redirect('admin/blog/' . $id . '/duzenle');
        }

        require_once __DIR__ . '/../models/Blog.php';
        $blogModel = new Blog();

        $data = [
            'title' => trim($_POST['title']),
            'slug' => slugify(trim($_POST['title'])),
            'content' => $_POST['content'] ?? '',
            'excerpt' => trim($_POST['excerpt'] ?? ''),
            'is_published' => isset($_POST['is_published']) ? 1 : 0,
        ];

        if ($data['is_published']) {
            $existing = $blogModel->findById((int) $id);
            if (!$existing['published_at']) {
                $data['published_at'] = date('Y-m-d H:i:s');
            }
        }

        if (!empty($_FILES['thumbnail']['name'])) {
            $uploadError = validateUpload($_FILES['thumbnail']);
            if ($uploadError) {
                setFlash('error', $uploadError);
                redirect('admin/blog/' . $id . '/duzenle');
            }
            $ext = strtolower(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION));
            $filename = 'blog-' . $data['slug'] . '-' . time() . '.' . $ext;
            $target = __DIR__ . '/../../public/uploads/blog/' . $filename;
            @mkdir(dirname($target), 0755, true);
            if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target)) {
                $data['thumbnail'] = 'uploads/blog/' . $filename;
            }
        }

        $blogModel->update((int) $id, $data);
        setFlash('success', 'Blog yazisi guncellendi.');
        redirect('admin/blog');
    }

    public function blogDelete(string $id): void
    {
        if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
            setFlash('error', 'Gecersiz istek.');
            redirect('admin/blog');
        }
        require_once __DIR__ . '/../models/Blog.php';
        (new Blog())->delete((int) $id);
        setFlash('success', 'Blog yazisi silindi.');
        redirect('admin/blog');
    }

    // ---- Ders Silme ----
    public function lessonDelete(): void
    {
        if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
            setFlash('error', 'Gecersiz istek.');
            redirect('admin/kurslar');
        }

        $db = Database::connect();
        $lessonId = (int) ($_POST['lesson_id'] ?? 0);
        $courseId = (int) ($_POST['course_id'] ?? 0);

        $db->prepare('DELETE FROM lessons WHERE id = ?')->execute([$lessonId]);
        setFlash('success', 'Ders silindi.');
        redirect('admin/kurslar/' . $courseId . '/duzenle');
    }

    // ---- Bolum Silme ----
    public function sectionDelete(): void
    {
        if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
            setFlash('error', 'Gecersiz istek.');
            redirect('admin/kurslar');
        }

        $db = Database::connect();
        $sectionId = (int) ($_POST['section_id'] ?? 0);
        $courseId = (int) ($_POST['course_id'] ?? 0);

        $db->prepare('DELETE FROM lessons WHERE section_id = ?')->execute([$sectionId]);
        $db->prepare('DELETE FROM course_sections WHERE id = ?')->execute([$sectionId]);
        setFlash('success', 'Bolum ve dersleri silindi.');
        redirect('admin/kurslar/' . $courseId . '/duzenle');
    }

    // ---- Ayarlar ----
    public function settings(): void
    {
        require_once __DIR__ . '/../models/Setting.php';
        $settings = (new Setting())->getAll();
        $pageTitle = 'Site Ayarlari';
        $view = 'settings';
        require __DIR__ . '/../views/admin/layout.php';
    }

    public function settingsUpdate(): void
    {
        if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
            setFlash('error', 'Gecersiz istek.');
            redirect('admin/ayarlar');
        }

        require_once __DIR__ . '/../models/Setting.php';
        $settingModel = new Setting();

        unset($_POST['csrf_token']);
        foreach ($_POST as $key => $value) {
            $settingModel->set($key, trim($value));
        }

        setFlash('success', 'Ayarlar guncellendi.');
        redirect('admin/ayarlar');
    }

    // ---- Mesajlar ----
    public function messages(): void
    {
        $db = Database::connect();
        $messages = $db->query('SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 100')->fetchAll();
        $corporateRequests = $db->query('SELECT * FROM corporate_requests ORDER BY created_at DESC LIMIT 100')->fetchAll();
        $pageTitle = 'Mesajlar';
        $view = 'messages';
        require __DIR__ . '/../views/admin/layout.php';
    }
}