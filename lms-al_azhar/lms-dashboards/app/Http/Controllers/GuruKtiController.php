<?php

namespace App\Http\Controllers;

use App\Models\NilaiKti;
use App\Models\Siswa;
use Illuminate\Http\Request;

class GuruKtiController extends Controller
{
    public function store(Request $request)
    {
        if ($request->user()->role !== 'guru') {
            return redirect()->back()->with('error', 'Hanya guru yang bisa input nilai KTI');
        }

        $data = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'judul_kti' => 'required|string|max:255',
            'nilai_proses' => 'required|numeric|min:0|max:100',
            'nilai_tulisan' => 'required|numeric|min:0|max:100',
            'nilai_sidang' => 'required|numeric|min:0|max:100',
            'catatan' => 'nullable|string',
        ]);

        // Calculate weighted final grade
        $nilaiAkhir = ($data['nilai_proses'] * 0.30) + ($data['nilai_tulisan'] * 0.40) + ($data['nilai_sidang'] * 0.30);

        NilaiKti::updateOrCreate(
            ['siswa_id' => $data['siswa_id']],
            [
                'judul_kti' => $data['judul_kti'],
                'nilai_proses' => $data['nilai_proses'],
                'nilai_tulisan' => $data['nilai_tulisan'],
                'nilai_sidang' => $data['nilai_sidang'],
                'nilai_akhir' => round($nilaiAkhir, 2),
                'catatan' => $data['catatan'] ?? null,
            ]
        );

        return redirect()->back()->with('success', 'Nilai KTI berhasil disimpan!');
    }
}
