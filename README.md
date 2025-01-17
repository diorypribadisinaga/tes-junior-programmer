<h1 style="text-align:center">Penjelasan Singkat</h1>

# Teknologi
Aplikasi ini dibangun menggunakan beberapa teknologi di dalamnya, di antaranya:
1. **Backend**:
    - Framework: Laravel (v.10.48.25);
    - Bahasa Pemrograman: PHP;
    - Database: MySQL.
2. **Frontend**:
    - View: Blade Template Laravel;
    - Teknologi: HTML, Bootstrap Framework.

# Instalasi
Berikut adalah langkah-langkah instalasi dan cara menjalankan aplikasi.
1. **Unduh repositori:**
    ```shell
    git clone <repository-url>
    cd <folder-name>
    ```
2. **Install dependency:**
   Jalankan perintah berikut melalui terminal:
    ```shell
    composer install
    # Selanjutnya
    npm install
    ```
3. **Konfigurasi environment:**
    - Duplikat file `.env.example`, lalu ubah namanya menjadi `.env`;
    - Sesuaikan konfigurasi database di dalam file `.env` seperti berikut:
      ```shell
      DB_CONNECTION=mysql
      DB_HOST=#Host
      DB_PORT=#Port
      DB_DATABASE=#nama_database
      DB_USERNAME=#username
      DB_PASSWORD=#password
      ```
4. **Jalankan migrasi tabel:**
   Jalankan perintah untuk membuat tabel:
    ```shell
    php artisan migrate
    ```
5. **Jalankan seeding data:**
   Pastikan untuk menjalankan perintah berikut **hanya sekali** agar tidak terjadi duplikasi data:
    ```shell
    php artisan db:seed
    ```
6. **Jalankan aplikasi:**
   Gunakan perintah berikut untuk menjalankan aplikasi:
    ```shell
    php artisan serve
    ```
   Jika berhasil, maka akan muncul pesan seperti ini:
    ```
    INFO  Server running on [http://127.0.0.1:8000].
    ```

   
>Penjelasan detail dapat dilihat setelah menjalankan aplikasi ini
