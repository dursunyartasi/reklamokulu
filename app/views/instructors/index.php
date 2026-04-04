<section class="section">
    <div class="container">
        <div class="section-header">
            <h1>Egitmenlerimiz</h1>
            <p>Alaninda uzman egitmenlerle tanisin</p>
        </div>

        <div class="instructors-grid">
            <?php foreach ($instructors as $inst): ?>
            <div class="instructor-card-big">
                <div class="instructor-avatar-big">
                    <?php if ($inst['avatar']): ?>
                        <img src="<?= url($inst['avatar']) ?>" alt="<?= e($inst['first_name'] . ' ' . $inst['last_name']) ?>">
                    <?php else: ?>
                        <div class="avatar-placeholder-big"><i class="fas fa-user fa-3x"></i></div>
                    <?php endif; ?>
                </div>
                <h3><?= e($inst['first_name'] . ' ' . $inst['last_name']) ?></h3>
                <?php if ($inst['expertise']): ?>
                    <p class="instructor-expertise"><?= e($inst['expertise']) ?></p>
                <?php endif; ?>
                <?php if ($inst['bio']): ?>
                    <p class="instructor-bio-short"><?= e(mb_substr($inst['bio'], 0, 150)) ?>...</p>
                <?php endif; ?>
                <div class="instructor-links">
                    <?php if ($inst['linkedin']): ?>
                        <a href="<?= e($inst['linkedin']) ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <?php endif; ?>
                    <?php if ($inst['instagram']): ?>
                        <a href="<?= e($inst['instagram']) ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>
                </div>
                <a href="<?= url('egitmen/' . slugify($inst['first_name'] . ' ' . $inst['last_name'])) ?>" class="btn btn-outline btn-sm">Profili Gor</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>