FROM php:8.1-apache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install pdo_mysql mysqli

WORKDIR /var/www/html

# Habilita o mod_rewrite do Apache e garante que AllowOverride All esteja ativo
# para o DocumentRoot. Isso pode variar um pouco dependendo da configuração
# exata do Apache na imagem base, mas geralmente o 000-default.conf é o alvo.
RUN a2enmod rewrite \
    && sed -i '/<Directory \/var\/www\/html>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/sites-available/000-default.conf
# Se o comando sed acima não funcionar, pode ser que a configuração esteja no apache2.conf:
# && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf


COPY . .

RUN composer install
