<?php

class Order
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function create(int $userId, float $totalAmount, ?string $couponCode = null, float $discount = 0): int
    {
        $orderNumber = 'RO-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(4)));

        $stmt = $this->db->prepare(
            'INSERT INTO orders (user_id, order_number, total_amount, discount_amount, coupon_code)
             VALUES (?, ?, ?, ?, ?)'
        );
        $stmt->execute([$userId, $orderNumber, $totalAmount, $discount, $couponCode]);
        return (int) $this->db->lastInsertId();
    }

    public function addItem(int $orderId, int $courseId, float $price): void
    {
        $stmt = $this->db->prepare('INSERT INTO order_items (order_id, course_id, price) VALUES (?, ?, ?)');
        $stmt->execute([$orderId, $courseId, $price]);
    }

    public function updateStatus(int $orderId, string $status, ?string $paymentId = null): bool
    {
        $stmt = $this->db->prepare('UPDATE orders SET status = ?, payment_id = ? WHERE id = ?');
        return $stmt->execute([$status, $paymentId, $orderId]);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM orders WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function getUserOrders(int $userId): array
    {
        $stmt = $this->db->prepare('SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getAll(int $limit = 50, int $offset = 0): array
    {
        $stmt = $this->db->prepare(
            'SELECT o.*, u.first_name, u.last_name, u.email
             FROM orders o
             JOIN users u ON o.user_id = u.id
             ORDER BY o.created_at DESC LIMIT ? OFFSET ?'
        );
        $stmt->execute([$limit, $offset]);
        return $stmt->fetchAll();
    }

    public function getOrderItems(int $orderId): array
    {
        $stmt = $this->db->prepare(
            'SELECT oi.*, c.title, c.slug, c.thumbnail
             FROM order_items oi
             JOIN courses c ON oi.course_id = c.id
             WHERE oi.order_id = ?'
        );
        $stmt->execute([$orderId]);
        return $stmt->fetchAll();
    }

    public function getTotalRevenue(): float
    {
        return (float) $this->db->query("SELECT COALESCE(SUM(total_amount), 0) FROM orders WHERE status = 'completed'")->fetchColumn();
    }

    public function countAll(): int
    {
        return (int) $this->db->query('SELECT COUNT(*) FROM orders')->fetchColumn();
    }

    public function verifyCoupon(string $code): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM coupons WHERE code = ? AND is_active = 1
             AND (valid_from IS NULL OR valid_from <= NOW())
             AND (valid_until IS NULL OR valid_until >= NOW())
             AND (max_uses IS NULL OR used_count < max_uses)'
        );
        $stmt->execute([$code]);
        return $stmt->fetch() ?: null;
    }
}
