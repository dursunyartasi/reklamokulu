<section class="section">
    <div class="container">
        <div class="section-header">
            <h1>Online Eğitimler</h1>
            <p>Tum eğitimlerimizi inceleyin ve kariyerinize yatirim yapin</p>
        </div>

        <div class="courses-grid">
            <?php if (empty($courses)): ?>
                <p class="text-center">Henuz eğitim eklenmemis.</p>
            <?php endif; ?>

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
                        <span class="badge badge-free">Ücretsiz</span>
                    <?php elseif ($course['sale_price']): ?>
                        <span class="badge badge-sale">İndirim</span>
                    <?php endif; ?>
                </div>
                <div class="course-info">
                    <h3><a href="<?= url('egitim/' . $course['slug']) ?>"><?= e($course['title']) ?></a></h3>
                    <div class="course-meta">
                        <span><i class="fas fa-user"></i> <?= e($course['instructor_first_name'] . ' ' . $course['instructor_last_name']) ?></span>
                        <?php if ($course['duration']): ?>
                            <span><i class="fas fa-clock"></i> <?= e($course['duration']) ?></span>
                        <?php endif; ?>
                        <?php if ($course['total_students'] > 0): ?>
                            <span><i class="fas fa-users"></i> <?= $course['total_students'] ?> öğrenci</span>
                        <?php endif; ?>
                    </div>
                    <div class="course-price">
                        <?php if ($course['is_free']): ?>
                            <span class="price-current">Ücretsiz</span>
                        <?php else: ?>
                            <?php if ($course['sale_price']): ?>
                                <span class="price-old"><?= formatPrice($course['price']) ?></span>
                            <?php endif; ?>
                            <span class="price-current"><?= formatPrice($course['sale_price'] ?? $course['price']) ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="course-actions">
                        <a href="<?= url('egitim/' . $course['slug']) ?>" class="btn btn-primary btn-block">Detay</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>