<!-- Panel Header -->
<section class="panel-hero">
    <div class="container">
        <div class="panel-hero-inner">
            <div class="panel-avatar">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="panel-user-info">
                <h2><?= e(currentUser()['first_name'] ?? '') ?> <?= e(currentUser()['last_name'] ?? '') ?></h2>
                <div class="panel-user-stats">
                    <span><i class="fas fa-book"></i> <?= count($myCourses) ?> Alinan Egitim</span>
                    <span><i class="fas fa-certificate"></i> <?= $certificateCount ?? 0 ?> Katılım Belgesi</span>
                </div>
            </div>
            <a href="<?= url('egitimler') ?>" class="btn btn-panel-cta">Tüm Eğitimler <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<section class="section panel-section">
    <div class="container">
        <div class="panel-layout">
            <!-- Sidebar -->
            <aside class="panel-sidebar">
                <div class="panel-sidebar-greeting">
                    <small><?= strtoupper(e(currentUser()['first_name'] ?? '')) ?> <?= strtoupper(e(currentUser()['last_name'] ?? '')) ?> HOŞ GELDİN!</small>
                </div>
                <nav class="panel-nav">
                    <a href="<?= url('panel') ?>" class="panel-nav-item active">
                        <i class="fas fa-home"></i> Pano
                    </a>
                    <a href="<?= url('panel/profil') ?>" class="panel-nav-item">
                        <i class="fas fa-user"></i> Profil
                    </a>
                    <a href="<?= url('panel') ?>" class="panel-nav-item">
                        <i class="fas fa-book-open"></i> Egitimler
                    </a>
                    <a href="<?= url('panel/sertifikalar') ?>" class="panel-nav-item">
                        <i class="fas fa-certificate"></i> Katılım Belgeleri
                    </a>
                    <a href="<?= url('panel/siparisler') ?>" class="panel-nav-item">
                        <i class="fas fa-shopping-bag"></i> Siparişler
                    </a>
                    <a href="<?= url('panel/gorusme') ?>" class="panel-nav-item">
                        <i class="fas fa-comments"></i> Bire Bir Görüşme
                    </a>
                </nav>
                <div class="panel-nav-divider">DIGER</div>
                <nav class="panel-nav">
                    <a href="<?= url('panel/profil') ?>" class="panel-nav-item">
                        <i class="fas fa-cog"></i> Ayarlar
                    </a>
                    <a href="<?= url('cikis') ?>" class="panel-nav-item panel-nav-logout">
                        <i class="fas fa-sign-out-alt"></i> Cikis
                    </a>
                </nav>
            </aside>

            <!-- Main Content -->
            <div class="panel-main">
                <h3 class="panel-title">Pano</h3>

                <!-- Stats Cards -->
                <div class="panel-stats-grid">
                    <div class="panel-stat-card panel-stat-purple">
                        <div class="panel-stat-icon"><i class="fas fa-book-open"></i></div>
                        <div class="panel-stat-number"><?= count(array_filter($myCourses, fn($c) => $c['progress']['percentage'] < 100)) ?></div>
                        <div class="panel-stat-label">DEVAM EDEN EGITIM SAYISI</div>
                    </div>
                    <div class="panel-stat-card panel-stat-blue">
                        <div class="panel-stat-icon"><i class="fas fa-desktop"></i></div>
                        <div class="panel-stat-number"><?= count(array_filter($myCourses, fn($c) => $c['progress']['percentage'] >= 100)) ?></div>
                        <div class="panel-stat-label">TAMAMLANAN EGITIM SAYISI</div>
                    </div>
                </div>

                <!-- Active Courses -->
                <?php if (!empty($myCourses)): ?>
                <h3 class="panel-title" style="margin-top: 2rem;">Aktif Egitimler</h3>
                <div class="panel-tabs">
                    <button class="panel-tab active">Aktif Egitimler</button>
                    <button class="panel-tab">Tamamlanan Egitimler</button>
                </div>
                <div class="panel-courses-grid">
                    <?php foreach ($myCourses as $course): ?>
                    <div class="panel-course-card">
                        <div class="panel-course-thumb">
                            <?php if ($course['thumbnail']): ?>
                                <img src="<?= url($course['thumbnail']) ?>" alt="" loading="lazy">
                            <?php else: ?>
                                <div class="course-thumb-placeholder"><i class="fas fa-play-circle"></i></div>
                            <?php endif; ?>
                        </div>
                        <div class="panel-course-info">
                            <h4><?= e($course['title']) ?></h4>
                            <p class="panel-course-instructor"><i class="fas fa-user"></i> <?= e($course['instructor_first_name'] . ' ' . $course['instructor_last_name']) ?></p>
                            <div class="panel-progress">
                                <span class="panel-progress-label">TAMAMLANDI</span>
                                <span class="panel-progress-pct"><?= $course['progress']['percentage'] ?>%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: <?= $course['progress']['percentage'] ?>%"></div>
                            </div>
                            <a href="<?= url('panel/kurs/' . $course['slug']) ?>" class="btn btn-primary btn-block" style="margin-top: 0.75rem;">
                                <i class="fas fa-play"></i> Devam Et
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-graduation-cap fa-3x"></i>
                        <h3>Henuz Egitim Almadiniz</h3>
                        <p>Eğitimlerimize göz atin ve öğrenmeye başlayın.</p>
                        <a href="<?= url('egitimler') ?>" class="btn btn-primary">Eğitimleri İncele</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
