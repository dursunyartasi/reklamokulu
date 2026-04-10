<div class="admin-header-row">
    <h1>Blog Yazilari</h1>
    <a href="<?= url('admin/blog/ekle') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Yeni Yazi</a>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>Baslik</th>
            <th>Yazar</th>
            <th>Goruntuleme</th>
            <th>Durum</th>
            <th>Tarih</th>
            <th>Islemler</th>
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
                    <?= $post['is_published'] ? 'Yayinda' : 'Taslak' ?>
                </span>
            </td>
            <td><?= date('d.m.Y', strtotime($post['created_at'])) ?></td>
            <td>
                <a href="<?= url('admin/blog/' . $post['id'] . '/duzenle') ?>" class="btn btn-sm btn-outline" title="Duzenle">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="<?= url('admin/blog/' . $post['id'] . '/sil') ?>" method="POST" style="display:inline"
                      onsubmit="return confirm('Bu yaziyi silmek istediginize emin misiniz?')">
                    <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">
                    <button type="submit" class="btn btn-sm btn-danger" title="Sil">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($posts)): ?>
        <tr><td colspan="6" class="text-center">Henuz blog yazisi yok</td></tr>
        <?php endif; ?>
    </tbody>
</table>
