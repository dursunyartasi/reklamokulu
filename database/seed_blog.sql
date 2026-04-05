-- Reklam Okulu - 20 Blog Yazisi Seed
-- Calistirma: mysql -u mysql -p default < /var/www/html/database/seed_blog.sql

-- Oncelikle admin/instructor user ID'sini bulalim
SET @author_id = (SELECT id FROM users WHERE email = 'ahmet@reklamokulu.com' LIMIT 1);
SET @author2_id = (SELECT id FROM users WHERE email = 'zeynep@reklamokulu.com' LIMIT 1);
SET @author3_id = (SELECT id FROM users WHERE email = 'mehmet@reklamokulu.com' LIMIT 1);
SET @author4_id = (SELECT id FROM users WHERE email = 'elif@reklamokulu.com' LIMIT 1);

INSERT INTO blog_posts (user_id, title, slug, content, excerpt, is_published, published_at, views) VALUES

(@author_id, 'Dijital Pazarlama Nedir? 2025 Rehberi',
'dijital-pazarlama-nedir-2025-rehberi',
'<h2>Dijital Pazarlama Nedir?</h2>
<p>Dijital pazarlama, urunlerin veya hizmetlerin internet ve dijital kanallar araciligiyla tanitilmasi ve pazarlanmasi surecidir. Gunumuzde isletmelerin buyuk cogunlugu dijital pazarlama stratejileri kullanarak hedef kitlelerine ulasmaktadir.</p>
<h3>Dijital Pazarlamanin Temel Kanallari</h3>
<p>Dijital pazarlama bircokkanaldan olusur. Bunlar arasinda arama motoru optimizasyonu (SEO), sosyal medya pazarlamasi, e-posta pazarlamasi, icerik pazarlamasi, tiklama basina odeme (PPC) reklamlari ve influencer pazarlamasi yer alir.</p>
<h3>Neden Dijital Pazarlama?</h3>
<p>Geleneksel pazarlamaya kiyasla dijital pazarlama daha olculebilir, daha hedefli ve genellikle daha dusuk maliyetlidir. Kucuk isletmelerden buyuk markalara kadar herkes dijital pazarlamanin avantajlarindan yararlanabilir.</p>
<h3>2025 Trendleri</h3>
<p>Yapay zeka destekli pazarlama, kisa video icerikleri, sesli arama optimizasyonu ve kisisellestirme 2025 yilinin en onemli dijital pazarlama trendleri arasinda yer almaktadir.</p>',
'Dijital pazarlamanin temellerini, kanallarini ve 2025 trendlerini kapsamli bir sekilde inceliyoruz.', 1, DATE_SUB(NOW(), INTERVAL 1 DAY), FLOOR(RAND() * 500 + 100)),

(@author3_id, 'SEO Nedir ve Nasil Yapilir?',
'seo-nedir-nasil-yapilir',
'<h2>SEO: Arama Motoru Optimizasyonu</h2>
<p>SEO, web sitenizin arama motorlarinda ust siralarda yer almasini saglayan tekniklerin butunudur. Google gibi arama motorlari, kullanicilarin aradiklari icerigi en iyi sekilde sunmak icin yuzlerce faktoru degerlendirmektedir.</p>
<h3>On-Page SEO</h3>
<p>On-page SEO, web sitenizin icerigini ve HTML kaynak kodunu optimize etmeyi icerir. Baslik etiketleri, meta aciklamalar, baslik hiyerarsisi, gorsel alt metinleri ve URL yapisi on-page SEO''nun temel unsurlaridir.</p>
<h3>Off-Page SEO</h3>
<p>Off-page SEO, web sitenizin disinda yapilan optimizasyonlari kapsar. Backlink olusturma, sosyal medya sinyalleri ve marka bilinirligini artirma off-page SEO stratejileridir.</p>
<h3>Teknik SEO</h3>
<p>Site hizi, mobil uyumluluk, SSL sertifikasi, XML site haritasi ve robots.txt dosyasi teknik SEO''nun onemli bilesenleridir. Google, hizli yuklenen ve mobil uyumlu siteleri on plana cikarmaktadir.</p>',
'Arama motoru optimizasyonunun temellerini ogrenin. On-page, off-page ve teknik SEO stratejileri.', 1, DATE_SUB(NOW(), INTERVAL 2 DAY), FLOOR(RAND() * 500 + 100)),

