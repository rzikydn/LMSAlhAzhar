<?php

namespace App\Http\Controllers;

use App\Models\CbtExam;
use App\Models\CbtSoal;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Http\Request;

class GuruCbtController extends Controller
{
    public function index(Request $request)
    {
        $guru = $request->user()->guru;
        $exams = CbtExam::where('guru_id', $guru->id)->with('mapel', 'kelas')->latest()->get();
        return view('dashboard.guru-sections.cbt-index', compact('exams', 'guru'));
    }

    public function create(Request $request)
    {
        $guru = $request->user()->guru;
        $mapels = Mapel::all();
        $kelasList = Kelas::all();
        return view('dashboard.guru-sections.cbt-form', compact('mapels', 'kelasList', 'guru'));
    }

    public function store(Request $request)
    {
        $guru = $request->user()->guru;
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:ulangan,uts,uas',
            'deskripsi' => 'nullable|string',
            'mapel_id' => 'required|exists:mapel,id',
            'kelas_id' => 'nullable|exists:kelas,id',
            'durasi' => 'required|integer|min:1|max:300',
        ]);

        $data['guru_id'] = $guru->id;
        $data['status'] = 'draft';
        $data['jumlah_soal'] = 0;

        $exam = CbtExam::create($data);

        return redirect()->route('guru.cbt.add-soal', $exam->id)->with('success', 'Ujian dibuat, silakan tambah soal');
    }

    public function addSoal(Request $request, CbtExam $cbtExam)
    {
        $guru = $request->user()->guru;
        $soals = $cbtExam->soals()->orderBy('nomor')->get();
        return view('dashboard.guru-sections.cbt-add-soal', compact('cbtExam', 'soals', 'guru'));
    }

    public function storeSoal(Request $request, CbtExam $cbtExam)
    {
        $data = $request->validate([
            'soal' => 'required|string',
            'tipe' => 'required|in:pg,essay',
            'pilihan_a' => 'required_if:tipe,pg|nullable|string',
            'pilihan_b' => 'required_if:tipe,pg|nullable|string',
            'pilihan_c' => 'required_if:tipe,pg|nullable|string',
            'pilihan_d' => 'required_if:tipe,pg|nullable|string',
            'jawaban_benar' => 'required_if:tipe,pg|nullable|string|in:a,b,c,d',
        ]);

        $nomorTerakhir = $cbtExam->soals()->max('nomor') ?? 0;

        CbtSoal::create([
            'cbt_exam_id' => $cbtExam->id,
            'nomor' => $nomorTerakhir + 1,
            'soal' => $data['soal'],
            'tipe' => $data['tipe'],
            'pilihan_a' => $data['pilihan_a'] ?? null,
            'pilihan_b' => $data['pilihan_b'] ?? null,
            'pilihan_c' => $data['pilihan_c'] ?? null,
            'pilihan_d' => $data['pilihan_d'] ?? null,
            'jawaban_benar' => $data['jawaban_benar'] ?? null,
        ]);

        $cbtExam->increment('jumlah_soal');

        return redirect()->back()->with('success', 'Soal berhasil ditambahkan!');
    }

    public function deleteSoal(CbtExam $cbtExam, CbtSoal $cbtSoal)
    {
        $cbtSoal->delete();
        $cbtExam->decrement('jumlah_soal');
        return redirect()->back()->with('success', 'Soal berhasil dihapus');
    }

    public function ajukan(CbtExam $cbtExam)
    {
        if ($cbtExam->jumlah_soal < 1) {
            return redirect()->back()->with('error', 'Minimal 1 soal untuk mengajukan');
        }
        $cbtExam->update(['status' => 'pending']);
        return redirect()->back()->with('active_tab', 'cbt')->with('success', 'Ujian diajukan ke admin untuk approval');
    }
}
