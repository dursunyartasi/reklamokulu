<h1>Yeni Blog Yazisi</h1>

<form action="<?= url('admin/blog/kaydet') ?>" method="POST" enctype="multipart/form-data" class="admin-form">
    <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

    <div class="form-group">
        <label>Baslik *</label>
        <input type="text" name="title" required>
    </div>

    <div class="form-group">
        <label>Ozet</label>
        <input type="text" name="excerpt" maxlength="500">
    </div>

    <div class="form-group">
        <label>İçerik</label>
        <textarea name="content" rows="15"></textarea>
    </div>

    <div class="form-group">
        <label>Kapak Görseli</label>
        <input type="file" name="thumbnail" accept="image/*">
    </div>

    <div class="form-group">
        <label class="checkbox-label">
            <input type="checkbox" name="is_published"> Yayinla
        </label>
    </div>

    <button type="submit" class="btn btn-primary btn-lg">Kaydet</button>
</form>