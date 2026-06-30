<?php

namespace App\Http\Controllers;

use App\Models\CatatanWali;
use App\Models\Kehadiran;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\TahfidzSetoran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RaporController extends Controller
{
    public function pdf(Request $request)
    {
        $user = $request->user();
        $role = $user->role;

        if (in_array($role, ['siswa_sd', 'siswa_smp'])) {
            $siswa = $user->siswa;
        } elseif ($role === 'orang_tua') {
            $siswa = Siswa::find($request->get('siswa_id'));
            if (!$siswa) return redirect()->back()->with('error', 'Siswa tidak ditemukan');
        } else {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $kelas = $siswa->kelas;
        $nilai = Nilai::where('siswa_id', $siswa->id)->with('mapel')->get();
        $rata = round($nilai->avg('nilai') ?? 0, 1);
        $catatanWali = CatatanWali::where('siswa_id', $siswa->id)->latest()->first();
        $kehadiran = Kehadiran::where('siswa_id', $siswa->id)->get();
        $totalHadir = $kehadiran->where('status', 'hadir')->count();
        $totalSakit = $kehadiran->where('status', 'sakit')->count();
        $totalIzin = $kehadiran->where('status', 'izin')->count();
        $totalAlpha = $kehadiran->where('status', 'alpha')->count();
        $tahfidz = TahfidzSetoran::where('siswa_id', $siswa->id)->sum('jumlah_ayat');
        $kkm = str_contains($kelas?->nama_kelas ?? '', 'SD') ? setting('kkm_sd') : setting('kkm_smp');

        $pdf = Pdf::loadView('rapor-pdf', compact(
            'siswa', 'kelas', 'nilai', 'rata', 'catatanWali',
            'kehadiran', 'totalHadir', 'totalSakit', 'totalIzin', 'totalAlpha',
            'tahfidz', 'kkm'
        ));

        return $pdf->download('rapor-' . $siswa->nama . '.pdf');
    }
}
