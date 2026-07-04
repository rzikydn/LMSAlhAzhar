<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\NilaiKti;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KtiGradingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed database for test environment
        $this->seed();
    }

    public function test_guru_can_grade_kti_specifically_for_class_9_students()
    {
        $guruUser = User::where('role', 'guru')->first(); // A teacher

        // Create a student in Class 9A
        $kelas9 = Kelas::where('nama_kelas', '9A')->first();
        $userSiswa9 = User::create([
            'name' => 'Rian Hidayat',
            'email' => 'rian.hidayat@alazharjayaindonesia.sch.id',
            'password' => bcrypt('password123'),
            'role' => 'siswa_smp'
        ]);
        $siswa9 = Siswa::create([
            'user_id' => $userSiswa9->id,
            'nama' => 'Rian Hidayat',
            'nis' => '2022001',
            'kelas_id' => $kelas9->id,
            'jenis_kelamin' => 'L',
            'status' => 'aktif'
        ]);

        // 1. Submit KTI grade from Guru
        $response = $this
            ->actingAs($guruUser)
            ->post('/guru/kti', [
                'siswa_id' => $siswa9->id,
                'judul_kti' => 'Pengaruh Gadget terhadap Konsentrasi Belajar',
                'nilai_proses' => 80.00,  // Bobot 30% -> 24.00
                'nilai_tulisan' => 90.00, // Bobot 40% -> 36.00
                'nilai_sidang' => 85.00,  // Bobot 30% -> 25.50
                'catatan' => 'Sangat bagus, pertahankan!',
            ]);

        $response->assertRedirect();

        // 2. Assert calculated weighted score in DB (24 + 36 + 25.5 = 85.50)
        $this->assertDatabaseHas('nilai_ktis', [
            'siswa_id' => $siswa9->id,
            'judul_kti' => 'Pengaruh Gadget terhadap Konsentrasi Belajar',
            'nilai_proses' => 80.00,
            'nilai_tulisan' => 90.00,
            'nilai_sidang' => 85.00,
            'nilai_akhir' => 85.50,
            'catatan' => 'Sangat bagus, pertahankan!',
        ]);

        // 3. Test Student Access (Class 9 gets access)
        $responseSiswa9 = $this
            ->actingAs($userSiswa9)
            ->get('/dashboard');

        $responseSiswa9->assertOk();
        $responseSiswa9->assertViewHas('isKelas9', true);
        $responseSiswa9->assertViewHas('nilaiKti');

        // 4. Test Student Access (Class 7 does NOT get access)
        $userSiswa7 = User::where('email', 'ahmad.rizky@alazharjayaindonesia.sch.id')->first();
        $responseSiswa7 = $this
            ->actingAs($userSiswa7)
            ->get('/dashboard');

        $responseSiswa7->assertOk();
        $responseSiswa7->assertViewHas('isKelas9', false);
        $responseSiswa7->assertViewHas('nilaiKti', null);
    }
}
