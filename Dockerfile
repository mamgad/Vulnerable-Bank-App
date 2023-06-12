FROM debian

ARG DEBIAN_FRONTEND=noninteractive
RUN apt-get update && apt-get install -y \
  mariadb-server \
  php \
  php-mysql \
  php-curl \
  && rm -rf /var/lib/apt/lists/*
COPY src/ /var/www/html/
COPY flag.txt /var/www/
RUN service mariadb start; mysql -e "CREATE DATABASE ict; \
CREATE USER ict@localhost IDENTIFIED BY 'password'; \
GRANT ALL PRIVILEGES ON ict.* TO ict@'localhost'; \
FLUSH PRIVILEGES; use ict; \
CREATE TABLE IF NOT EXISTS users ( \
 id int(11) NOT NULL AUTO_INCREMENT, \
 email varchar(50) NOT NULL, \
 password varchar(50) NOT NULL, \
 balance float(50) NOT NULL DEFAULT 0, \
 trn_date datetime NOT NULL, \
 PRIMARY KEY (id) \
 ); \
 CREATE TABLE IF NOT EXISTS reset_tokens ( \
 id int(11) NOT NULL AUTO_INCREMENT, \
 token varchar(50) NOT NULL, \
 token_date datetime NOT NULL, \
 PRIMARY KEY (id) \
 ); \
"
COPY load.php /var/
RUN service mariadb start; php /var/load.php
EXPOSE 80

WORKDIR /var/www/html
CMD service mariadb start; PHP_CLI_SERVER_WORKERS=30 php -S 0.0.0.0:80

#CMD service mysql start; apachectl -D FOREGROUND
