<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class GuruNilaiController extends Controller
{
    public function store(Request $request)
    {
        if ($request->user()->role !== 'guru') {
            return redirect()->back()->with('error', 'Hanya guru yang bisa input nilai');
        }

        $data = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'mapel_id' => 'required|exists:mapel,id',
            'nilai' => 'required|numeric|min:0|max:100',
            'jenis_nilai' => 'required|in:biasa,unggulan',
            'nilai_bahasa' => 'nullable|numeric|min:0|max:100',
        ]);

        Nilai::updateOrCreate(
            [
                'siswa_id' => $data['siswa_id'], 
                'mapel_id' => $data['mapel_id'],
                'jenis_nilai' => $data['jenis_nilai']
            ],
            [
                'nilai' => $data['nilai'],
                'nilai_bahasa' => $data['nilai_bahasa'] ?? null,
            ]
        );

        return redirect()->back()->with('success', 'Nilai berhasil disimpan!');
    }
}
