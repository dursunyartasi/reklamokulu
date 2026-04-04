<?php

class Course
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT c.*, i.title as instructor_title, u.first_name as instructor_first_name,
                    u.last_name as instructor_last_name, u.avatar as instructor_avatar,
                    cat.name as category_name
             FROM courses c
             JOIN instructors i ON c.instructor_id = i.id
             JOIN users u ON i.user_id = u.id
             LEFT JOIN categories cat ON c.category_id = cat.id
             WHERE c.id = ?'
        );
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT c.*, i.title as instructor_title, i.bio as instructor_bio,
                    u.first_name as instructor_first_name, u.last_name as instructor_last_name,
                    u.avatar as instructor_avatar,
                    cat.name as category_name
             FROM courses c
             JOIN instructors i ON c.instructor_id = i.id
             JOIN users u ON i.user_id = u.id
             LEFT JOIN categories cat ON c.category_id = cat.id
             WHERE c.slug = ? AND c.is_published = 1'
        );
        $stmt->execute([$slug]);
        return $stmt->fetch() ?: null;
    }

    public function getPublished(): array
    {
        return $this->db->query(
            'SELECT c.*, u.first_name as instructor_first_name, u.last_name as instructor_last_name
             FROM courses c
             JOIN instructors i ON c.instructor_id = i.id
             JOIN users u ON i.user_id = u.id
             WHERE c.is_published = 1
             ORDER BY c.sort_order ASC, c.created_at DESC'
        )->fetchAll();
    }

    public function getAll(): array
    {
        return $this->db->query(
            'SELECT c.*, u.first_name as instructor_first_name, u.last_name as instructor_last_name
             FROM courses c
             JOIN instructors i ON c.instructor_id = i.id
             JOIN users u ON i.user_id = u.id
             ORDER BY c.sort_order ASC, c.created_at DESC'
        )->fetchAll();
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO courses (instructor_id, category_id, title, slug, description, short_description,
             thumbnail, preview_video, price, sale_price, duration, level, is_published, is_free)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([
            $data['instructor_id'], $data['category_id'] ?? null, $data['title'], $data['slug'],
            $data['description'] ?? null, $data['short_description'] ?? null,
            $data['thumbnail'] ?? null, $data['preview_video'] ?? null,
            $data['price'] ?? 0, $data['sale_price'] ?? null,
            $data['duration'] ?? null, $data['level'] ?? 'beginner',
            $data['is_published'] ?? 0, $data['is_free'] ?? 0,
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $fields = [];
        $values = [];
        foreach ($data as $key => $value) {
            $fields[] = "{$key} = ?";
            $values[] = $value;
        }
        $values[] = $id;
        $stmt = $this->db->prepare('UPDATE courses SET ' . implode(', ', $fields) . ' WHERE id = ?');
        return $stmt->execute($values);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM courses WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function getSections(int $courseId): array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM course_sections WHERE course_id = ? ORDER BY sort_order ASC'
        );
        $stmt->execute([$courseId]);
        return $stmt->fetchAll();
    }

    public function getLessons(int $sectionId): array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM lessons WHERE section_id = ? ORDER BY sort_order ASC'
        );
        $stmt->execute([$sectionId]);
        return $stmt->fetchAll();
    }

    public function getSectionsWithLessons(int $courseId): array
    {
        $sections = $this->getSections($courseId);
        foreach ($sections as &$section) {
            $section['lessons'] = $this->getLessons($section['id']);
        }
        return $sections;
    }

    public function countAll(): int
    {
        return (int) $this->db->query('SELECT COUNT(*) FROM courses')->fetchColumn();
    }

    public function isEnrolled(int $userId, int $courseId): bool
    {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM enrollments WHERE user_id = ? AND course_id = ? AND status = 'active'"
        );
        $stmt->execute([$userId, $courseId]);
        return (int) $stmt->fetchColumn() > 0;
    }

    public function enroll(int $userId, int $courseId, float $pricePaid = 0, ?string $paymentMethod = null): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO enrollments (user_id, course_id, price_paid, payment_method) VALUES (?, ?, ?, ?)
             ON DUPLICATE KEY UPDATE status = "active", price_paid = ?'
        );
        $stmt->execute([$userId, $courseId, $pricePaid, $paymentMethod, $pricePaid]);

        $this->db->prepare('UPDATE courses SET total_students = total_students + 1 WHERE id = ?')
            ->execute([$courseId]);
    }

    public function getUserCourses(int $userId): array
    {
        $stmt = $this->db->prepare(
            'SELECT c.*, e.enrolled_at, e.status as enrollment_status
             FROM enrollments e
             JOIN courses c ON e.course_id = c.id
             WHERE e.user_id = ? AND e.status = "active"
             ORDER BY e.enrolled_at DESC'
        );
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getCourseProgress(int $userId, int $courseId): array
    {
        $stmt = $this->db->prepare(
            'SELECT COUNT(DISTINCT l.id) as total_lessons,
                    COUNT(DISTINCT lp.lesson_id) as completed_lessons
             FROM course_sections cs
             JOIN lessons l ON l.section_id = cs.id
             LEFT JOIN lesson_progress lp ON lp.lesson_id = l.id AND lp.user_id = ? AND lp.is_completed = 1
             WHERE cs.course_id = ?'
        );
        $stmt->execute([$userId, $courseId]);
        $result = $stmt->fetch();
        $result['percentage'] = $result['total_lessons'] > 0
            ? round(($result['completed_lessons'] / $result['total_lessons']) * 100)
            : 0;
        return $result;
    }
}