(@author2_id, 'Instagram Algoritmasini Anlamak',
'instagram-algoritmasini-anlamak',
'<h2>Instagram Algoritmasi Nasil Calisir?</h2>
<p>Instagram algoritmasi, kullanicilara en ilgili icerikleri gostermek icin surekli guncellenmektedir. 2025 yilinda algoritma, ozellikle etkilesim oranini, icerik kalitesini ve kullanici davranislarini on planda tutmaktadir.</p>
<h3>Etkilesim Onceliklendirmesi</h3>
<p>Instagram, begeni, yorum, paylasim ve kaydetme gibi etkilesim metrikleri yuksek olan icerikleri daha fazla kullaniciya gostermektedir. Ozellikle ''kaydet'' ve ''paylas'' butonlari algoritma icin cok degerlidir.</p>
<h3>Reels ve Video Iceriklerin Onemi</h3>
<p>Instagram, video iceriklerini ve ozellikle Reels formatini algoritmik olarak onceliklendirmektedir. Kisa, dikkat cekici ve egitici videolar daha genis kitlelere ulasma sansi sunmaktadir.</p>
<h3>Tutarlilik ve Zamanlama</h3>
<p>Duzenli icerik paylasimi ve dogru zamanlarda paylasum yapmak algoritmanin icerginizi daha fazla kullaniciya gostermesini saglar. Hedef kitlenizin en aktif oldugu saatleri analiz ederek paylasum stratejinizi belirleyin.</p>',
'Instagram algoritmasinin nasil calistigini ogrenin ve iceriklerinizin daha fazla kisiye ulasmasini saglayin.', 1, DATE_SUB(NOW(), INTERVAL 3 DAY), FLOOR(RAND() * 500 + 100)),

(@author_id, 'Google Ads ile Etkili Reklam Verme',
'google-ads-etkili-reklam-verme',
'<h2>Google Ads Nedir?</h2>
<p>Google Ads, Google''un reklam platformudur ve isletmelerin arama sonuclarinda, YouTube''da, Gmail''de ve partner sitelerde reklam vermesini saglar. Tiklama basina odeme (PPC) modeliyle calisir.</p>
<h3>Kampanya Turleri</h3>
<p>Google Ads''te arama agi, gorunrulu reklam agi, video, alisveris ve uygulama kampanyalari olusturabilirsiniz. Her kampanya turu farkli hedeflere hizmet eder.</p>
<h3>Anahtar Kelime Stratejisi</h3>
<p>Basarili bir Google Ads kampanyasinin temeli dogru anahtar kelimeleri secmektir. Genis eslesme, ifade eslesmesi ve tam eslesme seceneklerini dogru kullanmak butcenizi verimli kullanmanizi saglar.</p>
<h3>Donusum Takibi</h3>
<p>Reklam harcamalarinizin geri donusunu olcmek icin donusum takibi kurmaniz sart. Google Ads donusum etiketi ve Google Analytics entegrasyonu ile kampanyalarinizin performansini takip edebilirsiniz.</p>',
'Google Ads ile etkili reklam kampanyalari olusturmanin ipuclarini paylasiyoruz.', 1, DATE_SUB(NOW(), INTERVAL 4 DAY), FLOOR(RAND() * 500 + 100)),

(@author4_id, 'Canva ile Profesyonel Gorsel Tasarim',
'canva-ile-profesyonel-gorsel-tasarim',
'<h2>Canva Nedir?</h2>
<p>Canva, tasarim bilgisi olmayan kullanicilarin bile profesyonel gorseller olusturmasini saglayan online bir tasarim aracidir. Sosyal medya gorselleri, sunumlar, posterler ve daha fazlasini kolayca olusturabilirsiniz.</p>
<h3>Canva''nin Temel Ozellikleri</h3>
<p>Hazir sablonlar, surukle birak arayuzu, marka kiti olusturma, takim calismas, ve binlerce ucretsiz gorsel ve ikon Canva''nin one cikan ozellikleridir.</p>
<h3>Sosyal Medya Gorselleri</h3>
<p>Instagram, Facebook, Twitter ve LinkedIn icin dogru boyutlarda gorsel olusturmak Canva ile cok kolaydir. Her platform icin optimize edilmis sablonlar mevcuttur.</p>
<h3>Canva Pro Avantajlari</h3>
<p>Canva Pro ile marka kiti, arka plan kaldirma, sihirli boyutlandirma ve 100 milyondan fazla premium gorsel erisimi gibi gelismis ozelliklere erisebilirsiniz.</p>',
'Canva ile tasarim bilginiz olmadan profesyonel gorseller olusturmayi ogrenin.', 1, DATE_SUB(NOW(), INTERVAL 5 DAY), FLOOR(RAND() * 500 + 100)),

(@author2_id, 'TikTok Pazarlama Stratejileri',
'tiktok-pazarlama-stratejileri',
'<h2>TikTok''un Yukselisi</h2>
<p>TikTok, kisa video formatiyla dunyanin en hizli buyuyen sosyal medya platformu haline gelmistir. Markalar icin buyuk firsatlar sunan bu platform, ozellikle genc kitleye ulasmak isteyenler icin vazgecilmezdir.</p>
<h3>Icerik Stratejisi</h3>
<p>TikTok''ta basarili olmak icin otantik, eglenceli ve egitici icerikler uretmeniz gerekmektedir. Trend sesleri ve hashtag''leri takip etmek, iceriklerinizin virallesme sansini arttirir.</p>
<h3>TikTok Reklamlari</h3>
<p>TikTok Ads Manager ile In-Feed reklamlar, TopView reklamlar ve Branded Hashtag Challenge gibi farkli reklam formatlari kullanabilirsiniz.</p>
<h3>Influencer Isbirlikleri</h3>
<p>TikTok Creator Marketplace uzerinden markaniza uygun icerik uretcileriyle isbirligi yaparak daha genis kitlelere ulasabilirsiniz.</p>',
'TikTok''u pazarlama araci olarak nasil kullanabilirsiniz? Stratejiler ve ipuclari.', 1, DATE_SUB(NOW(), INTERVAL 6 DAY), FLOOR(RAND() * 500 + 100)),

(@author3_id, 'E-posta Pazarlama: Kapsamli Rehber',
'e-posta-pazarlama-kapsamli-rehber',
'<h2>E-posta Pazarlama Neden Onemli?</h2>
<p>E-posta pazarlama, dijital pazarlamanin en yuksek ROI (yatirim getirisi) saglayan kanallarindan biridir. Dogru stratejilerle e-posta listenizi buyutebilir ve satis donusumlerinizi arttirabilirsiniz.</p>
<h3>Liste Olusturma</h3>
<p>Kaliteli bir e-posta listesi olusturmak, basarili e-posta pazarlamasinin ilk adimidir. Lead magnet''ler, landing page''ler ve pop-up formlar ile abone sayinizi artirabilirsiniz.</p>
<h3>Segmentasyon</h3>
<p>Abonelerinizi demografik bilgiler, ilgi alanlari ve davranislarina gore segmente etmek, kisisellestirilmis icerikler gondermenizi saglar ve etkilesim oranlarini arttirir.</p>
<h3>Otomasyon</h3>
<p>Hos geldin serileri, terk edilmis sepet e-postalari ve yeniden etkilesim kampanyalari gibi otomatik akislar kurarak zamandan tasarruf edebilir ve satis donusumlerinizi artirabilirsiniz.</p>',
'E-posta pazarlamasinin temellerini ogrenin. Liste olusturma, segmentasyon ve otomasyon stratejileri.', 1, DATE_SUB(NOW(), INTERVAL 7 DAY), FLOOR(RAND() * 500 + 100)),

