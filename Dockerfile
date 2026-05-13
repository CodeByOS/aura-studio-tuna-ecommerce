# Use official PHP image with Apache
FROM php:8.3-apache

# Install system dependencies and PHP extensions in one step
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    zip \
    unzip \
    postgresql-client \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        pgsql \
        mbstring \
        xml \
        curl \
        tokenizer \
        bcmath \
        ctype \
    && apt-get remove -y libpq-dev libonig-dev libxml2-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache modules
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer.json composer.lock* ./

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies with retry logic
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress || \
    (composer clear-cache && composer install --no-dev --optimize-autoloader --no-interaction --no-progress)

# Copy application files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configure Apache DocumentRoot and .htaccess
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Copy .htaccess if it exists, or create default
RUN echo '<IfModule mod_rewrite.c>\n\
    <IfModule mod_negotiation.c>\n\
        Options -MultiViews -Indexes\n\
    </IfModule>\n\
    RewriteEngine On\n\
    RewriteCond %{HTTP:Authorization} .\n\
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]\n\
    RewriteCond %{REQUEST_FILENAME} !-f\n\
    RewriteCond %{REQUEST_FILENAME} !-d\n\
    RewriteRule ^ index.php [L]\n\
</IfModule>' > /var/www/html/public/.htaccess

# Expose port
EXPOSE 80

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=40s --retries=3 \
    CMD curl -f http://localhost/health || exit 1

# Start Apache
CMD ["apache2-foreground"]
