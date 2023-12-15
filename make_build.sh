#!/bin/bash

docker build -f docker/php/Dockerfile -t vdmitriev/vdmitriev-lamoda-test/php:latest .
echo "Сборка php image завершена" .
docker build -t vdmitriev/vdmitriev-lamoda-test/nginx:latest -f docker/nginx/Dockerfile .
echo "Сборка nginx image завершена" .
echo "Скрипт завершен"