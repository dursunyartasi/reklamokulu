<h1>Siparişler</h1>

<table class="admin-table">
    <thead>
        <tr>
            <th>Sipariş No</th>
            <th>Musteri</th>
            <th>E-Posta</th>
            <th>Tutar</th>
            <th>İndirim</th>
            <th>Durum</th>
            <th>Tarih</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><strong><?= e($order['order_number']) ?></strong></td>
            <td><?= e($order['first_name'] . ' ' . $order['last_name']) ?></td>
            <td><?= e($order['email']) ?></td>
            <td><?= formatPrice($order['total_amount']) ?></td>
            <td><?= $order['discount_amount'] > 0 ? formatPrice($order['discount_amount']) : '-' ?></td>
            <td>
                <span class="status-badge status-<?= $order['status'] ?>">
                    <?= $order['status'] === 'completed' ? 'Tamamlandı' : ($order['status'] === 'pending' ? 'Bekliyor' : ($order['status'] === 'failed' ? 'Basarisiz' : 'Iade')) ?>
                </span>
            </td>
            <td><?= date('d.m.Y H:i', strtotime($order['created_at'])) ?></td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($orders)): ?>
        <tr><td colspan="7" class="text-center">Henuz sipariş yok</td></tr>
        <?php endif; ?>
    </tbody>
</table>