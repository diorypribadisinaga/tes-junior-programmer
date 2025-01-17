<h1 style="text-align:center">Dokumentasi</h1>

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

# Struktur Tabel
Berikut adalah struktur tabel yang digunakan:

1. **Tabel kategori**
   | **Field**       | **Type**        | **Null** | **Key**     | **Default** | **Extra**         |
   |------------------|-----------------|----------|-------------|-------------|-------------------|
   | id_kategori      | bigint unsigned | No       | PRIMARY (PK)| NULL        | auto_increment    |
   | nama_kategori    | varchar(255)    | No       |             | NULL        |                   |

2. **Tabel status**
   | **Field**       | **Type**        | **Null** | **Key**     | **Default** | **Extra**         |
   |------------------|-----------------|----------|-------------|-------------|-------------------|
   | id_status        | bigint unsigned | No       | PRIMARY (PK)| NULL        | auto_increment    |
   | nama_status      | varchar(255)    | No       |             | NULL        |                   |

3. **Tabel produk**
   | **Field**       | **Type**        | **Null** | **Key**     | **Default** | **Extra**         |
   |------------------|-----------------|----------|-------------|-------------|-------------------|
   | id_produk        | bigint unsigned | No       | PRIMARY (PK)| NULL        | auto_increment    |
   | nama_produk      | varchar(255)    | No       |             | NULL        |                   |
   | harga            | bigint unsigned | No       |             | 0           |                   |
   | kategori_id      | bigint unsigned | No       | FOREIGN (FK) |             | kategori)         |
   | status_id        | bigint unsigned | No       | FOREIGN (FK) |             | status)           |

# Relasi Antar Tabel

Diagram relasi antar tabel berikut menjelaskan bagaimana tabel-tabel saling berhubungan dalam database aplikasi ini:

1. **kategori**
    - **Primary Key (PK):** `id_kategori`
    - **Relasi:**
        - Satu kategori **dapat memiliki banyak produk** di dalam tabel `produk`.
    - **Jenis Relasi:** *One to Many*

2. **status**
    - **Primary Key (PK):** `id_status`
    - **Relasi:**
        - Satu status **dapat dimiliki oleh banyak produk** di dalam tabel `produk`.
    - **Jenis Relasi:** *One to Many*

3. **produk**
    - **Primary Key (PK):** `id_produk`
    - **Foreign Key (FK):**
        - `kategori_id`: Mengacu pada `id_kategori` di tabel `kategori`.
        - `status_id`: Mengacu pada `id_status` di tabel `status`.
    - **Relasi:**
        - Setiap produk **memiliki satu kategori** (*Many to One*) melalui `kategori_id`.
        - Setiap produk **memiliki satu status** (*Many to One*) melalui `status_id`.

# Routes
Berikut adalah beberapa route yang digunakan dalam aplikasi ini:

### Produk
```bash
GET    /products                 # Menampilkan semua produk (default: status 'bisa dijual')
POST   /products                 # Menambahkan produk baru
PUT    /products/:id/edit        # Mengedit data produk
DELETE /products/:id/delete      # Menghapus data produk
GET    /products/search          # Melakukan pencarian berdasarkan nama produk
```

### Kategori
```bash
GET    /categories               # Menampilkan semua kategori
POST   /categories               # Menambahkan kategori baru
PUT    /categories/:id/edit      # Mengedit data kategori
DELETE /categories/:id/delete    # Menghapus data kategori
GET    /categories/:id/detail    # Menampilkan produk berdasarkan kategori
```

### Status
```bash
GET    /status                   # Menampilkan data status
POST   /status                   # Menambahkan status baru
PUT    /status/:id/edit          # Mengedit data status
DELETE /status/:id/delete        # Menghapus status
```

### Dokumentasi
```bash
GET    /documentation            # Dokumentasi aplikasi
```

# Penjelasan Penggunaan Aplikasi
Berdasarkan list routes di atas aplikasi ini memiliki fitur-fitur diantara
1. **Menampilkan produk (GET /products)**
    <br>Secara default saat mengakses <a href="/products" target="_blank">/products</a>,
    maka akan menampikan semua produk dengan status `bisa dijual`. Berikut tampilannya
    <p align="center"><img src="/image/produk.png" width="87%" alt="Produk"></p>

    Tetapi, jika ingin menampilkan produk dengan status yang berbeda atau menampilkan semua produk tanpa terkecuali,
    kita dapat menekan tombol dropdown `pilih status` kemudian pilih status yang diinginkan.
    <p align="center"><img src="/image/pilihstatus.png" width="35%" alt="Pilih status"></p>
