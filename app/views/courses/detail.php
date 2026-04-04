<!-- Course Hero -->
<section class="course-hero">
    <div class="container">
        <div class="course-hero-grid">
            <div class="course-hero-content">
                <?php if ($course['category_name']): ?>
                    <span class="course-category"><?= e($course['category_name']) ?></span>
                <?php endif; ?>
                <h1><?= e($course['title']) ?></h1>
                <?php if ($course['short_description']): ?>
                    <p class="course-subtitle"><?= e($course['short_description']) ?></p>
                <?php endif; ?>
                <div class="course-meta-hero">
                    <span><i class="fas fa-user"></i> <?= e($course['instructor_first_name'] . ' ' . $course['instructor_last_name']) ?></span>
                    <?php if ($course['duration']): ?>
                        <span><i class="fas fa-clock"></i> <?= e($course['duration']) ?></span>
                    <?php endif; ?>
                    <span><i class="fas fa-signal"></i> <?= $course['level'] === 'beginner' ? 'Baslangic' : ($course['level'] === 'intermediate' ? 'Orta' : 'Ileri') ?></span>
                    <?php if ($course['last_updated']): ?>
                        <span><i class="fas fa-sync"></i> <?= date('d.m.Y', strtotime($course['last_updated'])) ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Price Card -->
            <div class="course-price-card">
                <?php if ($course['preview_video']): ?>
                <div class="preview-video">
                    <div class="video-placeholder" data-video="<?= e($course['preview_video']) ?>">
                        <i class="fas fa-play-circle fa-3x"></i>
                        <span>Tanitim Videosunu Izle</span>
                    </div>
                </div>
                <?php endif; ?>

                <div class="price-card-body">
                    <div class="course-price-big">
                        <?php if ($course['is_free']): ?>
                            <span class="price-current-big">Ucretsiz</span>
                        <?php else: ?>
                            <?php if ($course['sale_price']): ?>
                                <span class="price-old-big"><?= formatPrice($course['price']) ?></span>
                            <?php endif; ?>
                            <span class="price-current-big"><?= formatPrice($course['sale_price'] ?? $course['price']) ?></span>
                        <?php endif; ?>
                    </div>

                    <?php if ($isEnrolled): ?>
                        <a href="<?= url('panel/kurs/' . $course['slug']) ?>" class="btn btn-success btn-block btn-lg">
                            <i class="fas fa-play"></i> Egitime Devam Et
                        </a>
                    <?php else: ?>
                        <form action="<?= url('sepete-ekle/' . $course['slug']) ?>" method="POST">
                            <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">
                                <i class="fas fa-cart-plus"></i> Sepete Ekle
                            </button>
                        </form>

                        <?php if (!$course['is_free']): ?>
                        <p class="installment-info"><i class="fas fa-credit-card"></i> Pesin Fiyatina 3 Taksit</p>
                        <?php endif; ?>
                    <?php endif; ?>

                    <ul class="price-card-features">
                        <li><i class="fas fa-check"></i> Omur Boyu Erisim</li>
                        <li><i class="fas fa-check"></i> Bire Bir Egitmen Destegi</li>
                        <li><i class="fas fa-check"></i> Sertifika</li>
                        <li><i class="fas fa-check"></i> Canli Yayinlar</li>
                        <li><i class="fas fa-check"></i> Topluluk Destegi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Course Content Tabs -->
<section class="section course-content-section">
    <div class="container">
        <div class="tabs">
            <button class="tab-btn active" data-tab="curriculum">Kurs Icerigi</button>
            <button class="tab-btn" data-tab="description">Aciklama</button>
            <button class="tab-btn" data-tab="instructor">Egitmen</button>
        </div>

        <!-- Curriculum Tab -->
        <div class="tab-content active" id="tab-curriculum">
            <?php if (empty($sections)): ?>
                <p>Mufredat henuz eklenmemis.</p>
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
                                        <span class="badge badge-free-sm">Onizleme</span>
                                    <?php endif; ?>
                                </span>
                                <?php if ($lesson['video_duration']): ?>
                                    <span class="lesson-duration"><?= formatDuration($lesson['video_duration']) ?></span>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Description Tab -->
        <div class="tab-content" id="tab-description">
            <div class="course-description">
                <?= $course['description'] ?>
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
</section>

<!-- Related Courses -->
<?php if (!empty($relatedCourses)): ?>
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Benzer Egitimler</h2>
        </div>
        <div class="courses-grid">
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
                    <div class="course-price">
                        <?php if ($rc['is_free']): ?>
                            <span class="price-current">Ucretsiz</span>
                        <?php else: ?>
                            <?php if ($rc['sale_price']): ?>
                                <span class="price-old"><?= formatPrice($rc['price']) ?></span>
                            <?php endif; ?>
                            <span class="price-current"><?= formatPrice($rc['sale_price'] ?? $rc['price']) ?></span>
                        <?php endif; ?>
                    </div>
                    <a href="<?= url('egitim/' . $rc['slug']) ?>" class="btn btn-primary btn-block">Detay</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>