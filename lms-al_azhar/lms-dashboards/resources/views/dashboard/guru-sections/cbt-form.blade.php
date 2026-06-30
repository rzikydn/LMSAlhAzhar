@extends('layouts.app')

@section('title', 'Buat Ujian CBT - LMS Al Azhar Jaya Indonesia')

@section('sidebar')
    <li>
        <a href="{{ route('dashboard') }}" style="color:var(--gray-500);text-decoration:none;display:flex;align-items:center;gap:10px;padding:10px 16px;font-size:14px;border-radius:var(--radius-sm);transition:all 0.2s">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
    </li>
    <li>
        <a href="{{ route('dashboard') }}" style="color:var(--gray-500);text-decoration:none;display:flex;align-items:center;gap:10px;padding:10px 16px;font-size:14px;border-radius:var(--radius-sm);transition:all 0.2s">
            <i class="fas fa-laptop"></i> CBT / Ulangan
        </a>
    </li>
    <li>
        <a href="{{ route('dashboard') }}" style="color:var(--gray-500);text-decoration:none;display:flex;align-items:center;gap:10px;padding:10px 16px;font-size:14px;border-radius:var(--radius-sm);transition:all 0.2s">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </li>
@endsection

@section('content')
@php
    $guru = auth()->user()->guru;
    $mapels = \App\Models\Mapel::all();
    $kelasList = \App\Models\Kelas::all();
@endphp
<div class="content-header">
    <div>
        <h1>Buat Ujian CBT Baru</h1>
        <p style="font-size:14px;color:var(--gray-400);margin-top:2px">Buat ujian berbasis komputer untuk siswa</p>
    </div>
    <div class="header-right">
        <a href="{{ route('dashboard') }}" class="header-btn outline" style="text-decoration:none;cursor:pointer"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="avatar blue">{{ strtoupper(substr($guru->nama, 0, 1)) }}</div>
    </div>
</div>

<div class="card" style="max-width:600px">
    <div class="card-header"><h3><i class="fas fa-plus" style="color:var(--teal)"></i> Informasi Ujian</h3></div>
    <form method="POST" action="{{ route('guru.cbt.store') }}" style="padding:4px 0">
        @csrf
        <div class="form-group" style="margin-bottom:14px">
            <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Judul Ujian</label>
            <input type="text" name="judul" required placeholder="Contoh: UTS Matematika Kelas 8" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font)">
        </div>
        <div class="form-group" style="margin-bottom:14px">
            <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Tipe Ujian</label>
            <select name="tipe" required class="form-select" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font);background:var(--white)">
                <option value="ulangan">Ulangan Harian</option>
                <option value="uts">UTS (Mid Semester)</option>
                <option value="uas">UAS (Akhir Semester)</option>
            </select>
        </div>
        <div class="form-group" style="margin-bottom:14px">
            <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Deskripsi (opsional)</label>
            <textarea name="deskripsi" rows="3" placeholder="Deskripsi ujian..." style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font);resize:vertical"></textarea>
        </div>
        <div style="display:flex;gap:10px;margin-bottom:14px">
            <div class="form-group" style="flex:1">
                <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Mata Pelajaran</label>
                <select name="mapel_id" required class="form-select" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font);background:var(--white)">
                    <option value="">Pilih Mapel</option>
                    @foreach($mapels as $m)
                    <option value="{{ $m->id }}">{{ $m->nama_mapel }} ({{ $m->kode }})</option>
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
        <div class="form-group" style="margin-bottom:16px">
            <label style="display:block;font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Durasi (menit)</label>
            <input type="number" name="durasi" required value="60" min="1" max="300" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:var(--radius-sm);font-size:14px;font-family:var(--font)">
        </div>
        <button type="submit" class="btn-login" style="cursor:pointer;border:none"><i class="fas fa-save"></i> Simpan & Lanjutkan</button>
    </form>
</div>
@endsection
