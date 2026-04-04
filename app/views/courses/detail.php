<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container">
        <a href="<?= url('') ?>">Anasayfa</a> <i class="fas fa-chevron-right"></i>
        <a href="<?= url('egitimler') ?>">Eğitimlerimiz</a> <i class="fas fa-chevron-right"></i>
        <span><?= e($course['title']) ?></span>
    </div>
</div>

<!-- Course Hero -->
<section class="course-hero">
    <div class="container">
        <div class="course-hero-grid">
            <div class="course-hero-content">
                <h1><?= e($course['title']) ?></h1>
                <?php if ($course['short_description']): ?>
                    <p class="course-subtitle"><?= e($course['short_description']) ?></p>
                <?php endif; ?>

                <div class="course-hero-badges">
                    <span class="hero-feature-badge"><i class="fas fa-bullseye"></i> Bire Bir Eğitmen Desteği</span>
                    <span class="hero-feature-badge"><i class="fas fa-comments"></i> Soru Cevap Grupları</span>
                    <span class="hero-feature-badge"><i class="fas fa-video"></i> Canlı Yayınlar</span>
                </div>

                <div class="course-meta-hero">
                    <span><i class="fas fa-heart"></i> Canli ve Bire Bir Eğitmen Desteği (2 x 30 dk ücretsiz)</span>
                    <span><i class="fas fa-comment-dots"></i> Canlı Yayınlara Katilim Hakki</span>
                    <span><i class="fas fa-users"></i> Telegram Grubu Soru & Cevap Destegi</span>
                    <span><i class="fas fa-certificate"></i> Katılım Belgesi</span>
                    <?php if ($course['category_name']): ?>
                        <span><i class="fas fa-folder"></i> Kategori: <?= e($course['category_name']) ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Price Card (Sticky Sidebar) -->
            <div class="course-price-card">
                <?php if ($course['preview_video']): ?>
                <div class="preview-video">
                    <div class="video-placeholder" data-video="<?= e($course['preview_video']) ?>">
                        <i class="fas fa-play-circle fa-3x"></i>
                        <span><i class="fas fa-clock"></i> Egitmenden Dinleyin!</span>
                    </div>
                </div>
                <?php endif; ?>

                <div class="price-card-body">
                    <div class="course-price-big">
                        <?php if ($course['is_free']): ?>
                            <span class="price-current-big">Ücretsiz</span>
                        <?php else: ?>
                            <div class="price-row-with-badge">
                                <?php if ($course['sale_price']): ?>
                                    <span class="price-old-big"><?= formatPrice($course['price']) ?></span>
                                <?php endif; ?>
                                <span class="price-current-big"><?= formatPrice($course['sale_price'] ?? $course['price']) ?></span>
                                <span class="campaign-badge"><i class="fas fa-clock"></i> Kampanya</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($isEnrolled): ?>
                        <a href="<?= url('panel/kurs/' . $course['slug']) ?>" class="btn btn-cta btn-block btn-lg">
                            <i class="fas fa-play"></i> İzlemeye Basla
                        </a>
                    <?php else: ?>
                        <form action="<?= url('sepete-ekle/' . $course['slug']) ?>" method="POST">
                            <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">
                            <button type="submit" class="btn btn-cta btn-block btn-lg">
                                İzlemeye Basla
                            </button>
                        </form>
                    <?php endif; ?>

                    <?php if (!$course['is_free']): ?>
                    <p class="installment-info">Peşin Fiyatına 3 Taksit</p>
                    <p class="installment-info"><i class="fas fa-infinity"></i> Ömür Boyu Ücretsiz Erisim</p>
                    <?php endif; ?>

                    <ul class="price-card-features">
                        <?php if ($course['category_name']): ?>
                        <li><span>Kategori</span><strong><?= e($course['category_name']) ?></strong></li>
                        <?php endif; ?>
                        <?php if ($course['duration']): ?>
                        <li><span>Sure</span><strong><?= e($course['duration']) ?></strong></li>
                        <?php endif; ?>
                        <?php if ($course['last_updated']): ?>
                        <li><span>Son Güncelleme</span><strong><?= date('d M Y', strtotime($course['last_updated'])) ?></strong></li>
                        <?php endif; ?>
                        <li><span>Egitmen</span><strong><?= e($course['instructor_first_name'] . ' ' . $course['instructor_last_name']) ?></strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Course Content Tabs -->
