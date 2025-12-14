FROM php:8.1-apache

# Systemtools + Composer + PHP Extensions
RUN apt-get update && apt-get install -y \
    curl unzip autoconf gcc make \
 && docker-php-ext-install pdo_mysql \
 && rm -rf /var/lib/apt/lists/*

# Apache: rewrite + DocumentRoot = /web (Watson public folder)
RUN a2enmod rewrite \
 && sed -i 's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/web#g' /etc/apache2/sites-available/000-default.conf

# AllowOverride (htaccess) + access
RUN printf '%s\n' \
'<Directory /var/www/html/web>' \
'    AllowOverride All' \
'    Require all granted' \
'</Directory>' \
> /etc/apache2/conf-available/watson.conf \
 && a2enconf watson

# (Optional, aber praktisch) Deprecated Notices unterdrücken
RUN printf '%s\n' \
'display_errors=On' \
'error_reporting=E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED' \
> /usr/local/etc/php/conf.d/watson.ini

# Composer installieren
RUN curl -sS https://getcomposer.org/installer | php \
 && mv composer.phar /usr/local/bin/composer \
 && chmod +x /usr/local/bin/composer