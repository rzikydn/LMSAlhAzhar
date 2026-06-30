# Script Otomatis Menjalankan LMS Al-Azhar di Lokal
# Jalankan script ini dari terminal PowerShell di folder workspace root.

$ErrorActionPreference = "Stop"

# 1. Tambahkan PHP dari XAMPP ke PATH sementara untuk sesi terminal ini
Write-Host "Setting up PHP path..." -ForegroundColor Cyan
$env:PATH = "C:\xamppmostnew\php;" + $env:PATH

# Cek apakah PHP terdeteksi
if (!(Get-Command php -ErrorAction SilentlyContinue)) {
    Write-Error "PHP tidak ditemukan di C:\xamppmostnew\php. Pastikan folder XAMPP Anda benar."
    exit
}

# 2. Setup Database PostgreSQL
Write-Host "`n--- Setup Database PostgreSQL (Port: 5433) ---" -ForegroundColor Cyan
$pg_password = $null

while ($null -eq $pg_password) {
    $input_password = Read-Host -Prompt "Masukkan password untuk user 'postgres' di PostgreSQL Anda (Tekan Enter untuk default: admin)"
    if ([string]::IsNullOrEmpty($input_password)) {
        $input_password = "admin"
    }

    # Test the connection
    $env:PGPASSWORD = $input_password
    $testResult = & psql -h localhost -p 5433 -U postgres -c "SELECT 1;" 2>&1
    if ($LASTEXITCODE -eq 0) {
        $pg_password = $input_password
        Write-Host "Koneksi ke PostgreSQL berhasil!" -ForegroundColor Green
    } else {
        Write-Host "Koneksi GAGAL! Password '$input_password' salah." -ForegroundColor Red
        Write-Host "Silakan masukkan password PostgreSQL yang benar (biasanya: admin)." -ForegroundColor Yellow
    }
}

# Buat database
Write-Host "Membuat database lms_alazhar..." -ForegroundColor Yellow
try {
    & psql -h localhost -p 5433 -U postgres -c "CREATE DATABASE lms_alazhar;" 2>$null
    Write-Host "Database lms_alazhar berhasil dibuat (atau sudah ada)." -ForegroundColor Green
} catch {
    Write-Host "Terjadi kendala saat membuat database. Mungkin database sudah ada. Melanjutkan..." -ForegroundColor Yellow
}

# Impor file database lms_alazhar.sql
Write-Host "Mengimpor data lms_alazhar.sql ke database..." -ForegroundColor Yellow
try {
    & psql -h localhost -p 5433 -U postgres -d lms_alazhar -f lms-al_azhar/lms_alazhar.sql
    Write-Host "Impor database selesai!" -ForegroundColor Green
} catch {
    Write-Error "Gagal mengimpor database. Pastikan password Anda benar dan file SQL tersedia."
    exit
}

# 3. Update file .env dengan password PostgreSQL
Write-Host "`n--- Mengonfigurasi file .env ---" -ForegroundColor Cyan
$envPath = "lms-al_azhar\lms-dashboards\.env"
$envExamplePath = "lms-al_azhar\lms-dashboards\.env.example"

if (!(Test-Path $envPath)) {
    Write-Host "Copying .env.example to .env..." -ForegroundColor Yellow
    Copy-Item $envExamplePath $envPath
}

$envContent = Get-Content $envPath
$envContent = $envContent -replace '^DB_PORT=.*', 'DB_PORT=5433'
$envContent = $envContent -replace '^DB_PASSWORD=.*', "DB_PASSWORD=$pg_password"
$envContent | Set-Content $envPath
Write-Host "File .env berhasil diperbarui dengan port 5433 dan password Anda." -ForegroundColor Green

# 4. Install PHP Dependencies
Write-Host "`n--- Menginstal dependensi PHP (Composer) ---" -ForegroundColor Cyan
Set-Location "lms-al_azhar\lms-dashboards"
Write-Host "Menjalankan composer install..." -ForegroundColor Yellow
& composer install --ignore-platform-reqs

# 5. Install JS Dependencies & Build Assets
Write-Host "`n--- Menginstal dependensi Node.js & Compile Assets ---" -ForegroundColor Cyan
Write-Host "Menjalankan npm install..." -ForegroundColor Yellow
& npm install
Write-Host "Menjalankan npm run build..." -ForegroundColor Yellow
& npm run build

# 6. Setup Laravel Key & Storage Link
Write-Host "`n--- Setup Laravel Application ---" -ForegroundColor Cyan
Write-Host "Generate app key..." -ForegroundColor Yellow
& php artisan key:generate
Write-Host "Linking storage..." -ForegroundColor Yellow
try {
    & php artisan storage:link
} catch {
    Write-Host "Storage link sudah ada atau tidak bisa dibuat. Melanjutkan..." -ForegroundColor Yellow
}

# 7. Jalankan Server
Write-Host "`n=======================================================" -ForegroundColor Green
Write-Host "SETUP SELESAI! MENJALANKAN SERVER LOKAL..." -ForegroundColor Green
Write-Host "Buka browser Anda di: http://localhost:8100" -ForegroundColor Green
Write-Host "Tekan Ctrl+C untuk mematikan server." -ForegroundColor Yellow
Write-Host "=======================================================" -ForegroundColor Green

& php artisan serve --port=8100