2. **Menambahkan produk baru (POST /products)**
    <br>Untuk menambah produk baru, kita bisa menekan tombol `tambah produk` yang ada di atas drop down `pilih status`.
    Setelah menekan tombol `tambah produk`, maka akan muncul form modal untuk pengisian data produk baru.
    <p align="center"><img src="/image/modal_tambahProduk.png" width="70%" alt="Tambah produk"></p>

    Form di atas, setiap inputan sudah dilakukan validasi di antaranya `nama produk` harus diisi dan berupa string.
    Input `harga produk` harus berupa angka integer dan minimal 0. Input `kategori`&`status` juga harus diisi.
    Setelah semuanya diisi dengan benar, maka setelah menekan tombol `tambah` akan muncul pesan alert `success`.
     Jika inputan tidak sesuai, maka akan muncul alert `error` dengan detail pesan errornya.
    <p style="text-align: center"><img src="/image/alert_success.png" style="width: 42%; display: inline-block; margin: 1%;" alt="Alert success"><img src="/image/alert_error.png" style="width: 42%; display: inline-block; margin: 1%;" alt="Alert success"></p>
3. **Mengedit produk (PUT /products/:id/edit)**
    <br>Selain manambah produk, kita bisa mengedit produk yang sudah ada dengan menekan tombol `edit` pada produk
    yang ingin di perbarui. Setelah menekan tombol `edit`, maka akan muncul form yang mirip dengan gambar
    di atas. Kita bisa memperbarui data yang sebelumnya sudah ada, dengan data yang baru. Form ini juga
    melakukan validasi yang sama dengan form menambah produk. Jika sukses atau gagal, maka akan menampilkan
    alert `success` atau `gagal`.
4. **Menghapus produk (DELETE /products/:id/delete)**
    <br>Jika ingin menghapus produk maka dapat menekan tombol `hapus` yang ada di sebelah tombol `edit`.
    Saat tombol sudah ditekan, maka akan muncul modal konfirmasi untuk memastikan apakah yakin menghapus atau tidak.
    Jika sukses atau gagal akan menampilkan pesan alert.
5. **Mencari produk (GET /products/search)**
    <br>Pada aplikasi ini juga tersedia fitur pencarian produk berdasarkan `nama produk` dengan kata kunci yang dimasukan.
    Untuk menggunakan fitur ini, kita bisa masukan kata kunci di dalam input `Cari produk disini dst...`
    yang berada di samping kanan tombol dropdown `pilih status`. Setelah memasukan kata kunci, kemudian
    tekan enter pada keyboard. Setelah menekan enter, maka akan muncul data produk yang sesuai.
    Saat menggunakan fitur ini, produk yang  ditampilkan adalah produk yang memiliki status `bisa dijual`.
    Bagaimana jika produk dengan status `tidak bisa dijual`? Untuk menampilkan produk berdasarkan kata kunci
    dan status, maka dapat menuliskan format `katakunci#status` dalam pencariannya. 
    Kita bisa menuliskan kata kunci sebagai berikut
    ```bash
    produk#tidak bisa dijual    #Menampikan semua produk yang memiliki nama seperti `produk` dengan status `tidak bisa dijual`
    produk#bisa dijual    #Menampikan semua produk yang memiliki nama seperti `produk` dengan status `bisa dijual`
   
   # dan yang terakhir menampilkan produk tanpa melihat status
   produk#all  # #Menampikan semua produk yang memiliki nama seperti `produk`
    ```
6. **Menampilkan kategori (GET /categories)**
    <br>Untuk melihat data kategori, kita dapat mengaksesnya dengan menekan tombol sidebar <a href="/categories" target="_blank">categories</a> yang ada disebelah kiri.
    Di bawah ini tampilan data kategori.
    <p align="center"><img src="/image/kategori.png" width="87%" alt="Kategori"></p>
    Pada gambar di atas terdapat informasi nama kategori, dan banyak produk di setiap kategorinya.
7. **Menambahkan kategori baru (POST /categories)**
    <br>Jika ingin menambah kategori, bisa menekan tombol `tambah kategori`. Secara penggunaan, fitur ini mirip dengan
    fitur menambah produk. Sukses dan gagal akan menampilkan alert dengan bentuk yang sama dengan fitur nambah produk.
    Selain validasi inputan, jika ingin menambah kategori maka `nama kategori` tidak boleh sama dengan
    nama kategori yang sudah ada (unique).
8. **Mengedit kategori (PUT /categories/:id/edit)**
    <br>Secara penggunaan, fitur edit kategori mirip dengan fitur edit produk di atas. Validasi inputan edit juga sama dengan
    validasi inputan saat menambah kategori baru. Sukses atau error juga akan menampilkan error.
9. **Menghapus kategori (DELETE /categories/:id/edit)**
    <br>Fitur ini digunakan untuk menghapus kategori yang ada. Jika sukses atau gagal akan menampilkan pesan alert.
