<!DOCTYPE html>
<html lang="tr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Admin') ?> - Reklam Okulu Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= url('css/style.css') ?>">
    <link rel="stylesheet" href="<?= url('css/admin.css') ?>">
</head>
<body class="admin-body">

<div class="admin-layout">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="admin-logo">
            <a href="<?= url('admin') ?>">Reklam<strong>Okulu</strong></a>
            <small>Admin Panel</small>
        </div>
        <nav class="admin-nav">
            <a href="<?= url('admin') ?>" class="<?= !isset($view) ? 'active' : '' ?>">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a href="<?= url('admin/kurslar') ?>" class="<?= ($view ?? '') === 'courses' || ($view ?? '') === 'course-form' ? 'active' : '' ?>">
                <i class="fas fa-graduation-cap"></i> Kurslar
            </a>
            <a href="<?= url('admin/kullanicilar') ?>" class="<?= ($view ?? '') === 'users' ? 'active' : '' ?>">
                <i class="fas fa-users"></i> Kullanicilar
            </a>
            <a href="<?= url('admin/siparişler') ?>" class="<?= ($view ?? '') === 'orders' ? 'active' : '' ?>">
                <i class="fas fa-shopping-bag"></i> Siparişler
            </a>
            <a href="<?= url('admin/blog') ?>" class="<?= ($view ?? '') === 'blog-posts' || ($view ?? '') === 'blog-form' ? 'active' : '' ?>">
                <i class="fas fa-newspaper"></i> Blog
            </a>
            <a href="<?= url('admin/mesajlar') ?>" class="<?= ($view ?? '') === 'messages' ? 'active' : '' ?>">
                <i class="fas fa-envelope"></i> Mesajlar
            </a>
            <a href="<?= url('admin/ayarlar') ?>" class="<?= ($view ?? '') === 'settings' ? 'active' : '' ?>">
                <i class="fas fa-cog"></i> Ayarlar
            </a>
            <hr>
            <a href="<?= url('') ?>" target="_blank"><i class="fas fa-external-link-alt"></i> Siteyi Gor</a>
            <a href="<?= url('cikis') ?>"><i class="fas fa-sign-out-alt"></i> Çıkış</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="admin-topbar">
            <button class="admin-sidebar-toggle" id="sidebarToggle"><i class="fas fa-bars"></i></button>
            <div class="admin-user">
                <span><?= e(currentUser()['first_name'] . ' ' . currentUser()['last_name']) ?></span>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if ($successMsg = getFlash('success')): ?>
        <div class="alert alert-success"><?= $successMsg ?></div>
        <?php endif; ?>
        <?php if ($errorMsg = getFlash('error')): ?>
        <div class="alert alert-error"><?= $errorMsg ?></div>
        <?php endif; ?>

        <div class="admin-content">
            <?php
            $viewFile = __DIR__ . '/' . ($view ?? 'dashboard') . '.php';
            if (file_exists($viewFile)) {
                require $viewFile;
            } else {
                require __DIR__ . '/dashboard.php';
            }
            ?>
        </div>
    </main>
</div>

<script src="<?= url('js/app.js') ?>"></script>
<script src="<?= url('js/admin.js') ?>"></script>
</body>
</html>