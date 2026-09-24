FROM php:8.5-cli
RUN apt-get update && apt-get install -y --no-install-recommends git unzip && rm -rf /var/lib/apt/lists/* \
 && pecl install pcov xdebug && docker-php-ext-enable pcov \
 && echo 'pcov.enabled=1' > /usr/local/etc/php/conf.d/zz-pcov.ini
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /app
