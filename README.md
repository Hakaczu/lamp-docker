# Linux Apache MariaDB PHP - multi-version via docker-compose
Nginx front routes traffic to multiple PHP-FPM versions (per folder) with MariaDB and phpMyAdmin.

## Quick start
```bash
git clone https://github.com/Hakaczu/lamp-docker.git
cd lamp-docker
cp .env.example .env
# (optional) adjust ports and credentials in .env
docker-compose up -d
```

Services:
- Nginx entrypoint: http://127.0.0.1:${PHP_PORT:-8080}
- PHP 8.2 app: http://127.0.0.1:${PHP_PORT:-8080}/php82/
- PHP 8.1 app: http://127.0.0.1:${PHP_PORT:-8080}/php81/
- phpMyAdmin: http://127.0.0.1:${PHPMYADMIN_PORT:-8000}

## Configuration
Environment is driven by `.env` (not committed). Default values are in [.env.example](.env.example):
- `PHP_PORT` / `PHPMYADMIN_PORT` – exposed host ports
- `MYSQL_ROOT_PASSWORD` – root password for MariaDB (change it!)
- `MYSQL_DATABASE`, `MYSQL_USER`, `MYSQL_PASSWORD` – app database and credentials

## Adding another PHP version
- Duplicate the `php82` service block in [docker-compose.yaml](docker-compose.yaml), change the image (e.g., `php:8.3-fpm`), service name, and mount the same `./htdocs` volume.
- In [nginx/conf.d/default.conf](nginx/conf.d/default.conf), add a pair of `location /phpXX/ { ... }` blocks pointing to the new service.
- Create `htdocs/phpXX` with your app code (copy one of the sample folders).

## Notes
- MariaDB healthcheck remains; php containers depend_on the DB.
- phpMyAdmin connects to the `mariadb` service automatically via `PMA_HOST`.
- Use `docker-compose logs -f` for troubleshooting startup issues.
