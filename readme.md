# SPPAK e-Gov (backend)
An e-government project for birth administration.
SPPAK stands for "Sistem Pencatatan dan Pembuatan Akta Kelahiran".

This is not real system and is build for course completion only.

## Installation
- Follow installation steps from [Laravel Installation Instructions](https://laravel.com/docs/5.2/installation).
- Import MySQL database `db_ppl_core`.
- Create new MySQL database named `sppak`.
- Rename .env.example to .env. 
- Configure DB_HOST, DB_DATABASE=sppak, DB_USERNAME, DB_PASSWORD.
- Run `php artisan key:generate`
- Run `composer install`.
- Run `php artisan migrate`.

## Technology Stack
This project is built with:
- Laravel 5.2
- PHP 5.6
- MySQL 5.6

## Contributors
We are students from *Institut Teknologi Bandung*, Indonesia:
- Devina Ekawati
- Fiqie Ulya
- Octavianus Marcel Harjono
- Natan
- Rahman Adianto
