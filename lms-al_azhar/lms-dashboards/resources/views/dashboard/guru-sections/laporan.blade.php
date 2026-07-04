@php
    $guruActive = \App\Models\Guru::where('user_id', auth()->id())->first();
    $laporans = $guruActive ? \App\Models\LaporanMengajar::where('guru_id', $guruActive->id)->orderBy('tanggal', 'desc')->get() : collect();
@endphp

<div x-data="{ 
    tipe: 'harian', 
    tanggal: '{{ date('Y-m-d') }}',
    isi: '',
    get isiLabel() {
        if (this.tipe === 'harian') return 'Kendala Mengajar Hari Ini';
        if (this.tipe === 'mingguan') return 'Progres Materi Minggu Ini';
        return 'Progres Keseluruhan Bulan Ini';
    },
    get isiPlaceholder() {
        if (this.tipe === 'harian') return 'Tuliskan kendala atau catatan khusus mengajar hari ini (misal: kelas kurang kondusif, proyektor mati)...';
        if (this.tipe === 'mingguan') return 'Tuliskan materi apa saja yang berhasil diselesaikan pada minggu ini...';
        return 'Tuliskan rangkuman dan progres keseluruhan kelas binaan/ajaran bulan ini...';
    },
    loadLaporan(tipe, tanggal, isi) {
        this.tipe = tipe;
        this.tanggal = tanggal;
        this.isi = isi;
        window.scrollTo({top: 0, behavior: 'smooth'});
        setTimeout(() => document.getElementById('isi_laporan_textarea').focus(), 150);
    }
}">

    <div class="content-header">
        <h1>Laporan Mengajar <span>Guru</span></h1>
        <div class="header-right">
            <div class="avatar blue">{{ strtoupper(substr($guru->nama, 0, 1)) }}</div>
        </div>
    </div>

    <div class="grid-2" style="margin-bottom:20px">
        <!-- Form Input -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-edit" style="color:var(--blue)"></i> Input / Edit Laporan Mengajar</h3>
            </div>
            <form method="POST" action="{{ route('guru.laporan.store') }}" style="padding:4px 0">
                @csrf
                
                <div class="form-group" style="margin-bottom:14px">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:6px">Tipe Laporan</label>
                    <div style="display:flex;gap:12px">
                        <label style="display:inline-flex;align-items:center;font-size:14px;cursor:pointer">
                            <input type="radio" name="tipe" value="harian" x-model="tipe" style="margin-right:6px"> Harian
                        </label>
                        <label style="display:inline-flex;align-items:center;font-size:14px;cursor:pointer">
                            <input type="radio" name="tipe" value="mingguan" x-model="tipe" style="margin-right:6px"> Mingguan
                        </label>
                        <label style="display:inline-flex;align-items:center;font-size:14px;cursor:pointer">
                            <input type="radio" name="tipe" value="bulanan" x-model="tipe" style="margin-right:6px"> Bulanan
                        </label>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom:14px">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Tanggal Laporan</label>
                    <input type="date" name="tanggal" required x-model="tanggal" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px">
                </div>

                <div class="form-group" style="margin-bottom:14px">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px" x-text="isiLabel"></label>
                    <textarea name="isi" id="isi_laporan_textarea" required rows="5" :placeholder="isiPlaceholder" x-model="isi" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font);line-height:1.5"></textarea>
                </div>

                <button type="submit" class="btn-login" style="cursor:pointer;border:none"><i class="fas fa-paper-plane"></i> Kirim Laporan</button>
            </form>
        </div>

        <!-- Pedoman Laporan -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-info-circle" style="color:var(--teal)"></i> Petunjuk &amp; Ketentuan</h3>
            </div>
            <div style="padding:10px 0">
                <p style="font-size:13px;line-height:1.6;color:var(--gray-600);margin-bottom:16px">
                    Laporan mengajar ini dipantau secara berkala oleh Admin Sekolah untuk proses monitoring dan evaluasi kinerja pengajaran.
                </p>
                <div style="display:flex;flex-direction:column;gap:14px">
                    <div style="display:flex;gap:12px;align-items:flex-start">
                        <div style="width:24px;height:24px;background:var(--blue-bg);color:var(--blue);display:flex;align-items:center;justify-content:center;border-radius:50%;font-size:12px;font-weight:700">1</div>
                        <div>
                            <strong style="display:block;font-size:13px;color:var(--gray-700)">Laporan Harian (Kendala)</strong>
                            <span style="font-size:12px;color:var(--gray-500)">Diisi setiap hari mengajar untuk mencatat kendala KBM kelas hari itu.</span>
                        </div>
                    </div>
                    <div style="display:flex;gap:12px;align-items:flex-start">
                        <div style="width:24px;height:24px;background:var(--teal-light);color:var(--teal);display:flex;align-items:center;justify-content:center;border-radius:50%;font-size:12px;font-weight:700">2</div>
                        <div>
                            <strong style="display:block;font-size:13px;color:var(--gray-700)">Laporan Mingguan (Materi)</strong>
                            <span style="font-size:12px;color:var(--gray-500)">Diisi satu kali setiap akhir pekan untuk mencatat bab/sub-bab materi yang selesai diajarkan.</span>
                        </div>
                    </div>
                    <div style="display:flex;gap:12px;align-items:flex-start">
                        <div style="width:24px;height:24px;background:var(--purple-light);color:var(--purple);display:flex;align-items:center;justify-content:center;border-radius:50%;font-size:12px;font-weight:700">3</div>
                        <div>
                            <strong style="display:block;font-size:13px;color:var(--gray-700)">Laporan Bulanan (Evaluasi)</strong>
                            <span style="font-size:12px;color:var(--gray-500)">Diisi di akhir bulan untuk rangkuman perkembangan belajar siswa secara umum.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Laporan -->
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-history" style="color:var(--orange)"></i> Riwayat Laporan Mengajar Saya</h3>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Tipe</th>
                        <th>Isi Catatan Laporan</th>
                        <th style="width:100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporans as $l)
                        <tr>
                            <td><strong>{{ $l->tanggal->format('d M Y') }}</strong></td>
                            <td>
                                <span class="badge light {{ $l->tipe === 'harian' ? 'blue' : ($l->tipe === 'mingguan' ? 'green' : 'purple') }}">
                                    {{ ucfirst($l->tipe) }}
                                </span>
                            </td>
                            <td style="font-size:13px;line-height:1.5;max-width:500px;white-space:pre-line">{{ $l->isi }}</td>
                            <td>
                                <button type="button" @click="loadLaporan('{{ $l->tipe }}', '{{ $l->tanggal->format('Y-m-d') }}', {{ json_encode($l->isi) }})" class="btn-small outline" style="border-radius:var(--radius-sm);cursor:pointer;font-weight:600">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center;color:var(--gray-400);padding:20px">Belum ada laporan mengajar yang dikirim.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@if(session('success'))
    <div style="position:fixed;bottom:20px;right:20px;background:var(--green);color:#fff;padding:14px 20px;border-radius:var(--radius-sm);font-weight:600;box-shadow:0 4px 12px rgba(0,0,0,0.15);z-index:999">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif
