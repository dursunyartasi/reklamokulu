<?php
$host = getenv('DB_HOST');
$name = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

try {
    $db = new PDO("mysql:host=$host;dbname=$name;charset=utf8mb4", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get author IDs
    $authors = $db->query("SELECT id, email FROM users WHERE role IN ('instructor','admin') ORDER BY id LIMIT 4")->fetchAll(PDO::FETCH_KEY_PAIR);

    if (empty($authors)) {
        echo "HATA: Kullanici bulunamadi\n";
        exit(1);
    }

    $authorIds = array_keys($authors);
    echo "Yazarlar: " . implode(', ', $authors) . "\n";

    $stmt = $db->prepare("INSERT INTO blog_posts (user_id, title, slug, content, excerpt, is_published, published_at, views) VALUES (?, ?, ?, ?, ?, 1, ?, ?)");

    $posts = [
        ['Dijital Pazarlama Nedir? 2025 Rehberi', 'dijital-pazarlama-nedir-2025-rehberi', 0, 1,
         '<h2>Dijital Pazarlama Nedir?</h2><p>Dijital pazarlama, urunlerin veya hizmetlerin internet ve dijital kanallar araciligiyla tanitilmasi ve pazarlanmasi surecidir.</p><h3>Dijital Pazarlamanin Temel Kanallari</h3><p>SEO, sosyal medya pazarlamasi, e-posta pazarlamasi, icerik pazarlamasi, PPC reklamlari ve influencer pazarlamasi dijital pazarlamanin temel kanallaridir.</p><h3>2025 Trendleri</h3><p>Yapay zeka destekli pazarlama, kisa video icerikleri, sesli arama optimizasyonu ve kisisellestirme 2025 yilinin en onemli trendleri arasindadir.</p>',
         'Dijital pazarlamanin temellerini, kanallarini ve 2025 trendlerini kapsamli bir sekilde inceliyoruz.'],
        ['SEO Nedir ve Nasil Yapilir?', 'seo-nedir-nasil-yapilir', 2, 2,
         '<h2>SEO: Arama Motoru Optimizasyonu</h2><p>SEO, web sitenizin arama motorlarinda ust siralarda yer almasini saglayan tekniklerin butunudur.</p><h3>On-Page SEO</h3><p>Baslik etiketleri, meta aciklamalar, baslik hiyerarsisi, gorsel alt metinleri ve URL yapisi on-page SEO unsurlaridir.</p><h3>Off-Page SEO</h3><p>Backlink olusturma, sosyal medya sinyalleri ve marka bilinirligini artirma off-page SEO stratejileridir.</p><h3>Teknik SEO</h3><p>Site hizi, mobil uyumluluk, SSL sertifikasi, XML site haritasi teknik SEO bilesenleridir.</p>',
         'Arama motoru optimizasyonunun temellerini ogrenin. On-page, off-page ve teknik SEO stratejileri.'],
        ['Instagram Algoritmasini Anlamak', 'instagram-algoritmasini-anlamak', 1, 3,
         '<h2>Instagram Algoritmasi Nasil Calisir?</h2><p>Instagram algoritmasi, kullanicilara en ilgili icerikleri gostermek icin surekli guncellenmektedir.</p><h3>Etkilesim Onceliklendirmesi</h3><p>Begeni, yorum, paylasim ve kaydetme gibi etkilesim metrikleri yuksek olan icerikler daha fazla kullaniciya gosterilir.</p><h3>Reels ve Video Iceriklerin Onemi</h3><p>Instagram, video iceriklerini ve ozellikle Reels formatini algoritmik olarak onceliklendirmektedir.</p>',
         'Instagram algoritmasinin nasil calistigini ogrenin ve iceriklerinizin daha fazla kisiye ulasmasini saglayin.'],
        ['Google Ads ile Etkili Reklam Verme', 'google-ads-etkili-reklam-verme', 0, 4,
         '<h2>Google Ads Nedir?</h2><p>Google Ads, isletmelerin arama sonuclarinda, YouTube da ve partner sitelerde reklam vermesini saglar.</p><h3>Kampanya Turleri</h3><p>Arama agi, goruntulu reklam agi, video, alisveris ve uygulama kampanyalari olusturabilirsiniz.</p><h3>Anahtar Kelime Stratejisi</h3><p>Dogru anahtar kelime secimi basarili kampanyanin temelidir. Genis eslesme, ifade eslesmesi ve tam eslesme seceneklerini dogru kullanin.</p>',
         'Google Ads ile etkili reklam kampanyalari olusturmanin ipuclarini paylasiyoruz.'],
        ['Canva ile Profesyonel Gorsel Tasarim', 'canva-ile-profesyonel-gorsel-tasarim', 3, 5,
         '<h2>Canva Nedir?</h2><p>Canva, tasarim bilgisi olmayan kullanicilarin bile profesyonel gorseller olusturmasini saglayan online bir tasarim aracidir.</p><h3>Sosyal Medya Gorselleri</h3><p>Instagram, Facebook, Twitter ve LinkedIn icin dogru boyutlarda gorsel olusturmak Canva ile cok kolaydir.</p><h3>Canva Pro Avantajlari</h3><p>Marka kiti, arka plan kaldirma, sihirli boyutlandirma ve premium gorsel erisimi gibi gelismis ozellikler sunar.</p>',
         'Canva ile tasarim bilginiz olmadan profesyonel gorseller olusturmayi ogrenin.'],
        ['TikTok Pazarlama Stratejileri', 'tiktok-pazarlama-stratejileri', 1, 6,
         '<h2>TikTok un Yukselisi</h2><p>TikTok, kisa video formatiyla dunyanin en hizli buyuyen sosyal medya platformudur.</p><h3>Icerik Stratejisi</h3><p>Otantik, eglenceli ve egitici icerikler uretin. Trend sesleri ve hashtagleri takip edin.</p><h3>TikTok Reklamlari</h3><p>In-Feed reklamlar, TopView reklamlar ve Branded Hashtag Challenge gibi formatlar kullanabilirsiniz.</p>',
         'TikTok u pazarlama araci olarak nasil kullanabilirsiniz? Stratejiler ve ipuclari.'],
        ['E-posta Pazarlama Kapsamli Rehber', 'e-posta-pazarlama-kapsamli-rehber', 2, 7,
         '<h2>E-posta Pazarlama Neden Onemli?</h2><p>E-posta pazarlama, en yuksek ROI saglayan kanallardan biridir.</p><h3>Liste Olusturma</h3><p>Lead magnetler, landing pageler ve pop-up formlar ile abone sayinizi artirin.</p><h3>Otomasyon</h3><p>Hos geldin serileri, terk edilmis sepet e-postalari ve yeniden etkilesim kampanyalari ile zamandan tasarruf edin.</p>',
         'E-posta pazarlamasinin temellerini ogrenin. Liste olusturma, segmentasyon ve otomasyon.'],
        ['Facebook Reklam Hedefleme Stratejileri', 'facebook-reklam-hedefleme-stratejileri', 0, 8,
         '<h2>Facebook Hedefleme Secenekleri</h2><p>Facebook, dunyanin en gelismis reklam hedefleme seceneklerini sunar.</p><h3>Demografik Hedefleme</h3><p>Yas, cinsiyet, konum, egitim durumu ve is unvanina gore hedefleme yapin.</p><h3>Benzer Hedef Kitle</h3><p>Mevcut musterilerinize benzer kullanicilara ulasmak icin Lookalike Audience olusturun.</p><h3>Retargeting</h3><p>Web sitenizi ziyaret eden kullanicilara yeniden reklam gosterin.</p>',
         'Facebook reklamlarinda dogru hedef kitleyi bulmanin yollarini ogrenin.'],
        ['Video Icerik Uretiminin Temelleri', 'video-icerik-uretiminin-temelleri', 3, 9,
         '<h2>Video Icerikin Onemi</h2><p>Video icerik, dijital pazarlamada en etkili iletisim aracidir.</p><h3>Ekipman Secimi</h3><p>Akilli telefonlar bile yuksek kaliteli video cekebilir. Iyi bir isik ve mikrofon yeterlidir.</p><h3>Video Duzenleme</h3><p>CapCut, DaVinci Resolve ve Adobe Premiere ile profesyonel duzenleme yapin.</p>',
         'Video icerik uretiminin temellerini ogrenin. Ekipman, duzenleme ve platform optimizasyonu.'],
        ['Google Analytics 4 Kullanim Rehberi', 'google-analytics-4-kullanim-rehberi', 2, 10,
         '<h2>Google Analytics 4 Nedir?</h2><p>GA4, Google un en yeni analitik platformudur. Olay tabanli veri modeli ile kullanici davranislarini detayli takip edin.</p><h3>GA4 Kurulumu</h3><p>Google Tag Manager ile olaylari kod yazmadan takip edin.</p><h3>Raporlar</h3><p>Explore bolumu ile ozel raporlar olusturun ve donusum hunilerinizi analiz edin.</p>',
         'Google Analytics 4 kurulumu, temel metrikleri ve raporlama ozelliklerini ogrenin.'],
        ['Icerik Pazarlama Stratejileri', 'icerik-pazarlama-stratejileri', 0, 11,
         '<h2>Icerik Pazarlama Nedir?</h2><p>Degerli icerik olusturarak hedef kitlenizi cekmek ve karli aksiyonlara yonlendirmek icin kullanilan stratejik yaklasimdir.</p><h3>Icerik Turleri</h3><p>Blog yazilari, videolar, infografikler, podcastler, e-kitaplar ve sosyal medya paylasimlari.</p><h3>SEO Uyumlu Icerik</h3><p>Anahtar kelime arastirmasi yapin, baslik etiketlerini optimize edin ve ic baglanti stratejisi uygulayin.</p>',
         'Icerik pazarlama stratejilerini ogrenin. Icerik turleri, takvim olusturma ve SEO uyumu.'],
        ['Sosyal Medya Yonetim Araclari', 'sosyal-medya-yonetim-araclari', 1, 12,
         '<h2>Sosyal Medya Yonetimini Kolaylastirin</h2><p>Birden fazla sosyal medya hesabini yonetmek icin araclar kullanin.</p><h3>Hootsuite</h3><p>Birden fazla hesabi tek panelden yonetin.</p><h3>Buffer</h3><p>Basit arayuzuyle icerik planlama ve analiz yapin.</p><h3>Meta Business Suite</h3><p>Facebook ve Instagram hesaplarinizi ucretsiz yonetin.</p>',
         'Sosyal medya yonetimini kolaylastiran en iyi araclari inceliyoruz.'],
        ['Yapay Zeka ile Dijital Pazarlama', 'yapay-zeka-ile-dijital-pazarlama', 0, 13,
         '<h2>Yapay Zekanin Pazarlamaya Etkisi</h2><p>Yapay zeka, icerik olusturma, segmentasyon, kisisellestirme ve otomasyonda devrim yaratmaktadir.</p><h3>ChatGPT ve Icerik</h3><p>Blog, sosyal medya ve reklam kopyalari olusturmada yardimci olur.</p><h3>Gorsel Olusturma</h3><p>Midjourney, DALL-E ve Canva AI ile pazarlama gorselleri olusturun.</p>',
         'Yapay zeka araclarini dijital pazarlamada nasil kullanabilirsiniz?'],
        ['WordPress SEO Optimizasyonu', 'wordpress-seo-optimizasyonu', 2, 14,
         '<h2>WordPress te SEO</h2><p>WordPress, dogru optimizasyonlarla arama motorlarinda ust siralarda yer alabilir.</p><h3>SEO Eklentileri</h3><p>Yoast SEO ve Rank Math ile baslik etiketleri, meta aciklamalar ve site haritasi yonetin.</p><h3>Site Hizi</h3><p>Onbellek eklentileri, gorsel optimizasyonu ve CDN kullanin.</p>',
         'WordPress sitenizi SEO icin nasil optimize edebilirsiniz?'],
        ['Influencer Pazarlama Rehberi', 'influencer-pazarlama-rehberi', 1, 15,
         '<h2>Influencer Pazarlama Nedir?</h2><p>Sosyal medyada etkili kisilerin markanizi tanitmasi icin isbirligi yapmanizdir.</p><h3>Influencer Turleri</h3><p>Nano, mikro, makro ve mega influencer kategorileri vardir. Mikro influencerlar genellikle daha yuksek etkilesim sunar.</p><h3>Kampanya Olcumleme</h3><p>UTM parametreleri ve ozel indirim kodlari kullanin.</p>',
         'Influencer pazarlamanin temelleri, influencer secimi ve kampanya olcumleme.'],
        ['Landing Page Optimizasyonu', 'landing-page-optimizasyonu', 0, 16,
         '<h2>Landing Page Nedir?</h2><p>Kullanicilarin bir reklama tikladiklarinda ulastiklari, belirli bir amaca yonelik tasarlanmis sayfadir.</p><h3>Etkili Unsurlar</h3><p>Dikkat cekici baslik, net deger onerisi, gorsel, sosyal kanit ve guclu CTA butonu.</p><h3>A/B Testi</h3><p>Farkli versiyonlari test ederek en iyi performansi bulun.</p>',
         'Landing page tasarimi ve donusum orani optimizasyonu icin pratik ipuclari.'],
        ['Reels ve Kisa Video Trendleri', 'reels-kisa-video-trendleri', 3, 17,
         '<h2>Kisa Videonun Yukselisi</h2><p>Instagram Reels, TikTok ve YouTube Shorts en populer icerik turleridir.</p><h3>Viral Icerik</h3><p>Ilk 3 saniyede dikkat cekin, trend sesleri kullanin, egitici icerikler olusturun.</p><h3>2025 Trendleri</h3><p>Yapay zeka destekli duzenleme, edutainment ve kisisellestirme one cikiyor.</p>',
         'Reels ve kisa video trendlerini ogrenin. Viral icerik olusturma ve duzenleme ipuclari.'],
        ['E-ticaret SEO Stratejileri', 'e-ticaret-seo-stratejileri', 2, 18,
         '<h2>E-ticarette SEO</h2><p>Organik arama trafigi e-ticaret siteleri icin en degerli trafik kaynagidir.</p><h3>Urun Sayfasi Optimizasyonu</h3><p>Benzersiz urun aciklamalari yazin, gorselleri optimize edin.</p><h3>Teknik SEO</h3><p>Schema markup, canonical etiketler ve site haritasi kullanin.</p>',
         'E-ticaret siteleri icin SEO stratejileri. Urun sayfasi ve teknik optimizasyon.'],
        ['LinkedIn Pazarlama Stratejileri', 'linkedin-pazarlama-stratejileri', 1, 19,
         '<h2>LinkedIn in Is Dunyasindaki Yeri</h2><p>LinkedIn, B2B pazarlama icin en etkili sosyal medya platformudur.</p><h3>Profil Optimizasyonu</h3><p>Profesyonel foto, dikkat cekici baslik ve anahtar kelimelerle zengin ozet yazin.</p><h3>LinkedIn Reklamlari</h3><p>Sponsored Content, Message Ads ve Dynamic Ads kullanin.</p>',
         'LinkedIn i pazarlama araci olarak kullanmanin yollari.'],
        ['Dijital Pazarlamada Butce Yonetimi', 'dijital-pazarlamada-butce-yonetimi', 0, 20,
         '<h2>Butce Planlamasi</h2><p>Dijital pazarlama butcenizi dogru planlamak yatiriminizin karsiligini almaniz icin kritiktir.</p><h3>Kanal Bazli Dagitim</h3><p>SEO, sosyal medya, Google Ads ve icerik uretimi arasinda butcenizi dagitin.</p><h3>ROAS Hesaplama</h3><p>Her kampanyanin ROAS degerini takip ederek butcenizi optimize edin.</p>',
         'Dijital pazarlama butcenizi nasil planlar ve yonetirsiniz? ROAS hesaplama ve optimizasyon.'],
    ];

    $inserted = 0;
    foreach ($posts as $p) {
        $authorIdx = $p[2] % count($authorIds);
        $authorId = $authorIds[$authorIdx];
        $days = $p[3];
        $publishedAt = date('Y-m-d H:i:s', strtotime("-{$days} days"));
        $views = rand(100, 600);

        // Check if slug exists
        $check = $db->prepare("SELECT id FROM blog_posts WHERE slug = ?");
        $check->execute([$p[1]]);
        if ($check->fetch()) continue;

        $stmt->execute([$authorId, $p[0], $p[1], $p[4], $p[5], $publishedAt, $views]);
        $inserted++;
    }

    echo "Blog seed tamamlandi. $inserted yeni yazi eklendi.\n";
    $result = $db->query('SELECT COUNT(*) as cnt FROM blog_posts')->fetch();
    echo "Toplam blog yazisi: " . $result['cnt'] . "\n";
} catch (Exception $e) {
    echo "HATA: " . $e->getMessage() . "\n";
}
