<section class="section">
    <div class="container">
        <h1>Ödeme</h1>

        <form action="<?= url('ödeme-yap') ?>" method="POST" class="checkout-form">
            <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

            <div class="checkout-layout">
                <div class="checkout-details">
                    <h3>Sipariş Detaylari</h3>
                    <?php foreach ($cart as $item): ?>
                    <div class="checkout-item">
                        <span><?= e($item['title']) ?></span>
                        <span><?= formatPrice($item['price']) ?></span>
                    </div>
                    <?php endforeach; ?>

                    <div class="coupon-form">
                        <label>Kupon Kodu</label>
                        <div class="input-group">
                            <input type="text" name="coupon_code" placeholder="Kupon kodunuz varsa girin">
                        </div>
                    </div>
                </div>

                <div class="checkout-summary">
                    <h3>Ödeme Bilgileri</h3>
                    <div class="summary-row">
                        <span>Ara Toplam</span>
                        <span><?= formatPrice($total) ?></span>
                    </div>
                    <div class="summary-row summary-total-row">
                        <span>Toplam</span>
                        <span class="summary-total"><?= formatPrice($total) ?></span>
                    </div>

                    <div class="payment-info">
                        <p><i class="fas fa-lock"></i> Güvenli ödeme - SSL ile korunmaktadir</p>
                        <p><i class="fas fa-credit-card"></i> Pesin fiyatina 3 taksit imkani</p>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        <i class="fas fa-lock"></i> Ödemeyi Tamamla
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>