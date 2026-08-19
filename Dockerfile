FROM node:22-alpine AS frontend

WORKDIR /app
COPY . .
RUN npm ci && npm run build

FROM composer:2.8 AS dependencies

WORKDIR /app
COPY . .
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --prefer-dist \
    --optimize-autoloader

FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html
COPY . .
COPY --from=dependencies /app/vendor ./vendor
COPY --from=frontend /app/public/build ./public/build

ENV SKIP_COMPOSER=1 \
    WEBROOT=/var/www/html/public \
    PHP_ERRORS_STDERR=1 \
    RUN_SCRIPTS=1 \
    REAL_IP_HEADER=1 \
    APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    COMPOSER_ALLOW_SUPERUSER=1

RUN rm -f public/hot \
    && chmod +x scripts/00-laravel-deploy.sh \
    && chmod -R ug+rwX storage bootstrap/cache

CMD ["/start.sh"]
