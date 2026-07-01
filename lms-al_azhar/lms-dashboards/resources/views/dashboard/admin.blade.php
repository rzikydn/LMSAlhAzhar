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
    <li :class="{'active': tab === 'kurikulum'}" @click="tab = 'kurikulum'">
        <label><i class="fas fa-book-open"></i> Kurikulum &amp; KKM</label>
    </li>
    <li :class="{'active': tab === 'asesmen'}" @click="tab = 'asesmen'">
        <label><i class="fas fa-cubes"></i> Asesmen &amp; Ujian</label>
    </li>
    <li :class="{'active': tab === 'audit_guru'}" @click="tab = 'audit_guru'">
        <label><i class="fas fa-clipboard-check"></i> Audit &amp; Kinerja Guru</label>
    </li>
    <li :class="{'active': tab === 'karya_tahfidz'}" @click="tab = 'karya_tahfidz'">
        <label><i class="fas fa-medal"></i> Karya Tulis &amp; Tahfidz</label>
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

    <!-- KURIKULUM & KKM TAB -->
    <div x-show="tab === 'kurikulum'" x-data="{
        showToast: false,
        toastMsg: '',
        kkmList: [
            { mapel: 'Matematika', biasa: 75, unggulan: 85 },
            { mapel: 'IPA', biasa: 75, unggulan: 85 },
            { mapel: 'Bahasa Indonesia', biasa: 78, unggulan: 88 },
            { mapel: 'Pendidikan Agama Islam', biasa: 80, unggulan: 90 },
            { mapel: 'Bahasa Inggris', biasa: 75, unggulan: 85 }
        ],
        mapelPairs: [
            { mapel1: 'Matematika', mapel2: 'Mathematics' },
            { mapel1: 'IPA', mapel2: 'Science' },
            { mapel1: 'IPS', mapel2: 'Social Studies' }
        ],
        newPair1: '',
        newPair2: '',
        saveKKM() {
            this.toastMsg = 'Pengaturan KKM berhasil disimpan!';
            this.showToast = true;
            setTimeout(() => this.showToast = false, 3000);
        },
        addPair() {
            if (!this.newPair1 || !this.newPair2) return;
            this.mapelPairs.push({ mapel1: this.newPair1, mapel2: this.newPair2 });
            this.newPair1 = '';
            this.newPair2 = '';
            this.toastMsg = 'Pasangan Mata Pelajaran ditambahkan!';
            this.showToast = true;
            setTimeout(() => this.showToast = false, 3000);
        },
        removePair(index) {
            this.mapelPairs.splice(index, 1);
            this.toastMsg = 'Pasangan Mata Pelajaran dihapus!';
            this.showToast = true;
            setTimeout(() => this.showToast = false, 3000);
        }
    }">
        <div class="content-header">
            <div>
                <h1>Kurikulum &amp; KKM</h1>
                <p style="font-size:14px;color:var(--gray-400);margin-top:2px">Kelola KKM Mata Pelajaran &amp; Pasangan Mapel Bilingual</p>
            </div>
            <div class="header-right">
                <div class="avatar teal">AD</div>
            </div>
        </div>

        <div class="grid-2">
            <!-- Card KKM -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-sliders-h" style="color:var(--teal)"></i> Pengaturan Nilai Minimum (KKM)</h3>
                </div>
                <div class="table-wrap" style="margin-bottom: 20px;">
                    <table>
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>KKM Biasa</th>
                                <th>KKM Unggulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(kkm, index) in kkmList" :key="index">
                                <tr>
                                    <td style="font-weight: 600;" x-text="kkm.mapel"></td>
                                    <td>
                                        <div class="input-wrap" style="border: 1px solid var(--border-light); border-radius: 4px; padding: 2px 6px; width: 80px; display: inline-block;">
                                            <input type="number" x-model.number="kkm.biasa" style="border:none; outline:none; width: 100%; font-size: 13px; text-align: center;">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-wrap" style="border: 1px solid var(--border-light); border-radius: 4px; padding: 2px 6px; width: 80px; display: inline-block;">
                                            <input type="number" x-model.number="kkm.unggulan" style="border:none; outline:none; width: 100%; font-size: 13px; text-align: center;">
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <button @click="saveKKM()" class="btn-primary btn-small" style="display: block; width: 100%; text-align: center; border-radius: 8px;">
                    <i class="fas fa-save"></i> Simpan Nilai KKM
                </button>
            </div>

            <!-- Card Pasangan Mapel -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-link" style="color:var(--blue)"></i> Pasangan Mata Pelajaran (Bilingual)</h3>
                </div>
                
                <div style="background: var(--blue-bg); padding: 12px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); margin-bottom: 16px;">
                    <p style="font-size: 12px; color: var(--gray-600); line-height: 1.4;">
                        Tentukan pasangan mapel nasional dengan pasangan mapel internasionalnya untuk pelaporan rapor terintegrasi.
                    </p>
                </div>

                <div class="table-wrap" style="margin-bottom: 20px; max-height: 250px; overflow-y: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>Mapel Utama</th>
                                <th></th>
                                <th>Mapel Pasangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(pair, index) in mapelPairs" :key="index">
                                <tr>
                                    <td style="font-weight:600;" x-text="pair.mapel1"></td>
                                    <td style="color: var(--gray-400); text-align: center;"><i class="fas fa-arrows-alt-h"></i></td>
                                    <td style="font-weight:600; color: var(--blue);" x-text="pair.mapel2"></td>
                                    <td>
                                        <button @click="removePair(index)" class="btn-small outline" style="border-color: var(--red); color: var(--red); padding: 2px 8px; font-size: 11px;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <div style="border-top: 1px solid var(--border-light); padding-top: 16px;">
                    <h4 style="font-size: 12px; font-weight: 700; margin-bottom: 8px;">Tambah Hubungan Baru</h4>
                    <div style="display: flex; gap: 8px;">
                        <div class="input-wrap" style="flex:1; border: 1px solid var(--border-light); border-radius: var(--radius-sm); padding: 6px 12px;">
                            <input type="text" placeholder="Contoh: IPS" x-model="newPair1" style="border:none; outline:none; width: 100%; font-size:12px;">
                        </div>
                        <div style="align-self: center; color: var(--gray-400);"><i class="fas fa-link"></i></div>
                        <div class="input-wrap" style="flex:1; border: 1px solid var(--border-light); border-radius: var(--radius-sm); padding: 6px 12px;">
                            <input type="text" placeholder="Contoh: Social Studies" x-model="newPair2" style="border:none; outline:none; width: 100%; font-size:12px;">
                        </div>
                        <button @click="addPair()" class="btn-primary btn-small" style="padding: 8px 12px; border-radius: var(--radius-sm);">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Alert -->
        <div x-show="showToast" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-2"
             style="position: fixed; bottom: 24px; right: 24px; background: var(--teal); color: white; padding: 12px 24px; border-radius: var(--radius-sm); box-shadow: var(--shadow-lg); z-index: 9999; display: flex; align-items: center; gap: 8px;">
             <i class="fas fa-check-circle"></i> <span x-text="toastMsg"></span>
        </div>
    </div>

    <!-- ASESMEN & UJIAN TAB -->
    <div x-show="tab === 'asesmen'" x-data="{
        showToast: false,
        toastMsg: '',
        isGenerating: false,
        examAssembled: false,
        selectedMapel: 'Matematika',
        selectedKelas: '7A',
        soalCount: 40,
        compEasy: 30,
        compMedium: 40,
        compHard: 20,
        compOlim: 10,
        soalList: [],
        anomalies: [
            { nama: 'Ahmad Rizky', kelas: '7A', mapel: 'Matematika', biasa: 55, unggulan: 92, status: 'Flagged', guru: 'Bu Dewi Sartika' },
            { nama: 'Siti Aisyah', kelas: '7A', mapel: 'IPA', biasa: 95, unggulan: 48, status: 'Flagged', guru: 'Pak Budi Santoso' },
            { nama: 'Budi Santoso', kelas: '7A', mapel: 'PAI', biasa: 40, unggulan: 88, status: 'Flagged', guru: 'Ustadz Ahmad Fauzi' }
        ],
        generateExam() {
            this.isGenerating = true;
            this.examAssembled = false;
            setTimeout(() => {
                this.isGenerating = false;
                this.examAssembled = true;
                this.soalList = [
                    { no: 1, teks: 'Hasil dari 12 x (15 + 25) adalah...', tipe: 'Gampang' },
                    { no: 2, teks: 'Jika x + 5 = 12, maka nilai 2x - 3 adalah...', tipe: 'Sedang' },
                    { no: 3, teks: 'Tentukan himpunan penyelesaian dari persamaan kuadrat x² - 5x + 6 = 0...', tipe: 'Susah' },
                    { no: 4, teks: 'Diberikan segitiga ABC dengan panjang sisi AB=6, BC=8, CA=10. Jika titik D pada...', tipe: 'Olimpiade' }
                ];
                this.toastMsg = 'Ujian Otomatis Berhasil Dirakit!';
                this.showToast = true;
                setTimeout(() => this.showToast = false, 3000);
            }, 1500);
        },
        swapScores(index) {
            let a = this.anomalies[index];
            let temp = a.biasa;
            a.biasa = a.unggulan;
            a.unggulan = temp;
            a.status = 'Fixed';
            this.toastMsg = 'Nilai berhasil ditukar kembali untuk ' + a.nama;
            this.showToast = true;
            setTimeout(() => this.showToast = false, 3000);
        }
    }">
        <div class="content-header">
            <div>
                <h1>Asesmen &amp; Bank Soal</h1>
                <p style="font-size:14px;color:var(--gray-400);margin-top:2px">Rakit Ujian Otomatis &amp; Cek Nilai Tertukar (Audit Nilai)</p>
            </div>
            <div class="header-right">
                <div class="avatar teal">AD</div>
            </div>
        </div>

        <div class="grid-2">
            <!-- Card Bank Soal & Rakit Ujian -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-cog" style="color:var(--teal)"></i> Perakitan Ujian Otomatis</h3>
                </div>

                <div style="display:flex; flex-direction:column; gap:12px;">
                    <div class="grid-2">
                        <div class="form-group" style="margin-bottom:0;">
                            <label style="font-size: 11px; font-weight:700;">Mata Pelajaran</label>
                            <select x-model="selectedMapel" class="form-select" style="width:100%; border:1px solid var(--border-light); border-radius:4px; padding:6px; font-family:var(--font); outline:none;">
                                <option>Matematika</option>
                                <option>IPA</option>
                                <option>Bahasa Indonesia</option>
                                <option>Bahasa Inggris</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label style="font-size: 11px; font-weight:700;">Kelas Target</label>
                            <select x-model="selectedKelas" class="form-select" style="width:100%; border:1px solid var(--border-light); border-radius:4px; padding:6px; font-family:var(--font); outline:none;">
                                <option>7A</option>
                                <option>7B</option>
                                <option>8A</option>
                                <option>9A</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label style="font-size: 11px; font-weight:700;">Jumlah Soal</label>
                        <div class="input-wrap" style="border: 1px solid var(--border-light); border-radius: 4px; padding: 6px 12px;">
                            <input type="number" x-model.number="soalCount" style="border:none; outline:none; width:100%; font-size:13px; font-family:var(--font);">
                        </div>
                    </div>

                    <!-- Slider / Input Komposisi Soal -->
                    <div style="background:var(--gray-50); padding:12px; border-radius:var(--radius-sm); border: 1px solid var(--border-light); display:flex; flex-direction:column; gap:8px;">
                        <span style="font-size:11px; font-weight:700; color:var(--gray-600);">Komposisi Soal (%)</span>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:8px;">
                            <div>
                                <span style="font-size:11px; color:var(--gray-500);">Gampang</span>
                                <input type="number" x-model.number="compEasy" class="form-select" style="width:100%; border:1px solid var(--border-light); padding:4px; font-size:12px; font-family:var(--font); outline:none; border-radius:4px;">
                            </div>
                            <div>
                                <span style="font-size:11px; color:var(--gray-500);">Sedang</span>
                                <input type="number" x-model.number="compMedium" class="form-select" style="width:100%; border:1px solid var(--border-light); padding:4px; font-size:12px; font-family:var(--font); outline:none; border-radius:4px;">
                            </div>
                            <div>
                                <span style="font-size:11px; color:var(--gray-500);">Susah</span>
                                <input type="number" x-model.number="compHard" class="form-select" style="width:100%; border:1px solid var(--border-light); padding:4px; font-size:12px; font-family:var(--font); outline:none; border-radius:4px;">
                            </div>
                            <div>
                                <span style="font-size:11px; color:var(--gray-500);">Olimpiade</span>
                                <input type="number" x-model.number="compOlim" class="form-select" style="width:100%; border:1px solid var(--border-light); padding:4px; font-size:12px; font-family:var(--font); outline:none; border-radius:4px;">
                            </div>
                        </div>
                    </div>

                    <button @click="generateExam()" class="btn-primary btn-small" style="padding: 10px; width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; border-radius:8px;" :disabled="isGenerating">
                        <i class="fas fa-spinner fa-spin" x-show="isGenerating" style="display:none;"></i>
                        <i class="fas fa-magic" x-show="!isGenerating"></i>
                        <span x-text="isGenerating ? 'Merakit Soal...' : 'Rakit Ujian Otomatis'"></span>
                    </button>
                </div>

                <!-- Preview Rakitan Soal -->
                <div x-show="examAssembled" style="margin-top:20px; border-top:1.5px dashed var(--border); padding-top:16px;" x-transition>
                    <h4 style="font-size: 13px; font-weight: 700; margin-bottom: 8px; color: var(--teal);"><i class="fas fa-file-alt"></i> Preview Lembar Ujian Terakit</h4>
                    <div style="display:flex; flex-direction:column; gap:8px;">
                        <template x-for="soal in soalList" :key="soal.no">
                            <div style="background:var(--white); border: 1px solid var(--border-light); border-radius: var(--radius-sm); padding:8px 12px; display:flex; gap:10px;">
                                <span style="font-weight:700; color:var(--teal);" x-text="soal.no"></span>
                                <div style="flex:1;">
                                    <p style="font-size:12px; font-weight:500;" x-text="soal.teks"></p>
                                    <span class="badge" :class="{'teal': soal.tipe==='Gampang', 'blue': soal.tipe==='Sedang', 'orange': soal.tipe==='Susah', 'red': soal.tipe==='Olimpiade'}" style="font-size:9px; padding:2px 6px;" x-text="soal.tipe"></span>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Card Cek Nilai Ketuker -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-exclamation-triangle" style="color:var(--orange)"></i> Cek Nilai Tertukar (Audit Nilai)</h3>
                </div>

                <div style="background: var(--orange-bg); padding: 12px; border-radius: var(--radius-sm); border: 1px solid var(--border-light); margin-bottom: 16px;">
                    <p style="font-size: 12px; color: var(--gray-600); line-height: 1.4;">
                        Algoritma mendeteksi anomali entri di mana nilai harian biasa dan nilai unggulan terbalik pada kolom nilai guru.
                    </p>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Siswa</th>
                                <th>Mapel</th>
                                <th>Biasa</th>
                                <th>Unggulan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(anomali, index) in anomalies" :key="index">
                                <tr>
                                    <td>
                                        <div style="font-weight:600;" x-text="anomali.nama"></div>
                                        <small style="color:var(--gray-400);" x-text="'Kelas: ' + anomali.kelas"></small>
                                    </td>
                                    <td>
                                        <div style="font-weight:600;" x-text="anomali.mapel"></div>
                                        <small style="color:var(--gray-400);" x-text="'Guru: ' + anomali.guru"></small>
                                    </td>
                                    <td>
                                        <span x-text="anomali.biasa" :style="anomali.status === 'Flagged' ? 'color: var(--red); font-weight:700;' : 'color: var(--text);'"></span>
                                    </td>
                                    <td>
                                        <span x-text="anomali.unggulan" :style="anomali.status === 'Flagged' ? 'color: var(--teal); font-weight:700;' : 'color: var(--text);'"></span>
                                    </td>
                                    <td>
                                        <span class="badge" :class="anomali.status === 'Flagged' ? 'red' : 'green'" style="font-size:10px;" x-text="anomali.status"></span>
                                    </td>
                                    <td>
                                        <template x-if="anomali.status === 'Flagged'">
                                            <button @click="swapScores(index)" class="btn-small teal" style="padding: 4px 8px; font-size:11px;">
                                                <i class="fas fa-sync-alt"></i> Tukar Kembali
                                            </button>
                                        </template>
                                        <template x-if="anomali.status === 'Fixed'">
                                            <span style="color: var(--green); font-size: 11px; font-weight: 600;"><i class="fas fa-check"></i> Selesai</span>
                                        </template>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Toast Alert -->
        <div x-show="showToast" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-2"
             style="position: fixed; bottom: 24px; right: 24px; background: var(--teal); color: white; padding: 12px 24px; border-radius: var(--radius-sm); box-shadow: var(--shadow-lg); z-index: 9999; display: flex; align-items: center; gap: 8px;">
             <i class="fas fa-check-circle"></i> <span x-text="toastMsg"></span>
        </div>
    </div>

    <!-- AUDIT & KINERJA GURU TAB -->
    <div x-show="tab === 'audit_guru'" x-data="{
        showToast: false,
        toastMsg: '',
        guruReports: [
            { nama: 'Ustadz Ahmad Fauzi', harian: 'Lengkap', mingguan: 'Lengkap', bulanan: 'Belum Isi', kelas: '7A', mapel: 'PAI' },
            { nama: 'Bu Dewi Sartika', harian: 'Lengkap', mingguan: 'Lengkap', bulanan: 'Lengkap', kelas: '7A-9B', mapel: 'Matematika' },
            { nama: 'Ibu Siti Rahmawati', harian: 'Terlambat', mingguan: 'Belum Isi', bulanan: 'Belum Isi', kelas: '7A', mapel: 'B. Indonesia' },
            { nama: 'Pak Budi Santoso', harian: 'Lengkap', mingguan: 'Lengkap', bulanan: 'Lengkap', kelas: '7A', mapel: 'IPA' }
        ],
        materiAjar: [
            { id: 1, guru: 'Bu Dewi Sartika', mapel: 'Matematika 7', judul: 'Aljabar & SPLDV', status: 'Pending' },
            { id: 2, guru: 'Pak Budi Santoso', mapel: 'IPA 7', judul: 'Ekosistem & Lingkungan', status: 'Pending' },
            { id: 3, guru: 'Ustadz Ahmad Fauzi', mapel: 'PAI 7', judul: 'Fiqih Sholat Berjamaah', status: 'Approved' }
        ],
        sendReminder(nama) {
            this.toastMsg = 'Peringatan terkirim ke ' + nama + '!';
            this.showToast = true;
            setTimeout(() => this.showToast = false, 3000);
        },
        approveMateri(id) {
            let m = this.materiAjar.find(x => x.id === id);
            if (m) m.status = 'Approved';
            this.toastMsg = 'Materi ajar disetujui!';
            this.showToast = true;
            setTimeout(() => this.showToast = false, 3000);
        },
        rejectMateri(id) {
            let m = this.materiAjar.find(x => x.id === id);
            if (m) m.status = 'Rejected';
            this.toastMsg = 'Materi ajar ditolak!';
            this.showToast = true;
            setTimeout(() => this.showToast = false, 3000);
        },
        calculatePerformance(guruName) {
            let rep = this.guruReports.find(x => x.nama === guruName);
            let mat = this.materiAjar.filter(x => x.guru === guruName);
            
            let score = 70; // Base score
            if (rep) {
                if (rep.harian === 'Lengkap') score += 10;
                if (rep.mingguan === 'Lengkap') score += 10;
                if (rep.bulanan === 'Lengkap') score += 10;
                if (rep.harian === 'Terlambat') score += 5;
            }
            let approvedCount = mat.filter(x => x.status === 'Approved').length;
            score += approvedCount * 5;
            return Math.min(score, 100);
        }
    }">
        <div class="content-header">
            <div>
                <h1>Audit &amp; Kinerja Guru</h1>
                <p style="font-size:14px;color:var(--gray-400);margin-top:2px">Cek Kelengkapan Laporan Mengajar, Approval Modul, dan Rapor Kinerja</p>
            </div>
            <div class="header-right">
                <div class="avatar teal">AD</div>
            </div>
        </div>

        <div class="grid-2" style="margin-bottom: 24px;">
            <!-- Column 1: Laporan Mengajar -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-clipboard-list" style="color:var(--teal)"></i> Kelengkapan Laporan Guru</h3>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Guru</th>
                                <th>Harian</th>
                                <th>Mingguan</th>
                                <th>Bulanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(rep, index) in guruReports" :key="index">
                                <tr>
                                    <td>
                                        <div style="font-weight: 600;" x-text="rep.nama"></div>
                                        <small style="color:var(--gray-400);" x-text="rep.mapel + ' - ' + rep.kelas"></small>
                                    </td>
                                    <td>
                                        <span class="badge" :class="{'green': rep.harian==='Lengkap', 'orange': rep.harian==='Terlambat', 'red': rep.harian==='Belum Isi'}" x-text="rep.harian"></span>
                                    </td>
                                    <td>
                                        <span class="badge" :class="{'green': rep.mingguan==='Lengkap', 'orange': rep.mingguan==='Terlambat', 'red': rep.mingguan==='Belum Isi'}" x-text="rep.mingguan"></span>
                                    </td>
                                    <td>
                                        <span class="badge" :class="{'green': rep.bulanan==='Lengkap', 'orange': rep.bulanan==='Terlambat', 'red': rep.bulanan==='Belum Isi'}" x-text="rep.bulanan"></span>
                                    </td>
                                    <td>
                                        <template x-if="rep.harian === 'Belum Isi' || rep.mingguan === 'Belum Isi' || rep.bulanan === 'Belum Isi' || rep.harian === 'Terlambat'">
                                            <button @click="sendReminder(rep.nama)" class="btn-small outline" style="border-color:var(--red); color:var(--red); padding:4px 8px; font-size:11px;">
                                                <i class="fas fa-bell"></i> Hubungi
                                            </button>
                                        </template>
                                        <template x-if="rep.harian === 'Lengkap' && rep.mingguan === 'Lengkap' && rep.bulanan === 'Lengkap'">
                                            <span style="color:var(--green); font-size:11px; font-weight:600;"><i class="fas fa-check-circle"></i> Ok</span>
                                        </template>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Column 2: Approve Materi Ajar -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-check-double" style="color:var(--blue)"></i> Approve Materi Ajar Guru</h3>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Materi / Modul</th>
                                <th>Guru</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(mat, index) in materiAjar" :key="index">
                                <tr>
                                    <td>
                                        <div style="font-weight: 600;" x-text="mat.judul"></div>
                                        <small style="color: var(--blue);" x-text="mat.mapel"></small>
                                    </td>
                                    <td style="font-weight:500;" x-text="mat.guru"></td>
                                    <td>
                                        <span class="badge" :class="{'green': mat.status==='Approved', 'red': mat.status==='Rejected', 'orange': mat.status==='Pending'}" x-text="mat.status"></span>
                                    </td>
                                    <td>
                                        <template x-if="mat.status === 'Pending'">
                                            <div style="display:flex; gap:4px;">
                                                <button @click="approveMateri(mat.id)" class="btn-small teal" style="padding: 2px 6px; font-size:11px;"><i class="fas fa-check"></i></button>
                                                <button @click="rejectMateri(mat.id)" class="btn-small outline" style="border-color: var(--red); color: var(--red); padding: 2px 6px; font-size:11px;"><i class="fas fa-times"></i></button>
                                            </div>
                                        </template>
                                        <template x-if="mat.status !== 'Pending'">
                                            <span style="font-size: 11px; color: var(--gray-400); font-weight: 500;">Selesai di-review</span>
                                        </template>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Full width Rapor Kinerja Guru -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-trophy" style="color:var(--orange)"></i> Rapor Skor Kinerja Guru</h3>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Guru</th>
                            <th>Mata Pelajaran</th>
                            <th style="width: 50%;">Skor Indeks Kinerja</th>
                            <th>Nilai</th>
                            <th>Predikat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(rep, index) in guruReports" :key="index">
                            <tr>
                                <td style="font-weight:700;" x-text="rep.nama"></td>
                                <td style="color:var(--gray-500);" x-text="rep.mapel"></td>
                                <td>
                                    <div class="progress-wrap" style="margin:0;">
                                        <div class="progress-bar" style="height:10px;">
                                            <div class="fill" :style="'width: ' + calculatePerformance(rep.nama) + '%;'"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong style="color:var(--teal); font-size:15px;" x-text="calculatePerformance(rep.nama)"></strong>
                                </td>
                                <td>
                                    <span class="badge" :class="{'green': calculatePerformance(rep.nama) >= 90, 'blue': calculatePerformance(rep.nama) >= 80 && calculatePerformance(rep.nama) < 90, 'orange': calculatePerformance(rep.nama) < 80}" style="font-size: 10px;" x-text="calculatePerformance(rep.nama) >= 90 ? 'Sangat Baik' : (calculatePerformance(rep.nama) >= 80 ? 'Baik' : 'Cukup')"></span>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Toast Alert -->
        <div x-show="showToast" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-2"
             style="position: fixed; bottom: 24px; right: 24px; background: var(--teal); color: white; padding: 12px 24px; border-radius: var(--radius-sm); box-shadow: var(--shadow-lg); z-index: 9999; display: flex; align-items: center; gap: 8px;">
             <i class="fas fa-check-circle"></i> <span x-text="toastMsg"></span>
        </div>
    </div>

    <!-- KARYA TULIS & TAHFIDZ TAB -->
    <div x-show="tab === 'karya_tahfidz'" x-data="{
        showToast: false,
        toastMsg: '',
        searchSiswa: '',
        sidangList: [
            { siswa: 'Ahmad Rizky', kelas: '9A', judul: 'Rancang Bangun Mini Green House Otomatis', tanggal: '2026-07-15', waktu: '09:00', penguji: 'Pak Budi Santoso', status: 'Terjadwal' },
            { siswa: 'Budi Santoso', kelas: '9A', judul: 'Pengaruh Sholat Dhuha Terhadap Ketenangan Jiwa', tanggal: '2026-07-16', waktu: '10:30', penguji: 'Ustadz Ahmad Fauzi', status: 'Terjadwal' },
            { siswa: 'Siti Aisyah', kelas: '9B', judul: 'Analisis Kadar Vitamin C pada Buah Lokal', tanggal: '2026-07-17', waktu: '13:00', penguji: 'Ibu Siti Rahmawati', status: 'Draft' }
        ],
        tahfidzList: [
            { nama: 'Ahmad Rizky', kelas: '7A', surah: 'An-Naba', ayat: '1-40', target: 'Juz 30', progress: 95 },
            { nama: 'Siti Aisyah', kelas: '7A', surah: 'Al-Mulk', ayat: '1-30', target: 'Juz 29', progress: 75 },
            { nama: 'Budi Santoso', kelas: '7A', surah: 'Al-Waqiah', ayat: '1-96', target: 'Juz 27', progress: 40 },
            { nama: 'Citra Dewi', kelas: '7A', surah: 'Yasin', ayat: '1-83', target: 'Juz 28', progress: 85 },
            { nama: 'Doni Prasetyo', kelas: '8B', surah: 'Al-Kahfi', ayat: '1-110', target: 'Juz 15', progress: 60 }
        ],
        newSiswa: '',
        newKelas: '9A',
        newJudul: '',
        newTanggal: '',
        newWaktu: '',
        newPenguji: 'Pak Budi Santoso',
        showForm: false,
        addSidang() {
            if (!this.newSiswa || !this.newJudul || !this.newTanggal || !this.newWaktu) return;
            this.sidangList.push({
                siswa: this.newSiswa,
                kelas: this.newKelas,
                judul: this.newJudul,
                tanggal: this.newTanggal,
                waktu: this.newWaktu,
                penguji: this.newPenguji,
                status: 'Terjadwal'
            });
            this.newSiswa = '';
            this.newJudul = '';
            this.newTanggal = '';
            this.newWaktu = '';
            this.showForm = false;
            this.toastMsg = 'Jadwal sidang berhasil ditambahkan!';
            this.showToast = true;
            setTimeout(() => this.showToast = false, 3000);
        }
    }">
        <div class="content-header">
            <div>
                <h1>Karya Tulis &amp; Tahfidz</h1>
                <p style="font-size:14px;color:var(--gray-400);margin-top:2px">Jadwalkan Sidang Karya Tulis Ilmiah Kelas 9 &amp; Rekap Hafalan Quran Siswa</p>
            </div>
            <div class="header-right">
                <div class="avatar teal">AD</div>
            </div>
        </div>

        <div class="grid-2">
            <!-- Column 1: Sidang Karya Tulis -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-file-signature" style="color:var(--teal)"></i> Jadwal Sidang Karya Tulis (Kelas 9)</h3>
                    <button @click="showForm = !showForm" class="btn-small teal" style="padding:4px 8px; font-size:11px;">
                        <i class="fas" :class="showForm ? 'fa-times' : 'fa-plus'"></i> <span x-text="showForm ? 'Batal' : 'Tambah'"></span>
                    </button>
                </div>

                <!-- Form Tambah Jadwal -->
                <div x-show="showForm" style="background:var(--gray-50); border: 1px solid var(--border-light); border-radius: var(--radius-sm); padding:16px; margin-bottom: 16px;" x-transition>
                    <div style="display:flex; flex-direction:column; gap:10px;">
                        <div class="grid-2">
                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:11px; font-weight:700;">Nama Siswa</label>
                                <div class="input-wrap" style="border: 1px solid var(--border-light); border-radius: 4px; padding: 4px 8px;">
                                    <input type="text" x-model="newSiswa" placeholder="Ahmad Rizky" style="border:none; outline:none; width:100%; font-size:12px; font-family:var(--font);">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:11px; font-weight:700;">Kelas</label>
                                <select x-model="newKelas" class="form-select" style="width:100%; border:1px solid var(--border-light); border-radius:4px; padding:4px; font-family:var(--font); outline:none;">
                                    <option>9A</option>
                                    <option>9B</option>
                                    <option>9C</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label style="font-size:11px; font-weight:700;">Judul Karya Tulis</label>
                            <div class="input-wrap" style="border: 1px solid var(--border-light); border-radius: 4px; padding: 4px 8px;">
                                <input type="text" x-model="newJudul" placeholder="Analisis..." style="border:none; outline:none; width:100%; font-size:12px; font-family:var(--font);">
                            </div>
                        </div>
                        <div class="grid-2">
                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:11px; font-weight:700;">Tanggal</label>
                                <div class="input-wrap" style="border: 1px solid var(--border-light); border-radius: 4px; padding: 4px 8px;">
                                    <input type="date" x-model="newTanggal" style="border:none; outline:none; width:100%; font-size:12px; font-family:var(--font);">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label style="font-size:11px; font-weight:700;">Waktu</label>
                                <div class="input-wrap" style="border: 1px solid var(--border-light); border-radius: 4px; padding: 4px 8px;">
                                    <input type="time" x-model="newWaktu" style="border:none; outline:none; width:100%; font-size:12px; font-family:var(--font);">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label style="font-size:11px; font-weight:700;">Dosen Penguji / Guru</label>
                            <select x-model="newPenguji" class="form-select" style="width:100%; border:1px solid var(--border-light); border-radius:4px; padding:4px; font-family:var(--font); outline:none;">
                                <option>Pak Budi Santoso</option>
                                <option>Ustadz Ahmad Fauzi</option>
                                <option>Bu Dewi Sartika</option>
                                <option>Ibu Siti Rahmawati</option>
                            </select>
                        </div>
                        <button @click="addSidang()" class="btn-primary btn-small" style="align-self: flex-start; padding: 8px 16px; border-radius:6px;">
                            <i class="fas fa-save"></i> Jadwalkan
                        </button>
                    </div>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Siswa</th>
                                <th>Judul Karya Tulis</th>
                                <th>Tanggal &amp; Jam</th>
                                <th>Penguji</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(sidang, index) in sidangList" :key="index">
                                <tr>
                                    <td>
                                        <div style="font-weight:600;" x-text="sidang.siswa"></div>
                                        <small style="color:var(--gray-400);" x-text="'Kelas: ' + sidang.kelas"></small>
                                    </td>
                                    <td>
                                        <div style="font-size:12px; font-weight:500; line-height:1.3;" x-text="sidang.judul"></div>
                                    </td>
                                    <td>
                                        <div style="font-weight:600;" x-text="sidang.tanggal"></div>
                                        <small style="color:var(--teal);" x-text="sidang.waktu + ' WIB'"></small>
                                    </td>
                                    <td style="font-weight:500; font-size:12px;" x-text="sidang.penguji"></td>
                                    <td>
                                        <span class="badge" :class="{'green': sidang.status==='Terjadwal', 'orange': sidang.status==='Draft'}" x-text="sidang.status"></span>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Column 2: Rekap Hafalan Quran -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-quran" style="color:var(--blue)"></i> Rekap Hafalan Quran Siswa</h3>
                    <div class="input-wrap" style="border: 1px solid var(--border-light); border-radius: 20px; padding: 2px 10px; width: 140px; display: flex; align-items: center;">
                        <input type="text" placeholder="Cari Siswa..." x-model="searchSiswa" style="border:none; outline:none; width: 100%; font-size: 11px; font-family:var(--font);">
                    </div>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Siswa</th>
                                <th>Hafalan Terakhir</th>
                                <th>Target</th>
                                <th>Progress Juz</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(tahfidz, index) in tahfidzList" :key="index">
                                <tr x-show="searchSiswa === '' || tahfidz.nama.toLowerCase().includes(searchSiswa.toLowerCase())">
                                    <td>
                                        <div style="font-weight: 600;" x-text="tahfidz.nama"></div>
                                        <small style="color:var(--gray-400);" x-text="'Kelas: ' + tahfidz.kelas"></small>
                                    </td>
                                    <td>
                                        <div style="font-weight:600; color:var(--teal);" x-text="'Q.S. ' + tahfidz.surah"></div>
                                        <small style="color:var(--gray-500);" x-text="'Ayat: ' + tahfidz.ayat"></small>
                                    </td>
                                    <td>
                                        <span class="badge light blue" x-text="tahfidz.target"></span>
                                    </td>
                                    <td>
                                        <div class="progress-wrap" style="margin:0;">
                                            <div class="progress-label" style="font-size:10px; margin-bottom:2px;">
                                                <span class="percentage" x-text="tahfidz.progress + '%'"></span>
                                            </div>
                                            <div class="progress-bar" style="height:6px; width:100px;">
                                                <div class="fill" :style="'width: ' + tahfidz.progress + '%;'"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Toast Alert -->
        <div x-show="showToast" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-2"
             style="position: fixed; bottom: 24px; right: 24px; background: var(--teal); color: white; padding: 12px 24px; border-radius: var(--radius-sm); box-shadow: var(--shadow-lg); z-index: 9999; display: flex; align-items: center; gap: 8px;">
             <i class="fas fa-check-circle"></i> <span x-text="toastMsg"></span>
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
