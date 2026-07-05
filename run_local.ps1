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

# 2. Setup Database MySQL
Write-Host "`n--- Setup Database MySQL ---" -ForegroundColor Cyan
$mysql_path = "C:\xamppmostnew\mysql\bin"
if (!(Test-Path "$mysql_path\mysql.exe")) {
    $mysql_path = "C:\xampp\mysql\bin"
}
if (!(Test-Path "$mysql_path\mysql.exe")) {
    if (Get-Command mysql -ErrorAction SilentlyContinue) {
        $mysql_cmd = "mysql"
    } else {
        Write-Error "MySQL (mysql.exe) tidak ditemukan di C:\xamppmostnew\mysql\bin atau C:\xampp\mysql\bin. Pastikan MySQL terpasang."
        exit
    }
} else {
    $mysql_cmd = "$mysql_path\mysql.exe"
}

$db_user = "root"
$db_pass = ""

# Test the connection
Write-Host "Mengecek koneksi ke MySQL..." -ForegroundColor Yellow
$testResult = & $mysql_cmd -u $db_user -e "SELECT 1;" 2>&1
if ($LASTEXITCODE -ne 0) {
    $db_pass = Read-Host -Prompt "Koneksi root tanpa password gagal. Masukkan password MySQL root Anda"
    $testResult = & $mysql_cmd -u $db_user -p$db_pass -e "SELECT 1;" 2>&1
    if ($LASTEXITCODE -ne 0) {
        Write-Error "Gagal menghubungkan ke MySQL. Pastikan MySQL server Anda sudah aktif."
        exit
    }
}
Write-Host "Koneksi ke MySQL berhasil!" -ForegroundColor Green

# Buat database jika belum ada
Write-Host "Membuat database lms_alazhar jika belum ada..." -ForegroundColor Yellow
if ($db_pass -eq "") {
    & $mysql_cmd -u $db_user -e "CREATE DATABASE IF NOT EXISTS lms_alazhar;" 2>$null
} else {
    & $mysql_cmd -u $db_user -p$db_pass -e "CREATE DATABASE IF NOT EXISTS lms_alazhar;" 2>$null
}

# Impor file database lms_alazhar.sql
Write-Host "Mengimpor data lms_alazhar.sql ke database..." -ForegroundColor Yellow
try {
    if ($db_pass -eq "") {
        & $mysql_cmd -u $db_user -D lms_alazhar -e "source lms-al_azhar/lms_alazhar.sql"
    } else {
        & $mysql_cmd -u $db_user -p$db_pass -D lms_alazhar -e "source lms-al_azhar/lms_alazhar.sql"
    }
    Write-Host "Impor database selesai!" -ForegroundColor Green
} catch {
    Write-Error "Gagal mengimpor database. Pastikan file SQL lms-al_azhar/lms_alazhar.sql tersedia."
    exit
}

# 3. Update file .env dengan password MySQL
Write-Host "`n--- Mengonfigurasi file .env ---" -ForegroundColor Cyan
$envPath = "lms-al_azhar\lms-dashboards\.env"
$envExamplePath = "lms-al_azhar\lms-dashboards\.env.example"

if (!(Test-Path $envPath)) {
    Write-Host "Copying .env.example to .env..." -ForegroundColor Yellow
    Copy-Item $envExamplePath $envPath
}

$envContent = Get-Content $envPath
$envContent = $envContent -replace '^DB_CONNECTION=.*', 'DB_CONNECTION=mysql'
$envContent = $envContent -replace '^DB_PORT=.*', 'DB_PORT=3306'
$envContent = $envContent -replace '^DB_PASSWORD=.*', "DB_PASSWORD=$db_pass"
$envContent = $envContent -replace '^DB_USERNAME=.*', "DB_USERNAME=$db_user"
$envContent | Set-Content $envPath
Write-Host "File .env berhasil diperbarui untuk MySQL." -ForegroundColor Green

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
