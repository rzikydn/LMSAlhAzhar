@php
    $materiList = \App\Models\Materi::where('guru_id', $guru->id)->with('mapel', 'kelas')->orderBy('created_at', 'desc')->get();
    $mapelList = \App\Models\Mapel::all();
    $kelasList = \App\Models\Kelas::all();
    $fileIcon = fn($path) => match (true) {
        str_ends_with($path, '.pdf') => 'fa-file-pdf',
        str_ends_with($path, '.doc') || str_ends_with($path, '.docx') => 'fa-file-word',
        str_ends_with($path, '.xls') || str_ends_with($path, '.xlsx') => 'fa-file-excel',
        str_ends_with($path, '.ppt') || str_ends_with($path, '.pptx') => 'fa-file-powerpoint',
        str_ends_with($path, '.zip') || str_ends_with($path, '.rar') => 'fa-file-archive',
        str_ends_with($path, '.jpg') || str_ends_with($path, '.jpeg') || str_ends_with($path, '.png') => 'fa-file-image',
        str_ends_with($path, '.mp4') => 'fa-file-video',
        str_ends_with($path, '.mp3') => 'fa-file-audio',
        default => 'fa-file',
    };
@endphp
<div class="content-header">
    <h1>Upload Materi</h1>
    <div class="header-right">
        <div class="avatar blue">{{ strtoupper(substr($guru->nama, 0, 1)) }}</div>
    </div>
</div>

<div class="grid-2" style="margin-bottom:20px">
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-upload" style="color:var(--teal)"></i> Upload Materi Baru</h3></div>
        <form method="POST" action="{{ route('guru.materi.store') }}" enctype="multipart/form-data" style="padding:4px 0">
            @csrf
            <div class="form-group" style="margin-bottom:14px">
                <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Judul</label>
                <input type="text" name="judul" required placeholder="Judul materi" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font)">
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
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Kelas (opsional)</label>
                    <select name="kelas_id" class="form-select" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font);background:var(--white)">
                        <option value="">Semua Kelas</option>
                        @foreach($kelasList as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div style="display:flex;gap:10px;margin-bottom:14px">
                <div class="form-group" style="flex:1">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Tipe</label>
                    <select name="tipe" class="form-select" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font);background:var(--white)">
                        <option value="materi">Materi Ajar</option>
                        <option value="referensi">Referensi</option>
                        <option value="tugas">Tugas</option>
                    </select>
                </div>
                <div class="form-group" style="flex:1">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">File</label>
                    <input type="file" name="file" required style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font);background:var(--white)">
                </div>
            </div>
            <div class="form-group" style="margin-bottom:16px">
                <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Deskripsi (opsional)</label>
                <textarea name="deskripsi" rows="3" placeholder="Deskripsi materi..." style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font);resize:vertical"></textarea>
            </div>
            <button type="submit" class="btn-login" style="cursor:pointer;border:none"><i class="fas fa-upload"></i> Upload</button>
        </form>
    </div>
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-chart-bar" style="color:var(--teal)"></i> Statistik</h3></div>
        <div style="padding:4px 0">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                <div><span style="font-size:12px;color:var(--gray-400)">Total File</span><div style="font-size:22px;font-weight:700;color:var(--teal)">{{ $materiList->count() }}</div></div>
                <div><span style="font-size:12px;color:var(--gray-400)">Materi Ajar</span><div style="font-size:22px;font-weight:700;color:var(--blue)">{{ $materiList->where('tipe', 'materi')->count() }}</div></div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><h3><i class="fas fa-folder-open" style="color:var(--teal)"></i> Daftar Materi</h3>
        <select x-model="filterTipeVal" class="form-select" style="padding:5px 10px;font-size:12px;border:1px solid var(--border);border-radius:var(--radius-sm)">
            <option value="">Semua Tipe</option>
            <option value="materi">Materi Ajar</option>
            <option value="referensi">Referensi</option>
            <option value="tugas">Tugas</option>
        </select>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>File</th><th>Judul</th><th>Mapel</th><th>Kelas</th><th>Tipe</th><th>Tanggal</th><th></th></tr></thead>
            <tbody>
                @forelse($materiList as $m)
                <tr x-show="!filterTipeVal || '{{ $m->tipe }}' === filterTipeVal">
                    <td style="text-align:center;font-size:20px;color:var(--teal)"><i class="fas {{ $fileIcon($m->file_path) }}"></i></td>
                    <td><strong>{{ $m->judul }}</strong></td>
                    <td>{{ $m->mapel->kode ?? '-' }}</td>
                    <td>{{ $m->kelas->nama_kelas ?? 'Semua' }}</td>
                    <td><span class="badge {{ $m->tipe == 'materi' ? 'teal' : ($m->tipe == 'referensi' ? 'blue' : 'orange') }} light">{{ $m->tipe }}</span></td>
                    <td style="font-size:12px;color:var(--gray-400)">{{ $m->created_at->format('d M Y') }}</td>
                    <td><a href="{{ asset('storage/' . $m->file_path) }}" target="_blank" class="btn-small outline" style="text-decoration:none"><i class="fas fa-download"></i></a></td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;color:var(--gray-400)">Belum ada materi</td></tr>
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