(@author_id, 'Facebook Reklam Hedefleme Stratejileri',
'facebook-reklam-hedefleme-stratejileri',
'<h2>Facebook Hedefleme Secenekleri</h2>
<p>Facebook, dunyanin en gelismis reklam hedefleme seceneklerini sunan platformlardan biridir. Dogru hedef kitleyi bulmak, reklam butcenizi en verimli sekilde kullanmanizi saglar.</p>
<h3>Demografik Hedefleme</h3>
<p>Yas, cinsiyet, konum, egitim durumu ve is unvani gibi demografik bilgilere gore hedefleme yapabilirsiniz.</p>
<h3>Ilgi Alani Hedefleme</h3>
<p>Kullanicilarin begendikleri sayfalar, katildiklari gruplar ve etkilesim kurdugu icerikler uzerinden ilgi alanina gore hedefleme yapabilirsiniz.</p>
<h3>Benzer Hedef Kitle (Lookalike)</h3>
<p>Mevcut musterilerinize benzer ozelliklere sahip yeni kullanicilara ulasmak icin Lookalike Audience olusturabilirsiniz. Bu yontem, donusum oranlarinizi onemli olcude artirabilir.</p>
<h3>Yeniden Pazarlama (Retargeting)</h3>
<p>Web sitenizi ziyaret eden veya iceriklerinizle etkilesim kuran kullanicilara yeniden reklam gostererek donusum oranlarinizi artirabilirsiniz.</p>',
'Facebook reklamlarinda dogru hedef kitleyi bulmanin yollarini ogrenin.', 1, DATE_SUB(NOW(), INTERVAL 8 DAY), FLOOR(RAND() * 500 + 100)),

(@author4_id, 'Video Icerik Uretiminin Temelleri',
'video-icerik-uretiminin-temelleri',
'<h2>Video Icerkin Onemi</h2>
<p>Video icerik, dijital pazarlamada en etkili iletisim aracidir. Kullanicilar metin yerine video izlemeyi tercih etmekte ve video iceriklerin etkilesim oranlari diger formatlara gore cok daha yuksek olmaktadir.</p>
<h3>Ekipman Secimi</h3>
<p>Profesyonel video cekimi icin pahali ekipmanlar gerekmez. Gunumuzde akilli telefonlar bile yuksek kaliteli video cekebilmektedir. Iyi bir isik kaynagi ve mikrofon, video kalitenizi onemli olcude arttirir.</p>
<h3>Video Duzenleme</h3>
<p>CapCut, DaVinci Resolve ve Adobe Premiere gibi araclarla videolarinizi profesyonel sekilde duzenleyebilirsiniz. CapCut, ucretsiz ve kullanimi kolay olmasiyla ozellikle baslangiclara uygundur.</p>
<h3>Platform Bazli Optimizasyon</h3>
<p>Her platform icin farkli video formatlari ve sureleri optimize edilmelidir. Instagram Reels icin 15-30 saniye, YouTube icin 8-15 dakika ideal sureler olarak one cikmaktadir.</p>',
'Video icerik uretiminin temellerini ogrenin. Ekipman, duzenleme ve platform optimizasyonu.', 1, DATE_SUB(NOW(), INTERVAL 9 DAY), FLOOR(RAND() * 500 + 100)),

