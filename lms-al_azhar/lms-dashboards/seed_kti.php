<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Siswa;
use App\Models\NilaiKti;
use App\Models\KtiBimbingan;

$siswa = Siswa::where('nama', 'Rian Hidayat')->first();
if ($siswa) {
    // 1. Create/update KTI entry
    $kti = NilaiKti::updateOrCreate(
        ['siswa_id' => $siswa->id],
        [
            'judul_kti' => 'Pengaruh Gadget terhadap Konsentrasi Belajar Siswa SMP',
            'current_bab' => 'Bab 1',
            'nilai_proses' => 0,
            'nilai_tulisan' => 0,
            'nilai_sidang' => 0,
            'nilai_akhir' => 0,
        ]
    );

    // 2. Create pending bimbingan
    KtiBimbingan::updateOrCreate(
        ['siswa_id' => $siswa->id, 'bab' => 'Bab 1'],
        [
            'file_draft' => 'https://docs.google.com/document/d/1XyZ_example_docs_rian_hidayat',
            'catatan_siswa' => 'Ustadz, saya sudah menyelesaikan Bab 1 Latar Belakang dan Rumusan Masalah. Mohon bimbingan dan koreksinya.',
            'status' => 'pending',
            'catatan_guru' => null
        ]
    );
    echo "Seed KTI untuk Rian Hidayat Sukses!\n";
} else {
    echo "Siswa Rian Hidayat tidak ditemukan.\n";
}
