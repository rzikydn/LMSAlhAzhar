@php
    $inits = strtoupper(substr($siswa->nama, 0, 1) . (str_contains($siswa->nama, ' ') ? substr(explode(' ', $siswa->nama)[1], 0, 1) : ''));
    $badgeColors = ['green light', 'teal', 'blue', 'orange light', 'purple light', 'cyan light', 'pink light'];
    $gradeColor = function($v) {
        if ($v >= 90) return 'grade-A';
        if ($v >= 85) return 'grade-B';
        if ($v >= 80) return 'grade-B';
        return 'grade-C';
    };
    $gradeLetter = function($v) {
        if ($v >= 90) return 'A';
        if ($v >= 85) return 'A-';
        if ($v >= 80) return 'B+';
        if ($v >= 75) return 'B';
        if ($v >= 70) return 'B-';
        return 'C';
    };
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
    $hariIni = now()->locale('id')->dayName;
    $jadwalCount = $jadwalHariIni->count();
    $tugasCount = $tugas->count();
@endphp
<div class="content-header">
    <div class="greeting">Assalamu'alaikum, <strong>{{ $siswa->nama }}</strong> 👋</div>
    <div class="header-right">
        <div class="notif-badge"><i class="fas fa-bell"></i></div>
        <div class="avatar teal">{{ $inits }}</div>
        <span style="font-weight:600;font-size:14px">{{ explode(' ', $siswa->nama)[0] }}</span>
    </div>
</div>
<div class="welcome-banner">
    <div class="welcome-banner-left">
        <h2>Assalamu'alaikum, {{ explode(' ', $siswa->nama)[0] }}! 👋</h2>
        <p>Hari ini ada {{ $jadwalCount }} jadwal pelajaran dan {{ $tugasCount }} tugas yang perlu dikerjakan. Tetap semangat!</p>
    </div>
    <div class="welcome-banner-right">📚</div>
</div>

@if(!$sudahIsiKondisi)
<div class="card" style="background: var(--white); border-radius: var(--radius); padding: 20px; box-shadow: var(--shadow); margin-bottom: 20px; border-left: 5px solid var(--teal)">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px">
        <h3 style="font-size:16px; font-weight:700; color:var(--teal); margin:0">
            <i class="fas fa-heartbeat" style="color:var(--red); margin-right:6px"></i> Survei Kondisi Kelas Hari Ini
        </h3>
        <span class="badge green light" style="font-size:11px">15 Detik</span>
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
                    <span style="background:var(--teal); color:white; padding:1px 6px; border-radius:4px" x-text="hubungan"></span>
                </div>
                <input type="range" name="hubungan_guru_siswa" min="1" max="5" step="1" x-model.number="hubungan" style="width:100%; accent-color:var(--teal); cursor:pointer">
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
            <button type="submit" class="btn-login" style="border:none; cursor:pointer; padding:8px 24px; font-size:13px; font-weight:700; border-radius:var(--radius-sm)"><i class="fas fa-paper-plane"></i> Kirim Penilaian</button>
        </div>
    </form>
</div>
@endif
<div class="card" style="margin-bottom:20px">
    <div class="card-header">
        <h3><i class="fas fa-chart-bar" style="color:var(--teal)"></i> Grafik Nilai per Mapel</h3>
    </div>
    <canvas id="nilaiChart" width="400" height="160" style="max-height:160px;width:100%"></canvas>
</div>

<div class="grid-2" style="margin-bottom:20px">
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-calendar-day" style="color:var(--teal)"></i> Jadwal Hari Ini</h3><label @click="tab='jadwal'" style="cursor:pointer;font-size:12px;color:var(--blue);font-weight:600;text-decoration:none">Lihat Semua</label></div>
        @forelse($jadwalHariIni as $j)
            <div class="schedule-item"><div class="schedule-time">{{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }}</div><div class="schedule-info"><div class="mapel">{{ $j->mapel->nama_mapel }}</div><div class="guru">{{ $j->guru->nama }}</div></div><span class="badge {{ $badgeColors[$loop->index % count($badgeColors)] }}">{{ $j->mapel->kode }}</span></div>
        @empty
            <div style="padding:20px;text-align:center;color:var(--gray-400)">Tidak ada jadwal hari ini</div>
        @endforelse
    </div>
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-exclamation-triangle" style="color:var(--orange)"></i> Tugas &amp; Ulangan Terdekat</h3><label @click="tab='tugas'">Lihat Semua</label></div>
        @forelse($tugas as $t)
            @php $icon = $t->tipe === 'tugas' ? 'fa-file-alt' : 'fa-pencil-alt'; $color = ['var(--teal)','var(--blue)','var(--purple)','var(--orange)','var(--cyan)'][$loop->index % 5]; @endphp
            <div class="task-item"><i class="fas {{ $icon }}" style="color:{{ $color }};font-size:18px"></i><div class="task-info"><div class="task-title">{{ $t->judul }}</div><div class="task-meta">{{ $t->mapel->nama_mapel }} – Deadline: {{ \Carbon\Carbon::parse($t->tanggal_deadline)->format('d M Y') }}</div></div><span class="badge {{ $statusClass($t->tanggal_deadline) }}">{{ $statusLabel($t->tanggal_deadline) }}</span></div>
        @empty
            <div style="padding:20px;text-align:center;color:var(--gray-400)">Tidak ada tugas</div>
        @endforelse
    </div>
