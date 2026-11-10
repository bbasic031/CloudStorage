# ngCloud – Laravel 11 zadatak

## Postavljanje
```bash
composer create-project laravel/laravel:^11.0 ngcloud
cd ngcloud
# kopiraj sadržaj ovog foldera preko projekta (prepisuje bootstrap/app.php,
# app/Models/User.php, app/Providers/AppServiceProvider.php,
# database/factories/UserFactory.php i database/seeders/DatabaseSeeder.php)
```
U `.env` postavi MySQL:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ngcloud
DB_USERNAME=root
DB_PASSWORD=
```
Stvori praznu bazu `ngcloud`, pa:
```bash
php artisan migrate:fresh --seed
php artisan serve
```
Demo računi (lozinka `password`): `superadmin`, `admin`, `user`.

Za veće uploade povećaj `upload_max_filesize` i `post_max_size` u php.ini.
