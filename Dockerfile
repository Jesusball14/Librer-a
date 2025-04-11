# Etapa de construcción
FROM composer:2 as builder

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

COPY . .
RUN composer dump-autoload --optimize

# Etapa de producción
FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

# Instalar dependencias del sistema
RUN apk add --no-cache \
    nginx \
    supervisor \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Copiar configuración de Nginx y Supervisor
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copiar la aplicación construida
COPY --from=builder /app /var/www/html

# Configurar permisos y optimización
RUN mkdir -p /var/www/html/storage/app/public/defaults && \
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache && \
    php artisan storage:link && \
    php artisan config:cache && \
    php artisan view:cache

HEALTHCHECK --interval=30s --timeout=30s --start-period=5s --retries=3 \
CMD curl -f http://localhost:8080 || exit 1

EXPOSE 8080
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]