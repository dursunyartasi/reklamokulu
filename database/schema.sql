-- Reklam Okulu Veritabani Semasi
-- Coolify'da veritabani adi "default" olarak olusturuldu
-- Eger farkli bir isim kullaniyorsaniz asagidaki satiri guncelleyin
USE `default`;

-- Kullanicilar
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20) DEFAULT NULL,
    avatar VARCHAR(255) DEFAULT NULL,
    role ENUM('student','instructor','admin') DEFAULT 'student',
    is_active TINYINT(1) DEFAULT 1,
    email_verified_at DATETIME DEFAULT NULL,
    remember_token VARCHAR(100) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Kategoriler
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT DEFAULT NULL,
    sort_order INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Egitmenler (profil detaylari)
CREATE TABLE instructors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) DEFAULT NULL,
    bio TEXT DEFAULT NULL,
    expertise VARCHAR(255) DEFAULT NULL,
    linkedin VARCHAR(255) DEFAULT NULL,
    instagram VARCHAR(255) DEFAULT NULL,
    website VARCHAR(255) DEFAULT NULL,
    sort_order INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Kurslar
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    instructor_id INT NOT NULL,
    category_id INT DEFAULT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT DEFAULT NULL,
    short_description VARCHAR(500) DEFAULT NULL,
    thumbnail VARCHAR(255) DEFAULT NULL,
    preview_video VARCHAR(255) DEFAULT NULL,
    price DECIMAL(10,2) DEFAULT 0.00,
    sale_price DECIMAL(10,2) DEFAULT NULL,
    duration VARCHAR(50) DEFAULT NULL,
    level ENUM('beginner','intermediate','advanced') DEFAULT 'beginner',
    is_published TINYINT(1) DEFAULT 0,
    is_free TINYINT(1) DEFAULT 0,
    sort_order INT DEFAULT 0,
    total_students INT DEFAULT 0,
    last_updated DATE DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (instructor_id) REFERENCES instructors(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Kurs Bolumleri
CREATE TABLE course_sections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    sort_order INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Dersler
CREATE TABLE lessons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) DEFAULT NULL,
    video_url VARCHAR(500) DEFAULT NULL,
    video_duration INT DEFAULT 0 COMMENT 'saniye cinsinden',
    content TEXT DEFAULT NULL,
    is_free_preview TINYINT(1) DEFAULT 0,
    sort_order INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (section_id) REFERENCES course_sections(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Kurs Kayitlari (satin alimlar)
CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    price_paid DECIMAL(10,2) DEFAULT 0.00,
    payment_method VARCHAR(50) DEFAULT NULL,
    payment_id VARCHAR(255) DEFAULT NULL,
    status ENUM('active','expired','refunded') DEFAULT 'active',
    enrolled_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    UNIQUE KEY unique_enrollment (user_id, course_id)
) ENGINE=InnoDB;

-- Ders Ilerleme Takibi
CREATE TABLE lesson_progress (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    lesson_id INT NOT NULL,
    is_completed TINYINT(1) DEFAULT 0,
    watch_time INT DEFAULT 0 COMMENT 'saniye cinsinden',
    completed_at DATETIME DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (lesson_id) REFERENCES lessons(id) ON DELETE CASCADE,
    UNIQUE KEY unique_progress (user_id, lesson_id)
) ENGINE=InnoDB;

-- Sertifikalar
CREATE TABLE certificates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    certificate_code VARCHAR(50) NOT NULL UNIQUE,
    issued_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Siparisler
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_number VARCHAR(50) NOT NULL UNIQUE,
    total_amount DECIMAL(10,2) NOT NULL,
    discount_amount DECIMAL(10,2) DEFAULT 0.00,
    coupon_code VARCHAR(50) DEFAULT NULL,
    payment_method VARCHAR(50) DEFAULT NULL,
    payment_id VARCHAR(255) DEFAULT NULL,
    installment INT DEFAULT 1,
    status ENUM('pending','completed','failed','refunded') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Siparis Detaylari
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    course_id INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Kupon Kodlari
CREATE TABLE coupons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) NOT NULL UNIQUE,
    discount_type ENUM('percent','fixed') DEFAULT 'percent',
    discount_value DECIMAL(10,2) NOT NULL,
    min_amount DECIMAL(10,2) DEFAULT 0.00,
    max_uses INT DEFAULT NULL,
    used_count INT DEFAULT 0,
    valid_from DATETIME DEFAULT NULL,
    valid_until DATETIME DEFAULT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Blog Yazilari
CREATE TABLE blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    content LONGTEXT DEFAULT NULL,
    excerpt VARCHAR(500) DEFAULT NULL,
    thumbnail VARCHAR(255) DEFAULT NULL,
    is_published TINYINT(1) DEFAULT 0,
    published_at DATETIME DEFAULT NULL,
    views INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- SSS
CREATE TABLE faqs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(500) NOT NULL,
    answer TEXT NOT NULL,
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Iletisim Formlari
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) DEFAULT NULL,
    company VARCHAR(255) DEFAULT NULL,
    subject VARCHAR(255) DEFAULT NULL,
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Kurumsal Egitim Talepleri
CREATE TABLE corporate_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    company VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) DEFAULT NULL,
    message TEXT DEFAULT NULL,
    status ENUM('new','contacted','completed','cancelled') DEFAULT 'new',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Bire Bir Gorusmeler
CREATE TABLE meetings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    preferred_date DATE NOT NULL,
    preferred_time VARCHAR(10) NOT NULL,
    duration INT DEFAULT 30,
    notes TEXT DEFAULT NULL,
    meeting_link VARCHAR(500) DEFAULT NULL,
    status ENUM('pending','approved','completed','cancelled') DEFAULT 'pending',
    admin_notes TEXT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
) ENGINE=InnoDB;

-- Site Ayarlari
CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Varsayilan Ayarlar
INSERT INTO settings (setting_key, setting_value) VALUES
('site_name', 'Reklam Okulu'),
('site_description', 'Dijital Pazarlama Egitim Platformu'),
('site_email', 'info@reklamokulu.com'),
('site_phone', ''),
('site_address', ''),
('instagram', ''),
('linkedin', ''),
('youtube', ''),
('facebook_pixel', ''),
('google_analytics', ''),
('countdown_date', ''),
('countdown_text', ''),
('hero_title', 'Dijital Pazarlamayi En Iyi Sekilde Ogrenmeye Hazir Misiniz?'),
('hero_subtitle', 'Uzman egitmenlerle, pratik odakli egitimlerle kariyerinizi bir ust seviyeye tasiyin.');

-- Varsayilan Admin Kullanici
INSERT INTO users (first_name, last_name, email, password, role) VALUES
('Admin', 'User', 'admin@reklamokulu.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
-- Varsayilan sifre: password