<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Tutorial Setup

1. Download/clone project ini terlebih dahulu
   
2. Pastikan sudah terinstall composer untuk menginstall dependecies Laravel. Ketik pada terminal :
    ```
    composer install
    ```

3. Selanjutnya, buat duplikat file **.env.example** menjadi file **.env**. Bisa dengan cara manual atau dengan mengetik pada terminal :
    ```
    cp .env.example .env
    ```
   
4. Generate app key yang terenkripsi ke file **.env** dengan cara mengetik pada terminal :
    ```
    php artisan key:generate
    ```
   
5. Buat database baru, kosongan, tanpa isi.
   
6. Modifikasi *DB_HOST*, *DB_PORT*, *DB_DATABASE*, *DB_USERNAME*, dan *DB_PASSWORD* pada file **.env** sesuai database yang telah dibuat.
   
7. Migrasikan database dengan mengetik pada terminal :
    ```
    php artisan migrate
    ```
   
8. Seed database dengan :
    ```
    php artisan db:seed
    ```
9. Setelah itu program dapat dijalankan dengan mengetik pada terminal :
    ```
    php artisan serve
    ```
