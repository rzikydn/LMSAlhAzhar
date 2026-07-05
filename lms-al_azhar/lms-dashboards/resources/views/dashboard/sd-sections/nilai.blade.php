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
    $getStatus = function($v, $kkm = 70) {
        if ($v >= 90) return ['label' => 'Bagus Banget', 'class' => 'status-bagus-banget'];
        if ($v >= 80) return ['label' => 'Bagus', 'class' => 'status-bagus'];
        if ($v >= $kkm) return ['label' => 'Perlu Belajar Lagi', 'class' => 'status-perlu-belajar'];
        return ['label' => 'Perlu Diulang', 'class' => 'status-perlu-diulang'];
    };
    $barColors = ['green', 'teal', 'blue', 'orange', 'purple', 'pink', 'cyan'];
    $rata = $nilai->avg('nilai');
@endphp
<style>
    .status-badge {
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        display: inline-block;
    }
    .status-bagus-banget {
        background-color: #e6fffa;
        color: #047857;
        border: 1px solid #b2f5ea;
    }
    .status-bagus {
        background-color: #ebf8ff;
        color: #0284c7;
        border: 1px solid #bee3f8;
    }
    .status-perlu-belajar {
        background-color: #fffaf0;
        color: #dd6b20;
        border: 1px solid #feebc8;
    }
    .status-perlu-diulang {
        background-color: #fff5f5;
        color: #e53e3e;
        border: 1px solid #fed7d7;
    }
</style>
<div class="sd-content sd-content-nilai">
  <div class="content-header"><h1>Nilai <span>SDIT {{ setting('school_name') }}</span></h1><div class="header-right"><div class="avatar teal">{{ strtoupper(substr($siswa->nama, 0, 1)) }}</div></div></div>
  <div class="grid-2">
    <div class="card"><div class="card-header"><h3><i class="fas fa-file-invoice" style="color:var(--blue)"></i> Rapor Semester Genap</h3><label @click="tab='rapor'" style="font-size:12px;color:var(--blue);font-weight:600;cursor:pointer;text-decoration:none">Cetak</label></div>
      @foreach($nilai as $n)
      @php $status = $getStatus($n->nilai, setting('kkm_sd')); @endphp
      <div class="rapor-item">
          <span class="rapor-mapel">{{ $n->mapel->nama_mapel }}</span>
          <div style="display:flex; align-items:center; gap:8px">
              <span class="rapor-nilai {{ $gradeColor($n->nilai) }}">{{ $n->nilai }} ({{ $gradeLetter($n->nilai) }})</span>
              <span class="status-badge {{ $status['class'] }}">{{ $status['label'] }}</span>
          </div>
      </div>
      @endforeach
    </div>
    <div class="card"><div class="card-header"><h3><i class="fas fa-chart-bar" style="color:var(--teal)"></i> Statistik Nilai</h3></div>
      <div class="h-bar-group">
        @foreach($nilai as $n)
        <div class="h-bar-row"><div class="h-bar-label">{{ $n->mapel->kode }}</div><div class="h-bar-track"><div class="h-bar-fill {{ $barColors[$loop->index % count($barColors)] }}" style="width:{{ $n->nilai }}%">{{ $n->nilai }}</div></div></div>
        @endforeach
      </div>
    </div>
  </div>
</div>
