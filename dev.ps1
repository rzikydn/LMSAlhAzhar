# Script Satu Klik untuk Menjalankan Backend & Frontend LMS Al-Azhar
$ErrorActionPreference = "Stop"

# 1. Daftarkan Path PHP dari XAMPP
$env:PATH = "C:\xamppmostnew\php;" + $env:PATH

# Cek PHP
if (!(Get-Command php -ErrorAction SilentlyContinue)) {
    Write-Error "PHP tidak ditemukan di C:\xamppmostnew\php."
    exit
}

# 2. Jalankan Laravel Backend (artisan serve) di background
Write-Host "Menjalankan Laravel Backend di port 8100..." -ForegroundColor Cyan
$laravelProcess = Start-Process php -ArgumentList "artisan serve --port=8100" -WorkingDirectory "lms-al_azhar\lms-dashboards" -PassThru -NoNewWindow

# Pastikan proses backend mati saat terminal ditutup
$currentId = $PID
Register-EngineEvent -SourceIdentifier PowerShell.Exiting -Action {
    Stop-Process -Id $laravelProcess.Id -Force
}

# 3. Buka browser otomatis ke port Laravel (8100) setelah jeda singkat
Start-Sleep -Seconds 2
Start-Process "http://localhost:8100"

# 4. Jalankan Vite Frontend di foreground terminal ini
Write-Host "Menjalankan Vite Frontend..." -ForegroundColor Cyan
Set-Location "lms-al_azhar\lms-dashboards"
npm run dev
