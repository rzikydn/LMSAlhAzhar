@extends('layouts.app')

@section('title', 'Dashboard Admin - LMS Al Azhar Jaya Indonesia')

@section('sidebar')
    <li :class="{'active': tab === 'dashboard'}" @click="tab = 'dashboard'">
        <label><i class="fas fa-th-large"></i> Dashboard</label>
    </li>
    <li :class="{'active': tab === 'siswa'}" @click="tab = 'siswa'">
        <label><i class="fas fa-user-graduate"></i> Siswa</label>
    </li>
    <li :class="{'active': tab === 'guru'}" @click="tab = 'guru'">
        <label><i class="fas fa-chalkboard-teacher"></i> Guru</label>
    </li>
    <li :class="{'active': tab === 'ortu'}" @click="tab = 'ortu'">
        <label><i class="fas fa-users"></i> Orang Tua</label>
    </li>
    <li :class="{'active': tab === 'kelas'}" @click="tab = 'kelas'">
        <label><i class="fas fa-school"></i> Kelas</label>
    </li>
    <li :class="{'active': tab === 'cbt'}" @click="tab = 'cbt'">
        <label><i class="fas fa-laptop"></i> CBT Approval</label>
    </li>
    <li :class="{'active': tab === 'pengaturan'}" @click="tab = 'pengaturan'">
        <label><i class="fas fa-cog"></i> Pengaturan</label>
    </li>
@endsection

