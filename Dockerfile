	# Use the official PHP 7.4 image as the base image
FROM php:8.1-fpm
 
# Set the working directory inside the container
WORKDIR /var/www/html
 
# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip
 
# Install PHP extensions
RUN apt-get install -y php8.1-cli php8.1-common php8.1-mysql php8.1-zip php8.1-gd php8.1-mbstring php8.1-curl php8.1-xml php8.1-bcmath php8.1-fpm
 
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
 
# Copy the project files to the working directory
COPY . .
 
# Set up environment variables
ENV APP_ENV=production
ENV APP_KEY=base64:your_app_key_here
ENV DB_CONNECTION=mysql
ENV DB_HOST=your_db_host
ENV DB_PORT=3306
ENV DB_DATABASE=your_db_name
ENV DB_USERNAME=your_db_username
ENV DB_PASSWORD=your_db_password
 
# Set up labels
LABEL maintainer="Your Name <your_email@example.com>"
LABEL description="Dockerfile for Laravel 10 project"
 
# Expose port 9000 for PHP-FPM
EXPOSE 9000
 
# Run the application
CMD ["php-fpm"]