(@author3_id, 'Google Analytics 4 Kullanim Rehberi',
'google-analytics-4-kullanim-rehberi',
'<h2>Google Analytics 4 Nedir?</h2>
<p>Google Analytics 4 (GA4), Google''un en yeni analitik platformudur. Olay tabanli veri modeli ile kullanici davranislarini daha detayli takip etmenizi saglar.</p>
<h3>GA4 Kurulumu</h3>
<p>GA4''u web sitenize eklemek icin Google etiket yoneticisini (GTM) kullanmaniz onerilir. GTM ile olaylari kod yazmadan takip edebilirsiniz.</p>
<h3>Temel Metrikler</h3>
<p>Aktif kullanicilar, etkilesim orani, oturum suresi, donusum orani ve gelir gibi temel metrikleri GA4 uzerinden takip edebilirsiniz.</p>
<h3>Raporlar ve Analizler</h3>
<p>GA4''un Explore bolumu ile ozel raporlar olusturabilir, kullanici segmentasyonu yapabilir ve donusum hunilerinizi analiz edebilirsiniz.</p>',
'Google Analytics 4 kurulumu, temel metrikleri ve raporlama ozelliklerini ogrenin.', 1, DATE_SUB(NOW(), INTERVAL 10 DAY), FLOOR(RAND() * 500 + 100)),

(@author_id, 'Icerik Pazarlama Stratejileri',
'icerik-pazarlama-stratejileri',
'<h2>Icerik Pazarlama Nedir?</h2>
<p>Icerik pazarlama, degerli ve ilgili icerik olusturarak hedef kitlenizi cekmek, etkilesimde tutmak ve sonucta karli musteri aksiyonlarina yonlendirmek icin kullanilan stratejik bir yaklasimdir.</p>
<h3>Icerik Turleri</h3>
<p>Blog yazilari, videolar, infografikler, podcast''ler, e-kitaplar ve sosyal medya paylasimlari icerik pazarlamasinda kullanilan baslica icerik turleridir.</p>
<h3>Icerik Takvimi</h3>
<p>Duzenli ve planlii icerik uretimi icin bir icerik takvimi olusturmak sart. Aylik veya haftalik bazda hangi iceriklerin ne zaman yayinlanacagini planlayarak tutarlilik saglayin.</p>
<h3>SEO Uyumlu Icerik</h3>
<p>Iceriklerinizin arama motorlarinda ust siralarda cikmasi icin anahtar kelime arastirmasi yapin, baslik etiketlerini optimize edin ve ic baglanti stratejisi uygulayin.</p>',
'Icerik pazarlama stratejilerini ogrenin. Icerik turleri, takvim olusturma ve SEO uyumu.', 1, DATE_SUB(NOW(), INTERVAL 11 DAY), FLOOR(RAND() * 500 + 100)),

(@author2_id, 'Sosyal Medya Yonetim Araclari',
'sosyal-medya-yonetim-araclari',
'<h2>Sosyal Medya Yonetimini Kolaylastirin</h2>
<p>Birden fazla sosyal medya hesabini yonetmek zaman alici olabilir. Sosyal medya yonetim araclari, iceriklerinizi planlamanizi, yayinlamanizi ve analiz etmenizi kolaylastirir.</p>
<h3>Hootsuite</h3>
<p>Hootsuite, birden fazla sosyal medya hesabini tek bir panel uzerinden yonetmenizi saglayan populer bir aractir. Icerik planlama, analiz ve takim isbirligi ozellikleri sunar.</p>
<h3>Buffer</h3>
<p>Buffer, basit ve kullanici dostu arayuzuyle one cikmaktadir. Icerik planlama ve performans analizi icin ideal bir aractir.</p>
<h3>Later</h3>
<p>Later, ozellikle Instagram icin tasarlanmis gorsel bir icerik planlama aracidir. Surukle birak ozelligiyle icerik takviminizi kolayca olusturabilirsiniz.</p>
<h3>Meta Business Suite</h3>
<p>Facebook ve Instagram hesaplarinizi ucretsiz olarak yonetebileceginiz Meta''nin kendi aracidir. Icerik planlama, reklam yonetimi ve analiz ozellikleri sunar.</p>',
'Sosyal medya yonetimini kolaylastiran en iyi araclari inceliyoruz.', 1, DATE_SUB(NOW(), INTERVAL 12 DAY), FLOOR(RAND() * 500 + 100)),

