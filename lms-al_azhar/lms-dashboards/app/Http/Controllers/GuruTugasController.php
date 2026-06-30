<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Tugas;
use Illuminate\Http\Request;

class GuruTugasController extends Controller
{
    public function store(Request $request)
    {
        if ($request->user()->role !== 'guru') {
            return redirect()->back()->with('error', 'Hanya guru yang bisa membuat tugas');
        }

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'mapel_id' => 'required|exists:mapel,id',
            'kelas_id' => 'required|exists:kelas,id',
            'tipe' => 'required|in:tugas,ulangan',
            'tanggal_deadline' => 'required|date',
            'deskripsi' => 'nullable|string|max:2000',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,jpg,jpeg,png|max:10240',
        ]);

        $guru = Guru::where('user_id', $request->user()->id)->firstOrFail();

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('tugas/' . $guru->id, 'public');
        }

        Tugas::create([
            'judul' => $data['judul'],
            'mapel_id' => $data['mapel_id'],
            'kelas_id' => $data['kelas_id'],
            'guru_id' => $guru->id,
            'tipe' => $data['tipe'],
            'tanggal_deadline' => $data['tanggal_deadline'],
            'deskripsi' => $data['deskripsi'] ?? null,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Tugas/ulangan berhasil dibuat!');
    }
}
