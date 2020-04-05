cp .env.example .env

cp public/img/sample/* storage/app/public/images/ 

echo -e "############################
Installing Composer dependencies
############################";
composer install

echo -e "############################
Generating app key
############################";
php artisan key:generate

echo -e "############################
Creating storage symlink
############################";
php artisan storage:link

echo -e "############################
Running DB migrations
############################";
php artisan migrate

echo -e "############################
Installing npm dependencies
############################";
npm install

echo -e "############################
Building assets
############################";
npm run dev

echo -e "############################
All Done!
############################";