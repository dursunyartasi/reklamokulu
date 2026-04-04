<?php $activePanel = 'siparişler'; ?>
<?php require __DIR__ . '/_panel_header.php'; ?>

<section class="section panel-section">
    <div class="container">
        <div class="panel-layout">
            <?php require __DIR__ . '/_sidebar.php'; ?>

            <div class="panel-main">
                <h3 class="panel-title">Siparişlerim</h3>

                <?php if (empty($orders)): ?>
                    <div class="empty-state">
                        <i class="fas fa-shopping-bag fa-3x"></i>
                        <h3>Henuz Siparişiniz Yok</h3>
                        <p>Egitim satin aldiginizda siparişleriniz burada gorunecektir.</p>
                        <a href="<?= url('egitimler') ?>" class="btn btn-primary">Eğitimleri İncele</a>
                    </div>
                <?php else: ?>
                    <div class="orders-list">
                        <?php foreach ($orders as $order): ?>
                        <div class="order-card">
                            <div class="order-card-header">
                                <div>
                                    <span class="order-number">#<?= e($order['order_number']) ?></span>
                                    <span class="order-date"><?= date('d.m.Y H:i', strtotime($order['created_at'])) ?></span>
                                </div>
                                <span class="order-status order-status-<?= $order['status'] ?>">
                                    <?php
                                    $statusLabels = ['pending' => 'Beklemede', 'completed' => 'Tamamlandı', 'failed' => 'Başarısız', 'refunded' => 'İade Edildi'];
                                    echo $statusLabels[$order['status']] ?? $order['status'];
                                    ?>
                                </span>
                            </div>
                            <div class="order-card-body">
                                <?php if (!empty($order['items'])): ?>
                                    <?php foreach ($order['items'] as $item): ?>
                                    <div class="order-item">
                                        <span><?= e($item['course_title'] ?? 'Egitim') ?></span>
                                        <strong><?= formatPrice($item['price']) ?></strong>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="order-card-footer">
                                <span>Toplam</span>
                                <strong class="order-total"><?= formatPrice($order['total_amount']) ?></strong>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
