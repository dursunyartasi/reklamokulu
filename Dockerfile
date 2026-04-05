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

# Cache bust - force rebuild
ARG CACHEBUST=2

# Proje dosyalarini kopyala
COPY . /var/www/html/

# Izinler
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html/public/uploads

EXPOSE 80