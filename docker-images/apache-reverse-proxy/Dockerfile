FROM php:7.2-apache

COPY templates /var/apache2/templates
COPY conf/ /etc/apache2/ 
COPY apache2-foreground /usr/local/bin/

RUN apt-get update && apt-get install -y vim 
RUN a2enmod proxy proxy_http proxy_balancer lbmethod_byrequests status 
RUN a2ensite 000-* 001-*   