@section('content')

    <div x-show="tab === 'dashboard'">
        <div>
            <div class="content-header">
                <div>
                    <h1>Dashboard Admin</h1>
                    <p style="font-size:14px;color:var(--gray-400);margin-top:2px">Selamat datang, Admin Sekolah</p>
                </div>
                <div class="header-right">
                    <span class="badge teal" style="font-size:12px;padding:6px 16px"><i class="fas fa-school"></i> SDIT &amp; SMPIT</span>
                    <div class="avatar teal">AD</div>
                </div>
            </div>
            <div class="grid-4" style="margin-bottom:20px">
                <div class="admin-stat-card"><div class="asc-icon grad-teal"><i class="fas fa-user-graduate"></i></div><div class="asc-body"><div class="asc-number">520</div><div class="asc-label">Total Siswa</div><div class="asc-compare up">&#x2191; 12 siswa baru bulan ini</div></div></div>
                <div class="admin-stat-card"><div class="asc-icon grad-blue"><i class="fas fa-chalkboard-teacher"></i></div><div class="asc-body"><div class="asc-number">42</div><div class="asc-label">Total Guru</div><div class="asc-compare up">&#x2191; 3 guru baru tahun ini</div></div></div>
                <div class="admin-stat-card"><div class="asc-icon grad-orange"><i class="fas fa-users"></i></div><div class="asc-body"><div class="asc-number">380</div><div class="asc-label">Total Orang Tua</div><div class="asc-compare up">&#x2191; 8 akun baru bulan ini</div></div></div>
                <div class="admin-stat-card"><div class="asc-icon grad-purple"><i class="fas fa-school"></i></div><div class="asc-body"><div class="asc-number">18</div><div class="asc-label">Kelas Aktif</div><div class="asc-compare down">&#x2193; 2 kelas dari bulan lalu</div></div></div>
            </div>
            <div class="grid-2" style="margin-bottom:20px">
                <div class="card">
                    <div class="card-header"><h3><i class="fas fa-signal" style="color:var(--teal)"></i> Aktivitas Login (30 Hari)</h3><label @click="tab='pengaturan'" style="font-size:12px;color:var(--blue);font-weight:600;cursor:pointer;text-decoration:none">Detail</label></div>
                    <div class="chart-area">
                        <div class="chart-bar" style="height:60%;background:linear-gradient(to top,var(--teal-light),var(--teal))"><span class="bar-label">Sen</span></div>
                        <div class="chart-bar" style="height:80%;background:linear-gradient(to top,var(--teal-light),var(--teal))"><span class="bar-label">Sel</span></div>
                        <div class="chart-bar" style="height:45%"><span class="bar-label">Rab</span></div>
                        <div class="chart-bar" style="height:90%"><span class="bar-label">Kam</span></div>
                        <div class="chart-bar" style="height:70%"><span class="bar-label">Jum</span></div>
                        <div class="chart-bar" style="height:30%"><span class="bar-label">Sab</span></div>
                        <div class="chart-bar" style="height:25%"><span class="bar-label">Min</span></div>
                        <div class="chart-bar" style="height:65%"><span class="bar-label">Sen</span></div>
                        <div class="chart-bar" style="height:85%"><span class="bar-label">Sel</span></div>
                        <div class="chart-bar" style="height:50%"><span class="bar-label">Rab</span></div>
                        <div class="chart-bar" style="height:75%"><span class="bar-label">Kam</span></div>
                        <div class="chart-bar" style="height:95%"><span class="bar-label">Jum</span></div>
                        <div class="chart-bar" style="height:35%"><span class="bar-label">Sab</span></div>
                        <div class="chart-bar" style="height:20%"><span class="bar-label">Min</span></div>
                    </div>
                    <p style="font-size:11px;color:var(--gray-400);text-align:center">Login per hari (14 hari terakhir)</p>
                </div>
                <div class="card">
                    <div class="card-header"><h3><i class="fas fa-layer-group" style="color:var(--blue)"></i> Distribusi Siswa per Jenjang</h3><label @click="tab='siswa'" style="font-size:12px;color:var(--blue);font-weight:600;cursor:pointer;text-decoration:none">Detail</label></div>
                    <div class="h-bar-group">
                        <div class="h-bar-row"><div class="h-bar-label">Kelas 1-3 SD</div><div class="h-bar-track"><div class="h-bar-fill teal" style="width:90%">180</div></div></div>
                        <div class="h-bar-row"><div class="h-bar-label">Kelas 4-6 SD</div><div class="h-bar-track"><div class="h-bar-fill blue" style="width:72%">145</div></div></div>
                        <div class="h-bar-row"><div class="h-bar-label">Kelas 7</div><div class="h-bar-track"><div class="h-bar-fill orange" style="width:58%">80</div></div></div>
                        <div class="h-bar-row"><div class="h-bar-label">Kelas 8</div><div class="h-bar-track"><div class="h-bar-fill purple" style="width:50%">70</div></div></div>
                        <div class="h-bar-row"><div class="h-bar-label">Kelas 9</div><div class="h-bar-track"><div class="h-bar-fill pink" style="width:38%">55</div></div></div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h3><i class="fas fa-history" style="color:var(--orange)"></i> Aktivitas Terbaru</h3><label style="font-size:12px;color:var(--blue);font-weight:600;cursor:pointer;text-decoration:none">Semua</label></div>
                <div class="filter-bar"><button class="filter-btn active">Semua</button><button class="filter-btn">SD</button><button class="filter-btn">SMP</button></div>
                <div class="table-wrap">
                    <table>
                        <thead><tr><th>Waktu</th><th>Jenis</th><th>Deskripsi</th><th>Status</th></tr></thead>
                        <tbody>
                            <tr><td style="color:var(--gray-400);font-size:12px">28 Mar 2026, 09:15</td><td><span class="badge light teal">User</span></td><td>User baru &mdash; Siti Aisyah (Siswa)</td><td><span class="badge light green">Selesai</span></td></tr>
                            <tr><td style="color:var(--gray-400);font-size:12px">28 Mar 2026, 08:30</td><td><span class="badge light blue">Kelas</span></td><td>Kelas 7C ditambahkan</td><td><span class="badge light green">Selesai</span></td></tr>
                            <tr><td style="color:var(--gray-400);font-size:12px">27 Mar 2026, 14:00</td><td><span class="badge light orange">Pengumuman</span></td><td>Pengumuman UTS dibuat</td><td><span class="badge light teal">Aktif</span></td></tr>
                            <tr><td style="color:var(--gray-400);font-size:12px">27 Mar 2026, 11:20</td><td><span class="badge light purple">Tugas</span></td><td>Tugas "Praktek Sholat" PAI 7A</td><td><span class="badge light teal">Aktif</span></td></tr>
                            <tr><td style="color:var(--gray-400);font-size:12px">26 Mar 2026, 15:45</td><td><span class="badge light pink">Laporan</span></td><td>Laporan bulanan Maret 2026</td><td><span class="badge light green">Selesai</span></td></tr>
                            <tr><td style="color:var(--gray-400);font-size:12px">25 Mar 2026, 13:30</td><td><span class="badge light red">Sistem</span></td><td>Pembaruan LMS versi 2.4.1</td><td><span class="badge light green">Selesai</span></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div x-show="tab === 'siswa'">
        <div>
            <div class="content-header">
                <h1>Manajemen Siswa</h1>
                <div class="header-right">
                    <label @click="tab='siswa-form'" class="header-btn primary" style="cursor:pointer"><i class="fas fa-plus"></i> Tambah Siswa</label>
                    <label class="header-btn outline" style="cursor:pointer"><i class="fas fa-upload"></i> Import</label>
                    <div class="avatar teal">AD</div>
                </div>
            </div>
            <div class="card">
                <div class="table-wrap">
                    <table>
                        <thead><tr><th>NIS</th><th>Nama</th><th>Kelas</th><th>Jenis Kelamin</th><th>Status</th><th></th></tr></thead>
                        <tbody>
                            <tr><td>2024001</td><td><strong>Ahmad Rizky</strong></td><td>7A</td><td>L</td><td><span class="badge light green">Aktif</span></td><td><label @click="tab='siswa-detail'" class="btn-small outline" style="cursor:pointer">Detail</label> <label @click="tab='siswa-edit'" class="btn-small outline" style="cursor:pointer">Edit</label></td></tr>
                            <tr><td>2024002</td><td><strong>Siti Aisyah</strong></td><td>7A</td><td>P</td><td><span class="badge light green">Aktif</span></td><td><label @click="tab='siswa-detail'" class="btn-small outline" style="cursor:pointer">Detail</label> <label @click="tab='siswa-edit'" class="btn-small outline" style="cursor:pointer">Edit</label></td></tr>
                            <tr><td>2024003</td><td><strong>Budi Santoso</strong></td><td>7A</td><td>L</td><td><span class="badge light green">Aktif</span></td><td><label @click="tab='siswa-detail'" class="btn-small outline" style="cursor:pointer">Detail</label> <label @click="tab='siswa-edit'" class="btn-small outline" style="cursor:pointer">Edit</label></td></tr>
                            <tr><td>2024004</td><td><strong>Citra Dewi</strong></td><td>7A</td><td>P</td><td><span class="badge light green">Aktif</span></td><td><label @click="tab='siswa-detail'" class="btn-small outline" style="cursor:pointer">Detail</label> <label @click="tab='siswa-edit'" class="btn-small outline" style="cursor:pointer">Edit</label></td></tr>
                            <tr><td>2023101</td><td><strong>Doni Prasetyo</strong></td><td>8B</td><td>L</td><td><span class="badge light red">Nonaktif</span></td><td><label @click="tab='siswa-detail'" class="btn-small outline" style="cursor:pointer">Detail</label> <label @click="tab='siswa-edit'" class="btn-small outline" style="cursor:pointer">Edit</label></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div x-show="tab === 'guru'">
        <div>
            <div class="content-header">
                <h1>Manajemen Guru</h1>
                <div class="header-right">
                    <label @click="tab='guru-form'" class="header-btn primary" style="cursor:pointer"><i class="fas fa-plus"></i> Tambah Guru</label>
                    <div class="avatar teal">AD</div>
                </div>
            </div>
            <div class="card">
                <div class="table-wrap">
                    <table>
                        <thead><tr><th>NIP</th><th>Nama</th><th>Mapel</th><th>Kelas</th><th>Status</th><th></th></tr></thead>
                        <tbody>
                            <tr><td>19870101</td><td><strong>Ustadz Ahmad Fauzi</strong></td><td>PAI</td><td>7A, 7B, 8A</td><td><span class="badge light green">Aktif</span></td><td><label @click="tab='guru-detail'" class="btn-small outline" style="cursor:pointer">Detail</label> <label @click="tab='guru-form'" class="btn-small outline" style="cursor:pointer">Edit</label></td></tr>
                            <tr><td>19900215</td><td><strong>Bu Dewi Sartika</strong></td><td>Matematika</td><td>7A-9B</td><td><span class="badge light green">Aktif</span></td><td><label @click="tab='guru-detail'" class="btn-small outline" style="cursor:pointer">Detail</label> <label @click="tab='guru-form'" class="btn-small outline" style="cursor:pointer">Edit</label></td></tr>
                            <tr><td>19910520</td><td><strong>Ibu Siti Rahmawati</strong></td><td>B. Indonesia</td><td>7A, 7B</td><td><span class="badge light green">Aktif</span></td><td><label @click="tab='guru-detail'" class="btn-small outline" style="cursor:pointer">Detail</label> <label @click="tab='guru-form'" class="btn-small outline" style="cursor:pointer">Edit</label></td></tr>
                            <tr><td>19881210</td><td><strong>Pak Budi Santoso</strong></td><td>IPA</td><td>7A, 8B, 9A</td><td><span class="badge light green">Aktif</span></td><td><label @click="tab='guru-detail'" class="btn-small outline" style="cursor:pointer">Detail</label> <label @click="tab='guru-form'" class="btn-small outline" style="cursor:pointer">Edit</label></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div x-show="tab === 'ortu'">
        <div>
            <div class="content-header">
                <h1>Manajemen Orang Tua</h1>
                <div class="header-right">
                    <label @click="tab='ortu-form'" class="header-btn primary" style="cursor:pointer"><i class="fas fa-plus"></i> Tambah Akun</label>
                    <div class="avatar teal">AD</div>
                </div>
            </div>
            <div class="card">
                <div class="table-wrap">
                    <table>
                        <thead><tr><th>Nama</th><th>Anak</th><th>Kelas</th><th>Email</th><th>Status</th><th></th></tr></thead>
                        <tbody>
                            <tr><td><strong>Bpk. Andi Pratama</strong></td><td>Ahmad Rizky</td><td>7A</td><td>andi@email.com</td><td><span class="badge light green">Aktif</span></td><td><label @click="tab='ortu-detail'" class="btn-small outline" style="cursor:pointer">Detail</label> <label @click="tab='ortu-form'" class="btn-small outline" style="cursor:pointer">Edit</label></td></tr>
                            <tr><td><strong>Ibu Sari Indah</strong></td><td>Siti Aisyah</td><td>7A</td><td>sari@email.com</td><td><span class="badge light green">Aktif</span></td><td><label @click="tab='ortu-detail'" class="btn-small outline" style="cursor:pointer">Detail</label> <label @click="tab='ortu-form'" class="btn-small outline" style="cursor:pointer">Edit</label></td></tr>
                            <tr><td><strong>Bpk. Dwi Hartono</strong></td><td>Budi Santoso</td><td>7A</td><td>dwi@email.com</td><td><span class="badge light green">Aktif</span></td><td><label @click="tab='ortu-detail'" class="btn-small outline" style="cursor:pointer">Detail</label> <label @click="tab='ortu-form'" class="btn-small outline" style="cursor:pointer">Edit</label></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div x-show="tab === 'kelas'">
        <div>
            <div class="content-header">
                <h1>Manajemen Kelas</h1>
                <div class="header-right">
                    <label @click="tab='kelas-form'" class="header-btn primary" style="cursor:pointer"><i class="fas fa-plus"></i> Tambah Kelas</label>
                    <div class="avatar teal">AD</div>
                </div>
            </div>
            <div class="card">
                <div class="table-wrap">
                    <table>
                        <thead><tr><th>Kelas</th><th>Jenjang</th><th>Jumlah Siswa</th><th>Wali Kelas</th><th>Status</th><th></th></tr></thead>
                        <tbody>
                            <tr><td><strong>1A</strong></td><td>SD</td><td>28</td><td>Ibu Siti Rahmawati</td><td><span class="badge light green">Aktif</span></td><td><label @click="tab='kelas-form'" class="btn-small outline" style="cursor:pointer">Edit</label> <label @click="tab='kelas-detail'" class="btn-small outline" style="cursor:pointer">Detail</label></td></tr>
                            <tr><td><strong>4B</strong></td><td>SD</td><td>26</td><td>Pak Budi Santoso</td><td><span class="badge light green">Aktif</span></td><td><label @click="tab='kelas-form'" class="btn-small outline" style="cursor:pointer">Edit</label> <label @click="tab='kelas-detail'" class="btn-small outline" style="cursor:pointer">Detail</label></td></tr>
                            <tr><td><strong>7A</strong></td><td>SMP</td><td>28</td><td>Ustadz Ahmad Fauzi</td><td><span class="badge light green">Aktif</span></td><td><label @click="tab='kelas-form'" class="btn-small outline" style="cursor:pointer">Edit</label> <label @click="tab='kelas-detail'" class="btn-small outline" style="cursor:pointer">Detail</label></td></tr>
                            <tr><td><strong>8B</strong></td><td>SMP</td><td>25</td><td>Bu Dewi Sartika</td><td><span class="badge light green">Aktif</span></td><td><label @click="tab='kelas-form'" class="btn-small outline" style="cursor:pointer">Edit</label> <label @click="tab='kelas-detail'" class="btn-small outline" style="cursor:pointer">Detail</label></td></tr>
                            <tr><td><strong>9A</strong></td><td>SMP</td><td>24</td><td>Pak Dwi Hartono</td><td><span class="badge light green">Aktif</span></td><td><label @click="tab='kelas-form'" class="btn-small outline" style="cursor:pointer">Edit</label> <label @click="tab='kelas-detail'" class="btn-small outline" style="cursor:pointer">Detail</label></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div x-show="tab === 'cbt'" x-data="{ selectedExam: null }">
        @include('dashboard.admin-sections.cbt-approval')
    </div>
    <div x-show="tab === 'pengaturan'">
        <div>
            <div class="content-header">
                <h1>Pengaturan</h1>
                <div class="header-right">
                    <div class="avatar teal">AD</div>
                </div>
            </div>
            <div class="grid-2">
                <div class="card">
                    <div class="card-header"><h3><i class="fas fa-cog" style="color:var(--teal)"></i> Pengaturan Umum</h3></div>
                    <p style="font-size:13px;color:var(--gray-500);margin-bottom:12px">Nama Sekolah: SDIT &amp; SMPIT Al Azhar Jaya Indonesia</p>
                    <p style="font-size:13px;color:var(--gray-500);margin-bottom:12px">Tahun Ajaran: 2025/2026</p>
                    <p style="font-size:13px;color:var(--gray-500);margin-bottom:12px">Semester: Genap</p>
                    <p style="font-size:13px;color:var(--gray-500)">Alamat: Jl. Sirih Prada No. 135, Pabuaran, Kec. Mustika Jaya, Kota Bekasi</p>
                </div>
                <div class="card">
                    <div class="card-header"><h3><i class="fas fa-palette" style="color:var(--purple)"></i> Tampilan</h3></div>
                    <p style="font-size:13px;color:var(--gray-500);margin-bottom:12px">Tema: Default (Hijau &amp; Biru)</p>
                    <p style="font-size:13px;color:var(--gray-500);margin-bottom:12px">Bahasa: Indonesia</p>
                    <p style="font-size:13px;color:var(--gray-500)">Zona Waktu: WIB (UTC+7)</p>
                </div>
            </div>
        </div>
    </div>

    <div x-show="tab === 'siswa-form'">
        <div>
            <div class="content-header">
                <h1><span>Tambah</span> Siswa</h1>
                <div class="header-right">
                    <label @click="tab='siswa'" class="header-btn outline" style="cursor:pointer"><i class="fas fa-arrow-left"></i> Kembali</label>
                    <div class="avatar teal">AD</div>
                </div>
            </div>
            <div class="card" style="max-width:600px">
                <div class="grid-2" style="margin-bottom:16px">
                    <div class="form-group"><label>NIS</label><div class="input-wrap"><input type="text" placeholder="2024001" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div><div class="form-error">NIS wajib diisi</div></div>
                    <div class="form-group"><label>Nama Lengkap</label><div class="input-wrap"><input type="text" placeholder="Ahmad Rizky" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div><div class="form-error">Nama wajib diisi</div></div>
                </div>
                <div class="grid-2" style="margin-bottom:16px">
                    <div class="form-group"><label>Kelas</label><div class="input-wrap"><input type="text" placeholder="7A" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div><div class="form-error">Kelas wajib diisi</div></div>
                    <div class="form-group"><label>Jenis Kelamin</label><select class="form-select"><option>L</option><option>P</option></select></div>
                </div>
                <div class="form-group" style="margin-bottom:16px"><label>Email</label><div class="input-wrap"><input type="email" placeholder="siswa@alazharjayaindonesia.sch.id" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div><div class="form-error">Email wajib diisi</div></div>
                <div class="form-group" style="margin-bottom:16px"><label>Alamat</label><div class="input-wrap"><input type="text" placeholder="Jl. ..." style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div><div class="form-error">Alamat wajib diisi</div></div>
                <div style="display:flex;gap:10px;margin-top:8px">
                    <label @click="tab='siswa'" class="btn-login" style="text-align:center;flex:1;cursor:pointer"><i class="fas fa-save"></i> Simpan</label>
                    <label @click="tab='siswa'" class="btn-login" style="text-align:center;flex:1;cursor:pointer;background:var(--gray-300);color:var(--text)"><i class="fas fa-times"></i> Batal</label>
                </div>
            </div>
        </div>
    </div>

    <div x-show="tab === 'guru-form'">
        <div>
            <div class="content-header">
                <h1><span>Tambah</span> Guru</h1>
                <div class="header-right">
                    <label @click="tab='guru'" class="header-btn outline" style="cursor:pointer"><i class="fas fa-arrow-left"></i> Kembali</label>
                    <div class="avatar teal">AD</div>
                </div>
            </div>
            <div class="card" style="max-width:600px">
                <div class="grid-2" style="margin-bottom:16px">
                    <div class="form-group"><label>NIP</label><div class="input-wrap"><input type="text" placeholder="19870101" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div><div class="form-error">NIP wajib diisi</div></div>
                    <div class="form-group"><label>Nama Lengkap</label><div class="input-wrap"><input type="text" placeholder="Ustadz Ahmad Fauzi" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div><div class="form-error">Nama wajib diisi</div></div>
                </div>
                <div class="grid-2" style="margin-bottom:16px">
                    <div class="form-group"><label>Mata Pelajaran</label><div class="input-wrap"><input type="text" placeholder="PAI" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div><div class="form-error">Mata Pelajaran wajib diisi</div></div>
                    <div class="form-group"><label>Kelas</label><div class="input-wrap"><input type="text" placeholder="7A, 7B, 8A" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div><div class="form-error">Kelas wajib diisi</div></div>
                </div>
                <div class="form-group" style="margin-bottom:16px"><label>Email</label><div class="input-wrap"><input type="email" placeholder="guru@alazharjayaindonesia.sch.id" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div><div class="form-error">Email wajib diisi</div></div>
                <div style="display:flex;gap:10px;margin-top:8px">
                    <label @click="tab='guru'" class="btn-login" style="text-align:center;flex:1;cursor:pointer"><i class="fas fa-save"></i> Simpan</label>
                    <label @click="tab='guru'" class="btn-login" style="text-align:center;flex:1;cursor:pointer;background:var(--gray-300);color:var(--text)"><i class="fas fa-times"></i> Batal</label>
                </div>
            </div>
        </div>
    </div>

    <div x-show="tab === 'ortu-form'">
        <div>
            <div class="content-header">
                <h1><span>Tambah</span> Orang Tua</h1>
                <div class="header-right">
                    <label @click="tab='ortu'" class="header-btn outline" style="cursor:pointer"><i class="fas fa-arrow-left"></i> Kembali</label>
                    <div class="avatar teal">AD</div>
                </div>
            </div>
            <div class="card" style="max-width:600px">
                <div class="grid-2" style="margin-bottom:16px">
                    <div class="form-group"><label>Nama</label><div class="input-wrap"><input type="text" placeholder="Bpk. Andi Pratama" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div><div class="form-error">Nama wajib diisi</div></div>
                    <div class="form-group"><label>Nama Anak</label><div class="input-wrap"><input type="text" placeholder="Ahmad Rizky" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div><div class="form-error">Nama Anak wajib diisi</div></div>
                </div>
                <div class="grid-2" style="margin-bottom:16px">
                    <div class="form-group"><label>Kelas Anak</label><div class="input-wrap"><input type="text" placeholder="7A" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div><div class="form-error">Kelas Anak wajib diisi</div></div>
                    <div class="form-group"><label>Email</label><div class="input-wrap"><input type="email" placeholder="ortu@email.com" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div><div class="form-error">Email wajib diisi</div></div>
                </div>
                <div style="display:flex;gap:10px;margin-top:8px">
                    <label @click="tab='ortu'" class="btn-login" style="text-align:center;flex:1;cursor:pointer"><i class="fas fa-save"></i> Simpan</label>
                    <label @click="tab='ortu'" class="btn-login" style="text-align:center;flex:1;cursor:pointer;background:var(--gray-300);color:var(--text)"><i class="fas fa-times"></i> Batal</label>
                </div>
            </div>
        </div>
    </div>

    <div x-show="tab === 'kelas-form'">
        <div>
            <div class="content-header">
                <h1><span>Tambah</span> Kelas</h1>
                <div class="header-right">
                    <label @click="tab='kelas'" class="header-btn outline" style="cursor:pointer"><i class="fas fa-arrow-left"></i> Kembali</label>
                    <div class="avatar teal">AD</div>
                </div>
            </div>
            <div class="card" style="max-width:600px">
                <div class="grid-2" style="margin-bottom:16px">
                    <div class="form-group"><label>Nama Kelas</label><div class="input-wrap"><input type="text" placeholder="1A" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div><div class="form-error">Nama Kelas wajib diisi</div></div>
                    <div class="form-group"><label>Jenjang</label><select class="form-select"><option>SD</option><option>SMP</option></select></div>
                </div>
                <div class="form-group" style="margin-bottom:16px"><label>Wali Kelas</label><div class="input-wrap"><input type="text" placeholder="Ibu Siti Rahmawati" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div><div class="form-error">Wali Kelas wajib diisi</div></div>
                <div style="display:flex;gap:10px;margin-top:8px">
                    <label @click="tab='kelas'" class="btn-login" style="text-align:center;flex:1;cursor:pointer"><i class="fas fa-save"></i> Simpan</label>
                    <label @click="tab='kelas'" class="btn-login" style="text-align:center;flex:1;cursor:pointer;background:var(--gray-300);color:var(--text)"><i class="fas fa-times"></i> Batal</label>
                </div>
            </div>
        </div>
    </div>

    <div x-show="tab === 'siswa-detail'">
        <div>
            <div class="content-header">
                <div><h1>Detail Siswa</h1><p style="font-size:14px;color:var(--gray-400);margin-top:2px">Informasi lengkap siswa</p></div>
                <div class="header-right">
                    <label @click="tab='siswa'" class="header-btn outline" style="cursor:pointer"><i class="fas fa-arrow-left"></i> Kembali</label>
                    <div class="avatar teal">AR</div>
                </div>
            </div>
            <div class="card" style="margin-bottom:20px">
                <div class="card-header"><h3><i class="fas fa-user-graduate" style="color:var(--teal)"></i> Identitas Siswa</h3><label @click="tab='siswa-edit'" class="btn-small teal" style="cursor:pointer"><i class="fas fa-edit"></i> Edit</label></div>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;padding:8px 0">
                    <div><span style="font-size:12px;color:var(--gray-400)">NIS</span><div style="font-weight:600">2024001</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Nama Lengkap</span><div style="font-weight:600">Ahmad Rizky</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Jenis Kelamin</span><div style="font-weight:600">Laki-laki</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Kelas</span><div style="font-weight:600">7A</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Tempat, Tgl Lahir</span><div style="font-weight:600">Bekasi, 12 Mei 2013</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Alamat</span><div style="font-weight:600">Jl. Sirih Prada No. 12</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Nama Orang Tua</span><div style="font-weight:600">Bapak Ahmad Fauzi</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">No. Telepon</span><div style="font-weight:600">0812-3456-7890</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Email</span><div style="font-weight:600">ahmad.rizky@alazharjayaindonesia.sch.id</div></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h3><i class="fas fa-chart-line" style="color:var(--blue)"></i> Ringkasan Akademik</h3></div>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:12px;padding:8px 0">
                    <div style="text-align:center;padding:16px;background:var(--teal-bg);border-radius:var(--radius-sm)"><div style="font-size:24px;font-weight:700;color:var(--teal)">85.3</div><div style="font-size:11px;color:var(--gray-400)">Rata-rata</div></div>
                    <div style="text-align:center;padding:16px;background:var(--blue-bg);border-radius:var(--radius-sm)"><div style="font-size:24px;font-weight:700;color:var(--blue)">5</div><div style="font-size:11px;color:var(--gray-400)">Peringkat</div></div>
                    <div style="text-align:center;padding:16px;background:var(--green-bg);border-radius:var(--radius-sm)"><div style="font-size:24px;font-weight:700;color:var(--green)">112</div><div style="font-size:11px;color:var(--gray-400)">Hadir</div></div>
                    <div style="text-align:center;padding:16px;background:var(--orange-bg);border-radius:var(--radius-sm)"><div style="font-size:24px;font-weight:700;color:var(--orange)">3</div><div style="font-size:11px;color:var(--gray-400)">Tugas</div></div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="tab === 'guru-detail'">
        <div>
            <div class="content-header">
                <div><h1>Detail Guru</h1><p style="font-size:14px;color:var(--gray-400);margin-top:2px">Informasi lengkap guru</p></div>
                <div class="header-right">
                    <label @click="tab='guru'" class="header-btn outline" style="cursor:pointer"><i class="fas fa-arrow-left"></i> Kembali</label>
                    <div class="avatar blue">DS</div>
                </div>
            </div>
            <div class="card" style="margin-bottom:20px">
                <div class="card-header"><h3><i class="fas fa-chalkboard-teacher" style="color:var(--blue)"></i> Identitas Guru</h3><label @click="tab='guru-form'" class="btn-small teal" style="cursor:pointer"><i class="fas fa-edit"></i> Edit</label></div>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;padding:8px 0">
                    <div><span style="font-size:12px;color:var(--gray-400)">NIP</span><div style="font-weight:600">198703202010012010</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Nama Lengkap</span><div style="font-weight:600">Bu Dewi Sartika, S.Pd.</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Jenis Kelamin</span><div style="font-weight:600">Perempuan</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Mata Pelajaran</span><div style="font-weight:600">Matematika</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">No. Telepon</span><div style="font-weight:600">0856-7890-1234</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Email</span><div style="font-weight:600">dewi.sartika@alazharjayaindonesia.sch.id</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Alamat</span><div style="font-weight:600">Perumahan Mustika Jaya Blok A5</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Status</span><div><span class="badge teal">Aktif</span></div></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h3><i class="fas fa-chalkboard" style="color:var(--teal)"></i> Kelas yang Diajar</h3></div>
                <div class="table-wrap">
                    <table>
                        <thead><tr><th>Kelas</th><th>Jumlah Siswa</th><th>Wali Kelas</th><th></th></tr></thead>
                        <tbody>
                            <tr><td><strong>7A</strong></td><td>28</td><td>Ustadz Ahmad Fauzi</td><td><label @click="tab='kelas-detail'" class="btn-small teal" style="cursor:pointer">Detail</label></td></tr>
                            <tr><td><strong>7B</strong></td><td>26</td><td>Ustadz Ahmad Fauzi</td><td><label @click="tab='kelas-detail'" class="btn-small teal" style="cursor:pointer">Detail</label></td></tr>
                            <tr><td><strong>8A</strong></td><td>27</td><td>Bu Dewi Sartika</td><td><label @click="tab='kelas-detail'" class="btn-small teal" style="cursor:pointer">Detail</label></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div x-show="tab === 'ortu-detail'">
        <div>
            <div class="content-header">
                <div><h1>Detail Orang Tua</h1><p style="font-size:14px;color:var(--gray-400);margin-top:2px">Informasi lengkap orang tua/wali</p></div>
                <div class="header-right">
                    <label @click="tab='ortu'" class="header-btn outline" style="cursor:pointer"><i class="fas fa-arrow-left"></i> Kembali</label>
                    <div class="avatar orange">SR</div>
                </div>
            </div>
            <div class="card" style="margin-bottom:20px">
                <div class="card-header"><h3><i class="fas fa-users" style="color:var(--orange)"></i> Identitas Orang Tua</h3><label @click="tab='ortu-form'" class="btn-small teal" style="cursor:pointer"><i class="fas fa-edit"></i> Edit</label></div>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;padding:8px 0">
                    <div><span style="font-size:12px;color:var(--gray-400)">Nama Ayah</span><div style="font-weight:600">Bapak Ahmad Syahroni</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Nama Ibu</span><div style="font-weight:600">Ibu Siti Rohmah</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">No. Telepon</span><div style="font-weight:600">0812-3456-7890</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Email</span><div style="font-weight:600">siti.rohmah@email.com</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Alamat</span><div style="font-weight:600">Jl. Sirih Prada No. 12</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Anak</span><div style="font-weight:600">Ahmad Rizky (7A), Siti Fatimah (5B)</div></div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="tab === 'kelas-detail'">
        <div>
            <div class="content-header">
                <div><h1>Detail Kelas</h1><p style="font-size:14px;color:var(--gray-400);margin-top:2px">Informasi lengkap kelas</p></div>
                <div class="header-right">
                    <label @click="tab='kelas'" class="header-btn outline" style="cursor:pointer"><i class="fas fa-arrow-left"></i> Kembali</label>
                    <div class="avatar teal">7A</div>
                </div>
            </div>
            <div class="card" style="margin-bottom:20px">
                <div class="card-header"><h3><i class="fas fa-school" style="color:var(--teal)"></i> Informasi Kelas</h3><label @click="tab='kelas-form'" class="btn-small teal" style="cursor:pointer"><i class="fas fa-edit"></i> Edit</label></div>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;padding:8px 0">
                    <div><span style="font-size:12px;color:var(--gray-400)">Nama Kelas</span><div style="font-weight:600">7A</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Jenjang</span><div style="font-weight:600">SMP</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Wali Kelas</span><div style="font-weight:600">Ustadz Ahmad Fauzi</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Jumlah Siswa</span><div style="font-weight:600">28</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Tahun Ajaran</span><div style="font-weight:600">2025/2026</div></div>
                    <div><span style="font-size:12px;color:var(--gray-400)">Status</span><div><span class="badge teal">Aktif</span></div></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h3><i class="fas fa-user-graduate" style="color:var(--blue)"></i> Daftar Siswa</h3><label style="font-size:12px;color:var(--blue);font-weight:600;cursor:pointer;text-decoration:none">Lihat Semua</label></div>
                <div class="table-wrap">
                    <table>
                        <thead><tr><th>No</th><th>NIS</th><th>Nama</th><th>L/P</th><th></th></tr></thead>
                        <tbody>
                            <tr><td>1</td><td>2024001</td><td><strong>Ahmad Rizky</strong></td><td>L</td><td><label @click="tab='siswa-detail'" class="btn-small outline" style="cursor:pointer">Detail</label></td></tr>
                            <tr><td>2</td><td>2024002</td><td><strong>Siti Aisyah</strong></td><td>P</td><td><label @click="tab='siswa-detail'" class="btn-small outline" style="cursor:pointer">Detail</label></td></tr>
                            <tr><td>3</td><td>2024003</td><td><strong>Budi Santoso</strong></td><td>L</td><td><label @click="tab='siswa-detail'" class="btn-small outline" style="cursor:pointer">Detail</label></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div x-show="tab === 'siswa-edit'">
        <div>
            <div class="content-header">
                <h1>Edit Siswa</h1>
                <div class="header-right">
                    <label @click="tab='siswa'" class="header-btn outline" style="cursor:pointer"><i class="fas fa-arrow-left"></i> Kembali</label>
                    <div class="avatar teal">AD</div>
                </div>
            </div>
            <div class="card" style="max-width:600px">
                <div class="grid-2" style="margin-bottom:16px">
                    <div class="form-group"><label>NIS</label><div class="input-wrap"><input type="text" value="2024001" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div></div>
                    <div class="form-group"><label>Nama Lengkap</label><div class="input-wrap"><input type="text" value="Ahmad Rizky" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div></div>
                </div>
                <div class="grid-2" style="margin-bottom:16px">
                    <div class="form-group"><label>Kelas</label><div class="input-wrap"><input type="text" value="7A" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div></div>
                    <div class="form-group"><label>Jenis Kelamin</label><select class="form-select"><option selected>L</option><option>P</option></select></div>
                </div>
                <div class="form-group" style="margin-bottom:16px"><label>Email</label><div class="input-wrap"><input type="email" value="ahmad.rizky@alazharjayaindonesia.sch.id" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div></div>
                <div class="form-group" style="margin-bottom:16px"><label>Alamat</label><div class="input-wrap"><input type="text" value="Jl. Sirih Prada No. 12" style="border:none;outline:none;padding:10px 0;font-size:14px;font-family:var(--font);width:100%"></div></div>
                <div style="display:flex;gap:10px;margin-top:8px">
                    <label @click="tab='siswa'" class="btn-login" style="text-align:center;flex:1;cursor:pointer"><i class="fas fa-save"></i> Simpan</label>
                    <label @click="tab='siswa-detail'" class="btn-login" style="text-align:center;flex:1;cursor:pointer;background:var(--gray-300);color:var(--text)"><i class="fas fa-times"></i> Batal</label>
                </div>
            </div>
        </div>
    </div>

@endsection
