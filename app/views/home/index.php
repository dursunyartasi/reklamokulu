<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">
                <span class="hero-badge"><i class="fas fa-graduation-cap"></i> Dijital Pazarlama Akademisi</span>
                <h1><?= e($settings['hero_title'] ?? 'Dijital Pazarlamayi En Iyi Sekilde Öğrenmeye Hazir Misiniz?') ?></h1>
                <p><?= e($settings['hero_subtitle'] ?? 'Uzman eğitmenlerle, pratik odakli eğitimlerle kariyerinizi bir ust seviyeye tasiyin.') ?></p>
                <div class="hero-features">
                    <span><i class="fas fa-check-circle"></i> Bire Bir Eğitmen Desteği</span>
                    <span><i class="fas fa-check-circle"></i> Ömür Boyu Erisim</span>
                    <span><i class="fas fa-check-circle"></i> Canlı Yayınlar</span>
                </div>
                <div class="hero-buttons">
                    <a href="<?= url('eğitimler') ?>" class="btn btn-dark btn-lg">Eğitimleri İncele <i class="fas fa-arrow-right"></i></a>
                    <a href="<?= url('kayit') ?>" class="btn btn-outline-white btn-lg">Ücretsiz Kayıt Ol</a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-stat-card">
                    <div class="hero-stat-icon"><i class="fas fa-users"></i></div>
                    <div>
                        <strong>50.000+</strong>
                        <span>Öğrenci</span>
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
            <p>Dijital pazarlamayi Reklam Okulu kalitesiyle öğren!</p>
        </div>
        <div class="advantages-grid">
            <div class="advantage-card" style="background: var(--accent-light);">
                <div class="advantage-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <h3>Bire Bir Eğitmen Desteği</h3>
                <p>Eğitmenlerinle bire bir online baglanti yaparak destek alabilirsin.</p>
            </div>
            <div class="advantage-card" style="background: #E8F5E9;">
                <div class="advantage-icon" style="background: #C8E6C9; color: #2E7D32;"><i class="fas fa-video"></i></div>
                <h3>Düzenli Canlı Yayınlar</h3>
                <p>Her ay düzenli canlı yayınlara ücretsiz katilarak sorularini sorabilirsin.</p>
            </div>
            <div class="advantage-card" style="background: #F3E5F5;">
                <div class="advantage-icon" style="background: #E1BEE7; color: #7B1FA2;"><i class="fas fa-sync-alt"></i></div>
                <h3>Surekli Güncellenen Egitimler</h3>
                <p>Egitimler surekli güncellenir, ömür boyu en guncel haline erisim hakkin olur.</p>
            </div>
            <div class="advantage-card" style="background: #E0F7FA;">
                <div class="advantage-icon" style="background: #B2EBF2; color: #00838F;"><i class="fas fa-comments"></i></div>
                <h3>Soru & Cevap Grupları</h3>
                <p>WhatsApp ve Telegram gruplariyla tum sorularini eğitmenine ve öğrencilere sorabilirsin.</p>
            </div>
            <div class="advantage-card" style="background: #FCE4EC;">
                <div class="advantage-icon" style="background: #F8BBD0; color: #C2185B;"><i class="fas fa-infinity"></i></div>
                <h3>Ömür Boyu Ücretsiz Erisim</h3>
                <p>Bir egitime kaydoldugunuzda o eğitimin en guncel haline ve desteklere erisim hakkin olur.</p>
            </div>
            <div class="advantage-card" style="background: #FFF8E1;">
                <div class="advantage-icon" style="background: #FFECB3; color: #F57F17;"><i class="fas fa-certificate"></i></div>
                <h3>Katılım Belgesi</h3>
                <p>Eğitimi başarıyla tamamladiginda eğitmen imzali katilim belgesine sahip olacaksin.</p>
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
                    <h2>Eğitimlerimiz</h2>
                    <p>Diledigin egitime simdi kaydol, öğrenme yolculuguna ilk adimini at.</p>
                </div>
                <a href="<?= url('eğitimler') ?>" class="btn btn-outline">Tum Eğitimlerimiz <i class="fas fa-arrow-right"></i></a>
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
                        <span class="badge badge-free">Ücretsiz</span>
                    <?php elseif ($course['sale_price']): ?>
                        <span class="badge badge-sale">İndirim</span>
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
                                <span class="price-current">Ücretsiz</span>
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
                    <p>Öğrencilerimizden gelen yorumlar</p>
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
                        <strong>Ornek Öğrenci</strong>
                        <span>Dijital Pazarlama Uzmanı</span>
                    </div>
                </div>
                <p>Reklam Okulu'nun eğitimlerini tamamladim. Eğitmenler konulari cok acik ve yalin bir sekilde anlatiyor. Kesinlikle tavsiye ederim.</p>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-quote"><i class="fas fa-quote-right"></i></div>
                <div class="testimonial-author">
                    <div class="testimonial-avatar"><i class="fas fa-user-circle"></i></div>
                    <div>
                        <strong>Ornek Öğrenci 2</strong>
                        <span>E-Ticaret Uzmanı</span>
                    </div>
                </div>
                <p>Dijital pazarlama eğitimi aldim. Dersleri cok kapsamli ve bilgilendirici buldum. Canli destek vermesi cok onemli bir avantaj.</p>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-quote"><i class="fas fa-quote-right"></i></div>
                <div class="testimonial-author">
                    <div class="testimonial-avatar"><i class="fas fa-user-circle"></i></div>
                    <div>
                        <strong>Ornek Öğrenci 3</strong>
                        <span>Girişimci</span>
                    </div>
                </div>
                <p>Eğitim sonrası da destek almaya devam ediyorum. Canli yayinlar ve soru-cevap gruplari sayesinde öğrenme surecim hic bitmiyor.</p>
            </div>
        </div>
    </div>
</section>

<!-- Corporate CTA -->
<section class="corporate-cta">
    <div class="container">
        <div class="corporate-cta-inner">
            <div>
                <h2>Kurumsal Eğitimlerimizi Keşfet</h2>
                <p>Şirketinizin ihtiyaclarina ve sektorunuzun dinamiklerine yonelik hazirlanan kurumsal, şirket içi eğitimlerimizi keşfedin.</p>
            </div>
            <a href="<?= url('kurumsal-eğitimler') ?>" class="btn btn-white btn-lg">Detaylı Bilgi Al <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>
