# ==========================================
# Stage 1: Build Vue application
# ==========================================

FROM node:24-alpine AS frontend

WORKDIR /app

COPY package*.json ./

RUN npm ci

COPY . .

RUN npm run build


# ==========================================
# Stage 2: PHP + Apache
# ==========================================

FROM php:8.3-apache

RUN a2enmod rewrite

# Vue production build
COPY --from=frontend /app/dist/ /var/www/html/

# PHP API
COPY api/ /var/www/html/api/

# Apache configuration
COPY apache.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 80

CMD ["apache2-foreground"]