<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kehadiran;
use App\Models\CatatanWali;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Pengumuman;
use App\Models\Pesan;
use App\Models\Siswa;
use App\Models\TahfidzSetoran;
use App\Models\Tugas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->user()->role;

        $views = [
            'siswa_sd' => 'dashboard.siswa-sd',
            'siswa_smp' => 'dashboard.siswa-smp',
            'guru' => 'dashboard.guru',
            'orang_tua' => 'dashboard.orang-tua',
            'admin' => 'dashboard.admin',
        ];

        $view = $views[$role] ?? 'dashboard';
        $data = [];

        if ($role === 'siswa_sd') {
            $user = $request->user();
            $siswa = $user->siswa;
            $kelas = $siswa->kelas;

            $data = [
                'user' => $user,
                'siswa' => $siswa,
                'kelas' => $kelas,
                'mapels' => Mapel::all(),
                'jadwalHariIni' => Jadwal::where('kelas_id', $kelas->id)
                    ->where('hari', now()->locale('id')->dayName)
                    ->with('mapel', 'guru')
                    ->orderBy('jam_mulai')
                    ->get(),
                'semuaJadwal' => Jadwal::where('kelas_id', $kelas->id)
                    ->with('mapel', 'guru')
                    ->orderBy('hari')
                    ->orderBy('jam_mulai')
                    ->get(),
                'tugas' => Tugas::where('kelas_id', $kelas->id)
                    ->where('tipe', 'tugas')
                    ->with('mapel')
                    ->orderBy('tanggal_deadline')
                    ->get(),
                'ulangan' => Tugas::where('kelas_id', $kelas->id)
                    ->where('tipe', 'ulangan')
                    ->with('mapel')
                    ->orderBy('tanggal_deadline')
                    ->get(),
                'nilai' => Nilai::where('siswa_id', $siswa->id)
                    ->with('mapel')
                    ->get(),
                'tahfidzSetoran' => TahfidzSetoran::where('siswa_id', $siswa->id)
                    ->with('guru')
                    ->orderBy('tanggal', 'desc')
                    ->get(),
                'pengumuman' => Pengumuman::orderBy('created_at', 'desc')->get(),
                'pesan' => Pesan::where('penerima_id', $user->id)
                    ->with('pengirim')
                    ->orderBy('created_at', 'desc')
                    ->get(),
                'guruKelas' => $kelas->load('siswa'),
                'kehadiran' => Kehadiran::where('siswa_id', $siswa->id)
                    ->orderBy('tanggal', 'desc')
                    ->get(),
                'catatanWali' => CatatanWali::where('siswa_id', $siswa->id)
                    ->with('guru')
                    ->latest()
                    ->first(),
                'badges' => Badge::with(['siswa' => function ($q) use ($siswa) {
                    $q->where('siswa_id', $siswa->id);
                }])->get(),
                'guruUsers' => \App\Models\User::where('role', 'guru')->get(),
                'nilaiChart' => Nilai::where('siswa_id', $siswa->id)
                    ->with('mapel')
                    ->get()
                    ->map(fn($n) => ['nama_mapel' => $n->mapel->nama_mapel ?? $n->mapel->kode ?? 'Mapel', 'nilai' => $n->nilai]),
            ];

            // === PERINGKAT KELAS ===
            $siswaKelas = \App\Models\Siswa::where('kelas_id', $kelas->id)->get();
            $rataMap = [];
            foreach ($siswaKelas as $s) {
                $rataMap[$s->id] = round(Nilai::where('siswa_id', $s->id)->avg('nilai'), 1);
            }
            arsort($rataMap);
            $rank = 1;
            $total = count($rataMap);
            foreach ($rataMap as $id => $r) {
                if ($id === $siswa->id) break;
                $rank++;
            }
            $data['peringkat'] = ['rank' => $rank, 'total' => $total];
        }

        if ($role === 'guru') {
            $user = $request->user();
            $guru = Guru::where('user_id', $user->id)->first();

            $kelasIds = Jadwal::where('guru_id', $guru->id)->pluck('kelas_id')->unique();
            $kelasYangDiajar = Kelas::whereIn('id', $kelasIds)->withCount('siswa')->get()->map(function ($k) use ($guru) {
                $siswaIds = Siswa::where('kelas_id', $k->id)->pluck('id');
                $k->rataNilai = round(Nilai::whereIn('siswa_id', $siswaIds)
                    ->whereHas('mapel', fn($q) => $q->where('kode', $guru->mapel->kode))
                    ->avg('nilai') ?? 0, 1);
                $k->siswa = Siswa::where('kelas_id', $k->id)->get();
                return $k;
            });

            $data = [
                'user' => $user,
                'guru' => $guru,
                'kelasYangDiajar' => $kelasYangDiajar,
                'tugas' => Tugas::where('guru_id', $guru->id)->with('kelas', 'mapel')->orderBy('tanggal_deadline')->get(),
                'pengumuman' => Pengumuman::orderBy('created_at', 'desc')->get(),
                'pesan' => Pesan::where('penerima_id', $user->id)->with('pengirim')->orderBy('created_at', 'desc')->get(),
            ];
        }

        if ($role === 'orang_tua') {
            $user = $request->user();
            $ortu = \App\Models\OrangTua::where('user_id', $user->id)->first();
            $anak = $ortu ? $ortu->siswa()->with('kelas')->get() : collect();

            $data = [
                'user' => $user,
                'ortu' => $ortu,
                'anak' => $anak,
                'daftarGuru' => Guru::with('mapel')->get(),
                'pengumuman' => \App\Models\Pengumuman::orderBy('created_at', 'desc')->get(),
                'pesanGuru' => \App\Models\Pesan::where('penerima_id', $user->id)
                    ->with('pengirim')
                    ->orderBy('created_at', 'desc')
                    ->get(),
            ];
        }

        if ($role === 'siswa_smp') {
            $user = $request->user();
            $siswa = $user->siswa;
            $kelas = $siswa->kelas;

            $data = [
                'user' => $user,
                'siswa' => $siswa,
                'kelas' => $kelas,
                'mapels' => Mapel::all(),
                'jadwalHariIni' => Jadwal::where('kelas_id', $kelas->id)
                    ->where('hari', now()->locale('id')->dayName)
                    ->with('mapel', 'guru')
                    ->orderBy('jam_mulai')
                    ->get(),
                'semuaJadwal' => Jadwal::where('kelas_id', $kelas->id)
                    ->with('mapel', 'guru')
                    ->orderBy('hari')
                    ->orderBy('jam_mulai')
                    ->get(),
                'tugas' => Tugas::where('kelas_id', $kelas->id)
                    ->where('tipe', 'tugas')
                    ->with('mapel')
                    ->orderBy('tanggal_deadline')
                    ->get(),
                'ulangan' => Tugas::where('kelas_id', $kelas->id)
                    ->where('tipe', 'ulangan')
                    ->with('mapel')
                    ->orderBy('tanggal_deadline')
                    ->get(),
                'nilai' => Nilai::where('siswa_id', $siswa->id)
                    ->with('mapel')
                    ->get(),
                'tahfidzSetoran' => TahfidzSetoran::where('siswa_id', $siswa->id)
                    ->with('guru')
                    ->orderBy('tanggal', 'desc')
                    ->get(),
                'pengumuman' => Pengumuman::orderBy('created_at', 'desc')->get(),
                'pesan' => Pesan::where('penerima_id', $user->id)
                    ->with('pengirim')
                    ->orderBy('created_at', 'desc')
                    ->get(),
                'kehadiran' => Kehadiran::where('siswa_id', $siswa->id)
                    ->orderBy('tanggal', 'desc')
                    ->get(),
                'catatanWali' => CatatanWali::where('siswa_id', $siswa->id)
                    ->with('guru')
                    ->latest()
                    ->first(),
                'badges' => Badge::with(['siswa' => function ($q) use ($siswa) {
                    $q->where('siswa_id', $siswa->id);
                }])->get(),
                'guruUsers' => \App\Models\User::where('role', 'guru')->get(),
                'nilaiChart' => Nilai::where('siswa_id', $siswa->id)
                    ->with('mapel')
                    ->get()
                    ->map(fn($n) => ['nama_mapel' => $n->mapel->nama_mapel ?? $n->mapel->kode ?? 'Mapel', 'nilai' => $n->nilai]),
            ];

            // === PERINGKAT KELAS ===
            $siswaKelas = \App\Models\Siswa::where('kelas_id', $kelas->id)->get();
            $rataMap = [];
            foreach ($siswaKelas as $s) {
                $rataMap[$s->id] = round(Nilai::where('siswa_id', $s->id)->avg('nilai'), 1);
            }
            arsort($rataMap);
            $rank = 1;
            $total = count($rataMap);
            foreach ($rataMap as $id => $r) {
                if ($id === $siswa->id) break;
                $rank++;
            }
            $data['peringkat'] = ['rank' => $rank, 'total' => $total];
        }

        return view($view, $data);
    }
}
