<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">
                <span class="hero-badge"><i class="fas fa-graduation-cap"></i> Dijital Pazarlama Akademisi</span>
                <h1><?= e($settings['hero_title'] ?? 'Dijital Pazarlamayi En Iyi Sekilde Ogrenmeye Hazir Misiniz?') ?></h1>
                <p><?= e($settings['hero_subtitle'] ?? 'Uzman egitmenlerle, pratik odakli egitimlerle kariyerinizi bir ust seviyeye tasiyin.') ?></p>
                <div class="hero-features">
                    <span><i class="fas fa-check-circle"></i> Bire Bir Egitmen Destegi</span>
                    <span><i class="fas fa-check-circle"></i> Omur Boyu Erisim</span>
                    <span><i class="fas fa-check-circle"></i> Canli Yayinlar</span>
                </div>
                <div class="hero-buttons">
                    <a href="<?= url('egitimler') ?>" class="btn btn-dark btn-lg">Egitimleri Incele <i class="fas fa-arrow-right"></i></a>
                    <a href="<?= url('kayit') ?>" class="btn btn-outline-white btn-lg">Ucretsiz Kayit Ol</a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-stat-card">
                    <div class="hero-stat-icon"><i class="fas fa-users"></i></div>
                    <div>
                        <strong>50.000+</strong>
                        <span>Ogrenci</span>
                    </div>
                </div>
                <div class="hero-stat-card">
                    <div class="hero-stat-icon"><i class="fas fa-play-circle"></i></div>
                    <div>
                        <strong><?= count($courses) ?>+</strong>
                        <span>Online Egitim</span>
                    </div>
                </div>
                <div class="hero-stat-card">
                    <div class="hero-stat-icon"><i class="fas fa-award"></i></div>
                    <div>
                        <strong>10+</strong>
                        <span>Uzman Egitmen</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Advantages -->
<section class="section advantages-section">
    <div class="container">
        <div class="section-header">
            <h2>Neden Reklam Okulu?</h2>
            <p>Dijital pazarlamayi Reklam Okulu kalitesiyle ogren!</p>
        </div>
        <div class="advantages-grid">
            <div class="advantage-card" style="background: var(--accent-light);">
                <div class="advantage-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <h3>Bire Bir Egitmen Destegi</h3>
                <p>Egitmenlerinle bire bir online baglanti yaparak destek alabilirsin.</p>
            </div>
            <div class="advantage-card" style="background: #E8F5E9;">
                <div class="advantage-icon" style="background: #C8E6C9; color: #2E7D32;"><i class="fas fa-video"></i></div>
                <h3>Duzenli Canli Yayinlar</h3>
                <p>Her ay duzenli canli yayinlara ucretsiz katilarak sorularini sorabilirsin.</p>
            </div>
            <div class="advantage-card" style="background: #F3E5F5;">
                <div class="advantage-icon" style="background: #E1BEE7; color: #7B1FA2;"><i class="fas fa-sync-alt"></i></div>
                <h3>Surekli Guncellenen Egitimler</h3>
                <p>Egitimler surekli guncellenir, omur boyu en guncel haline erisim hakkin olur.</p>
            </div>
            <div class="advantage-card" style="background: #E0F7FA;">
                <div class="advantage-icon" style="background: #B2EBF2; color: #00838F;"><i class="fas fa-comments"></i></div>
                <h3>Soru & Cevap Gruplari</h3>
                <p>WhatsApp ve Telegram gruplariyla tum sorularini egitmenine ve ogrencilere sorabilirsin.</p>
            </div>
            <div class="advantage-card" style="background: #FCE4EC;">
                <div class="advantage-icon" style="background: #F8BBD0; color: #C2185B;"><i class="fas fa-infinity"></i></div>
                <h3>Omur Boyu Ucretsiz Erisim</h3>
                <p>Bir egitime kaydoldugunuzda o egitimin en guncel haline ve desteklere erisim hakkin olur.</p>
            </div>
            <div class="advantage-card" style="background: #FFF8E1;">
                <div class="advantage-icon" style="background: #FFECB3; color: #F57F17;"><i class="fas fa-certificate"></i></div>
                <h3>Katilim Belgesi</h3>
                <p>Egitimi basariyla tamamladiginda egitmen imzali katilim belgesine sahip olacaksin.</p>
            </div>
        </div>
    </div>
</section>

