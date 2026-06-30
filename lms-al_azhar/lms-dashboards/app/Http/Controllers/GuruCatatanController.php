<?php

namespace App\Http\Controllers;

use App\Models\CatatanWali;
use App\Models\Guru;
use Illuminate\Http\Request;

class GuruCatatanController extends Controller
{
    public function store(Request $request)
    {
        if ($request->user()->role !== 'guru') {
            return redirect()->back()->with('error', 'Hanya guru yang bisa input catatan');
        }

        $data = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'catatan' => 'required|string|max:2000',
            'semester' => 'required|string|max:50',
        ]);

        $guru = Guru::where('user_id', $request->user()->id)->firstOrFail();

        CatatanWali::updateOrCreate(
            ['siswa_id' => $data['siswa_id'], 'semester' => $data['semester']],
            ['catatan' => $data['catatan'], 'created_by' => $guru->id]
        );

        return redirect()->back()->with('success', 'Catatan wali kelas berhasil disimpan!');
    }
}
