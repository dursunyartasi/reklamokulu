FROM php:8.3-apache

# Gerekli PHP uzantilari
RUN docker-php-ext-install pdo pdo_mysql

# Cache bust - force rebuild
ARG CACHEBUST=5

# Apache modullerini aktif et (ayri ayri, hata durumunda devam etsin)
RUN a2enmod rewrite && \
    a2enmod headers && \
    a2enmod expires && \
    a2enmod deflate

# Apache DocumentRoot'u public klasorune yonlendir
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# AllowOverride All - .htaccess calissin
RUN sed -ri -e 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# PHP production ayarlari
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" && \
    echo "upload_max_filesize = 10M" >> "$PHP_INI_DIR/php.ini" && \
    echo "post_max_size = 12M" >> "$PHP_INI_DIR/php.ini" && \
    echo "max_execution_time = 120" >> "$PHP_INI_DIR/php.ini" && \
    echo "expose_php = Off" >> "$PHP_INI_DIR/php.ini" && \
    echo "display_errors = Off" >> "$PHP_INI_DIR/php.ini" && \
    echo "log_errors = On" >> "$PHP_INI_DIR/php.ini" && \
    echo "session.cookie_httponly = 1" >> "$PHP_INI_DIR/php.ini" && \
    echo "session.cookie_samesite = Lax" >> "$PHP_INI_DIR/php.ini" && \
    echo "session.use_strict_mode = 1" >> "$PHP_INI_DIR/php.ini" && \
    echo "variables_order = EGPCS" >> "$PHP_INI_DIR/php.ini"

# Apache guvenlik ayarlari
RUN echo "ServerTokens Prod" >> /etc/apache2/conf-enabled/security.conf && \
    echo "ServerSignature Off" >> /etc/apache2/conf-enabled/security.conf

# Proje dosyalarini kopyala
COPY . /var/www/html/

# Upload dizinlerini olustur
RUN mkdir -p /var/www/html/public/uploads/courses \
    /var/www/html/public/uploads/blog \
    /var/www/html/public/uploads/instructors

# Izinler
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html/public/uploads

EXPOSE 80
