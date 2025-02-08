FROM php:8.2-apache

# Abilita moduli PHP necessari
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Abilita mod_rewrite per Apache
RUN a2enmod rewrite

# Imposta i permessi corretti
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Esponi la porta 80
EXPOSE 80

# Assicurati che Apache possa scrivere nella directory
RUN usermod -u 1000 www-data \
    && groupmod -g 1000 www-data