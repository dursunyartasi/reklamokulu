<section class="section">
    <div class="container">
        <div class="blog-detail-layout">
            <article class="blog-detail">
                <?php if ($post['thumbnail']): ?>
                    <img src="<?= url($post['thumbnail']) ?>" alt="<?= e($post['title']) ?>" class="blog-detail-img">
                <?php endif; ?>

                <div class="blog-detail-meta">
                    <span><i class="fas fa-user"></i> <?= e($post['first_name'] . ' ' . $post['last_name']) ?></span>
                    <?php if ($post['published_at']): ?>
                        <span><i class="fas fa-calendar"></i> <?= date('d.m.Y', strtotime($post['published_at'])) ?></span>
                    <?php endif; ?>
                    <span><i class="fas fa-eye"></i> <?= $post['views'] ?> goruntulenme</span>
                </div>

                <h1><?= e($post['title']) ?></h1>

                <div class="blog-content">
                    <?= $post['content'] ?>
                </div>
            </article>

            <aside class="blog-sidebar">
                <div class="sidebar-widget">
                    <h3>Son Yazilar</h3>
                    <?php foreach ($recentPosts as $rp): ?>
                        <a href="<?= url('blog/' . $rp['slug']) ?>" class="sidebar-post">
                            <?= e($rp['title']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </aside>
        </div>
    </div>
</section>