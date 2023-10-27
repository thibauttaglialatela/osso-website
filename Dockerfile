# Utilisation de l'image officielle PHP 8.2 avec Apache
FROM php:8.2-apache

# Installation des dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libmagickwand-dev \
    libicu-dev

# Activation des extensions PHP requises
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql gd intl pgsql imagick

# Activer les modules Apache nécessaires
RUN a2enmod rewrite
RUN a2enmod headers

# Copie de l'application Symfony dans le conteneur
COPY . /var/www/html

# Installation de Composer et Yarn
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apt-get install -y npm && npm install -g yarn

# Exposer le port Apache
EXPOSE 80

# Lancer Apache au démarrage du conteneur
CMD ["apache2-foreground"]

