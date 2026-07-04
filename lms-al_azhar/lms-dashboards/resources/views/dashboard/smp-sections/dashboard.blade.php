@php
    $inits = strtoupper(substr($siswa->nama, 0, 1) . (str_contains($siswa->nama, ' ') ? substr(explode(' ', $siswa->nama)[1], 0, 1) : ''));
    $rataNilai = round($nilai->avg('nilai'), 1);
    $totalTugas = $tugas->count();
    $tugasSelesai = $tugas->filter(fn($t) => \Carbon\Carbon::parse($t->tanggal_deadline)->isPast())->count();
    $totalHadir = $kehadiran->where('status', 'hadir')->count();
    $totalKehadiran = $kehadiran->count();
    $persenHadir = $totalKehadiran > 0 ? round(($totalHadir / $totalKehadiran) * 100) : 0;
    $badgeColors = ['green light', 'teal', 'blue', 'orange light', 'purple light', 'cyan light', 'pink light'];
    $statusClass = function($deadline) {
        $d = \Carbon\Carbon::parse($deadline);
        if ($d->isPast()) return 'status-terlambat';
        if ($d->diffInDays(now()) <= 3) return 'status-mendekati';
        return 'teal';
    };
    $statusLabel = function($deadline) {
        $d = \Carbon\Carbon::parse($deadline);
        if ($d->isPast()) return 'Terlambat';
        if ($d->diffInDays(now()) <= 3) return 'Mendekati';
        return 'Akan Datang';
    };
    $tugasDeadlineCount = $tugas->filter(fn($t) => !\Carbon\Carbon::parse($t->tanggal_deadline)->isPast() && \Carbon\Carbon::parse($t->tanggal_deadline)->diffInDays(now()) <= 7)->count();
    $leaderboard = \App\Models\Nilai::selectRaw('siswa_id, avg(nilai) as rata')
        ->whereIn('siswa_id', \App\Models\Siswa::where('kelas_id', $kelas->id)->pluck('id'))
        ->groupBy('siswa_id')
        ->orderBy('rata', 'desc')
        ->with('siswa')
        ->get();
@endphp
<div class="header-blue">
    <div class="content-header">
        <div class="greeting">Halo, <strong>{{ $siswa->nama }}</strong> 👋</div>
        <div class="header-right">
            <div class="notif-badge"><i class="fas fa-bell"></i></div>
            <div class="avatar blue">{{ $inits }}</div>
            <span style="font-weight:600;font-size:14px;color:#fff">{{ explode(' ', $siswa->nama)[0] }}</span>
        </div>
    </div>
</div>

@if(isset($remedialActive) && $remedialActive->count() > 0)
    @foreach($remedialActive as $rem)
        @php
            $kkmVal = str_contains($siswa->kelas->nama_kelas ?? '', 'SD') ? setting('kkm_sd', 70) : setting('kkm_smp', 75);
            $diffDays = \Carbon\Carbon::parse($rem->deadline)->diffInDays(now()->startOfDay(), false);
            $absDiff = abs($diffDays);
            $badgeText = $diffDays < 0 ? "Lewat $absDiff Hari" : ($diffDays == 0 ? "Hari Ini" : "Sisa $absDiff Hari");
        @endphp
        <div class="card" style="background: var(--red-bg); border-left: 5px solid var(--red); padding: 14px 20px; margin-bottom: 16px; margin-top: 16px; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: space-between; gap: 12px; box-shadow: var(--shadow)">
            <div style="display: flex; align-items: center; gap: 12px">
                <div style="font-size: 20px; color: var(--red)"><i class="fas fa-exclamation-triangle"></i></div>
                <div>
                    <h4 style="font-size: 14px; font-weight: 700; color: var(--red); margin-bottom: 2px">Wajib Remedial Mapel {{ $rem->mapel->nama_mapel }}</h4>
                    <p style="font-size: 12px; color: var(--gray-600); line-height: 1.4">
                        Nilai Anda **{{ number_format($rem->nilai_asal, 1) }}** belum mencapai KKM (**{{ $kkmVal }}**). Segera hubungi guru dan lakukan perbaikan sebelum **{{ \Carbon\Carbon::parse($rem->deadline)->format('d M Y') }}**.
                    </p>
                </div>
            </div>
            <span class="badge red light" style="font-size: 11px; padding: 4px 10px; font-weight: 700" x-text="'{{ $badgeText }}'"></span>
        </div>
    @endforeach
@endif

