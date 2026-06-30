<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use Illuminate\Http\Request;

class GuruAbsensiController extends Controller
{
    public function store(Request $request)
    {
        if ($request->user()->role !== 'guru') {
            return redirect()->back()->with('error', 'Hanya guru yang bisa input absensi');
        }

        $data = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:hadir,sakit,izin,alpha',
            'keterangan' => 'nullable|string|max:500',
        ]);

        Kehadiran::updateOrCreate(
            ['siswa_id' => $data['siswa_id'], 'tanggal' => $data['tanggal']],
            ['status' => $data['status'], 'keterangan' => $data['keterangan'] ?? null]
        );

        return redirect()->back()->with('success', 'Absensi berhasil disimpan!');
    }
}
