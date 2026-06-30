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
<div class="welcome-mini">
    <p><strong>Halo, {{ explode(' ', $siswa->nama)[0] }}!</strong> Kamu punya <strong>{{ $tugasDeadlineCount }} tugas</strong> mendekati deadline minggu ini. Ayo segera kerjakan!</p>
</div>

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
