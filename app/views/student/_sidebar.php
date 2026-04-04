<aside class="panel-sidebar">
    <div class="panel-sidebar-greeting">
        <small><?= strtoupper(e(currentUser()['first_name'] ?? '')) ?> <?= strtoupper(e(currentUser()['last_name'] ?? '')) ?> HOS GELDIN!</small>
    </div>
    <nav class="panel-nav">
        <a href="<?= url('panel') ?>" class="panel-nav-item <?= ($activePanel ?? '') === 'pano' ? 'active' : '' ?>">
            <i class="fas fa-home"></i> Pano
        </a>
        <a href="<?= url('panel/profil') ?>" class="panel-nav-item <?= ($activePanel ?? '') === 'profil' ? 'active' : '' ?>">
            <i class="fas fa-user"></i> Profil
        </a>
        <a href="<?= url('panel') ?>" class="panel-nav-item <?= ($activePanel ?? '') === 'egitimler' ? 'active' : '' ?>">
            <i class="fas fa-book-open"></i> Egitimler
        </a>
        <a href="<?= url('panel/sertifikalar') ?>" class="panel-nav-item <?= ($activePanel ?? '') === 'sertifikalar' ? 'active' : '' ?>">
            <i class="fas fa-certificate"></i> Katilim Belgeleri
        </a>
        <a href="<?= url('panel/siparisler') ?>" class="panel-nav-item <?= ($activePanel ?? '') === 'siparisler' ? 'active' : '' ?>">
            <i class="fas fa-shopping-bag"></i> Siparisler
        </a>
        <a href="<?= url('panel/gorusme') ?>" class="panel-nav-item <?= ($activePanel ?? '') === 'gorusme' ? 'active' : '' ?>">
            <i class="fas fa-comments"></i> Bire Bir Gorusme
        </a>
    </nav>
    <div class="panel-nav-divider">DIGER</div>
    <nav class="panel-nav">
        <a href="<?= url('panel/profil') ?>" class="panel-nav-item">
            <i class="fas fa-cog"></i> Ayarlar
        </a>
        <a href="<?= url('cikis') ?>" class="panel-nav-item panel-nav-logout">
            <i class="fas fa-sign-out-alt"></i> Cikis
        </a>
    </nav>
</aside>