<div class="welcome-mini">
    <p><strong>Halo, {{ explode(' ', $siswa->nama)[0] }}!</strong> Kamu punya <strong>{{ $tugasDeadlineCount }} tugas</strong> mendekati deadline minggu ini. Ayo segera kerjakan!</p>
</div>

@if(!$sudahIsiKondisi)
<div class="card" style="background: var(--white); border-radius: var(--radius); padding: 20px; box-shadow: var(--shadow); margin-bottom: 20px; border-left: 5px solid var(--blue)">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px">
        <h3 style="font-size:16px; font-weight:700; color:var(--blue); margin:0">
            <i class="fas fa-heartbeat" style="color:var(--red); margin-right:6px"></i> Survei Kondisi Kelas Hari Ini
        </h3>
        <span class="badge blue light" style="font-size:11px">15 Detik</span>
    </div>
    <p style="font-size:13px; color:var(--gray-500); margin-bottom:18px; line-height:1.5">
        Halo! Yuk bantu Bapak/Ibu Guru mengetahui suasana kelasmu hari ini agar kegiatan belajar mengajar kita jadi lebih menyenangkan dan nyaman. Jawabanmu bersifat rahasia dan aman.
    </p>
    <form method="POST" action="{{ route('siswa.kondisi-kelas.store') }}" x-data="{
        hubungan: 3,
        nyaman: 3,
        bantuan: 3,
        get hubunganDesc() {
            const list = {
                1: 'Kaku / Takut (Komunikasi satu arah & tegang)',
                2: 'Biasa Saja (Jarang berinteraksi dengan guru)',
                3: 'Cukup Dekat (Bisa mengobrol santai saat pelajaran)',
                4: 'Akrab (Sering bercanda & komunikatif)',
                5: 'Sangat Akrab & Hangat (Guru sangat peduli & mendengarkan siswa)'
            };
            return list[this.hubungan];
        },
        get nyamanDesc() {
            const list = {
                1: 'Sangat Tidak Nyaman (Ada suasana tegang / ada yang mengganggu)',
                2: 'Kurang Nyaman (Ada beberapa hal yang mengganggu konsentrasi)',
                3: 'Biasa Saja (Nyaman seperti biasa)',
                4: 'Nyaman (Bisa belajar dengan tenang & asyik)',
                5: 'Sangat Nyaman & Seru (Semua teman ceria, seru, & saling mendukung)'
            };
            return list[this.nyaman];
        },
        get bantuanDesc() {
            const list = {
                1: 'Sangat Takut (Takut dimarahi / ditertawakan teman)',
                2: 'Malu / Ragu (Sungkan bertanya jika belum paham)',
                3: 'Cukup Berani (Mau bertanya jika didorong oleh guru)',
                4: 'Mudah (Bebas bertanya kapan saja saat kesulitan)',
                5: 'Sangat Terbuka (Guru sangat ramah & senang membantu kapan saja)'
            };
            return list[this.bantuan];
        }
    }">
        @csrf
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap:20px; margin-bottom:20px">
            <!-- Hubungan Guru-Siswa -->
            <div style="background:var(--gray-50); border:1px solid var(--border-light); padding:14px; border-radius:var(--radius-sm)">
                <div style="display:flex; justify-content:space-between; font-weight:700; font-size:13px; color:var(--gray-700); margin-bottom:8px">
                    <span>Hubungan dengan Guru</span>
                    <span style="background:var(--blue); color:white; padding:1px 6px; border-radius:4px" x-text="hubungan"></span>
                </div>
                <input type="range" name="hubungan_guru_siswa" min="1" max="5" step="1" x-model.number="hubungan" style="width:100%; accent-color:var(--blue); cursor:pointer">
                <div style="font-size:11px; font-weight:600; margin-top:8px" :style="'color: ' + (hubungan <= 2 ? 'var(--red)' : (hubungan == 3 ? 'var(--orange)' : 'var(--green)'))" x-text="hubunganDesc"></div>
            </div>

            <!-- Kenyamanan -->
            <div style="background:var(--gray-50); border:1px solid var(--border-light); padding:14px; border-radius:var(--radius-sm)">
                <div style="display:flex; justify-content:space-between; font-weight:700; font-size:13px; color:var(--gray-700); margin-bottom:8px">
                    <span>Kenyamanan di Kelas</span>
                    <span style="background:var(--purple); color:white; padding:1px 6px; border-radius:4px" x-text="nyaman"></span>
                </div>
                <input type="range" name="siswa_nyaman" min="1" max="5" step="1" x-model.number="nyaman" style="width:100%; accent-color:var(--purple); cursor:pointer">
                <div style="font-size:11px; font-weight:600; margin-top:8px" :style="'color: ' + (nyaman <= 2 ? 'var(--red)' : (nyaman == 3 ? 'var(--orange)' : 'var(--green)'))" x-text="nyamanDesc"></div>
            </div>

            <!-- Bantuan -->
            <div style="background:var(--gray-50); border:1px solid var(--border-light); padding:14px; border-radius:var(--radius-sm)">
                <div style="display:flex; justify-content:space-between; font-weight:700; font-size:13px; color:var(--gray-700); margin-bottom:8px">
                    <span>Kemudahan Bertanya & Bantuan</span>
                    <span style="background:var(--orange); color:white; padding:1px 6px; border-radius:4px" x-text="bantuan"></span>
                </div>
                <input type="range" name="siswa_minta_bantuan" min="1" max="5" step="1" x-model.number="bantuan" style="width:100%; accent-color:var(--orange); cursor:pointer">
                <div style="font-size:11px; font-weight:600; margin-top:8px" :style="'color: ' + (bantuan <= 2 ? 'var(--red)' : (bantuan == 3 ? 'var(--orange)' : 'var(--green)'))" x-text="bantuanDesc"></div>
            </div>
        </div>
        <div style="display:flex; justify-content:flex-end">
            <button type="submit" class="btn-login" style="border:none; background:var(--blue); color:#fff; cursor:pointer; padding:8px 24px; font-size:13px; font-weight:700; border-radius:var(--radius-sm)"><i class="fas fa-paper-plane"></i> Kirim Penilaian</button>
        </div>
    </form>