10. **Melihat detail kategori (GET /categories/:id/detail)** 
    <br>Selain menampilkan data berdasarkan status, kita juga bisa menampilkan semua data produk berdasarkan spesifik kategori.
    Untuk menampilkan data produk berdasarkan spesifik kategori, dapat menekan tombol `detail` pada kategori yang dipilih.
    Secara default produk yang di tampilkan adalah produk yang memiliki status `bisa dijual`. Jika ingin menampilkan dengan
    status berbeda dapat menekan tombol `pilih status` dan memilih status yang diinginkan.
11. **Menampilkan status (GET /status)**
    <br>Untuk melihat data status, kita dapat mengaksesnya dengan menekan tombol sidebar <a href="/status" target="_blank">status</a>.
    Di bawah ini tampilan data status yang tersedia.
    <p align="center"><img src="/image/status.png" width="87%" alt="Status"></p>
    Pada gambar di atas terdapat informasi nama status, dan banyak produk di setiap status.
12. **Menambahkan status baru (POST /status)**
    <br>Fitur ini digunakan untuk menambah status baru. Penggunaan dan penjelasan mirip dengan fitur manambah kategori.
13. **Mengedit status (PUT /status/:id/edit)**
    <br>Fitur ini digunakan untuk mengedit status baru. Penggunaan dan penjelasan mirip dengan fitur mengedit kategori.
14. **Menghapus status (DELETE /status/:id/edit)**
    <br>Fitur ini digunakan untuk menghapus status baru. Penggunaan dan penjelasan mirip dengan fitur menghapus kategori.
15. **Dokumentasi**
    <br>Menampilkan cara instalasi dan penggunaan aplikasi (Halaman yang sedang dibaca).

# Pengujian aplikasi
Aplikasi ini sudah menggunakan testing (PHP Unit). Berikut hasil pengujiannya
```bash
   PASS  Tests\Feature\CategoryControllerTest
  ✓ view categories                                                                                 0.25s  
  ✓ save category success                                                                           0.03s  
  ✓ save category failed validation with data set #0                                                0.03s  
  ✓ save category failed validation with data set #1                                                0.03s  
  ✓ save category failed validation with data set #2                                                0.02s  
  ✓ save category failed unique                                                                     0.11s  
  ✓ edit category success                                                                           0.04s  
  ✓ edit category failed not found                                                                  0.02s  
  ✓ edit category failed validation with data set #0                                                0.06s  
  ✓ edit category failed validation with data set #1                                                0.05s  
  ✓ edit category failed validation with data set #2                                                0.03s  
  ✓ delete category success                                                                         0.06s  
  ✓ delete category failed not found                                                                0.02s  
  ✓ detail category success                                                                         0.04s  
  ✓ detail category failed not found                                                                0.02s  

   PASS  Tests\Feature\CategorySeedTest
  ✓ category seed                                                                                   0.05s  

   PASS  Tests\Feature\ProductControllerTest
  ✓ view products                                                                                   0.07s  
  ✓ save product success                                                                            0.06s  
  ✓ save product failed validation with data set #0                                                 0.06s  
  ✓ save product failed validation with data set #1                                                 0.04s  
  ✓ save product failed validation with data set #2                                                 0.05s  
  ✓ save product failed validation with data set #3                                                 0.04s  
  ✓ save product failed category not found                                                          0.04s  
  ✓ save product failed status not found                                                            0.04s  
  ✓ edit product success                                                                            0.12s  
  ✓ edit product fail not found                                                                     0.05s  
  ✓ edit product fail validation with data set #0                                                   0.14s  
  ✓ edit product fail validation with data set #1                                                   0.14s  
  ✓ edit product fail validation with data set #2                                                   0.14s  
  ✓ edit product fail validation with data set #3                                                   0.14s  
  ✓ delete product success                                                                          0.16s  
  ✓ delete product fail not found                                                                   0.06s  

   PASS  Tests\Feature\ProductSeedTest
  ✓ product seed                                                                                    0.05s  

   PASS  Tests\Feature\StatusControllerTest
  ✓ view status                                                                                     0.04s  
  ✓ save status success                                                                             0.04s  
  ✓ save status failed validation                                                                   0.03s  
  ✓ save status failed unique                                                                       0.04s  
  ✓ edit status success                                                                             0.05s  
  ✓ edit status failed not found                                                                    0.03s  
  ✓ edit status failed unique                                                                       0.03s  
  ✓ delete status success                                                                           0.06s  
  ✓ delete status failed not found                                                                  0.03s  

   PASS  Tests\Feature\StatusSeedTest
  ✓ status seed                                                                                     0.02s  

  Tests:    44 passed (219 assertions)
  Duration: 2.87s

```

<br><br>
