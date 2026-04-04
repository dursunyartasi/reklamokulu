<section class="section">
    <div class="container">
        <div class="instructor-profile">
            <div class="instructor-avatar-big">
                <?php if ($instructor['avatar']): ?>
                    <img src="<?= url($instructor['avatar']) ?>" alt="">
                <?php else: ?>
                    <div class="avatar-placeholder-big"><i class="fas fa-user fa-3x"></i></div>
                <?php endif; ?>
            </div>
            <h1><?= e($instructor['first_name'] . ' ' . $instructor['last_name']) ?></h1>
            <?php if ($instructor['expertise']): ?>
                <p class="instructor-expertise"><?= e($instructor['expertise']) ?></p>
            <?php endif; ?>
            <?php if ($instructor['bio']): ?>
                <div class="instructor-bio-full"><?= e($instructor['bio']) ?></div>
            <?php endif; ?>
        </div>

        <?php if (!empty($courses)): ?>
        <div class="section-header">
            <h2>Egitimleri</h2>
        </div>
        <div class="courses-grid">
            <?php foreach ($courses as $course): ?>
            <div class="course-card">
                <div class="course-thumb">
                    <?php if ($course['thumbnail']): ?>
                        <img src="<?= url($course['thumbnail']) ?>" alt="" loading="lazy">
                    <?php else: ?>
                        <div class="course-thumb-placeholder"><i class="fas fa-play-circle"></i></div>
                    <?php endif; ?>
                </div>
                <div class="course-info">
                    <h3><a href="<?= url('egitim/' . $course['slug']) ?>"><?= e($course['title']) ?></a></h3>
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
                    <a href="<?= url('egitim/' . $course['slug']) ?>" class="btn btn-primary btn-block">Detay</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>