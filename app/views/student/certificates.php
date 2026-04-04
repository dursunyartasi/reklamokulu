<section class="section">
    <div class="container">
        <h1>Sertifikalarim</h1>

        <?php if (empty($certificates)): ?>
            <div class="empty-state">
                <i class="fas fa-certificate fa-3x"></i>
                <h3>Henuz Sertifikaniz Yok</h3>
                <p>Bir egitimi tamamladiginizda sertifikaniz burada gorunecektir.</p>
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
</section>