docker-compose up -d --build
cd Larvel-tst
docker-compose exec php-cli bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate