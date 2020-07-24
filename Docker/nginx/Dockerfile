FROM debian:jessie

MAINTAINER Jakub Rusinowicz <rusinowiczjakub@gmail.com>

RUN apt-get update && apt-get install -y \
    nginx

ADD nginx.conf /etc/nginx/
ADD default.conf /etc/nginx/sites-available/

RUN ln -s /etc/nginx/sites-available/default.conf /etc/nginx/sites-enabled/

RUN echo "upstream php-upstream { server php-fpm:9000; }" > /etc/nginx/conf.d/upstream.conf

#RUN adduser -D -g '' -G www-data www-data

RUN chown -R www-data:www-data /usr/share/nginx/html

RUN usermod -u 1000 www-data

CMD ["nginx"]

EXPOSE 80
EXPOSE 443
