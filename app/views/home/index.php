<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1><?= e($settings['hero_title'] ?? 'Dijital Pazarlamayi En Iyi Sekilde Ogrenmeye Hazir Misiniz?') ?></h1>
            <p><?= e($settings['hero_subtitle'] ?? 'Uzman egitmenlerle, pratik odakli egitimlerle kariyerinizi bir ust seviyeye tasiyin.') ?></p>
            <div class="hero-buttons">
                <a href="<?= url('egitimler') ?>" class="btn btn-primary btn-lg">Egitimleri Incele</a>
                <a href="<?= url('kayit') ?>" class="btn btn-outline btn-lg">Ucretsiz Kayit Ol</a>
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="stats-bar">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-number" data-count="50000">0</span>
                <span class="stat-label">Ogrenci</span>
            </div>
            <div class="stat-item">
                <span class="stat-number" data-count="<?= count($courses) ?>">0</span>
                <span class="stat-label">Online Egitim</span>
            </div>
            <div class="stat-item">
                <span class="stat-number" data-count="10">0</span>
                <span class="stat-label">Uzman Egitmen</span>
            </div>
            <div class="stat-item">
                <span class="stat-number" data-count="8">0</span>
                <span class="stat-label">Yillik Deneyim</span>
            </div>
        </div>
    </div>
</section>

<!-- Courses -->
<section class="section courses-section">
    <div class="container">
        <div class="section-header">
            <h2>Online Egitimler</h2>
            <p>Uzman egitmenlerden dijital pazarlamanin tum alanlarinda egitim alin</p>
        </div>
        <div class="courses-grid">
            <?php foreach ($courses as $course): ?>
            <div class="course-card">
                <div class="course-thumb">
                    <?php if ($course['thumbnail']): ?>
                        <img src="<?= url($course['thumbnail']) ?>" alt="<?= e($course['title']) ?>" loading="lazy">
                    <?php else: ?>
                        <div class="course-thumb-placeholder">
                            <i class="fas fa-play-circle"></i>
                        </div>
                    <?php endif; ?>
                    <?php if ($course['is_free']): ?>
                        <span class="badge badge-free">Ucretsiz</span>
                    <?php elseif ($course['sale_price']): ?>
                        <span class="badge badge-sale">Indirim</span>
                    <?php endif; ?>
                </div>
                <div class="course-info">
                    <h3><a href="<?= url('egitim/' . $course['slug']) ?>"><?= e($course['title']) ?></a></h3>
                    <div class="course-meta">
                        <span><i class="fas fa-user"></i> <?= e($course['instructor_first_name'] . ' ' . $course['instructor_last_name']) ?></span>
                        <?php if ($course['duration']): ?>
                            <span><i class="fas fa-clock"></i> <?= e($course['duration']) ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="course-price">
                        <?php if ($course['is_free']): ?>
                            <span class="price-current">Ucretsiz</span>
                        <?php else: ?>
                            <?php if ($course['sale_price']): ?>
                                <span class="price-old"><?= formatPrice($course['price']) ?></span>
                            <?php endif; ?>
                            <span class="price-current"><?= formatPrice($course['sale_price'] ?? $course['price']) ?></span>
                        <?php endif; ?>
                    </div>
                    <a href="<?= url('egitim/' . $course['slug']) ?>" class="btn btn-primary btn-block">Detay</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Advantages -->
<section class="section advantages-section">
    <div class="container">
        <div class="section-header">
            <h2>Neden Reklam Okulu?</h2>
            <p>Egitimlerimizle fark yaratan ozellikler</p>
        </div>
        <div class="advantages-grid">
            <div class="advantage-card">
                <div class="advantage-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <h3>Bire Bir Egitmen Destegi</h3>
                <p>Her kurs icin 2x30 dakika ucretsiz bire bir gorusme hakki</p>
            </div>
            <div class="advantage-card">
                <div class="advantage-icon"><i class="fas fa-video"></i></div>
                <h3>Canli Yayinlar</h3>
                <p>Duzenlenen canli yayinlara omur boyu ucretsiz erisim</p>
            </div>
            <div class="advantage-card">
                <div class="advantage-icon"><i class="fas fa-sync-alt"></i></div>
                <h3>Guncel Icerik</h3>
                <p>Surekli guncellenen egitim icerikleri, ek ucret yok</p>
            </div>
            <div class="advantage-card">
                <div class="advantage-icon"><i class="fas fa-infinity"></i></div>
                <h3>Omur Boyu Erisim</h3>
                <p>Bir kez odeyin, sonsuza kadar erisim saglayin</p>
            </div>
            <div class="advantage-card">
                <div class="advantage-icon"><i class="fas fa-users"></i></div>
                <h3>Topluluk Destegi</h3>
                <p>WhatsApp ve Telegram gruplariyla surekli destek</p>
            </div>
            <div class="advantage-card">
                <div class="advantage-icon"><i class="fas fa-certificate"></i></div>
                <h3>Sertifika</h3>
                <p>Egitim sonunda imzali katilim sertifikasi</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <h2>Dijital Pazarlama Kariyerinize Baslayin</h2>
        <p>Ucretsiz temel egitimimizle hemen baslayabilirsiniz</p>
        <a href="<?= url('egitimler') ?>" class="btn btn-white btn-lg">Hemen Baslayalim</a>
    </div>
</section>