(@author_id, 'Yapay Zeka ile Dijital Pazarlama',
'yapay-zeka-ile-dijital-pazarlama',
'<h2>Yapay Zekanin Pazarlamaya Etkisi</h2>
<p>Yapay zeka, dijital pazarlamanin her alaninda devrim yaratmaktadir. Icerik olusturma, musteri segmentasyonu, kisiselltirme ve otomasyon gibi alanlarda yapay zeka araclari buyuk kolayliklar saglamaktadir.</p>
<h3>ChatGPT ve Icerik Olusturma</h3>
<p>ChatGPT gibi dil modelleri, blog yazilari, sosyal medya icerikleri, e-posta metinleri ve reklam kopyalari olusturmada yardimci olabilir. Ancak uretilen iceriklerin mutlaka insan tarafindan duzenlenmesi onemlidir.</p>
<h3>Gorsel Olusturma Araclari</h3>
<p>Midjourney, DALL-E ve Canva AI gibi araclarla pazarlama gorselleri olusturabilirsiniz. Bu araclar, tasarim surectni hizlandirarak maliyetleri dusurur.</p>
<h3>Veri Analizi ve Tahminleme</h3>
<p>Yapay zeka tabanli analiz araclari, musteri davranislarini tahmin etmenizi ve pazarlama stratejilerinizi optimize etmenizi saglar.</p>',
'Yapay zeka araclarini dijital pazarlamada nasil kullanabilirsiniz? Icerik, gorsel ve analiz.', 1, DATE_SUB(NOW(), INTERVAL 13 DAY), FLOOR(RAND() * 500 + 100)),

(@author3_id, 'WordPress SEO Optimizasyonu',
'wordpress-seo-optimizasyonu',
'<h2>WordPress''te SEO</h2>
<p>WordPress, dunyanin en populer icerik yonetim sistemidir ve dogru optimizasyonlarla arama motorlarinda ust siralarda yer alabilirsiniz.</p>
<h3>SEO Eklentileri</h3>
<p>Yoast SEO ve Rank Math, WordPress icin en populer SEO eklentileridir. Bu eklentiler, baslik etiketleri, meta aciklamalar ve site haritasi gibi SEO unsurlarini kolayca yonetmenizi saglar.</p>
<h3>Site Hizi Optimizasyonu</h3>
<p>WordPress sitenizin hizini artirmak icin onbellek eklentileri (WP Rocket, LiteSpeed Cache), gorsel optimizasyonu ve CDN kullanabalirsiniz.</p>
<h3>Ic Baglanti Stratejisi</h3>
<p>Icerikleriniz arasinda anlamli ic baglantilar kurarak hem kullanici deneyimini iylestirebilir hem de arama motorlarinin sitenizi daha iyi anlamasini saglayabilirsiniz.</p>',
'WordPress sitenizi SEO icin nasil optimize edebilirsiniz? Eklentiler, hiz ve strateji.', 1, DATE_SUB(NOW(), INTERVAL 14 DAY), FLOOR(RAND() * 500 + 100)),

(@author2_id, 'Influencer Pazarlama Rehberi',
'influencer-pazarlama-rehberi',
'<h2>Influencer Pazarlama Nedir?</h2>
<p>Influencer pazarlama, sosyal medyada etkili kisilerin markanizi tanitmasi icin isbirligi yapmanizdir. Dogru influencer secimi ve strateji ile marka bilinirliginizi artirabilir ve satis donusumlerinizi yukseltebilirsiniz.</p>
<h3>Influencer Turleri</h3>
<p>Nano (1K-10K), mikro (10K-100K), makro (100K-1M) ve mega (1M+) influencer kategorileri mevcuttur. Mikro influencer''lar genellikle daha yuksek etkilesim orani sunar.</p>
<h3>Dogru Influencer Secimi</h3>
<p>Hedef kitlenizle uyumlu, otantik ve guvenilir influencer''larla calismaniz onemlidir. Takipci sayisindan cok etkilesim oranina ve icerik kalitesine odaklanin.</p>
<h3>Kampanya Olcumleme</h3>
<p>Influencer kampanyalarinizin basarisini olcmek icin UTM parametreleri, ozel indirim kodlari ve sosyal medya metrikleri kullanabilirsiniz.</p>',
'Influencer pazarlamanin temelleri, influencer secimi ve kampanya olcumleme stratejileri.', 1, DATE_SUB(NOW(), INTERVAL 15 DAY), FLOOR(RAND() * 500 + 100)),

