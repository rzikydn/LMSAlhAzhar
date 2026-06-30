<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class GuruKelasController extends Controller
{
    public function store(Request $request)
    {
        if ($request->user()->role !== 'guru') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $data = $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'tingkat' => 'required|string|max:20',
        ]);

        $guru = Guru::where('user_id', $request->user()->id)->firstOrFail();

        Kelas::create([
            'nama_kelas' => $data['nama_kelas'],
            'tingkat' => $data['tingkat'],
            'guru_id' => $guru->id,
        ]);

        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan!');
    }
}
