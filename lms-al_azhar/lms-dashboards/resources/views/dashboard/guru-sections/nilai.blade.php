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
        <form method="POST" action="/guru/nilai" style="padding:4px 0" x-data="{ 
            selectedSiswa: '', 
            selectedMapel: '{{ $guru->mapel_id }}',
            jenisNilai: 'biasa', 
            isBilingual: false, 
            siswaList: @js($semuaSiswa),
            mapelList: @js($mapelList),
            updateBilingual() {
                const s = this.siswaList.find(x => x.id == this.selectedSiswa);
                const m = this.mapelList.find(x => x.id == this.selectedMapel);
                const isMathScience = m && (m.kode === 'MTK' || m.kode === 'IPA');
                const isKelasUnggulan = s && s.kelas && s.kelas.nama_kelas.endsWith('A');
                
                if (s && s.kelas) {
                    this.jenisNilai = isKelasUnggulan ? 'unggulan' : 'biasa';
                }
                
                // Auto-check bilingual if it is Math/Science in class A
                this.isBilingual = isMathScience && isKelasUnggulan;
            }
        }" x-init="$watch('selectedSiswa', () => updateBilingual()); $watch('selectedMapel', () => updateBilingual())">
            @csrf
            <div class="form-group" style="margin-bottom:14px">
                <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Kategori Nilai</label>
                <select name="jenis_nilai" required class="form-select" x-model="jenisNilai" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font);background:var(--white)">
                    <option value="biasa">Nilai Biasa</option>
                    <option value="unggulan">Nilai Unggulan</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom:14px">
                <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Siswa</label>
                <select name="siswa_id" required class="form-select" x-model="selectedSiswa" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font);background:var(--white)">
                    <option value="">Pilih Siswa</option>
                    @foreach($semuaSiswa as $s)
                    <option value="{{ $s->id }}">{{ $s->nama }} ({{ $s->kelas->nama_kelas ?? '-' }})</option>
                    @endforeach
                </select>
            </div>
            <template x-if="(() => { const m = mapelList.find(x => x.id == selectedMapel); return m && (m.kode === 'MTK' || m.kode === 'IPA'); })()">
                <div class="form-group" style="margin-bottom:14px; display:flex; align-items:center; gap:8px">
                    <input type="checkbox" id="is_bilingual" x-model="isBilingual" style="width:16px; height:16px; cursor:pointer">
                    <label for="is_bilingual" style="font-size:13px; font-weight:600; color:var(--gray-600); cursor:pointer">Gunakan Versi Inggris (Bilingual)</label>
                </div>
            </template>
            <div style="display:flex;gap:10px;margin-bottom:14px;align-items:flex-end">
                <div class="form-group" style="flex:1">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Mata Pelajaran</label>
                    <select name="mapel_id" required class="form-select" x-model="selectedMapel" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font);background:var(--white)">
                        <option value="">Pilih Mapel</option>
                        @foreach($mapelList as $m)
                        <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="flex:1">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">
                        <span x-text="isBilingual ? 'Nilai Paham Materi' : 'Nilai'">Nilai</span>
                    </label>
                    <input type="number" name="nilai" required min="0" max="100" placeholder="0-100" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font)">
                </div>
                <template x-if="isBilingual">
                    <div class="form-group" style="flex:1">
                        <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Nilai Bahasa Inggris</label>
                        <input type="number" name="nilai_bahasa" required min="0" max="100" placeholder="0-100" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font)">
                    </div>
                </template>
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

@if($guru->mapel->kode === 'ING')
<div class="card" style="margin-top:20px">
    <div class="card-header">
        <h3><i class="fas fa-language" style="color:var(--indigo)"></i> Tindak Lanjut Nilai Bahasa Inggris (dari Pelajaran Math & Science)</h3>
    </div>
    @php
        $nilaiBilingual = \App\Models\Nilai::whereIn('mapel_id', function($q) {
            $q->select('id')->from('mapel')->whereIn('kode', ['MTK', 'IPA']);
        })->whereNotNull('nilai_bahasa')
        ->with(['siswa.kelas', 'mapel'])
        ->get()
        ->sortBy('nilai_bahasa');
    @endphp
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Siswa</th>
                    <th>Kelas</th>
                    <th>Pelajaran</th>
                    <th>Nilai Bahasa Inggris</th>
                    <th>Nilai Materi</th>
                    <th>Status Tindak Lanjut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($nilaiBilingual as $nb)
                <tr>
                    <td><strong>{{ $nb->siswa->nama }}</strong></td>
                    <td>{{ $nb->siswa->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $nb->mapel->nama_mapel }}</td>
                    <td>
                        <span class="badge light {{ $nb->nilai_bahasa < 75 ? 'red' : 'green' }}" style="font-size:13px; font-weight:700">
                            {{ $nb->nilai_bahasa }}
                        </span>
                    </td>
                    <td>{{ $nb->nilai }}</td>
                    <td>
                        @if($nb->nilai_bahasa < 75)
                            <span class="badge light red"><i class="fas fa-exclamation-triangle"></i> Perlu Bimbingan</span>
                        @else
                            <span class="badge light green"><i class="fas fa-check"></i> Baik</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:var(--gray-400);padding:20px">Belum ada nilai Bahasa Inggris dari pelajaran Math / Science.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif

@if(session('success'))
    <div style="position:fixed;bottom:20px;right:20px;background:var(--green);color:#fff;padding:14px 20px;border-radius:var(--radius-sm);font-weight:600;box-shadow:0 4px 12px rgba(0,0,0,0.15);z-index:999">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif
