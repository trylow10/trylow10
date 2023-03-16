FROM php:7.4-apache
WORKDIR /var/www
COPY . .
CMD [ "php", "./index.php" ]
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
