<h1>Dashboard</h1>

<div class="admin-stats">
    <div class="admin-stat-card">
        <div class="stat-icon bg-blue"><i class="fas fa-users"></i></div>
        <div>
            <h3><?= number_format($stats['total_users']) ?></h3>
            <p>Toplam Kullanici</p>
        </div>
    </div>
    <div class="admin-stat-card">
        <div class="stat-icon bg-green"><i class="fas fa-graduation-cap"></i></div>
        <div>
            <h3><?= $stats['total_courses'] ?></h3>
            <p>Toplam Kurs</p>
        </div>
    </div>
    <div class="admin-stat-card">
        <div class="stat-icon bg-orange"><i class="fas fa-shopping-bag"></i></div>
        <div>
            <h3><?= $stats['total_orders'] ?></h3>
            <p>Toplam Sipariş</p>
        </div>
    </div>
    <div class="admin-stat-card">
        <div class="stat-icon bg-red"><i class="fas fa-lira-sign"></i></div>
        <div>
            <h3><?= formatPrice($stats['total_revenue']) ?></h3>
            <p>Toplam Gelir</p>
        </div>
    </div>
</div>

<div class="admin-section">
    <h2>Son Siparişler</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Sipariş No</th>
                <th>Musteri</th>
                <th>Tutar</th>
                <th>Durum</th>
                <th>Tarih</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recentOrders as $order): ?>
            <tr>
                <td><?= e($order['order_number']) ?></td>
                <td><?= e($order['first_name'] . ' ' . $order['last_name']) ?></td>
                <td><?= formatPrice($order['total_amount']) ?></td>
                <td>
                    <span class="status-badge status-<?= $order['status'] ?>">
                        <?= $order['status'] === 'completed' ? 'Tamamlandı' : ($order['status'] === 'pending' ? 'Bekliyor' : ($order['status'] === 'failed' ? 'Basarisiz' : 'Iade')) ?>
                    </span>
                </td>
                <td><?= date('d.m.Y H:i', strtotime($order['created_at'])) ?></td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($recentOrders)): ?>
            <tr><td colspan="5" class="text-center">Henuz sipariş yok</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>