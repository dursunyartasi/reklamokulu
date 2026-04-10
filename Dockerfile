FROM php:8.3-apache

# Gerekli PHP uzantilari
RUN docker-php-ext-install pdo pdo_mysql

# Apache mod_rewrite aktif et
RUN a2enmod rewrite

# Apache DocumentRoot'u public klasorune yonlendir
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# AllowOverride All - .htaccess calissin
RUN sed -ri -e 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# PHP: Docker env vars icin variables_order EGPCS olmali
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" && \
    sed -i 's/variables_order = "GPCS"/variables_order = "EGPCS"/' "$PHP_INI_DIR/php.ini"

# Cache bust - force rebuild
ARG CACHEBUST=7

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
