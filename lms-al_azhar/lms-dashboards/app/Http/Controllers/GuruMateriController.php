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

        $materi = Materi::create([
            'judul' => $data['judul'],
            'deskripsi' => $data['deskripsi'] ?? null,
            'file_path' => $filePath,
            'tipe' => $data['tipe'],
            'mapel_id' => $data['mapel_id'],
            'kelas_id' => $data['kelas_id'] ?? null,
            'guru_id' => $guru->id,
            'status' => 'draft',
        ]);

        // Evaluate checklist to update status
        $checklist = $materi->checklist();
        if ($checklist['is_ready']) {
            $materi->update(['status' => 'pending']);
        }

        return redirect()->back()->with('success', 'Materi berhasil diupload! Status: ' . ($materi->status === 'pending' ? 'Menunggu Persetujuan' : 'Draft (Belum Lengkap)'));
    }

    public function update(Request $request, Materi $materi)
    {
        if ($request->user()->role !== 'guru' || $materi->guru_id !== Guru::where('user_id', $request->user()->id)->firstOrFail()->id) {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:2000',
            'tipe' => 'required|in:materi,referensi,tugas',
            'mapel_id' => 'required|exists:mapel,id',
            'kelas_id' => 'nullable|exists:kelas,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,jpg,jpeg,png,mp4,mp3|max:51200',
        ]);

        $updateData = [
            'judul' => $data['judul'],
            'deskripsi' => $data['deskripsi'] ?? null,
            'tipe' => $data['tipe'],
            'mapel_id' => $data['mapel_id'],
            'kelas_id' => $data['kelas_id'] ?? null,
        ];

        if ($request->hasFile('file')) {
            $guru = Guru::where('user_id', $request->user()->id)->firstOrFail();
            $filePath = $request->file('file')->store('materi/' . $guru->id, 'public');
            $updateData['file_path'] = $filePath;
        }

        $materi->update($updateData);

        // Re-evaluate checklist
        $checklist = $materi->checklist();
        $newStatus = $checklist['is_ready'] ? 'pending' : 'draft';
        $materi->update(['status' => $newStatus]);

        return redirect()->back()->with('success', 'Materi berhasil diperbarui! Status: ' . ($newStatus === 'pending' ? 'Menunggu Persetujuan' : 'Draft (Belum Lengkap)'));
    }

    public function destroy(Request $request, Materi $materi)
    {
        if ($request->user()->role !== 'guru' || $materi->guru_id !== Guru::where('user_id', $request->user()->id)->firstOrFail()->id) {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $materi->delete();

        return redirect()->back()->with('success', 'Materi berhasil dihapus!');
    }

    public function approve(Request $request, Materi $materi)
    {
        if ($request->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $materi->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Materi ajar berhasil disetujui!');
    }

    public function reject(Request $request, Materi $materi)
    {
        if ($request->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $materi->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Materi ajar ditolak!');
    }
}
