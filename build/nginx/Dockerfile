FROM ubuntu:latest
RUN apt-get update && apt-get install -y nginx vim nano

COPY nginx.conf /etc/nginx/nginx.conf
ADD sites-enabled /etc/nginx/sites-enabled

RUN mkdir -p /var/log/nginx

WORKDIR /symfony

EXPOSE 80
EXPOSE 443

ARG APP_USER=www

RUN useradd --user-group --create-home --shell /bin/false ${APP_USER}
USER ${APP_USER}

CMD ["nginx"]
