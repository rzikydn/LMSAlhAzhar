<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\LaporanMengajar;
use Illuminate\Http\Request;

class GuruLaporanController extends Controller
{
    public function store(Request $request)
    {
        if ($request->user()->role !== 'guru') {
            return redirect()->back()->with('error', 'Hanya guru yang bisa input laporan mengajar');
        }

        $guru = Guru::where('user_id', $request->user()->id)->firstOrFail();

        $data = $request->validate([
            'tipe' => 'required|in:harian,mingguan,bulanan',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        LaporanMengajar::updateOrCreate(
            [
                'guru_id' => $guru->id,
                'tipe' => $data['tipe'],
                'tanggal' => $data['tanggal'],
            ],
            [
                'isi' => $data['isi'],
            ]
        );

        return redirect()->back()->with('success', 'Laporan mengajar berhasil dikirim!');
    }
}
