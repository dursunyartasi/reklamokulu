<div class="admin-header-row">
    <h1>Blog Yazıları</h1>
    <a href="<?= url('admin/blog/ekle') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Yeni Yazı</a>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>Başlık</th>
            <th>Yazar</th>
            <th>Görüntüleme</th>
            <th>Durum</th>
            <th>Tarih</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($posts as $post): ?>
        <tr>
            <td><strong><?= e($post['title']) ?></strong></td>
            <td><?= e($post['first_name'] . ' ' . $post['last_name']) ?></td>
            <td><?= $post['views'] ?></td>
            <td>
                <span class="status-badge <?= $post['is_published'] ? 'status-completed' : 'status-pending' ?>">
                    <?= $post['is_published'] ? 'Yayında' : 'Taslak' ?>
                </span>
            </td>
            <td><?= date('d.m.Y', strtotime($post['created_at'])) ?></td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($posts)): ?>
        <tr><td colspan="5" class="text-center">Henüz blog yazısı yok</td></tr>
        <?php endif; ?>
    </tbody>
</table>