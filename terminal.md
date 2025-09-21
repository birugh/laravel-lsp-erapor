php artisan make:controller NamaController
php artisan make:model NamaModel -m -s
php artisan make:migration create_nama_table
php artisan make:seeder NamaSeeder
php artisan make:factory NamaFactory
php artisan make:middleware NamaMiddleware

php artisan migrate
php artisan migrate:fresh
php artisan migrate:refresh
php artisan migrate:rollback
php artisan db:seed
php artisan db:seed --class=NamaSeeder
php artisan migrate --seed

php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize

php artisan route:list
