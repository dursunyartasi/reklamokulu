<section class="section">
    <div class="container">
        <div class="section-header">
            <h1>Blog</h1>
            <p>Dijital pazarlama alaninda faydali yazilar</p>
        </div>

        <div class="blog-grid">
            <?php if (empty($posts)): ?>
                <p class="text-center">Henuz blog yazisi eklenmemis.</p>
            <?php endif; ?>

            <?php foreach ($posts as $post): ?>
            <article class="blog-card">
                <div class="blog-thumb">
                    <?php if ($post['thumbnail']): ?>
                        <img src="<?= url($post['thumbnail']) ?>" alt="<?= e($post['title']) ?>" loading="lazy">
                    <?php else: ?>
                        <div class="blog-thumb-placeholder"><i class="fas fa-newspaper"></i></div>
                    <?php endif; ?>
                </div>
                <div class="blog-info">
                    <div class="blog-meta">
                        <span><i class="fas fa-user"></i> <?= e($post['first_name'] . ' ' . $post['last_name']) ?></span>
                        <?php if ($post['published_at']): ?>
                            <span><i class="fas fa-calendar"></i> <?= date('d.m.Y', strtotime($post['published_at'])) ?></span>
                        <?php endif; ?>
                    </div>
                    <h3><a href="<?= url('blog/' . $post['slug']) ?>"><?= e($post['title']) ?></a></h3>
                    <?php if ($post['excerpt']): ?>
                        <p><?= e($post['excerpt']) ?></p>
                    <?php endif; ?>
                    <a href="<?= url('blog/' . $post['slug']) ?>" class="read-more">Devamini Oku <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <?php if ($totalPages > 1): ?>
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="<?= url('blog?sayfa=' . $i) ?>" class="page-link <?= $i === $page ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
</section>