<?php $activePanel = 'sertifikalar'; ?>
<?php require __DIR__ . '/_panel_header.php'; ?>

<section class="section panel-section">
    <div class="container">
        <div class="panel-layout">
            <?php require __DIR__ . '/_sidebar.php'; ?>

            <div class="panel-main">
                <h3 class="panel-title">Katılım Belgeleri</h3>

                <?php if (empty($certificates)): ?>
                    <div class="empty-state">
                        <i class="fas fa-certificate fa-3x"></i>
                        <h3>Henuz Sertifikanız Yok</h3>
                        <p>Bir eğitimi tamamladiginizda sertifikaniz burada gorunecektir.</p>
                    </div>
                <?php else: ?>
                    <div class="certificates-grid">
                        <?php foreach ($certificates as $cert): ?>
                        <div class="certificate-card">
                            <div class="certificate-icon"><i class="fas fa-award"></i></div>
                            <h3><?= e($cert['course_title']) ?></h3>
                            <p class="cert-code">Sertifika No: <?= e($cert['certificate_code']) ?></p>
                            <p class="cert-date">Verilme Tarihi: <?= date('d.m.Y', strtotime($cert['issued_at'])) ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