(@author_id, 'Landing Page Optimizasyonu',
'landing-page-optimizasyonu',
'<h2>Landing Page Nedir?</h2>
<p>Landing page (varis sayfasi), kullanicilarin bir reklam veya boglantiya tikladiklarinda ulastiklari, belirli bir amaca yonelik tasarlanmis web sayfasidir.</p>
<h3>Etkili Landing Page Unsurlari</h3>
<p>Dikkat cekici baslik, net deger onerisi, gorsel veya video, sosyal kanit (musteri yorumlari), ve guclu bir aksiyona cagri (CTA) butonu etkili bir landing page''in temel unsurlaridir.</p>
<h3>A/B Testi</h3>
<p>Landing page''inizin farkli vrsiyonlarini test ederek hangi unsurlarin daha iyi performans gosterdigini bulabilirsiniz. Baslik, gorsel, CTA metni ve renkleri test edebilirsiniz.</p>
<h3>Donusum Orani Optimizasyonu</h3>
<p>Form alanlarini minimize etmek, sayfa yukleme hizini artirmak, mobil uyumluluugu saglamak ve guven unsurlarini eklemek donusum oranini artiran stratejilerdir.</p>',
'Landing page tasarimi ve donusum orani optimizasyonu icin pratik ipuclari.', 1, DATE_SUB(NOW(), INTERVAL 16 DAY), FLOOR(RAND() * 500 + 100)),

(@author4_id, 'Reels ve Kisa Video Trendleri',
'reels-kisa-video-trendleri',
'<h2>Kisa Videonun Yukselisi</h2>
<p>Instagram Reels, TikTok ve YouTube Shorts gibi kisa video formatlari sosyal medyanin en populer icerik turleri haline gelmistir. Markalar ve icerik ureticileri icin buyuk firsatlar sunmaktadir.</p>
<h3>Viral Icerik Olusturma</h3>
<p>Ilk 3 saniyede dikkat cekmek, trend sesleri kullanmak, hikaye anlatimi ve egitici icerikler viral olma sansini arttirir.</p>
<h3>Gecis Efektleri ve Duzenleme</h3>
<p>CapCut ve InShot gibi uygulamalarla profesyonel gecis efektleri, metin animasyonlari ve ses duzenleme yapabilirsiniz.</p>
<h3>2025 Kisa Video Trendleri</h3>
<p>Yapay zeka destekli duzenleme, egitici icerik (edutainment), arka plan kaldirma efektleri ve kisisellestirilmis icerikler 2025''in one cikan trendleri arasindadir.</p>',
'Reels ve kisa video trendlerini ogrenin. Viral icerik olusturma ve duzenleme ipuclari.', 1, DATE_SUB(NOW(), INTERVAL 17 DAY), FLOOR(RAND() * 500 + 100)),

