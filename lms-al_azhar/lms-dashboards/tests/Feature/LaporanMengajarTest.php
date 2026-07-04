<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Guru;
use App\Models\LaporanMengajar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaporanMengajarTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_guru_can_submit_and_update_teaching_reports()
    {
        $guruUser = User::where('role', 'guru')->first();
        $guru = Guru::where('user_id', $guruUser->id)->first();

        // 1. Submit daily report
        $response1 = $this
            ->actingAs($guruUser)
            ->post('/guru/laporan', [
                'tipe' => 'harian',
                'tanggal' => '2026-07-04',
                'isi' => 'Kendala hari ini: Proyektor mati di kelas 9A.',
            ]);

        $response1->assertRedirect();
        $this->assertDatabaseHas('laporan_mengajars', [
            'guru_id' => $guru->id,
            'tipe' => 'harian',
            'tanggal' => '2026-07-04',
            'isi' => 'Kendala hari ini: Proyektor mati di kelas 9A.',
        ]);

        // 2. Update the same daily report (same date and type)
        $response2 = $this
            ->actingAs($guruUser)
            ->post('/guru/laporan', [
                'tipe' => 'harian',
                'tanggal' => '2026-07-04',
                'isi' => 'Kendala hari ini: Proyektor mati di kelas 9A dan ada 2 siswa izin.',
            ]);

        $response2->assertRedirect();
        // Assert it was updated, not duplicated
        $this->assertEquals(1, LaporanMengajar::where('guru_id', $guru->id)->where('tipe', 'harian')->count());
        $this->assertDatabaseHas('laporan_mengajars', [
            'guru_id' => $guru->id,
            'tipe' => 'harian',
            'tanggal' => '2026-07-04',
            'isi' => 'Kendala hari ini: Proyektor mati di kelas 9A dan ada 2 siswa izin.',
        ]);

        // 3. Submit weekly and monthly reports
        $this->actingAs($guruUser)->post('/guru/laporan', [
            'tipe' => 'mingguan',
            'tanggal' => '2026-07-04',
            'isi' => 'Progres materi minggu ini: Menyelesaikan Bab 3 SPLDV.',
        ]);

        $this->actingAs($guruUser)->post('/guru/laporan', [
            'tipe' => 'bulanan',
            'tanggal' => '2026-07-04',
            'isi' => 'Progres keseluruhan bulan ini: Rata-rata pemahaman materi siswa baik.',
        ]);

        $this->assertDatabaseHas('laporan_mengajars', [
            'guru_id' => $guru->id,
            'tipe' => 'mingguan',
            'isi' => 'Progres materi minggu ini: Menyelesaikan Bab 3 SPLDV.',
        ]);
        $this->assertDatabaseHas('laporan_mengajars', [
            'guru_id' => $guru->id,
            'tipe' => 'bulanan',
            'isi' => 'Progres keseluruhan bulan ini: Rata-rata pemahaman materi siswa baik.',
        ]);
    }

    public function test_admin_can_view_teaching_report_status()
    {
        $adminUser = User::where('role', 'admin')->first();

        // Access dashboard as admin
        $response = $this
            ->actingAs($adminUser)
            ->get('/dashboard?tab=audit_guru');

        $response->assertOk();
        $response->assertViewHas('guruReportsData');
    }
}
