#!/bin/bash
set -e

# LMS Al-Azhar Local Runner for Linux/macOS (MySQL Version)
echo "=== Memulai Setup & Jalankan LMS Al-Azhar (Linux/macOS - MySQL) ==="

# 1. Pindah ke direktori Laravel
cd lms-al_azhar/lms-dashboards

# 2. Salin .env jika belum ada
if [ ! -f .env ]; then
    echo "Membuat file .env..."
    cp .env.example .env
fi

# 3. Instal dependensi PHP (Composer)
echo "Menginstal dependensi Composer..."
composer install --ignore-platform-reqs

# 4. Instal dependensi JavaScript (npm)
echo "Menginstal dependensi npm..."
npm install

# 5. Build asset Vite
echo "Membangun asset Vite..."
npm run build

# 6. Generate app key & storage link
echo "Menyiapkan aplikasi Laravel..."
php artisan key:generate --ansi
php artisan storage:link || true

# 7. Membuat Database & Migrasi (MySQL)
echo "--------------------------------------------------------"
echo "Apakah Anda ingin membuat & menjalankan migrasi database MySQL?"
echo "Pastikan MySQL Server (atau XAMPP) Anda sedang berjalan."
echo "--------------------------------------------------------"
read -p "Jalankan migrasi MySQL? (y/n): " confirm_db

if [[ $confirm_db =~ ^[Yy]$ ]]; then
    read -p "Masukkan username MySQL (default: root): " db_user
    db_user=${db_user:-root}
    read -sp "Masukkan password MySQL (tekan Enter jika kosong): " db_pass
    echo ""
    
    # Buat database jika belum ada menggunakan PHP PDO (lebih aman & tidak tergantung path CLI mysql)
    echo "Membuat database lms_alazhar (jika belum ada)..."
    php -r "
    try {
        \$db = new PDO('mysql:host=127.0.0.1', '$db_user', '$db_pass');
        \$db->exec('CREATE DATABASE IF NOT EXISTS lms_alazhar');
        echo 'Database lms_alazhar siap!\n';
    } catch (PDOException \$e) {
        echo 'Peringatan: Gagal membuat database otomatis: ' . \$e->getMessage() . '\n';
        echo 'Pastikan Anda telah membuat database lms_alazhar secara manual.\n';
    }
    "
    
    # Update password di .env sementara
    sed -i "s/^DB_USERNAME=.*/DB_USERNAME=$db_user/" .env
    sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=$db_pass/" .env
    
    echo "Menjalankan migrasi tabel dan mengisi data awal (seeding)..."
    php artisan migrate:fresh --seed
    echo "Migrasi database selesai!"
fi

echo "--------------------------------------------------------"
echo "Setup selesai! Menjalankan server..."
echo "Aplikasi berjalan di http://localhost:8100"
echo "Tekan Ctrl+C untuk menghentikan server."
echo "--------------------------------------------------------"

# 8. Jalankan Laravel dan Vite secara paralel
composer run dev
