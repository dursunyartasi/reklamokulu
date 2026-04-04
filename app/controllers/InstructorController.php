<?php

class InstructorController
{
    public function index(): void
    {
        $db = Database::connect();
        $instructors = $db->query(
            'SELECT i.*, u.first_name, u.last_name, u.avatar
             FROM instructors i
             JOIN users u ON i.user_id = u.id
             ORDER BY i.sort_order ASC'
        )->fetchAll();

        $pageTitle = 'Egitmenler';
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/instructors/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function show(string $slug): void
    {
        // slug: ad-soyad formatinda
        $parts = explode('-', $slug);
        if (count($parts) < 2) {
            http_response_code(404);
            require __DIR__ . '/../views/layouts/404.php';
            return;
        }

        $db = Database::connect();
        $instructors = $db->query(
            'SELECT i.*, u.first_name, u.last_name, u.avatar
             FROM instructors i
             JOIN users u ON i.user_id = u.id'
        )->fetchAll();

        $instructor = null;
        foreach ($instructors as $inst) {
            $instSlug = slugify($inst['first_name'] . ' ' . $inst['last_name']);
            if ($instSlug === $slug) {
                $instructor = $inst;
                break;
            }
        }

        if (!$instructor) {
            http_response_code(404);
            require __DIR__ . '/../views/layouts/404.php';
            return;
        }

        // Egitmenin kurslari
        $stmt = $db->prepare(
            'SELECT c.* FROM courses c WHERE c.instructor_id = ? AND c.is_published = 1 ORDER BY c.sort_order ASC'
        );
        $stmt->execute([$instructor['id']]);
        $courses = $stmt->fetchAll();

        $pageTitle = $instructor['first_name'] . ' ' . $instructor['last_name'];
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/instructors/show.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }
}