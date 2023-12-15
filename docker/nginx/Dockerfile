# build NGINX
FROM nginx:alpine as nginx_stage

WORKDIR /var/www

COPY docker/nginx/ /etc/nginx

EXPOSE 80

STOPSIGNAL SIGTERM

CMD ["nginx", "-g", "daemon off;"]
