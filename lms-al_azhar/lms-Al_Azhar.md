# LMS Al Azhar Jaya Indonesia — Handover Document

## Cara Menjalankan

```bash
# 1. Extract project
unzip lms-dashboards.zip

# 2. Install dependencies
cd lms-dashboards
composer install
npm install && npm run build

# 3. Buat database
psql -U postgres -c "CREATE DATABASE lms_alazhar;"

# 4. Import data
psql -U postgres -d lms_alazhar < lms_alazhar.sql

# 5. Setup .env
cp .env.example .env
# EDIT .env: isi DB_USERNAME=postgres DB_PASSWORD=xxx DB_DATABASE=lms_alazhar

# 6. Generate key + link storage
php artisan key:generate
php artisan storage:link

# 7. Jalankan
php artisan serve --port=8100
```

Buka `http://localhost:8100` — login dengan akun test (password: `password123`)

---

## Struktur File Penting

### 📁 Controllers (`app/Http/Controllers/`)

| File | Fungsi |
|------|--------|
| `DashboardController.php` | Routes 5 role ke dashboard masing-masing, passing data shared |
| `GuruTugasController.php` | CRUD tugas (guru buat) |
| `GuruNilaiController.php` | CRUD nilai, rekap, grafik |
| `GuruAbsensiController.php` | CRUD absensi per siswa |
| `GuruCatatanController.php` | Catatan wali kelas |
| `GuruTahfidzController.php` | CRUD setoran tahfidz |
| `GuruWorkbookController.php` | CRUD workbook + tambah soal |
| `GuruMateriController.php` | Upload materi file |
| `GuruPengumumanController.php` | CRUD pengumuman |
| `GuruKelasController.php` | CRUD kelas |
| `GuruCbtController.php` | CRUD CBT exam + tambah soal + ajukan approval |
| `AdminCbtController.php` | Approve/reject CBT exams |
| `SiswaTugasController.php` | Siswa upload jawaban tugas |
| `SiswaWorkbookController.php` | Siswa kerjakan workbook (quiz) |
| `SiswaCbtController.php` | Siswa kerjakan CBT exam |
| `SiswaPesanController.php` | Siswa kirim/balas pesan |
| `OrtuBayarController.php` | Ortu bayar SPP |
| `OrtuPesanController.php` | Ortu kirim pesan |
| `NilaiTugasController.php` | Guru nilai tugas siswa |
| `RaporController.php` | Generate PDF rapor (dompdf) |
| `SearchController.php` | Global search |
| `ExportController.php` | Export CSV nilai |

### 📁 Models (`app/Models/`)

| Model | Table | Notes |
|-------|-------|-------|
| `User` | `users` | Login, role: admin/guru/siswa_sd/siswa_smp/orang_tua |
| `Siswa` | `siswa` | Relasi ke User, Kelas |
| `Guru` | `guru` | Relasi ke User |
| `OrangTua` | `orang_tua` | Relasi ke User + anak-anak (many Siswa) |
| `Kelas` | `kelas` |
| `Mapel` | `mapel` | Mata pelajaran |
| `Nilai` | `nilai` | Per mapel per siswa |
| `Tugas` | `tugas` | + `pengumpulan_tugas` (jawaban siswa) |
| `Kehadiran` | `kehadiran` |
| `TahfidzSetoran` | `tahfidz_setoran` |
| `CatatanWali` | `catatan_wali` |
| `Jadwal` | `jadwal` |
| `Pesan` | `pesan` |
| `Pengumuman` | `pengumuman` |
| `Materi` | `materi` | Upload file |
| `Workbook` / `WorkbookSoal` / `WorkbookJawaban` | `workbooks`, `workbook_soals`, `workbook_jawabans` | Bank soal + jawaban siswa |
| `CbtExam` / `CbtSoal` / `CbtJawaban` | `cbt_exams`, `cbt_soals`, `cbt_jawabans` | CBT/ulangan + approval workflow |
| `Tagihan` / `Pembayaran` | `tagihan`, `pembayaran` | SPP |
| `Badge` / `SiswaBadge` | `badges`, `siswa_badge` | Prestasi siswa |
| `Setting` | `settings` | Key-value: kkm_sd, kkm_smp, school_name, semester_aktif |

### 📁 Views (`resources/views/`)

