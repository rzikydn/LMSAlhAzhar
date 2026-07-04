<div class="content-header">
    <h1>Karya Tulis Ilmiah (KTI) Saya <span>SMPIT {{ setting('school_name') }}</span></h1>
    <div class="header-right">
        <div class="avatar blue">{{ strtoupper(substr($siswa->nama, 0, 1)) }}</div>
    </div>
</div>

@if(!$nilaiKti)
    <div class="card" style="text-align:center;padding:40px 20px">
        <div style="font-size:48px;color:var(--gray-300);margin-bottom:16px"><i class="fas fa-file-signature"></i></div>
        <h3 style="font-size:18px;font-weight:700;color:var(--gray-700);margin-bottom:8px">Belum Ada Penilaian KTI</h3>
        <p style="font-size:14px;color:var(--gray-500);max-width:500px;margin:0 auto;line-height:1.6">
            Pembimbing atau Dewan Penguji belum memasukkan penilaian Karya Tulis Ilmiah Anda ke dalam sistem. Silakan berkoordinasi dengan Guru pembimbing Anda.
        </p>
    </div>
@else
    @php $isLulus = $nilaiKti->nilai_akhir >= 75.00; @endphp

    <div class="card" style="margin-bottom:20px;background:linear-gradient(135deg, var(--blue-bg), var(--white))">
        <span style="font-size:11px;font-weight:700;color:var(--blue);text-transform:uppercase;letter-spacing:1px">Judul Karya Tulis Ilmiah</span>
        <h2 style="font-size:20px;font-weight:800;color:var(--gray-800);margin-top:6px;line-height:1.4;font-style:italic">
            "{{ $nilaiKti->judul_kti }}"
        </h2>
    </div>

    <div class="grid-2" style="margin-bottom:20px">
        <!-- Skor Akhir -->
        <div class="card" style="display:flex;flex-direction:column;justify-content:center;align-items:center;padding:30px 20px;text-align:center">
            <span style="font-size:13px;font-weight:600;color:var(--gray-400);text-transform:uppercase;margin-bottom:10px">Nilai Akhir KTI</span>
            <div style="font-size:64px;font-weight:900;color:var(--blue);line-height:1;margin-bottom:14px">
                {{ number_format($nilaiKti->nilai_akhir, 2) }}
            </div>
            <span class="badge {{ $isLulus ? 'green' : 'red' }}" style="font-size:14px;padding:8px 24px;font-weight:700;border-radius:20px;letter-spacing:1px">
                {{ $isLulus ? 'LULUS SYARAT' : 'BELUM LULUS' }}
            </span>
            <p style="font-size:11px;color:var(--gray-400);margin-top:12px">Nilai KKM kelulusan KTI: 75.00</p>
        </div>

        <!-- Rincian Komponen -->
        <div class="card">
            <div class="card-header" style="margin-bottom:16px">
                <h3><i class="fas fa-chart-pie" style="color:var(--blue)"></i> Komponen Penilaian</h3>
            </div>
            <div style="display:flex;flex-direction:column;gap:18px">
                <!-- Proses -->
                <div>
                    <div style="display:flex;justify-content:space-between;margin-bottom:6px;font-size:13px">
                        <span style="font-weight:600"><i class="fas fa-microscope" style="color:var(--teal)"></i> Proses Riset &amp; Bimbingan (30%)</span>
                        <strong style="color:var(--gray-700)">{{ number_format($nilaiKti->nilai_proses, 1) }} / 100</strong>
                    </div>
                    <div style="height:8px;background:var(--gray-100);border-radius:4px;overflow:hidden">
                        <div style="height:100%;width:{{ $nilaiKti->nilai_proses }}%;background:var(--teal);border-radius:4px"></div>
                    </div>
                </div>

                <!-- Naskah -->
                <div>
                    <div style="display:flex;justify-content:space-between;margin-bottom:6px;font-size:13px">
                        <span style="font-weight:600"><i class="fas fa-file-alt" style="color:var(--indigo)"></i> Hasil Naskah / Tulisan (40%)</span>
                        <strong style="color:var(--gray-700)">{{ number_format($nilaiKti->nilai_tulisan, 1) }} / 100</strong>
                    </div>
                    <div style="height:8px;background:var(--gray-100);border-radius:4px;overflow:hidden">
                        <div style="height:100%;width:{{ $nilaiKti->nilai_tulisan }}%;background:var(--indigo);border-radius:4px"></div>
                    </div>
                </div>

                <!-- Sidang -->
                <div>
                    <div style="display:flex;justify-content:space-between;margin-bottom:6px;font-size:13px">
                        <span style="font-weight:600"><i class="fas fa-chalkboard-teacher" style="color:var(--orange)"></i> Presentasi Sidang KTI (30%)</span>
                        <strong style="color:var(--gray-700)">{{ number_format($nilaiKti->nilai_sidang, 1) }} / 100</strong>
                    </div>
                    <div style="height:8px;background:var(--gray-100);border-radius:4px;overflow:hidden">
                        <div style="height:100%;width:{{ $nilaiKti->nilai_sidang }}%;background:var(--orange);border-radius:4px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Catatan & Feedback -->
    <div class="card">
        <div class="card-header" style="margin-bottom:12px">
            <h3><i class="fas fa-comment-alt" style="color:var(--purple)"></i> Catatan &amp; Feedback Penguji</h3>
        </div>
        <div style="background:var(--gray-100);padding:16px 20px;border-left:4px solid var(--purple);border-radius:var(--radius-sm)">
            <p style="font-size:13px;line-height:1.6;color:var(--gray-700);margin:0;font-style:italic">
                "{{ $nilaiKti->catatan ?? 'Tidak ada catatan revisi dari penguji.' }}"
            </p>
        </div>
    </div>
@endif
