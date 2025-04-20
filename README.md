# TP7DPBO2025C1
Saya Nina Wulandari dengan NIM 2312091 mengerjakan Tugas Praktikum 7 dalam mata kuliah DPBO untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

# Desain ERD
![ERD TP7](https://github.com/user-attachments/assets/0909803a-6957-4e49-a47f-8f86e38c9947)

# Struktur Database (db_song)
Database berisi 5 tabel:

### 1. artist
- artist_id (PK)
- name
- debut_year
- country

### 2. album
- album_id (PK)
- title
- release_date
- artist_id (FK → artist)

### 3. song
- song_id (PK)
- title
- duration
- genre
- album_id (FK → album)

### 4. studio
- studio_id (PK)
- name
- location

### 5. recording
- recording_id (PK)
- song_id (FK → song)
- studio_id (FK → studio)
- recording_date

### Relasi:
- Album → Artist (Many to One)
- Song → Album (Many to One)
- Recording → Song (Many to One)
- Recording → Studio (Many to One)

# Penjelasan Struktural File
- config/db.php
   Berisi konfigurasi koneksi database menggunakan PDO. File ini digunakan oleh seluruh model untuk mengakses database.
- class/
   Folder ini berisi file PHP class model untuk masing-masing entitas di database, yaitu Artist.php, Album.php, Song.php, Studio.php, Recording.php. Masing-masing class memiliki fungsi CRUD (Create, Read, Update, Delete) yang berinteraksi langsung dengan database melalui koneksi dari db.php.
- database/db_song.sql
   Berisi kumpulan query SQL (DDL) untuk membuat struktur tabel-tabel yang digunakan dalam aplikasi, termasuk foreign key dan relasi antar tabel.
- view/
   Folder ini berisi subfolder untuk setiap entitas utama, yaitu view/Artist/, view/Album/, view/Song/, view/Studio/, view/Recording/. Masing-masing folder memiliki 4 file:
   - addX.php untuk form tambah data
   - editX.php untuk form edit data
   - deleteX.php untuk menghapus data
   - viewX.php untuk menampilkan data dalam tabel
   (X menyesuaikan nama entitas, misalnya Artist, Album, dsb)
- index.php
   Halaman utama aplikasi. File ini menangani navigasi halaman berdasarkan parameter page di URL dan me-load view yang sesuai.
- style.css
   File CSS untuk styling tampilan.

# Fitur Aplikasi
CRUD untuk semua tabel:  
- Artist  
- Album  
- Song  
- Studio  
- Recording  

Fitur Searching  
- Tersedia fitur pencarian per entitas berdasarkan judul Album, judul Lagu, nama Studio, nama Artis, dan tanggal rekaman.

Modularisasi  
- Semua class model terpisah di folder class/ 
- File view per entitas disusun rapi dalam view/

Keamanan  
- Menggunakan PDO dan prepared statements untuk mencegah SQL Injection

# Penjelasan Alur Program

1. User membuka privateindex.phpprivate sebagai halaman utama navigasi
2. Memilih entitas (Artist, Album, dll) akan diarahkan ke folder privateview/<entitas>/viewXXX.phpprivate
3. Di halaman tersebut dapat melihat daftar data dan melakukan:
   - Mencari data
   - Tambah data
   - Edit data
   - Hapus data
4. Untuk melakukan search terdapat search bar untuk mencari berdasarkan judul. Pencarian dikirim dengan metode GET, dan hasil ditampilkan dalam bentuk filter
5. Saat tambah/edit, jika entitas memiliki relasi, akan muncul dropdown (misal pilih artist saat buat album)
6. Data diproses melalui method-method class di privateclass/private dengan koneksi dari privateconfig/db.phpprivate

# Cara Menjalankan
1. Import database/db_song.sql ke phpMyAdmin atau via MySQL CLI
2. Pastikan config/db.php sudah disesuaikan
3. Program dapat dijalankan di browser

# Dokumentasi Program
