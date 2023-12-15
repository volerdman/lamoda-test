#!/bin/bash
docker build -f docker/nginx/Dockerfile .
docker build -f docker/php/Dockerfile .

docker run -d --name vdmitriev_php_test
sudo docker cp vdmitriev_php_test:/var/www/vendor/. ./vendor
docker cp vdmitriev_php_test:/var/www/composer.lock ./composer.lock
docker stop vdmitriev_php_test
docker rm vdmitriev_php_test
docker-compose up --force-recreate