</div>
@endif

<div class="performa-grid" style="margin-bottom:20px">
    <div class="performa-card">
        <div class="performa-icon teal"><i class="fas fa-calculator"></i></div>
        <div class="performa-value">{{ $rataNilai }}</div>
        <div class="performa-label">Rata-rata Nilai</div>
    </div>
    <div class="performa-card">
        <div class="performa-icon blue"><i class="fas fa-check-circle"></i></div>
        <div class="performa-value">{{ $tugasSelesai }}/{{ $totalTugas }}</div>
        <div class="performa-label">Tugas Selesai</div>
    </div>
    <div class="performa-card">
        <div class="performa-icon orange"><i class="fas fa-user-check"></i></div>
        <div class="performa-value">{{ $persenHadir }}%</div>
        <div class="performa-label">Kehadiran</div>
    </div>
</div>

<div class="card" style="margin-bottom:20px">
    <div class="card-header">
        <h3><i class="fas fa-chart-bar" style="color:var(--teal)"></i> Grafik Nilai per Mapel</h3>
    </div>
    <canvas id="nilaiChart" width="400" height="160" style="max-height:160px;width:100%"></canvas>
</div>

<div class="grid-2" style="margin-bottom:20px">
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-calendar-day" style="color:var(--teal)"></i> Jadwal Hari Ini</h3>
            <label @click="tab='jadwal'" style="cursor:pointer;font-size:12px;color:var(--blue);font-weight:600;text-decoration:none">Lihat Semua</label>
        </div>
        @forelse($jadwalHariIni as $j)
            <div class="schedule-item">
                <div class="schedule-time">{{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }}</div>
                <div class="schedule-info">
                    <div class="mapel">{{ $j->mapel->nama_mapel }}</div>
                    <div class="guru">{{ $j->guru->nama }}</div>
                </div>
                <span class="badge {{ $badgeColors[$loop->index % count($badgeColors)] }}">{{ $j->mapel->kode }}</span>
            </div>
        @empty
            <div style="padding:20px;text-align:center;color:var(--gray-400)">Tidak ada jadwal hari ini</div>
        @endforelse
    </div>
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-exclamation-triangle" style="color:var(--orange)"></i> Tugas &amp; Ulangan</h3>
            <label @click="tab='tugas'">Lihat Semua</label>
        </div>
        @php $semuaTugas = $tugas->merge($ulangan)->sortBy('tanggal_deadline')->take(5); @endphp
        @forelse($semuaTugas as $t)
            @php $icon = $t->tipe === 'tugas' ? 'fa-file-alt' : 'fa-pencil-alt'; $color = ['var(--teal)','var(--blue)','var(--purple)','var(--orange)','var(--cyan)'][$loop->index % 5]; @endphp
            <div class="task-item">
                <i class="fas {{ $icon }}" style="color:{{ $color }};font-size:18px"></i>
                <div class="task-info">
                    <div class="task-title">{{ $t->judul }}</div>
                    <div class="task-meta">{{ $t->mapel->nama_mapel }} &ndash; Deadline: {{ \Carbon\Carbon::parse($t->tanggal_deadline)->format('d M Y') }}</div>
                </div>
                <span class="badge {{ $statusClass($t->tanggal_deadline) }}">{{ $statusLabel($t->tanggal_deadline) }}</span>
            </div>
        @empty
            <div style="padding:20px;text-align:center;color:var(--gray-400)">Tidak ada tugas</div>
        @endforelse
    </div>
