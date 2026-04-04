<h1>Kullanıcılar</h1>

<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ad Soyad</th>
            <th>E-Posta</th>
            <th>Rol</th>
            <th>Kayit Tarihi</th>
            <th>Durum</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= e($user['first_name'] . ' ' . $user['last_name']) ?></td>
            <td><?= e($user['email']) ?></td>
            <td>
                <span class="role-badge role-<?= $user['role'] ?>">
                    <?= $user['role'] === 'admin' ? 'Admin' : ($user['role'] === 'instructor' ? 'Egitmen' : 'Öğrenci') ?>
                </span>
            </td>
            <td><?= date('d.m.Y', strtotime($user['created_at'])) ?></td>
            <td>
                <span class="status-badge <?= $user['is_active'] ? 'status-completed' : 'status-failed' ?>">
                    <?= $user['is_active'] ? 'Aktif' : 'Pasif' ?>
                </span>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>