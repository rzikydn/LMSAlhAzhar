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
    $barColors = ['green', 'teal', 'blue', 'orange', 'purple', 'pink', 'cyan'];
@endphp
<div class="content-header">
    <h1>Nilai <span>SMPIT {{ setting('school_name') }}</span></h1>
    <div class="header-right">
        <div class="avatar blue">{{ strtoupper(substr($siswa->nama, 0, 1)) }}</div>
    </div>
</div>
<div class="grid-2">
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-file-invoice" style="color:var(--blue)"></i> Rapor Semester Genap</h3><label @click="tab='rapor'" style="font-size:12px;color:var(--blue);font-weight:600;cursor:pointer;text-decoration:none">Cetak</label></div>
        @foreach($nilai as $n)
        <div class="rapor-item"><span class="rapor-mapel">{{ $n->mapel->nama_mapel }}</span><span class="rapor-nilai {{ $gradeColor($n->nilai) }}">{{ $n->nilai }} ({{ $gradeLetter($n->nilai) }})</span></div>
        @endforeach
    </div>
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-chart-bar" style="color:var(--teal)"></i> Statistik Nilai</h3></div>
        <div class="h-bar-group">
            @foreach($nilai as $n)
            <div class="h-bar-row"><div class="h-bar-label">{{ $n->mapel->kode }}</div><div class="h-bar-track"><div class="h-bar-fill {{ $barColors[$loop->index % count($barColors)] }}" style="width:{{ $n->nilai }}%">{{ $n->nilai }}</div></div></div>
            @endforeach
        </div>
    </div>
</div>
