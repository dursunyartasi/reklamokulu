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
    <link rel="stylesheet" href="<?= url('css/style.css') ?>">
</head>
<body>

<!-- Countdown Bar -->
<?php if (!empty($settings['countdown_date'])): ?>
<div id="countdown-bar">
    <div class="container">
        <span class="countdown-text"><?= e($settings['countdown_text'] ?? 'Kampanya bitis tarihi:') ?></span>
        <div class="countdown-timer" data-date="<?= e($settings['countdown_date']) ?>">
            <span class="cd-days">0</span>g
            <span class="cd-hours">0</span>s
            <span class="cd-minutes">0</span>dk
            <span class="cd-seconds">0</span>sn
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Header -->
<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <a href="<?= url('') ?>" class="logo">
                <span class="logo-text">Reklam<strong>Okulu</strong></span>
            </a>

            <nav class="main-nav" id="mainNav">
                <a href="<?= url('egitimler') ?>">Egitimler</a>
                <a href="<?= url('egitmenler') ?>">Egitmenler</a>
                <a href="<?= url('kurumsal-egitimler') ?>">Kurumsal</a>
                <a href="<?= url('blog') ?>">Blog</a>
                <a href="<?= url('neden-biz') ?>">Neden Biz?</a>
                <a href="<?= url('iletisim') ?>">Iletisim</a>
            </nav>

            <div class="header-actions">
                <a href="<?= url('sepet') ?>" class="cart-btn">
                    <i class="fas fa-shopping-cart"></i>
                    <?php $cartCount = count($_SESSION['cart'] ?? []); ?>
                    <?php if ($cartCount > 0): ?>
                        <span class="cart-badge"><?= $cartCount ?></span>
                    <?php endif; ?>
                </a>

                <button class="theme-toggle" id="themeToggle" title="Tema Degistir">
                    <i class="fas fa-moon"></i>
                </button>

                <?php if (isLoggedIn()): ?>
                    <div class="user-menu">
                        <button class="user-menu-btn">
                            <i class="fas fa-user-circle"></i>
                            <span><?= e(currentUser()['first_name'] ?? '') ?></span>
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
                    <a href="<?= url('giris') ?>" class="btn btn-primary btn-sm">Giris Yap</a>
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