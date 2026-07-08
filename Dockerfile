# Imagem PHP com Apache embutido.
FROM php:8.2-apache

# Extensões necessárias para acesso ao MariaDB/MySQL via PDO.
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Habilita mod_rewrite (necessário para o .htaccess / front controller).
RUN a2enmod rewrite

# Permite o uso de .htaccess (AllowOverride All) no document root.
RUN printf '<Directory /var/www/html>\n    AllowOverride All\n    Require all granted\n</Directory>\n' \
    > /etc/apache2/conf-available/app-override.conf \
    && a2enconf app-override

# Configura o include_path para incluir a raiz e views, ativa output buffering e remove avisos de depreciação
RUN printf 'include_path = ".:/var/www/html:/var/www/html/views"\noutput_buffering = On\nerror_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT\n' > /usr/local/etc/php/conf.d/custom-php.ini

WORKDIR /var/www/html
