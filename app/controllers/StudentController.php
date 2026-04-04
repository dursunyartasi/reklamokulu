<?php

class StudentController
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('giris');
        }
    }

    public function dashboard(): void
    {
        require_once __DIR__ . '/../models/Course.php';
        $courseModel = new Course();

        $myCourses = $courseModel->getUserCourses(currentUserId());

        // Her kurs icin ilerleme hesapla
        foreach ($myCourses as &$course) {
            $course['progress'] = $courseModel->getCourseProgress(currentUserId(), $course['id']);
        }

        $pageTitle = 'Ogrenci Paneli';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/student/dashboard.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function watchCourse(string $slug): void
    {
        require_once __DIR__ . '/../models/Course.php';
        $courseModel = new Course();
        $course = $courseModel->findBySlug($slug);

        if (!$course) {
            http_response_code(404);
            require __DIR__ . '/../views/layouts/404.php';
            return;
        }

        // Ucretsiz kurs veya kayitli kullanici mi?
        $isEnrolled = $course['is_free'] || $courseModel->isEnrolled(currentUserId(), $course['id']);
        if (!$isEnrolled) {
            setFlash('error', 'Bu kursa erisim icin satin almaniz gerekiyor.');
            redirect('egitim/' . $slug);
        }

        $sections = $courseModel->getSectionsWithLessons($course['id']);
        $progress = $courseModel->getCourseProgress(currentUserId(), $course['id']);

        // Aktif ders
        $currentLessonId = (int) ($_GET['ders'] ?? 0);
        $currentLesson = null;

        if ($currentLessonId) {
            $db = Database::connect();
            $stmt = $db->prepare('SELECT * FROM lessons WHERE id = ?');
            $stmt->execute([$currentLessonId]);
            $currentLesson = $stmt->fetch();
        }

        // Ilk dersi sec (eger ders secilmemisse)
        if (!$currentLesson && !empty($sections) && !empty($sections[0]['lessons'])) {
            $currentLesson = $sections[0]['lessons'][0];
        }

        $pageTitle = $course['title'] . ' - Izle';
        require __DIR__ . '/../views/student/watch.php';
    }

    public function completeLesson(): void
    {
        $lessonId = (int) ($_POST['lesson_id'] ?? 0);
        if (!$lessonId) {
            http_response_code(400);
            echo json_encode(['error' => 'Gecersiz ders']);
            return;
        }

        $db = Database::connect();
        $stmt = $db->prepare(
            'INSERT INTO lesson_progress (user_id, lesson_id, is_completed, completed_at)
             VALUES (?, ?, 1, NOW())
             ON DUPLICATE KEY UPDATE is_completed = 1, completed_at = NOW()'
        );
        $stmt->execute([currentUserId(), $lessonId]);

        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    }

    public function certificates(): void
    {
        $db = Database::connect();
        $stmt = $db->prepare(
            'SELECT cert.*, c.title as course_title, c.slug as course_slug
             FROM certificates cert
             JOIN courses c ON cert.course_id = c.id
             WHERE cert.user_id = ?
             ORDER BY cert.issued_at DESC'
        );
        $stmt->execute([currentUserId()]);
        $certificates = $stmt->fetchAll();

        $pageTitle = 'Sertifikalarim';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/student/certificates.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function profile(): void
    {
        require_once __DIR__ . '/../models/User.php';
        $userModel = new User();
        $user = $userModel->findById(currentUserId());

        $pageTitle = 'Profilim';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/student/profile.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function updateProfile(): void
    {
        if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
            setFlash('error', 'Gecersiz istek.');
            redirect('panel/profil');
        }

        require_once __DIR__ . '/../models/User.php';
        $userModel = new User();

        $data = [
            'first_name' => trim($_POST['first_name'] ?? ''),
            'last_name' => trim($_POST['last_name'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
        ];

        // Sifre degisikligi
        if (!empty($_POST['new_password'])) {
            $user = $userModel->findById(currentUserId());
            if (!password_verify($_POST['current_password'] ?? '', $user['password'])) {
                setFlash('error', 'Mevcut sifre hatali.');
                redirect('panel/profil');
            }
            $data['password'] = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        }

        $userModel->update(currentUserId(), $data);

        // Session guncelle
        $_SESSION['user']['first_name'] = $data['first_name'];
        $_SESSION['user']['last_name'] = $data['last_name'];

        setFlash('success', 'Profil basariyla guncellendi.');
        redirect('panel/profil');
    }
}