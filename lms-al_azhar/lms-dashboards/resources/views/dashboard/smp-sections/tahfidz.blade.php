@php
    $totalSetoran = $tahfidzSetoran->count();
    $avgNilai = $tahfidzSetoran->avg('nilai');
    $totalAyat = $tahfidzSetoran->sum('jumlah_ayat');
    $surahTerakhir = $tahfidzSetoran->first()?->surah ?? '-';
    $surahBaru = $tahfidzSetoran->where('status', 'baru')->count();
    $setoranBulanIni = $tahfidzSetoran->where('tanggal', '>=', now()->startOfMonth())->count();

    $grades = ['grade-A', 'grade-B', 'grade-C', 'grade-D', 'grade-E'];
    $gradeColor = function($v) {
        if ($v >= 90) return 'grade-A';
        if ($v >= 80) return 'grade-B';
        if ($v >= 70) return 'grade-C';
        return 'grade-D';
    };
    $gradeLetter = function($v) {
        if ($v >= 90) return 'A';
        if ($v >= 80) return 'B';
        if ($v >= 70) return 'C';
        return 'D';
    };
    $statusBadge = function($s) {
        if ($s === 'baru') return '<span class="badge green light">Baru</span>';
        return '<span class="badge blue">Murojaah</span>';
    };

    $minggu = [];
    for ($i = 4; $i >= 1; $i--) {
        $start = now()->subWeeks($i)->startOfWeek();
        $end = now()->subWeeks($i)->endOfWeek();
        $total = $tahfidzSetoran->filter(fn($t) =>
            \Carbon\Carbon::parse($t->tanggal)->between($start, $end)
        )->sum('jumlah_ayat');
        $minggu[] = ['label' => 'Minggu ' . (4 - $i + 1), 'ayat' => $total];
    }
    $maxAyat = max(array_column($minggu, 'ayat')) ?: 1;
    $barColors = ['green', 'teal', 'blue', 'orange'];
@endphp
<div class="content-header">
    <h1>Tahfidz &amp; Setoran Ayat</h1>
    <div class="header-right">
        <div class="avatar blue">{{ strtoupper(substr($siswa->nama, 0, 1) . (str_contains($siswa->nama, ' ') ? substr(explode(' ', $siswa->nama)[1], 0, 1) : '')) }}</div>
        <span style="font-weight:600;font-size:14px">{{ explode(' ', $siswa->nama)[0] }}</span>
    </div>
</div>

<div class="card" style="margin-bottom:20px">
    <div class="card-header"><h3><i class="fas fa-quran" style="color:var(--green)"></i> Progress Tahfidz {{ $kelas->nama_kelas }}</h3></div>
    <div class="tahfidz-stats">
        <div class="tahfidz-stat"><span class="tahfidz-stat-number green">{{ floor($totalAyat / 10) }}</span><span class="tahfidz-stat-label">Juz Dihafal</span></div>
        <div class="tahfidz-stat"><span class="tahfidz-stat-number teal">{{ $setoranBulanIni }}</span><span class="tahfidz-stat-label">Setoran Bulan Ini</span></div>
        <div class="tahfidz-stat"><span class="tahfidz-stat-number blue">{{ number_format($avgNilai, 0) }}</span><span class="tahfidz-stat-label">Rata-rata Nilai</span></div>
        <div class="tahfidz-stat"><span class="tahfidz-stat-number orange">{{ $surahBaru }}</span><span class="tahfidz-stat-label">Surah Baru</span></div>
    </div>
</div>

<div class="card" style="margin-bottom:20px">
    <div class="card-header"><h3><i class="fas fa-list" style="color:var(--teal)"></i> Riwayat Setoran Ayat</h3></div>
    <div class="table-wrap">
        <table class="tahfidz-table">
            <thead><tr><th>Tanggal</th><th>Surah</th><th>Ayat</th><th>Jenis</th><th>Nilai</th><th>Grade</th><th>Catatan Guru</th></tr></thead>
            <tbody>
                @forelse($tahfidzSetoran as $t)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($t->tanggal)->isoFormat('D MMM YYYY') }}</td>
                        <td><strong>{{ $t->surah }}</strong></td>
                        <td>{{ $t->ayat_mulai }}:{{ $t->ayat_selesai }} ({{ $t->jumlah_ayat }} ayat)</td>
                        <td>{!! $statusBadge($t->status) !!}</td>
                        <td style="font-weight:700">{{ $t->nilai }}</td>
                        <td><span class="{{ $gradeColor($t->nilai) }}">{{ $gradeLetter($t->nilai) }}</span></td>
                        <td style="color:var(--gray-400);font-size:13px">{{ $t->catatan_guru ?? '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align:center;color:var(--gray-400);padding:20px">Belum ada setoran tahfidz</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header"><h3><i class="fas fa-chart-bar" style="color:var(--blue)"></i> Grafik Perkembangan Tahfidz (4 Minggu Terakhir)</h3></div>
    <div class="h-bar-group">
        @foreach($minggu as $i => $m)
            @php $pct = max(round(($m['ayat'] / $maxAyat) * 80), 5); @endphp
            <div class="h-bar-row">
                <div class="h-bar-label">{{ $m['label'] }}</div>
                <div class="h-bar-track">
                    <div class="h-bar-fill {{ $barColors[$i] }}" style="width:{{ $pct }}%">{{ $m['ayat'] }} ayat</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
