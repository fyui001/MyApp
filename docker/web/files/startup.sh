cd /var/www/html

composer install
php artisan key:generate
npm install

php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# webpackのビルドモード、適宜変更
#npm run dev
npm run prod


# database mingrate
php artisan migrate

chmod -R 777 /code/storage
chmod -R 777 /code/bootstrap
php-fpm7 && nginx -g "daemon off;"
