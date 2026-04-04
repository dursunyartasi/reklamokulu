<section class="section">
    <div class="container">
        <div class="panel-header">
            <h1>Hosgeldiniz, <?= e(currentUser()['first_name'] ?? '') ?>!</h1>
            <p>Egitimlerinize buradan erisebilirsiniz</p>
        </div>

        <?php if (empty($myCourses)): ?>
            <div class="empty-state">
                <i class="fas fa-graduation-cap fa-3x"></i>
                <h3>Henuz Egitim Almadiniz</h3>
                <p>Egitimlerimize goz atin ve ogrenmeye baslayin.</p>
                <a href="<?= url('egitimler') ?>" class="btn btn-primary">Egitimleri Incele</a>
            </div>
        <?php else: ?>
            <div class="my-courses-grid">
                <?php foreach ($myCourses as $course): ?>
                <div class="my-course-card">
                    <div class="course-thumb">
                        <?php if ($course['thumbnail']): ?>
                            <img src="<?= url($course['thumbnail']) ?>" alt="" loading="lazy">
                        <?php else: ?>
                            <div class="course-thumb-placeholder"><i class="fas fa-play-circle"></i></div>
                        <?php endif; ?>
                    </div>
                    <div class="my-course-info">
                        <h3><?= e($course['title']) ?></h3>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?= $course['progress']['percentage'] ?>%"></div>
                        </div>
                        <div class="progress-text">
                            <span><?= $course['progress']['completed_lessons'] ?>/<?= $course['progress']['total_lessons'] ?> ders tamamlandi</span>
                            <span>%<?= $course['progress']['percentage'] ?></span>
                        </div>
                        <a href="<?= url('panel/kurs/' . $course['slug']) ?>" class="btn btn-primary btn-block">
                            <i class="fas fa-play"></i> Devam Et
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>