<!-- Courses -->
<section class="section courses-section">
    <div class="container">
        <div class="section-header">
            <div class="section-header-row">
                <div>
                    <h2>Egitimlerimiz</h2>
                    <p>Diledigin egitime simdi kaydol, ogrenme yolculuguna ilk adimini at.</p>
                </div>
                <a href="<?= url('egitimler') ?>" class="btn btn-outline">Tum Egitimlerimiz <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="courses-grid courses-grid-4">
            <?php foreach (array_slice($courses, 0, 8) as $course): ?>
            <div class="course-card">
                <div class="course-thumb">
                    <?php if ($course['thumbnail']): ?>
                        <img src="<?= url($course['thumbnail']) ?>" alt="<?= e($course['title']) ?>" loading="lazy">
                    <?php else: ?>
                        <div class="course-thumb-placeholder">
                            <i class="fas fa-play-circle"></i>
                        </div>
                    <?php endif; ?>
                    <?php if ($course['is_free']): ?>
                        <span class="badge badge-free">Ucretsiz</span>
                    <?php elseif ($course['sale_price']): ?>
                        <span class="badge badge-sale">Indirim</span>
                    <?php endif; ?>
                </div>
                <div class="course-info">
                    <h3><a href="<?= url('egitim/' . $course['slug']) ?>"><?= e($course['title']) ?></a></h3>
                    <div class="course-meta">
                        <?php if ($course['duration']): ?>
                            <span><i class="fas fa-clock"></i> Sure: <?= e($course['duration']) ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="course-price-row">
                        <div class="course-price">
                            <?php if ($course['is_free']): ?>
                                <span class="price-current">Ucretsiz</span>
                            <?php else: ?>
                                <?php if ($course['sale_price']): ?>
                                    <span class="price-old"><?= formatPrice($course['price']) ?></span>
                                <?php endif; ?>
                                <span class="price-current"><?= formatPrice($course['sale_price'] ?? $course['price']) ?></span>
                            <?php endif; ?>
                        </div>
                        <a href="<?= url('egitim/' . $course['slug']) ?>" class="course-link">Satin Al <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="section testimonials-section">
    <div class="container">
        <div class="section-header">
            <div class="section-header-row">
                <div>
                    <h2>Sizden Gelenler</h2>
                    <p>Ogrencilerimizden gelen yorumlar</p>
                </div>
                <a href="<?= url('neden-biz') ?>" class="btn btn-gold">Neden Biz?</a>
            </div>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-quote"><i class="fas fa-quote-right"></i></div>
                <div class="testimonial-author">
                    <div class="testimonial-avatar"><i class="fas fa-user-circle"></i></div>
                    <div>
                        <strong>Ornek Ogrenci</strong>
                        <span>Dijital Pazarlama Uzmani</span>
                    </div>
                </div>
                <p>Reklam Okulu'nun egitimlerini tamamladim. Egitmenler konulari cok acik ve yalin bir sekilde anlatiyor. Kesinlikle tavsiye ederim.</p>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-quote"><i class="fas fa-quote-right"></i></div>
                <div class="testimonial-author">
                    <div class="testimonial-avatar"><i class="fas fa-user-circle"></i></div>
                    <div>
                        <strong>Ornek Ogrenci 2</strong>
                        <span>E-Ticaret Uzmani</span>
                    </div>
                </div>
                <p>Dijital pazarlama egitimi aldim. Dersleri cok kapsamli ve bilgilendirici buldum. Canli destek vermesi cok onemli bir avantaj.</p>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-quote"><i class="fas fa-quote-right"></i></div>
                <div class="testimonial-author">
                    <div class="testimonial-avatar"><i class="fas fa-user-circle"></i></div>
                    <div>
                        <strong>Ornek Ogrenci 3</strong>
                        <span>Girisimci</span>
                    </div>
                </div>
                <p>Egitim sonrasi da destek almaya devam ediyorum. Canli yayinlar ve soru-cevap gruplari sayesinde ogrenme surecim hic bitmiyor.</p>
            </div>
        </div>
    </div>
</section>

<!-- Corporate CTA -->
<section class="corporate-cta">
    <div class="container">
        <div class="corporate-cta-inner">
            <div>
                <h2>Kurumsal Egitimlerimizi Kesfet</h2>
                <p>Sirketinizin ihtiyaclarina ve sektorunuzun dinamiklerine yonelik hazirlanan kurumsal, sirket ici egitimlerimizi kesfedin.</p>
            </div>
            <a href="<?= url('kurumsal-egitimler') ?>" class="btn btn-white btn-lg">Detayli Bilgi Al <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>
