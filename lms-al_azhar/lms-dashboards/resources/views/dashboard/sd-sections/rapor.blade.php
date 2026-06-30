@php
    $gradeColor = function($v) {
        if ($v >= 90) return 'grade-A';
        if ($v >= 85) return 'grade-B';
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
    $rata = round($nilai->avg('nilai'), 1);
    $totalHadir = $kehadiran->where('status', 'hadir')->count();
    $totalSakit = $kehadiran->where('status', 'sakit')->count();
    $totalIzin = $kehadiran->where('status', 'izin')->count();
    $totalAlpha = $kehadiran->where('status', 'alpha')->count();
@endphp
<div class="sd-content sd-content-rapor">
      <div class="content-header"><div><h1>Rapor Semester</h1><p style="font-size:14px;color:var(--gray-400);margin-top:2px">Laporan hasil belajar siswa — {{ $catatanWali?->semester ?? setting('semester_aktif') }}</p></div><div class="header-right"><a href="{{ route('rapor.pdf') }}" target="_blank" class="header-btn primary"><i class="fas fa-file-pdf"></i> PDF</a><a @click="window.print();return false" class="header-btn primary" style="cursor:pointer"><i class="fas fa-print"></i> Cetak</a><div class="avatar teal">{{ strtoupper(substr($siswa->nama, 0, 1)) }}</div></div></div>
  <div class="card" style="margin-bottom:20px">
    <div class="card-header"><h3><i class="fas fa-user-graduate" style="color:var(--teal)"></i> Identitas Siswa</h3></div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;padding:4px 0">
      <div><span style="font-size:12px;color:var(--gray-400)">Nama</span><div style="font-weight:600">{{ $siswa->nama }}</div></div>
      <div><span style="font-size:12px;color:var(--gray-400)">NIS</span><div style="font-weight:600">{{ $siswa->nis }}</div></div>
      <div><span style="font-size:12px;color:var(--gray-400)">Kelas</span><div style="font-weight:600">{{ $kelas->nama_kelas }}</div></div>
      <div><span style="font-size:12px;color:var(--gray-400)">Semester</span><div style="font-weight:600">{{ $catatanWali?->semester ?? setting('semester_aktif') }}</div></div>
    </div>
  </div>
  <div class="card" style="margin-bottom:20px">
    <div class="card-header"><h3><i class="fas fa-file-invoice" style="color:var(--blue)"></i> Nilai Akademik</h3></div>
    <div class="table-wrap">
      <table><thead><tr><th>No</th><th>Mata Pelajaran</th><th>KKM</th><th>Nilai</th><th>Grade</th><th>Predikat</th></tr></thead>
      <tbody>
        @foreach($nilai as $n)
        <tr><td>{{ $loop->iteration }}</td><td>{{ $n->mapel->nama_mapel }}</td><td>{{ setting('kkm_sd') }}</td><td style="font-weight:700">{{ $n->nilai }}</td><td><span class="{{ $gradeColor($n->nilai) }}">{{ $gradeLetter($n->nilai) }}</span></td><td>{{ $n->nilai >= 90 ? 'Sangat Baik' : ($n->nilai >= 80 ? 'Baik' : 'Cukup') }}</td></tr>
        @endforeach
      </tbody>
    </table></div>
    <div style="margin-top:16px;padding-top:14px;border-top:1px solid var(--border-light);display:flex;justify-content:space-between;flex-wrap:wrap;gap:12px">
      <div><span style="font-size:12px;color:var(--gray-400)">Rata-rata</span><div style="font-size:20px;font-weight:700;color:var(--teal)">{{ $rata }}</div></div>
      <div><span style="font-size:12px;color:var(--gray-400)">Peringkat Kelas</span><div style="font-size:20px;font-weight:700;color:var(--blue)">{{ $peringkat['rank'] }} / {{ $peringkat['total'] }}</div></div>
      <div><span style="font-size:12px;color:var(--gray-400)">Status</span><div style="font-size:20px;font-weight:700;color:var(--green)">{{ $rata >= setting('kkm_sd') ? 'LULUS' : 'TIDAK LULUS' }}</div></div>
    </div>
  </div>
  <div style="display:flex;gap:16px;flex-wrap:wrap">
    <div class="card" style="flex:1;min-width:200px">
      <div class="card-header"><h3><i class="fas fa-star" style="color:var(--orange)"></i> Catatan Wali Kelas</h3></div>
      @if($catatanWali)
        <p style="font-size:14px;color:var(--gray-500);line-height:1.7;font-style:italic">&quot;{{ $catatanWali->catatan }}&quot;</p>
        <p style="font-size:12px;color:var(--gray-400);margin-top:8px">— {{ $catatanWali->guru->nama }}, Wali Kelas {{ $kelas->nama_kelas }}</p>
      @else
        <p style="font-size:14px;color:var(--gray-400);font-style:italic">Belum ada catatan wali kelas.</p>
      @endif
    </div>
    <div class="card" style="flex:1;min-width:200px">
      <div class="card-header"><h3><i class="fas fa-calendar-check" style="color:var(--teal)"></i> Ringkasan Kehadiran</h3></div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
        <div><span style="font-size:12px;color:var(--gray-400)">Hadir</span><div style="font-weight:700;color:var(--green)">{{ $totalHadir }} Hari</div></div>
        <div><span style="font-size:12px;color:var(--gray-400)">Sakit</span><div style="font-weight:700;color:var(--orange)">{{ $totalSakit }} Hari</div></div>
        <div><span style="font-size:12px;color:var(--gray-400)">Izin</span><div style="font-weight:700;color:var(--blue)">{{ $totalIzin }} Hari</div></div>
        <div><span style="font-size:12px;color:var(--gray-400)">Alpha</span><div style="font-weight:700;color:var(--red)">{{ $totalAlpha }} Hari</div></div>
      </div>
    </div>
  </div>
</div>
