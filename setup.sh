#!/bin/bash

echo "Backend env copying ..."
cp news-aggregator-be/.env.example news-aggregator-be/.env

echo "Stoping all container ..."
docker-compose down --remove-orphans

echo "Frontend env copying ..."
cp news-aggregator-fe/.env.example news-aggregator-fe/.env

echo "New docker-compose build started ..."
echo "Please wait for a while to build with no cache ...."
echo "Run container with detach mode ...."
# docker-compose up --build -d
docker-compose build --no-cache
docker-compose up -d
echo "Generating new backend app key ...."
docker exec -it backend-container php artisan key:generate

# echo "Backend config clearing ..."
docker exec -it backend-container php artisan config:clear
# echo "Backend cache clearing ..."
docker exec -it backend-container php artisan cache:clear
docker exec -it backend-container php artisan optimize:clear 
echo "Waiting for MySQL db container ready ......\n"
sleep 15
echo "Migrating backend schema"
docker exec -it backend-container php artisan migrate:fresh
echo "Generating demo seed data"
docker exec -it backend-container php artisan db:seed

docker exec -it backend-container php artisan key:generate

docker exec -it laravel-supervisor composer install
docker exec -it laravel-supervisor composer dump-autoload --no-scripts

docker exec -it backend-container chmod 775 -R /var/www/html/
docker exec -it backend-container chown -R www-data:www-data /var/www/html/

# Fetch news feed
# docker exec -it backend-container php artisan newsfeed:fetch

# echo "Running lint on frontend container"
# docker exec -it frontend-container npm i dompurify

echo "Please click http://localhost:7890 to visit the app"