</div>
<div class="grid-2" style="margin-bottom:20px">
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-chart-bar" style="color:var(--teal)"></i> Progress Belajar</h3><label @click="tab='nilai'">Detail</label></div>
        <div class="grid-2x2">
            @foreach($nilai as $n)
                @php $color = ['var(--green)','var(--teal)','var(--blue)','var(--purple)','var(--orange)','var(--pink)','var(--cyan)'][$loop->index % 7]; @endphp
                <div class="subject-mini"><div class="subject-name" style="color:{{ $color }}">{{ $n->mapel->nama_mapel }}</div><div class="progress-wrap"><div class="progress-label"><span>Progress</span><span>{{ $n->nilai }}%</span></div><div class="progress-bar"><div class="fill" style="width:{{ $n->nilai }}%"></div></div></div></div>
            @endforeach
        </div>
    </div>
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-file-invoice" style="color:var(--blue)"></i> Rapor Singkat</h3><label @click="tab='nilai'">Lihat Rapor</label></div>
        @foreach($nilai as $n)
            <div class="rapor-item"><span class="rapor-mapel">{{ $n->mapel->nama_mapel }}</span><span class="rapor-nilai {{ $gradeColor($n->nilai) }}">{{ $n->nilai }} ({{ $gradeLetter($n->nilai) }})</span></div>
        @endforeach
    </div>
</div>
<div class="card" style="margin-bottom:20px">
    <div class="card-header"><h3><i class="fas fa-trophy" style="color:var(--orange)"></i> Pencapaianku (Badge)</h3><a href="javascript:void(0)">Semua Badge</a></div>
    <div class="badge-row">
        @forelse($badges as $b)
            @php $memiliki = $b->siswa->isNotEmpty(); @endphp
            <div class="badge-card @if(!$memiliki) locked @endif">
                <div class="badge-emoji">{{ $b->icon }}</div>
                <div class="badge-name">{{ $b->nama }}</div>
                <div class="badge-desc">{{ $b->deskripsi }}</div>
            </div>
        @empty
            <div style="padding:20px;text-align:center;color:var(--gray-400)">Belum ada badge tersedia</div>
        @endforelse
    </div>
    <div class="streak-row">
        <div class="streak-dots"><div class="streak-dot active">Sen</div><div class="streak-dot active">Sel</div><div class="streak-dot active">Rab</div><div class="streak-dot active">Kam</div><div class="streak-dot active">Jum</div><div class="streak-dot inactive">Sab</div><div class="streak-dot inactive">Min</div></div>
        <span class="streak-text">🔥 5 hari berturut-turut!</span>
    </div>
</div>
<div class="grid-2">
    <div class="card"><div class="card-header"><h3><i class="fas fa-bullhorn" style="color:var(--orange)"></i> Pengumuman Sekolah</h3><label @click="tab='pengumuman'">Semua</label></div>
        @forelse($pengumuman as $p)
            <div class="ann-item"><div class="ann-date">{{ \Carbon\Carbon::parse($p->created_at)->format('d F Y') }}</div><div class="ann-title">{{ $p->judul }}</div><div class="ann-desc">{{ Str::limit($p->konten, 80) }}</div></div>
        @empty
            <div style="padding:20px;text-align:center;color:var(--gray-400)">Tidak ada pengumuman</div>
        @endforelse
    </div>
    <div class="card"><div class="card-header"><h3><i class="fas fa-envelope" style="color:var(--blue)"></i> Pesan dari Guru</h3><label @click="tab='pesan'" style="cursor:pointer;font-size:12px;color:var(--blue);font-weight:600;text-decoration:none">Semua Pesan</label></div>
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