(@author3_id, 'E-ticaret SEO Stratejileri',
'e-ticaret-seo-stratejileri',
'<h2>E-ticarette SEO''nun Onemi</h2>
<p>E-ticaret siteleri icin organik arama trafigi en degerli trafik kaynaklarindan biridir. Dogru SEO stratejileriyle urun sayfalarinizin arama motorlarinda ust siralarda cikmasisini saglayabilirsiniz.</p>
<h3>Urun Sayfasi Optimizasyonu</h3>
<p>Urun basliklari, aciklamalari, gorselleri ve teknik ozellikleri SEO icin optimize edilmelidir. Benzersiz ve detayli urun aciklamalari yazmak ozellikle onemlidir.</p>
<h3>Kategori Sayfasi SEO</h3>
<p>Kategori sayfalarini anahtar kelime odakli basliklar, filtreleme secenekleri ve ozgun iceriklerle optimize edin.</p>
<h3>Teknik SEO</h3>
<p>Site hizi, mobil uyumluluk, yapilandirilmis veri (Schema markup), canonical etiketler ve site haritasi e-ticaret SEO''sunun teknik temellerini olusturur.</p>',
'E-ticaret siteleri icin SEO stratejileri. Urun sayfasi, kategori ve teknik optimizasyon.', 1, DATE_SUB(NOW(), INTERVAL 18 DAY), FLOOR(RAND() * 500 + 100)),

(@author2_id, 'LinkedIn Pazarlama Stratejileri',
'linkedin-pazarlama-stratejileri',
'<h2>LinkedIn''in Is Dunyasindaki Yeri</h2>
<p>LinkedIn, B2B pazarlama icin en etkili sosyal medya platformudur. Profesyonel ag kurma, marka bilinrligi ve icerik pazarlama icin mukemmel firsatlar sunar.</p>
<h3>Profil Optimizasyonu</h3>
<p>Profesyonel bir profil fotogrfai, dikkat cekici baslik, detayli deneyim bolumu ve anahtar kelimelerle zenginlestirilmis ozet yazisi LinkedIn''de gorunurlugu arttirir.</p>
<h3>Icerik Stratejisi</h3>
<p>LinkedIn''de uzun form yazilar, carousel paylasimlari, video icerikler ve makale paylasimlari yuksek etkilesim almaktadir. Kisisel deneyimler ve sektprel bilgiler paylasan icerikler one cikmaktadir.</p>
<h3>LinkedIn Reklamlari</h3>
<p>Sponsored Content, Message Ads ve Dynamic Ads gibi reklam formatlariyla hedef kitlenize ulasabilirsiniz. LinkedIn''in detayli is unvani ve sirket bazli hedefleme secenekleri B2B pazarlama icin cok degerlidir.</p>',
'LinkedIn''i pazarlama araci olarak kullanmanin yollari. Profil, icerik ve reklam stratejileri.', 1, DATE_SUB(NOW(), INTERVAL 19 DAY), FLOOR(RAND() * 500 + 100)),

(@author_id, 'Dijital Pazarlamada Butce Yonetimi',
'dijital-pazarlamada-butce-yonetimi',
'<h2>Butce Planlamasi</h2>
<p>Dijital pazarlama butcenizi dogru planlamak, yatiriminizin karsiligini almaniz icin kritik oneme sahiptir. Kanallar arasi butce dagilimini dogru yapmak ve performansa gore optimize etmek gerekir.</p>
<h3>Kanal Bazli Butce Dagilimi</h3>
<p>Hedeflerinize gore butcenizi SEO, sosyal medya reklamlari, Google Ads, e-posta pazarlama ve icerik uretimi arasinda dagitin. Her kanalin ROI''sini duzanli olarak olcun.</p>
<h3>ROAS Hesaplama</h3>
<p>Return on Ad Spend (ROAS), reklam harcamalarinizin ne kadar gelir getirdigini gosterir. Her kampanyanin ROAS degerini takip ederek butcenizi en verimli kanallara yonlendirin.</p>
<h3>Kucuk Butceyle Baslamak</h3>
<p>Dusuk butcelerle bile etkili dijital pazarlama yapabilirsiniz. Organik icerik uretimi, SEO ve sosyal medya topluluk yonetimi dusuk maliyetli ancak etkili stratejilerdir.</p>',
'Dijital pazarlama butcenizi nasil planlar ve yonetirsiniz? ROAS hesaplama ve optimizasyon.', 1, DATE_SUB(NOW(), INTERVAL 20 DAY), FLOOR(RAND() * 500 + 100))

ON DUPLICATE KEY UPDATE title=VALUES(title);
