# CloudStorage

Laravel 11 "cloud" aplikacija: upload, download i brisanje datoteka, uloge
(super_admin, admin, user), kvota prostora po korisniku.

## Pokretanje
1. `composer install`
2. `copy .env.example .env`
3. `php artisan key:generate`
4. U `.env` upiši lozinku za MySQL (`DB_PASSWORD`) i stvori praznu bazu:
   `CREATE DATABASE cloudstorage CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;`
5. `php artisan migrate:fresh --seed`
6. `php artisan serve`

## Demo računi (lozinka: `password`)
| Korisničko ime | Uloga |
|---|---|
| superadmin | super admin: sve datoteke, brisanje, popis korisnika |
| admin | admin: sve datoteke i popis korisnika, briše samo svoje |
| ivan.horvat | user: samo svoje datoteke |

Ostali korisnici se generiraju nasumično (hrvatska imena); njihov username je `ime.prezime`.

## Napomena
`public/index.php` gasi PHP "deprecated" upozorenja zbog PHP 8.5 (Laravel 11 ih na 8.5 ispisuje).