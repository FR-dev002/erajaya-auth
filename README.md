# instalasi

1. colone repository ini
2. masuk ke dalam folder yang baru selesai di download
3. jalankan ``` composer install ```
4. copy file .env.example menjadi .env
5. setting database 
``` 
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=erajaya_auth
    DB_USERNAME=root
    DB_PASSWORD=2020 
```
   untuk nama dan password databse di sesuaikan
6.  jalankan 
```
    php artisan migrate --seed 
```
untuk generate database dan  data admin

7.  jalankan php artisan serve untuk menjalankan servernya
8.  akses dari web browser denagn URL
    ```
        localhost:8000/
    ```
9. login dengan username: ramachan@gmail.com dan password: password

