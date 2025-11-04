# Dockerfile
FROM php:8.2-apache

# ติดตั้ง PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

# เปิด mod_rewrite (ถ้าใช้ .htaccess)
RUN a2enmod rewrite

# ตั้งค่า DocumentRoot
ENV APACHE_DOCUMENT_ROOT /var/www/html/app/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# สิทธิ์
RUN chown -R www-data:www-data /var/www/html