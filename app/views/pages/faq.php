<section class="section">
    <div class="container">
        <div class="section-header">
            <h1>Sikca Sorulan Sorular</h1>
        </div>

        <div class="faq-list">
            <?php if (empty($faqs)): ?>
                <div class="faq-item">
                    <button class="faq-question active">Egitimler nasil veriliyor?</button>
                    <div class="faq-answer" style="display:block">
                        <p>Tum egitimler Reklam Okulu web sitesi uzerinden online olarak verilmektedir. Satin aldiginiz egitime omur boyu erisim hakkiniz vardir.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">Egitimler sertifikali mi?</button>
                    <div class="faq-answer">
                        <p>Evet, tum kurslarimiz tamamlandiginda katilim sertifikasi verilmektedir. Sertifika otomatik olarak panelinize eklenir.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">Egitim sonrasi destek var mi?</button>
                    <div class="faq-answer">
                        <p>Evet, duzenli canli yayinlar, bire bir gorusmeler ve topluluk gruplari ile surekli destek sagliyoruz.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">Egitimlere ne kadar sure erisebilirim?</button>
                    <div class="faq-answer">
                        <p>Satin aldiginiz tum egitimlere omur boyu erisim hakkiniz vardir. Sure siniri yoktur.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">Iade politikaniz nedir?</button>
                    <div class="faq-answer">
                        <p>Satin alma tarihinden itibaren 14 gun icinde, egitimin %30'undan fazlasini izlemediyseniz tam iade yapilir.</p>
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