| Folder | Isi |
|--------|-----|
| `layouts/app.blade.php` | Layout utama: sidebar, navbar, Alpine x-data global, Chart.js CDN, search, mobile hamburger |
| `dashboard/siswa-sd.blade.php` | Dashboard SD — 11 tabs (sidebar + includes) |
| `dashboard/siswa-smp.blade.php` | Dashboard SMP — 12 tabs |
| `dashboard/guru.blade.php` | Dashboard Guru — 12 tabs + 3 sub-tabs |
| `dashboard/orang-tua.blade.php` | Dashboard Ortu — 7 tabs |
| `dashboard/admin.blade.php` | Dashboard Admin — **static HTML** (belum dynamic) |
| `dashboard/sd-sections/` | 10 section files untuk SD |
| `dashboard/smp-sections/` | 12 section files untuk SMP |
| `dashboard/guru-sections/` | 16 files: 12 section + cbt-form, cbt-add-soal, dll |
| `dashboard/orang-tua-sections/` | 7 section files |
| `dashboard/admin-sections/` | 1 file: cbt-approval.blade.php |
| `siswa-workbook-index/kerjakan/hasil` | Halaman standalone siswa kerjakan workbook |
| `siswa-cbt-index/kerjakan/hasil` | Halaman standalone siswa kerjakan CBT |
| `rapor-pdf.blade.php` | Template PDF rapor |

### 📁 Routes (`routes/web.php`)

Semua route ada di satu file `routes/web.php`:
- **GET `/dashboard`** → `DashboardController@index` (main page for all roles)
- **Guru POST** → 17 routes (tugas, nilai, absensi, catatan, workbook, cbt, dll)
- **Siswa** → 8 routes (tugas kumpul, pesan, workbook, cbt)
- **Ortu** → 2 routes (bayar, pesan)
- **Admin** → 3 routes (cbt approve/reject)
- **Other** → search, rapor pdf, export csv

### Database (`lms_alazhar`)

37 tables total. Semua migration ada di `database/migrations/`. Seed data di `database/seeders/`.

---

## ⚠️ Yang SUDAH (Aman)
- ✅ SD Student dashboard — 11 tabs, semua dari DB
- ✅ SMP Student dashboard — 12 tabs, workbook quiz + CBT
- ✅ Guru dashboard — 12 tabs, semua CRUD functional
- ✅ Orang Tua dashboard — 7 tabs, SPP bayar, pesan
- ✅ Rapor PDF download
- ✅ Global search
- ✅ Chart.js grafik nilai
- ✅ Mobile responsive
- ✅ Settings system (school name, KKM, semester dari DB)
- ✅ CBT approval workflow (guru → admin → siswa)
- ✅ Workbook quiz (PG auto-grade + essay review)

## ❌ Yang BELUM (PR Rekan)
- **Admin dashboard masih STATIC** — tabel siswa/guru/kelas/ortu/tagihan semua dummy. Perlu dibikin CRUD dynamic pake model + controller
- **Edit/Delete konten** — tugas, nilai, materi, workbook belum ada tombol edit/hapus
- **Olimpiade** — tabel `olympiad_exams` sudah ada di DB tapi fitur belum disentuh
- **Pagination** — tabel panjang (nilai, siswa) belum di-paginate
- **Notifikasi** — badge pesan baru (optional, skip sesuai request awal)
- **Validasi form** — beberapa form belum ada client-side validation
- **Dashboard admin chart** — masih pakai data dummy

## 🎯 Prioritas Pengembangan (Saran)
1. **Admin Dashboard** → CRUD siswa, guru, ortu, kelas, tagihan SPP
2. **Edit/Delete** → Tambah tombol edit & hapus di semua konten guru
3. **Olimpiade** → Copy paste pola CBT, bedanya tanpa approval workflow
4. **Pagination** → Pake `->paginate(20)` di query terus tambah links
5. **Polishing** → Loading state, confirm dialog, error handling

---

## Catatan Teknis

### Pola Kode
- **Tidak pakai Tailwind/Bootstrap** — semua styling manual di `public/style.css`
- **Alpine.js** untuk tab switching (`x-show`), form state (`x-model`), modal
- **@php block** di awal setiap section file untuk fetch data langsung (bukan dari controller)
- **Tab persistence** — layout `x-data` baca `session('active_tab')` biar setelah form submit tetap di tab yg sama
- **No public registration** — admin-only account creation

### Test Accounts
Semua password: `password123`

| Role | Email |
|------|-------|
| Admin | `admin@alazharjayaindonesia.sch.id` |
| Guru | `dewi.sartika@alazharjayaindonesia.sch.id` |
| Siswa SD | `ahmad.rizky@alazharjayaindonesia.sch.id` |
| Siswa SMP | `doni.prasetyo@alazharjayaindonesia.sch.id` |
| Orang Tua | `sari.rohmah@alazharjayaindonesia.sch.id` |

### Dev Server
```bash
cd /home/w/Desktop/lms-dashboards
php artisan serve --port=8100
```

