<h1>Mesajlar</h1>

<h2>İletişim Mesajlari</h2>
<table class="admin-table">
    <thead>
        <tr><th>Ad</th><th>E-Posta</th><th>Konu</th><th>Mesaj</th><th>Tarih</th></tr>
    </thead>
    <tbody>
        <?php foreach ($messages as $msg): ?>
        <tr>
            <td><?= e($msg['name']) ?></td>
            <td><?= e($msg['email']) ?></td>
            <td><?= e($msg['subject'] ?? '-') ?></td>
            <td><?= e(mb_substr($msg['message'], 0, 100)) ?>...</td>
            <td><?= date('d.m.Y H:i', strtotime($msg['created_at'])) ?></td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($messages)): ?>
        <tr><td colspan="5" class="text-center">Henuz mesaj yok</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<h2>Kurumsal Talepler</h2>
<table class="admin-table">
    <thead>
        <tr><th>Ad Soyad</th><th>Firma</th><th>E-Posta</th><th>Durum</th><th>Tarih</th></tr>
    </thead>
    <tbody>
        <?php foreach ($corporateRequests as $cr): ?>
        <tr>
            <td><?= e($cr['first_name'] . ' ' . $cr['last_name']) ?></td>
            <td><?= e($cr['company']) ?></td>
            <td><?= e($cr['email']) ?></td>
            <td>
                <span class="status-badge status-<?= $cr['status'] ?>">
                    <?= $cr['status'] === 'new' ? 'Yeni' : ($cr['status'] === 'contacted' ? 'İletişim Kuruldu' : ($cr['status'] === 'completed' ? 'Tamamlandı' : 'Iptal')) ?>
                </span>
            </td>
            <td><?= date('d.m.Y H:i', strtotime($cr['created_at'])) ?></td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($corporateRequests)): ?>
        <tr><td colspan="5" class="text-center">Henuz talep yok</td></tr>
        <?php endif; ?>
    </tbody>
</table>