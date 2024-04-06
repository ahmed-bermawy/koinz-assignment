FROM php:8.2-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install dependencies
RUN apt-get update && apt-get install -y \
    nano \
    curl \
    libonig-dev \
    libpng-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd pdo_mysql

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer
RUN chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Change existing application directory permissions
RUN chown -R www-data:www-data /var/www/html

# Run Composer install
RUN composer install --ignore-platform-reqs

# Copy .env.example to .env
COPY .env.example .env

# Generate application key
RUN php artisan key:generate

# Cache config
RUN php artisan config:cache

# Change user to non-root
USER $user

CMD ["php-fpm"]