</div>

<div class="grid-2" style="margin-bottom:20px">
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-chart-line" style="color:var(--blue)"></i> Perkembangan Nilai 6 Bulan</h3>
            <label @click="tab='nilai'">Detail</label>
        </div>
        <div class="mini-chart">
            @php
                $months = [];
                for ($i = 5; $i >= 0; $i--) {
                    $m = now()->subMonths($i);
                    $months[$m->format('Y-m')] = $m->format('M');
                }
                $chartMax = 1;
                $chartData = [];
                foreach ($months as $ym => $label) {
                    $avg = round(\App\Models\Nilai::where('siswa_id', $siswa->id)->whereMonth('created_at', substr($ym, 5))->whereYear('created_at', substr($ym, 0, 4))->avg('nilai') ?? 0, 1);
                    $chartData[$label] = $avg;
                    if ($avg > $chartMax) $chartMax = $avg;
                }
            @endphp
            @foreach($chartData as $label => $val)
                @php $pct = $chartMax > 0 ? max(round(($val / $chartMax) * 95), 5) : 0; @endphp
                <div class="chart-row"><span class="month-label">{{ $label }}</span><div class="bar-track"><div class="bar-fill" style="width:{{ $pct }}%"></div></div></div>
            @endforeach
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-trophy" style="color:var(--orange)"></i> Leaderboard {{ $kelas->nama_kelas }}</h3>
            <a href="javascript:void(0)" onclick="return false">Semua</a>
        </div>
        <ul class="leaderboard">
            @forelse($leaderboard as $i => $lb)
                <li @if($loop->first) class="rank-1" @endif>
                    <span class="rank-num">{{ $i + 1 }}</span>
                    <span class="rank-name">{{ $lb->siswa->nama }}</span>
                    <span class="rank-poin">{{ number_format($lb->rata, 0) }}</span>
                </li>
            @empty
                <li style="padding:10px;text-align:center;color:var(--gray-400)">Belum ada data</li>
            @endforelse
        </ul>
    </div>
</div>

<div class="grid-2">
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-bullhorn" style="color:var(--orange)"></i> Pengumuman Sekolah</h3>
            <label @click="tab='pengumuman'">Semua</label>
        </div>
        @forelse($pengumuman as $p)
            <div class="ann-item"><div class="ann-date">{{ \Carbon\Carbon::parse($p->created_at)->format('d F Y') }}</div><div class="ann-title">{{ $p->judul }}</div><div class="ann-desc">{{ Str::limit($p->konten, 80) }}</div></div>
        @empty
            <div style="padding:20px;text-align:center;color:var(--gray-400)">Tidak ada pengumuman</div>
        @endforelse
    </div>
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-envelope" style="color:var(--blue)"></i> Pesan dari Guru</h3>
            <label @click="tab='pesan'" style="cursor:pointer;font-size:12px;color:var(--blue);font-weight:600;text-decoration:none">Semua Pesan</label>
        </div>
        @forelse($pesan as $m)
            <div class="msg-item"><div class="msg-sender"><i class="fas fa-user-circle" style="color:var(--teal);margin-right:6px"></i> {{ $m->pengirim->name }}</div><div class="msg-preview">{{ Str::limit($m->isi, 70) }}</div></div>
        @empty
            <div style="padding:20px;text-align:center;color:var(--gray-400)">Tidak ada pesan</div>
        @endforelse
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('nilaiChart');
    if (canvas && typeof Chart !== 'undefined') {
        new Chart(canvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($nilaiChart->pluck('nama_mapel')) !!},
                datasets: [{
                    label: 'Nilai',
                    data: {!! json_encode($nilaiChart->pluck('nilai')) !!},
                    backgroundColor: '#1CA094',
                    borderColor: '#1CA094',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, max: 100 } }
            }
        });
    }
});
</script>
