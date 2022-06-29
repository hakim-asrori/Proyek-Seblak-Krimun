<p align="center"><a href="https://seblak.plazafood.id/" target="_blank"><img src="https://github.com/hakim-asrori/Proyek-Seblak-Krimun/blob/main/public/assets/img/logo.png?raw=true" width="400"></a></p>

## Prerequisite

- **[Git Bash](https://git-scm.com/downloads)**
- **[Composer](https://getcomposer.org/Composer-Setup.exe)**
- **[XAMPP (PHP > 8.\*)](https://www.apachefriends.org/download.html)**

## Cara Installasi

- **Buka Git Bash**
- **Download Repository Proyek Seblak Krimun**
```
git clone https://github.com/hakim-asrori/Proyek-Seblak-Krimun.git
```
- **Masuk directory Proyek-Seblak-Krimun**
```
cd Proyek-Seblak-Krimun
```
- **Installasi Resource Proyek**
```
composer install
```
- **Copy file .env.example ke .env**
```
cp .env.example .env
```
- **Edit file .env**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_databse
DB_USERNAME=root
DB_PASSWORD=
```
- **Tambahkan diakhir file .env**
```
FILESYSTEM_DISK='public'
```
- **Migrate table-table ke database**
```
php artisan migrate --seed
```
- **Jalankan serve laravel**
```
php artisan serve
```
