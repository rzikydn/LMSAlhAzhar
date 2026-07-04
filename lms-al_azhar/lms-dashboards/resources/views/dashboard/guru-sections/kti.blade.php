<div x-data="{ 
    selectedSiswa: '', 
    judulKti: '',
    nilaiProses: '',
    nilaiTulisan: '',
    nilaiSidang: '',
    catatanText: '',
    loadKti(siswaId, judul, proses, tulisan, sidang, catatan) {
        this.selectedSiswa = siswaId;
        this.judulKti = judul;
        this.nilaiProses = proses;
        this.nilaiTulisan = tulisan;
        this.nilaiSidang = sidang;
        this.catatanText = catatan;
        window.scrollTo({top: 0, behavior: 'smooth'});
        setTimeout(() => document.getElementById('judul_kti_input').focus(), 150);
    }
}">

    <div class="content-header">
        <h1>Karya Tulis Ilmiah (KTI) <span>Kelas 9</span></h1>
        <div class="header-right">
            <div class="avatar blue">{{ strtoupper(substr($guru->nama, 0, 1)) }}</div>
        </div>
    </div>

    <div class="grid-2" style="margin-bottom:20px">
        <div class="card">
            <div class="card-header"><h3><i class="fas fa-plus-circle" style="color:var(--teal)"></i> Input / Edit Nilai KTI</h3></div>
            <form method="POST" action="/guru/kti" style="padding:4px 0">
                @csrf
                <div class="form-group" style="margin-bottom:14px">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Siswa (Kelas 9)</label>
                    <select name="siswa_id" required class="form-select" x-model="selectedSiswa" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;background:var(--white)">
                        <option value="">Pilih Siswa Kelas 9</option>
                        @foreach($siswaKelas9 as $s)
                            <option value="{{ $s->id }}">{{ $s->nama }} ({{ $s->kelas->nama_kelas }})</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group" style="margin-bottom:14px">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Judul Karya Tulis Ilmiah (KTI)</label>
                    <input type="text" name="judul_kti" id="judul_kti_input" required placeholder="Masukkan judul karya tulis ilmiah..." x-model="judulKti" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px">
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:10px;margin-bottom:14px">
                    <div class="form-group">
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Proses Riset (30%)</label>
                        <input type="number" name="nilai_proses" required min="0" max="100" step="0.01" placeholder="0-100" x-model="nilaiProses" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px">
                    </div>
                    <div class="form-group">
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Naskah/Tulisan (40%)</label>
                        <input type="number" name="nilai_tulisan" required min="0" max="100" step="0.01" placeholder="0-100" x-model="nilaiTulisan" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px">
                    </div>
                    <div class="form-group">
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Presentasi Sidang (30%)</label>
                        <input type="number" name="nilai_sidang" required min="0" max="100" step="0.01" placeholder="0-100" x-model="nilaiSidang" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px">
                    </div>
                </div>

                <div class="form-group" style="margin-bottom:14px">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Catatan Penguji / Pembimbing</label>
                    <textarea name="catatan" rows="3" placeholder="Masukkan catatan atau feedback revisi sidang..." x-model="catatanText" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font)"></textarea>
                </div>

                <button type="submit" class="btn-login" style="cursor:pointer;border:none"><i class="fas fa-save"></i> Simpan Penilaian</button>
            </form>
        </div>

        <div class="card">
            <div class="card-header"><h3><i class="fas fa-info-circle" style="color:var(--blue)"></i> Informasi Pembobotan</h3></div>
            <div style="padding:10px 0">
                <p style="font-size:13px;line-height:1.6;color:var(--gray-600);margin-bottom:16px">
                    Penilaian Karya Tulis Ilmiah (KTI) dihitung secara otomatis oleh sistem dengan menerapkan bobot berikut sesuai standar sekolah:
                </p>
                <div style="display:flex;flex-direction:column;gap:12px">
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:8px 12px;background:var(--gray-100);border-radius:var(--radius-sm)">
                        <span style="font-weight:600;font-size:13px"><i class="fas fa-microscope" style="color:var(--teal);margin-right:6px"></i> Proses Riset & Bimbingan</span>
                        <span class="badge blue light" style="font-weight:700">30%</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:8px 12px;background:var(--gray-100);border-radius:var(--radius-sm)">
                        <span style="font-weight:600;font-size:13px"><i class="fas fa-file-alt" style="color:var(--indigo);margin-right:6px"></i> Hasil Naskah / Tulisan KTI</span>
                        <span class="badge purple light" style="font-weight:700">40%</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:8px 12px;background:var(--gray-100);border-radius:var(--radius-sm)">
                        <span style="font-weight:600;font-size:13px"><i class="fas fa-chalkboard-teacher" style="color:var(--orange);margin-right:6px"></i> Presentasi & Sidang KTI</span>
                        <span class="badge orange light" style="font-weight:700">30%</span>
                    </div>
                </div>
                <hr style="margin:16px 0;border:none;border-top:1px solid var(--border)">
                <div style="display:flex;justify-content:space-between;align-items:center;padding:0 4px">
                    <span style="font-weight:700;font-size:14px;color:var(--gray-700)">Batas KKM KTI Kelulusan:</span>
                    <span class="badge red light" style="font-size:13px;font-weight:700;padding:6px 12px">75.00</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Rekapitulasi Nilai KTI -->
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-list" style="color:var(--blue)"></i> Rekapitulasi Nilai KTI Siswa</h3></div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Judul Karya Tulis</th>
                        <th>Riset (30%)</th>
                        <th>Naskah (40%)</th>
                        <th>Sidang (30%)</th>
                        <th>Nilai Akhir</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($nilaiKtiRekap as $kti)
                        @php $isLulus = $kti->nilai_akhir >= 75.00; @endphp
                        <tr>
                            <td><strong>{{ $kti->siswa->nama }}</strong></td>
                            <td>{{ $kti->siswa->kelas->nama_kelas ?? '-' }}</td>
                            <td><span style="font-style:italic">"{{ $kti->judul_kti }}"</span></td>
                            <td>{{ number_format($kti->nilai_proses, 1) }}</td>
                            <td>{{ number_format($kti->nilai_tulisan, 1) }}</td>
                            <td>{{ number_format($kti->nilai_sidang, 1) }}</td>
                            <td><strong style="color:var(--teal)">{{ number_format($kti->nilai_akhir, 2) }}</strong></td>
                            <td>
                                <span class="badge light {{ $isLulus ? 'green' : 'red' }}">
                                    {{ $isLulus ? 'LULUS' : 'BELUM LULUS' }}
                                </span>
                            </td>
                            <td style="font-size:11px;color:var(--gray-500);max-width:180px">{{ $kti->catatan ?? '—' }}</td>
                            <td>
                                <button type="button" @click="loadKti('{{ $kti->siswa_id }}', '{{ addslashes($kti->judul_kti) }}', '{{ $kti->nilai_proses }}', '{{ $kti->nilai_tulisan }}', '{{ $kti->nilai_sidang }}', '{{ addslashes($kti->catatan) }}')" class="btn-small outline" style="border-radius:var(--radius-sm);cursor:pointer;font-weight:600">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" style="text-align:center;color:var(--gray-400);padding:20px">Belum ada penilaian KTI yang diinput.</td>
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
