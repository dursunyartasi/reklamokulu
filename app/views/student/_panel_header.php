<section class="panel-hero">
    <div class="container">
        <div class="panel-hero-inner">
            <div class="panel-avatar">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="panel-user-info">
                <h2><?= e(currentUser()['first_name'] ?? '') ?> <?= e(currentUser()['last_name'] ?? '') ?></h2>
                <div class="panel-user-stats">
                    <span><i class="fas fa-book"></i> <?= $panelCourseCount ?? 0 ?> Alinan Egitim</span>
                    <span><i class="fas fa-certificate"></i> <?= $panelCertCount ?? 0 ?> Katilim Belgesi</span>
                </div>
            </div>
            <a href="<?= url('egitimler') ?>" class="btn btn-panel-cta">Tum Egitimler <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>
