<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function nilaiCsv(Request $request)
    {
        if ($request->user()->role !== 'guru') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $guru = Guru::where('user_id', $request->user()->id)->firstOrFail();
        $siswaIds = Siswa::whereIn('kelas_id', function ($q) use ($guru) {
            $q->select('kelas_id')->from('jadwal')->where('guru_id', $guru->id);
        })->pluck('id');

        $nilai = Nilai::whereIn('siswa_id', $siswaIds)
            ->whereHas('mapel', fn($q) => $q->where('id', $guru->mapel_id))
            ->with('siswa', 'siswa.kelas', 'mapel')
            ->get();

        $filename = 'nilai_' . $guru->mapel->kode . '_' . now()->format('Ymd') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($nilai) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($handle, ['No', 'NIS', 'Nama', 'Kelas', 'Mapel', 'Nilai']);
            foreach ($nilai as $i => $n) {
                fputcsv($handle, [
                    $i + 1,
                    $n->siswa->nis ?? '-',
                    $n->siswa->nama ?? '-',
                    $n->siswa->kelas->nama_kelas ?? '-',
                    $n->mapel->nama_mapel ?? '-',
                    $n->nilai,
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
