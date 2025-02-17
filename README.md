# Project Setup
composer update
# Project Setup .env
cp .env.example .env
# Project Setup Key
php artisan key:generate
# Project Setup migrate
php artisan migrate
# Create Permission
php artisan db:seed --class=PermissionSeeder
# Admin Create
php artisan db:seed --class=CreateAdminUserSeeder
# Project Run
php artisan serve

# Credentials
email : susmita@gmail.com
password : 123456
