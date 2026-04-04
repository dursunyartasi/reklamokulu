<section class="section">
    <div class="container">
        <h1>Sepetim</h1>

        <?php if (empty($cart)): ?>
            <div class="empty-state">
                <i class="fas fa-shopping-cart fa-3x"></i>
                <h3>Sepetiniz Bos</h3>
                <p>Egitimlerimize goz atin ve kariyerinize yatirim yapin.</p>
                <a href="<?= url('egitimler') ?>" class="btn btn-primary">Egitimleri Incele</a>
            </div>
        <?php else: ?>
            <div class="cart-layout">
                <div class="cart-items">
                    <?php foreach ($cart as $item): ?>
                    <div class="cart-item">
                        <div class="cart-item-thumb">
                            <?php if (!empty($item['thumbnail'])): ?>
                                <img src="<?= url($item['thumbnail']) ?>" alt="">
                            <?php else: ?>
                                <div class="course-thumb-placeholder-sm"><i class="fas fa-play-circle"></i></div>
                            <?php endif; ?>
                        </div>
                        <div class="cart-item-info">
                            <h3><a href="<?= url('egitim/' . $item['slug']) ?>"><?= e($item['title']) ?></a></h3>
                            <span class="cart-item-price"><?= formatPrice($item['price']) ?></span>
                        </div>
                        <a href="<?= url('sepetten-cikar/' . $item['id']) ?>" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="cart-summary">
                    <h3>Siparis Ozeti</h3>
                    <div class="summary-row">
                        <span>Toplam</span>
                        <span class="summary-total"><?= formatPrice($total) ?></span>
                    </div>
                    <a href="<?= url('odeme') ?>" class="btn btn-primary btn-block btn-lg">Odemeye Gec</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>