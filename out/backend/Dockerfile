
# ==========================================
# Stage 2: PHP + Apache
# ==========================================

FROM php:8.3-apache

RUN a2enmod rewrite

# Apache configuration
COPY backend/apache.conf /etc/apache2/sites-available/000-default.conf

# PHP API
COPY backend/api/ /var/www/html/api/


RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 80

CMD ["apache2-foreground"]