<section class="section">
    <div class="container">
        <div class="section-header">
            <h1>Sıkça Sorulan Sorular</h1>
        </div>

        <div class="faq-list">
            <?php if (empty($faqs)): ?>
                <div class="faq-item">
                    <button class="faq-question active">Egitimler nasil veriliyor?</button>
                    <div class="faq-answer" style="display:block">
                        <p>Tum eğitimler Reklam Okulu web sitesi üzerinden online olarak verilmektedir. Satın aldiginiz egitime ömür boyu erişim hakkınız vardır.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">Egitimler sertifikali mi?</button>
                    <div class="faq-answer">
                        <p>Evet, tum kurslarimiz tamamlandıginda katilim sertifikasi verilmektedir. Sertifika otomatik olarak panelinize eklenir.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">Eğitim sonrası destek var mi?</button>
                    <div class="faq-answer">
                        <p>Evet, düzenli canlı yayınlar, bire bir görüşmeler ve topluluk gruplari ile surekli destek sagliyoruz.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">Eğitimlere ne kadar sure erisebilirim?</button>
                    <div class="faq-answer">
                        <p>Satın aldiginiz tum eğitimlere ömür boyu erişim hakkınız vardır. Sure sınırı yoktur.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">İade politikanız nedir?</button>
                    <div class="faq-answer">
                        <p>Satin alma tarihinden itibaren 14 gun icinde, eğitimin %30'undan fazlasini izlemediyseniz tam iade yapilir.</p>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($faqs as $index => $faq): ?>
                <div class="faq-item">
                    <button class="faq-question <?= $index === 0 ? 'active' : '' ?>"><?= e($faq['question']) ?></button>
                    <div class="faq-answer" <?= $index === 0 ? 'style="display:block"' : '' ?>>
                        <p><?= e($faq['answer']) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>