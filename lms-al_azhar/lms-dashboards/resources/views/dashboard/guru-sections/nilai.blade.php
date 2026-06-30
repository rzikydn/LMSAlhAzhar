@php
    $mapelList = \App\Models\Mapel::all();
    $semuaSiswa = \App\Models\Siswa::with('kelas')->get();
@endphp
<div class="content-header">
    <h1>Nilai</h1>
    <div class="header-right">
        <a href="{{ route('guru.export.nilai') }}" class="header-btn outline" style="text-decoration:none;display:inline-flex;align-items:center;gap:6px"><i class="fas fa-download"></i> Export CSV</a>
        <div class="avatar blue">{{ strtoupper(substr($guru->nama, 0, 1)) }}</div>
    </div>
</div>

<div class="grid-2" style="margin-bottom:20px">
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-plus" style="color:var(--teal)"></i> Input / Edit Nilai</h3></div>
        <form method="POST" action="/guru/nilai" style="padding:4px 0">
            @csrf
            <div class="form-group" style="margin-bottom:14px">
                <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Siswa</label>
                <select name="siswa_id" required class="form-select" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font);background:var(--white)">
                    <option value="">Pilih Siswa</option>
                    @foreach($semuaSiswa as $s)
                    <option value="{{ $s->id }}">{{ $s->nama }} ({{ $s->kelas->nama_kelas ?? '-' }})</option>
                    @endforeach
                </select>
            </div>
            <div style="display:flex;gap:10px;margin-bottom:14px">
                <div class="form-group" style="flex:1">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Mata Pelajaran</label>
                    <select name="mapel_id" required class="form-select" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font);background:var(--white)">
                        <option value="">Pilih Mapel</option>
                        @foreach($mapelList as $m)
                        <option value="{{ $m->id }}" {{ $m->id == $guru->mapel_id ? 'selected' : '' }}>{{ $m->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="flex:1">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Nilai</label>
                    <input type="number" name="nilai" required min="0" max="100" placeholder="0-100" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font)">
                </div>
            </div>
            <button type="submit" class="btn-login" style="cursor:pointer;border:none"><i class="fas fa-save"></i> Simpan Nilai</button>
        </form>
    </div>
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-chart-bar" style="color:var(--teal)"></i> Statistik Nilai</h3></div>
        <div style="padding:4px 0">
            @php
                $nilaiGuru = \App\Models\Nilai::whereHas('mapel', fn($q) => $q->where('id', $guru->mapel_id))->get();
            @endphp
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                <div><span style="font-size:12px;color:var(--gray-400)">Total Nilai</span><div style="font-size:22px;font-weight:700;color:var(--teal)">{{ $nilaiGuru->count() }}</div></div>
                <div><span style="font-size:12px;color:var(--gray-400)">Rata-rata</span><div style="font-size:22px;font-weight:700;color:var(--blue)">{{ $nilaiGuru->avg('nilai') ? number_format($nilaiGuru->avg('nilai'), 1) : '-' }}</div></div>
                <div><span style="font-size:12px;color:var(--gray-400)">Tertinggi</span><div style="font-size:22px;font-weight:700;color:var(--green)">{{ $nilaiGuru->max('nilai') ?? '-' }}</div></div>
                <div><span style="font-size:12px;color:var(--gray-400)">Terendah</span><div style="font-size:22px;font-weight:700;color:var(--orange)">{{ $nilaiGuru->min('nilai') ?? '-' }}</div></div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><h3><i class="fas fa-chart-bar" style="color:var(--blue)"></i> Rekap Nilai per Kelas</h3>
        <div style="display:flex;gap:8px">
            <select x-model="filterKelasVal" class="form-select" style="padding:5px 10px;font-size:12px;border:1px solid var(--border);border-radius:var(--radius-sm)">
                <option value="">Semua Kelas</option>
                @foreach($kelasYangDiajar as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Kelas</th><th>Rata-rata</th><th>Tertinggi</th><th>Terendah</th><th>Lulus</th><th></th></tr></thead>
            <tbody>
                @foreach($kelasYangDiajar as $k)
                @php
                    $siswaIds = $k->siswa ? $k->siswa->pluck('id') : collect();
                    $nilaiKelas = \App\Models\Nilai::whereIn('siswa_id', $siswaIds)->whereHas('mapel', fn($q) => $q->where('id', $guru->mapel_id));
                    $rata = round($nilaiKelas->avg('nilai') ?? 0, 1);
                    $max = $nilaiKelas->max('nilai') ?? 0;
                    $min = $nilaiKelas->min('nilai') ?? 0;
                    $lulusPct = $siswaIds->count() > 0 ? round($nilaiKelas->where('nilai', '>=', setting('kkm_smp'))->count() / $siswaIds->count() * 100) : 0;
                    $lulusBadge = $lulusPct >= 85 ? 'green' : ($lulusPct >= 70 ? 'orange' : 'red');
                @endphp
                <tr>
                    <td><strong>{{ $k->nama_kelas }}</strong></td>
                    <td>{{ $rata }}</td>
                    <td>{{ $max }}</td>
                    <td>{{ $min }}</td>
                    <td><span class="badge light {{ $lulusBadge }}">{{ $lulusPct }}%</span></td>
                    <td><label @click="selectedKelas='{{ $k->id }}'; tab='kelas-detail'" class="btn-small outline" style="cursor:pointer">Detail</label></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@if(session('success'))
    <div style="position:fixed;bottom:20px;right:20px;background:var(--green);color:#fff;padding:14px 20px;border-radius:var(--radius-sm);font-weight:600;box-shadow:0 4px 12px rgba(0,0,0,0.15);z-index:999">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif
