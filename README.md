# PORTAL PENGADUAN MASYARAKAT

## INSTALASI
* Clone repository ini
* Install Composer
   ```bash
   composer install
   ```
* Update Composer
   ```bash
   composer update
   ```
* Konfigurasi file `Routes.php` pada folder `vendor\myth\auth\src\Config`
   ```bash
   ...
   19 $routes->group('', ['namespace' => 'Myth\Auth\Controllers'], function($routes) {...}
   ...
   ```
  menjadi
    ```bash
    ...
    19 $routes->group('', ['namespace' => 'App\Controllers'], function($routes) {...}
    ...
    ```
* Copy file env menjadi .env dengan Generate key
   ```bash
   php spark key:generate
   ```
* Atur konfigurasi pada file .env
   ```bash
   ...
   16 CI_ENVIRONMENT = development
   
   ...
   23 app.baseURL = 'http://localhost:8080'
   
   ...
   33 database.default.hostname = 127.0.0.1
   34 database.default.database = nama_database
   35 database.default.username = root
   36 database.default.password =
   37 database.default.DBDriver = MySQLi
   38 database.default.DBPrefix =
   39 database.default.port = 3306
   ```
* Buat database baru
   ```bash
   php spark db:create nama_database 
   ```
* Migrasi database
   ```bash
   php spark migrate --all
   ```
* Seed database, dengan begitu akan terbuat user superadmin dengan `username: sa`, `email: sa@example.com` dan `password: superadmin`
   ```bash
   php spark db:seed InitSeeder
   ```
* Jalankan server
   ```bash
   php spark serve
   ```