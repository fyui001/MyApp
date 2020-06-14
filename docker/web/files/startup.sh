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

#パーミッションまわり
chown -R nginx:nginx /var/www/html/storage
chown -R nginx:nginx /var/www/html/bootstrap/cache
chmod -R 755 /var/www/html
chmod -R 766 /var/www/html/storage
chmod -R 766 /var/www/html/bootstrap/cache
php-fpm7 && nginx -g "daemon off;"
