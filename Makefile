REGISTRY='vdmitriev/vdmitriev-lamoda-test'

# сборка
.PHONY: build.service
build.service: build.php build.nginx service.start migrations.migrate

# сборка php
build.php:
	DOCKER_BUILDKIT=1 docker build \
		-f ./docker/php/Dockerfile . \
		-t ${REGISTRY}/nginx:latest

# сборка nginx
build.nginx:
	DOCKER_BUILDKIT=1 docker build --no-cache \
		-f ./docker/nginx/Dockerfile . \
		-t ${REGISTRY}/nginx:latest

service.start:
	docker-compose up -d

migrations.migrate:
	docker-compose -f docker-compose.yaml exec php php bin/console doctrine:migrations:migrate --no-interaction

