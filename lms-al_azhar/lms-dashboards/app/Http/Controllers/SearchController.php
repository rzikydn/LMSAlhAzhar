<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->get('q');
        if (strlen($q) < 2) {
            return response()->json([]);
        }

        $results = collect();

        $role = $request->user()->role;

        if (in_array($role, ['siswa_sd', 'siswa_smp', 'guru', 'admin'])) {
            $siswa = Siswa::where('nama', 'like', "%{$q}%")->limit(5)->get()->map(function($s) {
                return ['type' => 'Siswa', 'label' => $s->nama, 'url' => '#'];
            });
            $results = $results->concat($siswa);
        }

        if (in_array($role, ['guru', 'admin'])) {
            $guru = Guru::whereHas('user', fn($q2) => $q2->where('name', 'like', "%{$q}%"))
                ->limit(5)->get()->map(function($g) {
                    return ['type' => 'Guru', 'label' => $g->user->name, 'url' => '#'];
                });
            $results = $results->concat($guru);
        }

        if (in_array($role, ['siswa_sd', 'siswa_smp', 'guru', 'admin'])) {
            $tugas = Tugas::where('judul', 'like', "%{$q}%")->limit(5)->get()->map(function($t) {
                return ['type' => 'Tugas', 'label' => $t->judul, 'url' => '#'];
            });
            $results = $results->concat($tugas);
        }

        return response()->json($results->take(10)->values());
    }
}
