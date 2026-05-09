# Menggunakan image PHP 8.2 dengan web server Apache bawaan
FROM php:8.2-apache

# Mengaktifkan modul rewrite Apache (penting untuk routing PHP native/htaccess)
RUN a2enmod rewrite

# Mengubah default folder Apache agar langsung membaca folder 'public'
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Menyalin seluruh file project Anda ke dalam server
COPY . /var/www/html/

# Memberikan hak akses folder yang benar
RUN chown -R www-data:www-data /var/www/html/

# Membuka port 80 untuk web
EXPOSE 80