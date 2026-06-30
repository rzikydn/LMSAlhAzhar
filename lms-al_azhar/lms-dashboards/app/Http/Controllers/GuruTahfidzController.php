<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\TahfidzSetoran;
use Illuminate\Http\Request;

class GuruTahfidzController extends Controller
{
    public function store(Request $request)
    {
        if ($request->user()->role !== 'guru') {
            return redirect()->back()->with('error', 'Hanya guru yang bisa input setoran tahfidz');
        }

        $data = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'surah' => 'required|string|max:255',
            'ayat_mulai' => 'required|integer|min:1',
            'ayat_selesai' => 'required|integer|min:1|gte:ayat_mulai',
            'jumlah_ayat' => 'required|integer|min:1',
            'status' => 'required|in:baru,murojaah',
            'nilai' => 'nullable|integer|min:0|max:100',
            'tanggal' => 'required|date',
            'catatan_guru' => 'nullable|string|max:500',
        ]);

        $guru = Guru::where('user_id', $request->user()->id)->firstOrFail();

        TahfidzSetoran::create([
            'siswa_id' => $data['siswa_id'],
            'guru_id' => $guru->id,
            'surah' => $data['surah'],
            'ayat_mulai' => $data['ayat_mulai'],
            'ayat_selesai' => $data['ayat_selesai'],
            'jumlah_ayat' => $data['jumlah_ayat'],
            'status' => $data['status'],
            'nilai' => $data['nilai'],
            'tanggal' => $data['tanggal'],
            'catatan_guru' => $data['catatan_guru'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Setoran tahfidz berhasil disimpan!');
    }
}
