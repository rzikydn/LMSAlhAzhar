@php
    $statusBadge = fn($s) => $s === 'baru'
        ? '<span class="badge green light">Baru</span>'
        : '<span class="badge blue">Murojaah</span>';
    $siswaList = \App\Models\Siswa::with('kelas')->get();
    $allSetoran = \App\Models\TahfidzSetoran::where('guru_id', $guru->id)
        ->with('siswa', 'siswa.kelas')
        ->orderBy('tanggal', 'desc')
        ->get();
@endphp
<div class="content-header">
    <h1>Setoran Tahfidz</h1>
    <div class="header-right">
        <div class="avatar blue">{{ strtoupper(substr($guru->nama, 0, 1)) }}</div>
    </div>
</div>

<div class="grid-2" style="margin-bottom:20px">
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-plus" style="color:var(--green)"></i> Input Setoran Baru</h3></div>
        <form method="POST" action="/guru/tahfidz" style="padding:4px 0">
            @csrf
            <div class="form-group" style="margin-bottom:14px">
                <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Siswa</label>
                <select name="siswa_id" required class="form-select" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font);background:var(--white)">
                    <option value="">Pilih Siswa</option>
                    @foreach($siswaList as $s)
                    <option value="{{ $s->id }}">{{ $s->nama }} ({{ $s->kelas->nama_kelas ?? '-' }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin-bottom:14px">
                <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Surah</label>
                <input type="text" name="surah" required placeholder="Contoh: An-Naba'" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font)">
            </div>
            <div style="display:flex;gap:10px;margin-bottom:14px">
                <div class="form-group" style="flex:1">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Ayat Mulai</label>
                    <input type="number" name="ayat_mulai" required min="1" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font)">
                </div>
                <div class="form-group" style="flex:1">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Ayat Selesai</label>
                    <input type="number" name="ayat_selesai" required min="1" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font)">
                </div>
            </div>
            <div style="display:flex;gap:10px;margin-bottom:14px">
                <div class="form-group" style="flex:1">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Jumlah Ayat</label>
                    <input type="number" name="jumlah_ayat" required min="1" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font)">
                </div>
                <div class="form-group" style="flex:1">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Nilai</label>
                    <input type="number" name="nilai" min="0" max="100" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font)">
                </div>
            </div>
            <div style="display:flex;gap:10px;margin-bottom:14px">
                <div class="form-group" style="flex:1">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Status</label>
                    <select name="status" class="form-select" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font);background:var(--white)">
                        <option value="baru">Setoran Baru</option>
                        <option value="murojaah">Murojaah</option>
                    </select>
                </div>
                <div class="form-group" style="flex:1">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ now()->format('Y-m-d') }}" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font)">
                </div>
            </div>
            <div class="form-group" style="margin-bottom:16px">
                <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Catatan (opsional)</label>
                <textarea name="catatan_guru" rows="2" placeholder="Catatan untuk setoran ini..." style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font);resize:vertical"></textarea>
            </div>
            <button type="submit" class="btn-login" style="cursor:pointer;border:none"><i class="fas fa-save"></i> Simpan Setoran</button>
        </form>
    </div>

    <div class="card">
        <div class="card-header"><h3><i class="fas fa-chart-bar" style="color:var(--teal)"></i> Statistik Setoran Saya</h3></div>
        <div style="padding:4px 0">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                <div><span style="font-size:12px;color:var(--gray-400)">Total Setoran</span><div style="font-size:22px;font-weight:700;color:var(--teal)">{{ $allSetoran->count() }}</div></div>
                <div><span style="font-size:12px;color:var(--gray-400)">Total Ayat</span><div style="font-size:22px;font-weight:700;color:var(--blue)">{{ $allSetoran->sum('jumlah_ayat') }}</div></div>
                <div><span style="font-size:12px;color:var(--gray-400)">Rata-rata Nilai</span><div style="font-size:22px;font-weight:700;color:var(--orange)">{{ $allSetoran->avg('nilai') ? number_format($allSetoran->avg('nilai'), 0) : '-' }}</div></div>
                <div><span style="font-size:12px;color:var(--gray-400)">Siswa Dibimbing</span><div style="font-size:22px;font-weight:700;color:var(--purple)">{{ $allSetoran->pluck('siswa_id')->unique()->count() }}</div></div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><h3><i class="fas fa-list" style="color:var(--blue)"></i> Riwayat Setoran Saya</h3></div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Tanggal</th><th>Siswa</th><th>Kelas</th><th>Surah</th><th>Ayat</th><th>Status</th><th>Nilai</th><th>Catatan</th></tr></thead>
            <tbody>
                @forelse($allSetoran as $t)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d M Y') }}</td>
                    <td><strong>{{ $t->siswa->nama ?? '-' }}</strong></td>
                    <td>{{ $t->siswa->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $t->surah }}</td>
                    <td>{{ $t->ayat_mulai }}:{{ $t->ayat_selesai }} ({{ $t->jumlah_ayat }} ayat)</td>
                    <td>{!! $statusBadge($t->status) !!}</td>
                    <td style="font-weight:700">{{ $t->nilai ?? '-' }}</td>
                    <td style="color:var(--gray-400);font-size:13px">{{ $t->catatan_guru ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;color:var(--gray-400);padding:20px">Belum ada setoran tahfidz</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if(session('success'))
    <div style="position:fixed;bottom:20px;right:20px;background:var(--green);color:#fff;padding:14px 20px;border-radius:var(--radius-sm);font-weight:600;box-shadow:0 4px 12px rgba(0,0,0,0.15);z-index:999">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif
