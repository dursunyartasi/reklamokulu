<h1><?= isset($post) ? 'Blog Yazisi Duzenle' : 'Yeni Blog Yazisi' ?></h1>

<form action="<?= isset($post) ? url('admin/blog/' . $post['id'] . '/guncelle') : url('admin/blog/kaydet') ?>"
      method="POST" enctype="multipart/form-data" class="admin-form">
    <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

    <div class="form-group">
        <label>Baslik *</label>
        <input type="text" name="title" value="<?= e($post['title'] ?? '') ?>" required>
    </div>

    <div class="form-group">
        <label>Ozet</label>
        <input type="text" name="excerpt" value="<?= e($post['excerpt'] ?? '') ?>" maxlength="500">
    </div>

    <div class="form-group">
        <label>Icerik</label>
        <textarea name="content" rows="15" id="blogContent"><?= e($post['content'] ?? '') ?></textarea>
        <small>HTML kullanabilirsiniz. Ornek: &lt;p&gt;, &lt;h2&gt;, &lt;ul&gt;, &lt;strong&gt;</small>
    </div>

    <div class="form-group">
        <label>Kapak Gorseli</label>
        <input type="file" name="thumbnail" accept="image/*">
        <?php if (isset($post) && $post['thumbnail']): ?>
            <img src="<?= url($post['thumbnail']) ?>" alt="" class="form-preview-img" style="margin-top:0.5rem;max-height:150px;border-radius:8px;">
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label class="checkbox-label">
            <input type="checkbox" name="is_published" <?= (isset($post) && $post['is_published']) ? 'checked' : '' ?>> Yayinla
        </label>
    </div>

    <button type="submit" class="btn btn-primary btn-lg"><?= isset($post) ? 'Guncelle' : 'Kaydet' ?></button>
</form>