<section class="section course-content-section">
    <div class="container">
        <div class="course-detail-layout">
            <div class="course-detail-main">
                <div class="tabs">
                    <button class="tab-btn active" data-tab="advantages">Avantajlar</button>
                    <button class="tab-btn" data-tab="curriculum">Kurs İçeriği</button>
                    <button class="tab-btn" data-tab="faq">Sıkça Sorulan Sorular</button>
                    <button class="tab-btn" data-tab="instructor">Egitmen</button>
                </div>

                <!-- Advantages Tab -->
                <div class="tab-content active" id="tab-advantages">
                    <h3>Bu Egitimde Neler Öğreneceksin?</h3>
                    <div class="course-description">
                        <?= $course['description'] ?>
                    </div>

                    <h3 style="margin-top: 2rem;">Eğitimin Avantajları</h3>
                    <div class="advantage-list">
                        <div class="advantage-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p>Bire bir eğitmen destegi ile diledigin zaman canli görüşme yapabilirsin.</p>
                        </div>
                        <div class="advantage-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p>Her hafta duzenlenen canlı yayınlara ömür boyu ücretsiz katilabilirsin.</p>
                        </div>
                        <div class="advantage-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p>Egitim surekli güncellenir, her zaman en guncel bilgilere erisirsin.</p>
                        </div>
                        <div class="advantage-list-item">
                            <i class="fas fa-check-circle"></i>
                            <p>Eğitimi başarıyla tamamladiginda eğitmen imzali katilim belgesine sahip olacaksin.</p>
                        </div>
                    </div>
                </div>

                <!-- Curriculum Tab -->
                <div class="tab-content" id="tab-curriculum">
                    <h3>Kurs İçeriği</h3>
                    <?php if (empty($sections)): ?>
                        <p>Müfredat henüz eklenmemis.</p>
                    <?php else: ?>
                        <div class="curriculum-list">
                            <?php foreach ($sections as $index => $section): ?>
                            <div class="curriculum-section">
                                <button class="section-toggle <?= $index === 0 ? 'active' : '' ?>">
                                    <span>
                                        <i class="fas fa-chevron-down"></i>
                                        <?= e($section['title']) ?>
                                    </span>
                                    <span class="section-info"><?= count($section['lessons']) ?> ders</span>
                                </button>
                                <div class="section-lessons" <?= $index === 0 ? 'style="display:block"' : '' ?>>
                                    <?php foreach ($section['lessons'] as $lesson): ?>
                                    <div class="lesson-item">
                                        <span class="lesson-title">
                                            <i class="fas fa-play-circle"></i>
                                            <?= e($lesson['title']) ?>
                                            <?php if ($lesson['is_free_preview']): ?>
                                                <span class="badge badge-free-sm">Önizleme</span>
                                            <?php endif; ?>
                                        </span>
                                        <span class="lesson-right">
                                            <?php if ($lesson['video_duration']): ?>
                                                <span class="lesson-duration"><?= formatDuration($lesson['video_duration']) ?></span>
                                            <?php endif; ?>
                                            <?php if (!$lesson['is_free_preview'] && !$isEnrolled): ?>
                                                <i class="fas fa-lock lesson-lock"></i>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- FAQ Tab -->
                <div class="tab-content" id="tab-faq">
                    <h3>Sıkça Sorulan Sorular</h3>
                    <div class="faq-list">
                        <div class="faq-item">
                            <button class="faq-question">Egitim seviyem dusuk, yine de katilabilir miyim?</button>
                            <div class="faq-answer">Evet! Egitimimiz sifirdan ileri seviyeye kadar tasarlanmıştır. Hiçbir on bilgiye ihtiyac duymadan başlayabilirsiniz.</div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question">Eğitimi ne kadar surede tamamlamaliyim?</button>
                            <div class="faq-answer">Süresiz erişim hakkınız var. Kendi hızınızda ilerlemeniz için herhangi bir zaman sınırı yoktur.</div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question">Taksit imkani var mi?</button>
                            <div class="faq-answer">Evet, peşin fiyatına 3 taksit imkanimiz mevcuttur. Kredi karti ile taksitli ödeme yapabilirsiniz.</div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question">Sertifika veriliyor mu?</button>
                            <div class="faq-answer">Evet, eğitimi başarıyla tamamladiginizda eğitmen imzali katilim belgesi tarafiniza iletilmektedir.</div>
                        </div>
                    </div>
                </div>

                <!-- Instructor Tab -->
                <div class="tab-content" id="tab-instructor">
                    <div class="instructor-card">
                        <div class="instructor-avatar">
                            <?php if ($course['instructor_avatar']): ?>
                                <img src="<?= url($course['instructor_avatar']) ?>" alt="">
                            <?php else: ?>
                                <div class="avatar-placeholder"><i class="fas fa-user fa-2x"></i></div>
                            <?php endif; ?>
                        </div>
                        <div class="instructor-info">
                            <h3><?= e($course['instructor_first_name'] . ' ' . $course['instructor_last_name']) ?></h3>
                            <?php if ($course['instructor_title']): ?>
                                <p class="instructor-title"><?= e($course['instructor_title']) ?></p>
                            <?php endif; ?>
                            <?php if ($course['instructor_bio']): ?>
                                <p><?= e($course['instructor_bio']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Courses -->
<?php if (!empty($relatedCourses)): ?>
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Benzer Eğitimler</h2>
        </div>
        <div class="courses-grid courses-grid-4">
            <?php foreach ($relatedCourses as $rc): ?>
            <div class="course-card">
                <div class="course-thumb">
                    <?php if ($rc['thumbnail']): ?>
                        <img src="<?= url($rc['thumbnail']) ?>" alt="<?= e($rc['title']) ?>" loading="lazy">
                    <?php else: ?>
                        <div class="course-thumb-placeholder"><i class="fas fa-play-circle"></i></div>
                    <?php endif; ?>
                </div>
                <div class="course-info">
                    <h3><a href="<?= url('egitim/' . $rc['slug']) ?>"><?= e($rc['title']) ?></a></h3>
                    <div class="course-price-row">
                        <div class="course-price">
                            <?php if ($rc['is_free']): ?>
                                <span class="price-current">Ücretsiz</span>
                            <?php else: ?>
                                <?php if ($rc['sale_price']): ?>
                                    <span class="price-old"><?= formatPrice($rc['price']) ?></span>
                                <?php endif; ?>
                                <span class="price-current"><?= formatPrice($rc['sale_price'] ?? $rc['price']) ?></span>
                            <?php endif; ?>
                        </div>
                        <a href="<?= url('egitim/' . $rc['slug']) ?>" class="course-link">Satın Al <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
