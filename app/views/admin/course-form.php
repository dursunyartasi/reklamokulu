<h1><?= isset($course) ? 'Kurs Duzenle' : 'Yeni Kurs' ?></h1>

<form action="<?= isset($course) ? url('admin/kurslar/' . $course['id'] . '/guncelle') : url('admin/kurslar/kaydet') ?>"
      method="POST" enctype="multipart/form-data" class="admin-form">
    <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

    <div class="form-row-2">
        <div class="form-group">
            <label>Kurs Adi *</label>
            <input type="text" name="title" value="<?= e($course['title'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label>Egitmen *</label>
            <select name="instructor_id" required>
                <option value="">Secin...</option>
                <?php foreach ($instructors as $inst): ?>
                    <option value="<?= $inst['id'] ?>" <?= (isset($course) && $course['instructor_id'] == $inst['id']) ? 'selected' : '' ?>>
                        <?= e($inst['first_name'] . ' ' . $inst['last_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-row-2">
        <div class="form-group">
            <label>Kategori</label>
            <select name="category_id">
                <option value="">Secin...</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= (isset($course) && $course['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                        <?= e($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Seviye</label>
            <select name="level">
                <option value="beginner" <?= (isset($course) && $course['level'] === 'beginner') ? 'selected' : '' ?>>Baslangic</option>
                <option value="intermediate" <?= (isset($course) && $course['level'] === 'intermediate') ? 'selected' : '' ?>>Orta</option>
                <option value="advanced" <?= (isset($course) && $course['level'] === 'advanced') ? 'selected' : '' ?>>Ileri</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label>Kisa Aciklama</label>
        <input type="text" name="short_description" value="<?= e($course['short_description'] ?? '') ?>" maxlength="500">
    </div>

    <div class="form-group">
        <label>Detayli Aciklama</label>
        <textarea name="description" rows="8"><?= e($course['description'] ?? '') ?></textarea>
    </div>

    <div class="form-row-2">
        <div class="form-group">
            <label>Fiyat (TL)</label>
            <input type="number" name="price" step="0.01" value="<?= $course['price'] ?? '0' ?>">
        </div>
        <div class="form-group">
            <label>Indirimli Fiyat (TL)</label>
            <input type="number" name="sale_price" step="0.01" value="<?= $course['sale_price'] ?? '' ?>">
        </div>
    </div>

    <div class="form-row-2">
        <div class="form-group">
            <label>Sure</label>
            <input type="text" name="duration" value="<?= e($course['duration'] ?? '') ?>" placeholder="ornek: 10s 25dk">
        </div>
        <div class="form-group">
            <label>Tanitim Video URL</label>
            <input type="url" name="preview_video" value="<?= e($course['preview_video'] ?? '') ?>">
        </div>
    </div>

    <div class="form-group">
        <label>Kapak Gorseli</label>
        <input type="file" name="thumbnail" accept="image/*">
        <?php if (isset($course) && $course['thumbnail']): ?>
            <img src="<?= url($course['thumbnail']) ?>" alt="" class="form-preview-img">
        <?php endif; ?>
    </div>

    <div class="form-row-2">
        <div class="form-group">
            <label class="checkbox-label">
                <input type="checkbox" name="is_published" <?= (isset($course) && $course['is_published']) ? 'checked' : '' ?>>
                Yayinda
            </label>
        </div>
        <div class="form-group">
            <label class="checkbox-label">
                <input type="checkbox" name="is_free" <?= (isset($course) && $course['is_free']) ? 'checked' : '' ?>>
                Ucretsiz
            </label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-lg"><?= isset($course) ? 'Guncelle' : 'Kaydet' ?></button>
</form>

<?php if (isset($course) && isset($sections)): ?>
<hr>
<h2>Kurs Icerigi (Bolumler & Dersler)</h2>

<!-- Bolum Ekle -->
<form action="<?= url('admin/bolum-ekle') ?>" method="POST" class="inline-form">
    <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">
    <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
    <input type="text" name="title" placeholder="Bolum Adi" required>
    <input type="number" name="sort_order" placeholder="Sira" value="0" style="width:80px">
    <button type="submit" class="btn btn-primary btn-sm">Bolum Ekle</button>
</form>

<?php foreach ($sections as $section): ?>
<div class="admin-section-block">
    <h3><i class="fas fa-folder"></i> <?= e($section['title']) ?> (<?= count($section['lessons']) ?> ders)</h3>

    <!-- Ders Ekle -->
    <form action="<?= url('admin/ders-ekle') ?>" method="POST" class="inline-form">
        <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">
        <input type="hidden" name="section_id" value="<?= $section['id'] ?>">
        <input type="text" name="title" placeholder="Ders Adi" required>
        <input type="url" name="video_url" placeholder="Video URL">
        <input type="number" name="video_duration" placeholder="Sure (sn)" style="width:100px">
        <input type="number" name="sort_order" placeholder="Sira" value="0" style="width:80px">
        <label class="checkbox-label-inline">
            <input type="checkbox" name="is_free_preview"> Onizleme
        </label>
        <button type="submit" class="btn btn-primary btn-sm">Ders Ekle</button>
    </form>

    <?php if (!empty($section['lessons'])): ?>
    <table class="admin-table admin-table-sm">
        <thead>
            <tr><th>Sira</th><th>Ders Adi</th><th>Sure</th><th>Onizleme</th></tr>
        </thead>
        <tbody>
            <?php foreach ($section['lessons'] as $lesson): ?>
            <tr>
                <td><?= $lesson['sort_order'] ?></td>
                <td><?= e($lesson['title']) ?></td>
                <td><?= $lesson['video_duration'] ? formatDuration($lesson['video_duration']) : '-' ?></td>
                <td><?= $lesson['is_free_preview'] ? 'Evet' : '-' ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
<?php endforeach; ?>
<?php endif; ?>