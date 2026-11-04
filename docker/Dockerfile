# Image du site CJF Saint-Malo Pentathlon Moderne : PHP 8.3 + Apache
FROM php:8.3-apache

# Extensions : gd (conversion des images en WebP), zip (exports Excel)
RUN apt-get update \
 && apt-get install -y --no-install-recommends libpng-dev libjpeg62-turbo-dev libwebp-dev libfreetype6-dev libzip-dev \
 && docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype \
 && docker-php-ext-install -j"$(nproc)" gd zip \
 && a2enmod headers expires deflate \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY docker/apache.conf /etc/apache2/conf-enabled/cjf.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/cjf.ini
COPY docker/entrypoint.sh /usr/local/bin/cjf-entrypoint
RUN chmod +x /usr/local/bin/cjf-entrypoint

ENTRYPOINT ["cjf-entrypoint"]
CMD ["apache2-foreground"]
