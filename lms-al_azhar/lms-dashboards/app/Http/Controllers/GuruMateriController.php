<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Materi;
use Illuminate\Http\Request;

class GuruMateriController extends Controller
{
    public function store(Request $request)
    {
        if ($request->user()->role !== 'guru') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:2000',
            'tipe' => 'required|in:materi,referensi,tugas',
            'mapel_id' => 'required|exists:mapel,id',
            'kelas_id' => 'nullable|exists:kelas,id',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,jpg,jpeg,png,mp4,mp3|max:51200',
        ]);

        $guru = Guru::where('user_id', $request->user()->id)->firstOrFail();
        $filePath = $request->file('file')->store('materi/' . $guru->id, 'public');

        Materi::create([
            'judul' => $data['judul'],
            'deskripsi' => $data['deskripsi'] ?? null,
            'file_path' => $filePath,
            'tipe' => $data['tipe'],
            'mapel_id' => $data['mapel_id'],
            'kelas_id' => $data['kelas_id'] ?? null,
            'guru_id' => $guru->id,
        ]);

        return redirect()->back()->with('success', 'Materi berhasil diupload!');
    }
}
