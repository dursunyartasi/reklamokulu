<div class="admin-header-row">
    <h1>Kurslar</h1>
    <a href="<?= url('admin/kurslar/ekle') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Yeni Kurs</a>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>Kurs Adı</th>
            <th>Egitmen</th>
            <th>Fiyat</th>
            <th>Öğrenci</th>
            <th>Durum</th>
            <th>Islemler</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($courses as $course): ?>
        <tr>
            <td>
                <strong><?= e($course['title']) ?></strong>
                <br><small class="text-muted"><?= e($course['slug']) ?></small>
            </td>
            <td><?= e($course['instructor_first_name'] . ' ' . $course['instructor_last_name']) ?></td>
            <td>
                <?php if ($course['is_free']): ?>
                    <span class="badge badge-free">Ücretsiz</span>
                <?php else: ?>
                    <?php if ($course['sale_price']): ?>
                        <span class="price-old-sm"><?= formatPrice($course['price']) ?></span><br>
                    <?php endif; ?>
                    <?= formatPrice($course['sale_price'] ?? $course['price']) ?>
                <?php endif; ?>
            </td>
            <td><?= $course['total_students'] ?></td>
            <td>
                <span class="status-badge <?= $course['is_published'] ? 'status-completed' : 'status-pending' ?>">
                    <?= $course['is_published'] ? 'Yayında' : 'Taslak' ?>
                </span>
            </td>
            <td>
                <a href="<?= url('admin/kurslar/' . $course['id'] . '/duzenle') ?>" class="btn btn-sm btn-outline"><i class="fas fa-edit"></i></a>
                <a href="<?= url('admin/kurslar/' . $course['id'] . '/sil') ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediginize emin misiniz?')"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($courses)): ?>
        <tr><td colspan="6" class="text-center">Henuz kurs yok</td></tr>
        <?php endif; ?>
    </tbody>
</table>