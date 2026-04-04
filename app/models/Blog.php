<?php

class Blog
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT bp.*, u.first_name, u.last_name
             FROM blog_posts bp
             JOIN users u ON bp.user_id = u.id
             WHERE bp.id = ?'
        );
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT bp.*, u.first_name, u.last_name
             FROM blog_posts bp
             JOIN users u ON bp.user_id = u.id
             WHERE bp.slug = ? AND bp.is_published = 1'
        );
        $stmt->execute([$slug]);
        $post = $stmt->fetch();
        if ($post) {
            $this->db->prepare('UPDATE blog_posts SET views = views + 1 WHERE id = ?')->execute([$post['id']]);
        }
        return $post ?: null;
    }

    public function getPublished(int $limit = 12, int $offset = 0): array
    {
        $stmt = $this->db->prepare(
            'SELECT bp.*, u.first_name, u.last_name
             FROM blog_posts bp
             JOIN users u ON bp.user_id = u.id
             WHERE bp.is_published = 1
             ORDER BY bp.published_at DESC
             LIMIT ? OFFSET ?'
        );
        $stmt->execute([$limit, $offset]);
        return $stmt->fetchAll();
    }

    public function getAll(): array
    {
        return $this->db->query(
            'SELECT bp.*, u.first_name, u.last_name
             FROM blog_posts bp
             JOIN users u ON bp.user_id = u.id
             ORDER BY bp.created_at DESC'
        )->fetchAll();
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO blog_posts (user_id, title, slug, content, excerpt, thumbnail, is_published, published_at)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([
            $data['user_id'], $data['title'], $data['slug'],
            $data['content'] ?? null, $data['excerpt'] ?? null,
            $data['thumbnail'] ?? null, $data['is_published'] ?? 0,
            $data['is_published'] ? date('Y-m-d H:i:s') : null,
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
        $stmt = $this->db->prepare('UPDATE blog_posts SET ' . implode(', ', $fields) . ' WHERE id = ?');
        return $stmt->execute($values);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM blog_posts WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function countPublished(): int
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM blog_posts WHERE is_published = 1")->fetchColumn();
    }
}
