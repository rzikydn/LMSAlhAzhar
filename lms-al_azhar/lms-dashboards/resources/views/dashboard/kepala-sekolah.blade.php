@extends('layouts.app')

@section('title', 'Dashboard Kepala Sekolah - LMS Al Azhar Jaya Indonesia')

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
            <!-- Custom CSS for interactive elements -->
            <style>
                .score-row-card:hover {
                    transform: translateY(-2px);
                    background-color: var(--gray-50) !important;
                }
                .pulse-dot {
                    position: relative;
                    padding-right: 20px !important;
                }
                .pulse-dot::after {
                    content: '';
                    position: absolute;
                    width: 8px;
                    height: 8px;
                    background: #ef4444;
                    border-radius: 50%;
                    top: 50%;
                    right: 8px;
                    transform: translateY(-50%);
                    animation: pulse-glow 1.5s infinite;
                }
                @keyframes pulse-glow {
                    0% {
                        box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
                    }
                    70% {
                        box-shadow: 0 0 0 6px rgba(239, 68, 68, 0);
                    }
                    100% {
                        box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
                    }
                }
            </style>

            <div class="content-header">
                <div>
                    <h1>Dashboard Kepala Sekolah</h1>
                    <p style="font-size:14px;color:var(--gray-400);margin-top:2px">Selamat datang, Kepala Sekolah</p>
                </div>
                <div class="header-right">
                    <span class="badge teal" style="font-size:12px;padding:6px 16px"><i class="fas fa-school"></i> SDIT &amp; SMPIT</span>
                    <div class="avatar teal">KS</div>
                </div>
            </div>
            
            <div class="grid-4" style="margin-bottom:20px">
                <div class="admin-stat-card"><div class="asc-icon grad-teal"><i class="fas fa-user-graduate"></i></div><div class="asc-body"><div class="asc-number">520</div><div class="asc-label">Total Siswa</div><div class="asc-compare up">&#x2191; 12 siswa baru bulan ini</div></div></div>
                <div class="admin-stat-card"><div class="asc-icon grad-blue"><i class="fas fa-chalkboard-teacher"></i></div><div class="asc-body"><div class="asc-number">42</div><div class="asc-label">Total Guru</div><div class="asc-compare up">&#x2191; 3 guru baru tahun ini</div></div></div>
                <div class="admin-stat-card"><div class="asc-icon grad-orange"><i class="fas fa-users"></i></div><div class="asc-body"><div class="asc-number">380</div><div class="asc-label">Total Orang Tua</div><div class="asc-compare up">&#x2191; 8 akun baru bulan ini</div></div></div>
                <div class="admin-stat-card"><div class="asc-icon grad-purple"><i class="fas fa-school"></i></div><div class="asc-body"><div class="asc-number">18</div><div class="asc-label">Kelas Aktif</div><div class="asc-compare down">&#x2193; 2 kelas dari bulan lalu</div></div></div>
            </div>

            <!-- GRID: Nilai Besar Sekolah & Peringatan Kelas Gak Sehat -->
            <div class="grid-2" style="margin-bottom:20px">
                <!-- 1. Ringkasan 3 Nilai Besar Sekolah -->
                <div class="card" x-data="{
                    scores: [
                        { label: 'Akademik Nasional', val: 84.2, target: 80, trend: '+1.5%', type: 'up', status: 'Sangat Baik', color: 'var(--teal)', desc: 'Hasil UTS Matematika dan IPA Bilingual menunjukan tren positif berkat modul ajar kolaboratif.' },
                        { label: 'Bahasa Inggris / Internasional', val: 72.8, target: 75, trend: '-0.8%', type: 'down', status: 'Perlu Peningkatan', color: 'var(--orange)', desc: 'Aspek speaking dan writing siswa kelas 8 berada di bawah target KKM Bilingual. Diperlukan forum ekstrakurikuler English Club.' },
                        { label: 'Hafalan Quran / Tahfidz', val: 88.5, target: 85, trend: '+2.1%', type: 'up', status: 'Sangat Baik', color: 'var(--purple)', desc: 'Pencapaian setoran juz 30 dan juz 29 kelas 7-9 melampaui target indikator pencapaian bulanan.' }
                    ],
                    selectedScore: null
                }">
                    <div class="card-header">
                        <h3><i class="fas fa-chart-line" style="color:var(--teal)"></i> Ringkasan 3 Nilai Besar Sekolah</h3>
                        <span class="badge light green" style="font-size:11px">Semester Genap</span>
                    </div>
                    <p style="font-size:12px;color:var(--gray-400);margin-bottom:12px">Pilih nilai untuk melihat analisis dan rekomendasi peningkatan.</p>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <template x-for="(sc, i) in scores" :key="i">
                            <div @click="selectedScore = (selectedScore === i ? null : i)" class="score-row-card" style="border: 1px solid var(--border-light); border-radius: var(--radius-sm); padding: 10px 14px; cursor: pointer; transition: all 0.2s; background: var(--white);" :style="selectedScore === i ? 'border-color: ' + sc.color + '; box-shadow: var(--shadow-sm);' : ''">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                    <div>
                                        <strong style="font-size: 13.5px; color: var(--text);" x-text="sc.label"></strong>
                                        <span class="badge light" :class="sc.type === 'up' ? 'green' : 'orange'" style="font-size: 9.5px; margin-left: 6px; padding: 2px 6px;">
                                            <i class="fas" :class="sc.type === 'up' ? 'fa-arrow-up' : 'fa-arrow-down'"></i> <span x-text="sc.trend"></span>
                                        </span>
                                    </div>
                                    <div style="text-align: right;">
                                        <span style="font-size: 18px; font-weight: 700;" :style="'color: ' + sc.color + ';'" x-text="sc.val"></span>
                                        <span style="font-size: 11px; color: var(--gray-400);">/100</span>
                                    </div>
                                </div>
                                
                                <div class="progress-wrap" style="margin: 0 0 4px 0; background: var(--gray-100); height: 6px; border-radius: 3px; overflow: hidden;">
                                    <div class="fill" :style="'width: ' + sc.val + '%; background: ' + sc.color + '; height: 100%; border-radius: 3px; transition: width 0.5s;'"></div>
                                </div>
                                
                                <div style="display: flex; justify-content: space-between; font-size: 11px; color: var(--gray-400);">
                                    <span>Target Kelulusan: <span x-text="sc.target"></span></span>
                                    <span style="font-weight: 600;" :style="'color: ' + sc.color" x-text="sc.status"></span>
                                </div>

                                <div x-show="selectedScore === i" x-transition style="margin-top: 10px; padding-top: 10px; border-top: 1px dashed var(--border); font-size: 12px; color: var(--gray-600); line-height: 1.5;">
                                    <i class="fas fa-info-circle" :style="'color: ' + sc.color"></i> <span x-text="sc.desc"></span>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- 2. Peringatan Kelas "Gak Sehat" -->
                <div class="card" x-data="{
                    alerts: [
                        { kelas: '8B', wali: 'Bu Dewi Sartika', status: 'Kritis', stressLevel: 'Tinggi (28% Stress)', detail: 'Beban tugas menumpuk (3 PR & 1 Proyek dikumpulkan bersamaan). Tingkat kecemasan siswa terdeteksi tinggi.', mood: '2.3 / 5.0', bg: '#fef2f2', border: '#fca5a5', color: '#ef4444' },
                        { kelas: '9A', wali: 'Pak Dwi Hartono', status: 'Waspada', stressLevel: 'Sedang (15% Jenuh)', detail: 'Persiapan Karya Tulis Ilmiah (KTI) & try out CBT berturut-turut membuat tingkat kejenuhan siswa meningkat.', mood: '3.1 / 5.0', bg: '#fffbeb', border: '#fcd34d', color: '#f59e0b' }
                    ],
                    showToast: false,
                    toastMsg: '',
                    sendAlert(kelas, wali) {
                        this.toastMsg = 'Rekomendasi penyesuaian jadwal tugas terkirim ke Wali Kelas ' + kelas + ' (' + wali + ')!';
                        this.showToast = true;
                        setTimeout(() => this.showToast = false, 4000);
                    }
                }">
                    <div class="card-header">
                        <h3><i class="fas fa-heart-pulse" style="color:var(--red)"></i> Peringatan Kelas &quot;Gak Sehat&quot;</h3>
                        <span class="badge red pulse-dot" style="font-size: 11px;"><i class="fas fa-exclamation-triangle"></i> 2 Konflik</span>
                    </div>
                    <p style="font-size:12px;color:var(--gray-400);margin-bottom:12px">Mendeteksi potensi stress / ketidaknyamanan siswa berdasarkan input jurnal guru harian.</p>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <template x-for="(al, i) in alerts" :key="i">
                            <div style="border-radius: var(--radius-sm); padding: 12px; display: flex; flex-direction: column; gap: 6px;" :style="'background: ' + al.bg + '; border: 1px solid ' + al.border">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <span class="badge" :style="'background: ' + al.color + '; color: white; font-size: 10px; font-weight: 700;'" x-text="'Kelas ' + al.kelas"></span>
                                        <span style="font-size: 11px; color: var(--gray-500); margin-left: 6px;">Wali: <strong x-text="al.wali"></strong></span>
                                    </div>
                                    <span class="badge light" :class="al.status === 'Kritis' ? 'red' : 'orange'" style="font-size: 10px; font-weight: 600;" x-text="al.stressLevel"></span>
                                </div>
                                <p style="font-size: 12px; color: #475569; line-height: 1.5; margin: 2px 0;" x-text="al.detail"></p>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 4px; padding-top: 6px; border-top: 1px dashed rgba(0,0,0,0.06);">
                                    <span style="font-size: 11.5px; color: var(--gray-500);">
                                        <i class="fas fa-smile" :style="'color: ' + al.color"></i> Rata-rata Mood: <strong x-text="al.mood"></strong>
                                    </span>
                                    <button @click="sendAlert(al.kelas, al.wali)" class="btn-small outline" style="padding: 4px 8px; font-size: 10px; font-weight: 600; background: white; border-radius: 4px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#ef4444';this.style.color='white';this.style.borderColor='#ef4444'" onmouseout="this.style.background='white';this.style.color='var(--text)';this.style.borderColor='var(--border)'">
                                        <i class="fas fa-paper-plane"></i> Hubungi Wali
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Alert Toast -->
                    <div x-show="showToast" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform translate-y-2"
                         style="position: fixed; bottom: 24px; right: 24px; background: #ef4444; color: white; padding: 12px 24px; border-radius: var(--radius-sm); box-shadow: var(--shadow-lg); z-index: 9999; display: flex; align-items: center; gap: 8px;">
                         <i class="fas fa-check-circle"></i> <span x-text="toastMsg"></span>
                    </div>
                </div>
            </div>

            <!-- GRID: Charts (Aktivitas Login & Distribusi Siswa) -->
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

            <!-- 3. Ringkasan Skor Kinerja Guru -->
            <div class="card" style="margin-bottom:20px;" x-data="{
                searchQuery: '',
                filterTab: 'semua',
                showToast: false,
                toastMsg: '',
                guruData: [
                    { nama: 'Bu Dewi Sartika', mapel: 'Matematika', skor: 95, status: 'Sangat Baik', detail: 'Sangat disiplin mengumpulkan jurnal mengajar harian & modul ajar interaktif.', color: 'var(--teal)' },
                    { nama: 'Pak Budi Santoso', mapel: 'IPA', skor: 85, status: 'Baik', detail: 'Disiplin mengajar & pengisian modul lengkap. Evaluasi berkala berjalan baik.', color: 'var(--blue)' },
                    { nama: 'Ustadz Ahmad Fauzi', mapel: 'PAI', skor: 75, status: 'Butuh Bimbingan', detail: 'Kelengkapan administrasi jurnal bulanan belum terisi lengkap (Maret/April).', color: 'var(--orange)' },
                    { nama: 'Ibu Siti Rahmawati', mapel: 'B. Indonesia', skor: 70, status: 'Butuh Bimbingan', detail: 'Ada beberapa keterlambatan pengumpulan administrasi mingguan & bulanan.', color: 'var(--red)' }
                ],
                sendAssistance(nama) {
                    this.toastMsg = 'Undangan program bimbingan guru / coaching terkirim ke ' + nama + '!';
                    this.showToast = true;
                    setTimeout(() => this.showToast = false, 4000);
                },
                filteredGuru() {
                    return this.guruData.filter(g => {
                        const matchesSearch = g.nama.toLowerCase().includes(this.searchQuery.toLowerCase()) || g.mapel.toLowerCase().includes(this.searchQuery.toLowerCase());
                        if (this.filterTab === 'semua') return matchesSearch;
                        return matchesSearch && g.status === 'Butuh Bimbingan';
                    });
                }
            }">
                <div class="card-header" style="flex-wrap: wrap; gap: 12px; align-items: center; justify-content: space-between;">
                    <h3><i class="fas fa-trophy" style="color:var(--orange)"></i> Rapor Indeks Kinerja Guru</h3>
                    
                    <div style="display: flex; gap: 8px; align-items: center;">
                        <div class="input-wrap" style="padding: 6px 12px; display: flex; align-items: center; gap: 6px; width: 220px;">
                            <i class="fas fa-search" style="color: var(--gray-400); font-size: 13px;"></i>
                            <input type="text" x-model="searchQuery" placeholder="Cari guru..." style="border:none; outline:none; font-size:12px; font-family:var(--font); width:100%;">
                        </div>
                        
                        <div style="display: flex; background: var(--gray-100); border-radius: var(--radius-sm); padding: 2px;">
                            <button @click="filterTab = 'semua'" class="filter-btn" :class="filterTab === 'semua' ? 'active' : ''" style="padding: 6px 12px; font-size: 11.5px; border:none; border-radius:4px; cursor:pointer;" :style="filterTab === 'semua' ? 'background:white; font-weight:600; box-shadow:var(--shadow-sm);' : 'background:transparent; color:var(--gray-500);'">Semua</button>
                            <button @click="filterTab = 'bimbingan'" class="filter-btn" :class="filterTab === 'bimbingan' ? 'active' : ''" style="padding: 6px 12px; font-size: 11.5px; border:none; border-radius:4px; cursor:pointer;" :style="filterTab === 'bimbingan' ? 'background:white; font-weight:600; box-shadow:var(--shadow-sm);' : 'background:transparent; color:var(--gray-500);'">Butuh Bimbingan</button>
                        </div>
                    </div>
                </div>
                
                <div class="table-wrap" style="margin-top: 10px;">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Guru</th>
                                <th>Mata Pelajaran</th>
                                <th style="width: 35%;">Skor Indeks Kinerja</th>
                                <th>Skor</th>
                                <th>Rekomendasi Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(g, i) in filteredGuru()" :key="i">
                                <tr style="transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='var(--gray-50)'" onmouseout="this.style.backgroundColor='transparent'">
                                    <td>
                                        <strong style="color:var(--text); font-size:13px;" x-text="g.nama"></strong>
                                        <div style="font-size:11px; color:var(--gray-400); margin-top:2px;" x-text="g.detail"></div>
                                    </td>
                                    <td style="color:var(--gray-500); font-size:12.5px;" x-text="g.mapel"></td>
                                    <td>
                                        <div class="progress-wrap" style="margin: 0; background: var(--gray-100); height: 6px; border-radius: 3px; overflow: hidden;">
                                            <div class="fill" :style="'width: ' + g.skor + '%; background: ' + g.color + '; height: 100%; border-radius: 3px;'"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge light" :class="g.skor >= 90 ? 'green' : (g.skor >= 80 ? 'blue' : 'orange')" style="font-size:10.5px; font-weight:700;" x-text="g.skor + ' (' + g.status + ')'"></span>
                                    </td>
                                    <td>
                                        <button @click="sendAssistance(g.nama)" class="btn-small outline" style="padding: 5px 10px; font-size:11px; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px; cursor: pointer; transition: all 0.2s;" :style="g.status === 'Butuh Bimbingan' ? 'border-color:var(--orange); color:var(--orange);' : 'border-color:var(--border); color:var(--gray-500);'" onmouseover="this.style.background='var(--teal)'; this.style.color='white'; this.style.borderColor='var(--teal)'" onmouseout="this.style.background='transparent'; this.style.color=this.getAttribute('data-color')" :data-color="g.status === 'Butuh Bimbingan' ? 'var(--orange)' : 'var(--gray-500)'">
                                            <i class="fas" :class="g.status === 'Butuh Bimbingan' ? 'fa-handshake' : 'fa-check'"></i>
                                            <span x-text="g.status === 'Butuh Bimbingan' ? 'Bimbing Guru' : 'Beri Selamat'"></span>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                            <tr x-show="filteredGuru().length === 0">
                                <td colspan="5" style="text-align: center; color: var(--gray-400); padding: 24px;">Tidak ada data guru.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Assistance Toast -->
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
                    <div class="avatar teal">KS</div>
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
                    <div class="avatar teal">KS</div>
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
                    <div class="avatar teal">KS</div>
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
                    <div class="avatar teal">KS</div>
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
                    <div class="avatar teal">KS</div>
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
                    <div class="avatar teal">KS</div>
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
                    <div class="avatar teal">KS</div>
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
                    <div class="avatar teal">KS</div>
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
                    <div class="avatar teal">KS</div>
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
                    <div class="avatar teal">KS</div>
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
