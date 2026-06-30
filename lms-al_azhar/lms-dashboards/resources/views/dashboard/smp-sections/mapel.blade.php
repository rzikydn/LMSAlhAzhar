@php $cardColors = ['green', 'teal', 'blue', 'orange light', 'purple light', 'cyan light', 'pink light']; @endphp
<div class="content-header">
    <h1>Mata Pelajaran <span>SMPIT {{ setting('school_name') }}</span></h1>
    <div class="header-right">
        <div class="avatar blue">{{ strtoupper(substr($siswa->nama, 0, 1)) }}</div>
    </div>
</div>
<div class="grid-2">
    @foreach($mapels as $m)
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-book" style="color:var(--{{ $cardColors[$loop->index % count($cardColors)] }})"></i> {{ $m->nama_mapel }}</h3></div>
        <p style="font-size:13px;color:var(--gray-400)">Kode: {{ $m->kode }}</p>
    </div>
    @endforeach
</div>
