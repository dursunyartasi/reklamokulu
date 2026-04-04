<!DOCTYPE html>
<html lang="tr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Reklam Okulu') ?></title>
    <meta name="description" content="<?= e($settings['site_description'] ?? 'Dijital Pazarlama Egitim Platformu') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= url('css/style.css') ?>?v=20260405">
</head>
<body>

<!-- Top Bar -->
<div class="top-bar">
    <div class="container">
        <div class="top-bar-inner">
            <form class="search-bar" action="<?= url('egitimler') ?>" method="GET">
                <input type="text" name="q" placeholder="Egitim Arama" value="<?= e($_GET['q'] ?? '') ?>">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
            <div class="top-bar-actions">
                <a href="<?= url('sepet') ?>" class="top-cart-btn">
                    <i class="fas fa-shopping-cart"></i> Sepet
                    <?php $cartCount = count($_SESSION['cart'] ?? []); ?>
                    <?php if ($cartCount > 0): ?>
                        <span class="cart-badge"><?= $cartCount ?></span>
                    <?php endif; ?>
                </a>
                <?php if (isLoggedIn()): ?>
                    <a href="<?= url('panel') ?>" class="top-user-btn">
                        <i class="fas fa-user"></i> <?= e(currentUser()['first_name'] ?? '') ?> <?= e(currentUser()['last_name'] ?? '') ?>
                    </a>
                <?php else: ?>
                    <a href="<?= url('giris') ?>" class="top-user-btn">
                        <i class="fas fa-user"></i> Giris Yap
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Header -->
<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <a href="<?= url('') ?>" class="logo">
                <span class="logo-text">Reklam<strong>Okulu</strong></span>
            </a>

            <nav class="main-nav" id="mainNav">
                <div class="nav-item has-dropdown">
                    <a href="<?= url('egitimler') ?>">Online Egitimler <i class="fas fa-chevron-down"></i></a>
                </div>
                <a href="<?= url('egitmenler') ?>">Egitmenler</a>
                <a href="<?= url('kurumsal-egitimler') ?>">Kurumsal Egitim</a>
                <a href="<?= url('blog') ?>">Blog</a>
                <a href="<?= url('neden-biz') ?>">Neden Biz?</a>
                <a href="<?= url('iletisim') ?>">Iletisim</a>
            </nav>

            <div class="header-actions">
                <button class="theme-toggle" id="themeToggle" title="Tema Degistir">
                    <i class="fas fa-moon"></i>
                </button>

                <?php if (isLoggedIn()): ?>
                    <a href="<?= url('panel') ?>" class="btn btn-panel">
                        <?php if (isAdmin()): ?>
                            Admin Paneli
                        <?php else: ?>
                            Ogrenci Paneli
                        <?php endif; ?>
                    </a>
                    <div class="user-menu">
                        <button class="user-menu-btn">
                            <i class="fas fa-user-circle"></i>
                        </button>
                        <div class="user-dropdown">
                            <?php if (isAdmin()): ?>
                                <a href="<?= url('admin') ?>"><i class="fas fa-cog"></i> Admin Panel</a>
                            <?php endif; ?>
                            <a href="<?= url('panel') ?>"><i class="fas fa-th-large"></i> Panelim</a>
                            <a href="<?= url('panel/sertifikalar') ?>"><i class="fas fa-certificate"></i> Sertifikalar</a>
                            <a href="<?= url('panel/profil') ?>"><i class="fas fa-user"></i> Profilim</a>
                            <a href="<?= url('cikis') ?>" class="logout-link"><i class="fas fa-sign-out-alt"></i> Cikis</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="<?= url('kayit') ?>" class="btn btn-panel">Ucretsiz Kayit Ol</a>
                <?php endif; ?>

                <button class="mobile-toggle" id="mobileToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Flash Messages -->
<?php if ($successMsg = getFlash('success')): ?>
<div class="alert alert-success">
    <div class="container"><?= $successMsg ?></div>
</div>
<?php endif; ?>
<?php if ($errorMsg = getFlash('error')): ?>
<div class="alert alert-error">
    <div class="container"><?= $errorMsg ?></div>
</div>
<?php endif; ?>

<main>
