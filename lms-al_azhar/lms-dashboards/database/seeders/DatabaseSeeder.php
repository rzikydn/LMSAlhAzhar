<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\OrangTua;
use App\Models\Jadwal;
use App\Models\Tugas;
use App\Models\Nilai;
use App\Models\Kehadiran;
use App\Models\CatatanWali;
use App\Models\Badge;
use App\Models\SiswaBadge;
use App\Models\Workbook;
use App\Models\WorkbookSoal;
use App\Models\Spp;
use App\Models\Pembayaran;
use App\Models\LogAktivitas;
use App\Models\Pengaturan;
use App\Models\TahfidzSetoran;
use App\Models\Pengumuman;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // === KELAS ===
        $kelasData = ['1A', '4B', '7A', '7B', '8A', '8B', '9A', '9B'];
        $kelasIds = [];
        foreach ($kelasData as $nk) {
            $kelasIds[$nk] = Kelas::firstOrCreate(
                ['nama_kelas' => $nk],
                ['jenjang' => in_array($nk, ['1A', '4B', '7A', '7B']) ? 'SD' : 'SMP']
            )->id;
        }

        // === MAPEL ===
        $mapelList = [
            'Tahfidz Qur\'an' => 'TAH',
            'Pendidikan Agama Islam' => 'PAI',
            'Matematika' => 'MTK',
            'Bahasa Indonesia' => 'B.IND',
            'IPA' => 'IPA',
            'Bahasa Inggris' => 'ING',
            'IPS' => 'IPS',
            'SBK' => 'SBK',
            'PJOK' => 'PJOK',
            'Prakarya' => 'PRAK',
        ];
        $mapelIds = [];
        foreach ($mapelList as $nama => $kode) {
            $mapelIds[$kode] = Mapel::firstOrCreate(
                ['kode' => $kode],
                ['nama_mapel' => $nama]
            )->id;
        }

        // === USERS & GURU ===
        $guruData = [
            ['nama' => 'Ustadz Ahmad Fauzi', 'email' => 'ahmad.fauzi@alazharjayaindonesia.sch.id', 'nip' => '19870101', 'mapel' => 'PAI'],
            ['nama' => 'Bu Dewi Sartika',     'email' => 'dewi.sartika@alazharjayaindonesia.sch.id', 'nip' => '19900215', 'mapel' => 'MTK'],
            ['nama' => 'Ibu Siti Rahmawati',  'email' => 'siti.rahmawati@alazharjayaindonesia.sch.id', 'nip' => '19910520', 'mapel' => 'B.IND'],
            ['nama' => 'Pak Budi Santoso',    'email' => 'budi.santoso.guru@alazharjayaindonesia.sch.id', 'nip' => '19881210', 'mapel' => 'IPA'],
            ['nama' => 'Ms. Linda Wijaya',    'email' => 'linda.wijaya@alazharjayaindonesia.sch.id', 'nip' => '19920305', 'mapel' => 'ING'],
            ['nama' => 'Pak Dwi Hartono',     'email' => 'dwi.hartono@alazharjayaindonesia.sch.id', 'nip' => '19870712', 'mapel' => 'IPS'],
            ['nama' => 'Ustadz Hadi Prasetyo','email' => 'hadi.prasetyo@alazharjayaindonesia.sch.id', 'nip' => '19850520', 'mapel' => 'TAH'],
            ['nama' => 'Bu Fitri Handayani', 'email' => 'fitri.handayani@alazharjayaindonesia.sch.id', 'nip' => '19930815', 'mapel' => 'SBK'],
            ['nama' => 'Pak Agus Wijaya',    'email' => 'agus.wijaya@alazharjayaindonesia.sch.id', 'nip' => '19890120', 'mapel' => 'PJOK'],
            ['nama' => 'Bu Rina Marlina',    'email' => 'rina.marlina@alazharjayaindonesia.sch.id', 'nip' => '19941210', 'mapel' => 'PRAK'],
        ];
        $guruIds = [];
        foreach ($guruData as $gd) {
            $user = User::firstOrCreate(
                ['email' => $gd['email']],
                ['name' => $gd['nama'], 'password' => Hash::make('password123'), 'role' => 'guru']
            );
            $guruIds[$gd['mapel']] = Guru::firstOrCreate(
                ['nip' => $gd['nip']],
                ['user_id' => $user->id, 'nama' => $gd['nama'], 'mapel_id' => $mapelIds[$gd['mapel']]]
            )->id;
        }

        // === USERS & SISWA SD ===
        $siswaSD = [
            ['nama' => 'Ahmad Rizky', 'email' => 'ahmad.rizky@alazharjayaindonesia.sch.id', 'nis' => '2024001', 'kelas' => '7A', 'jk' => 'L'],
            ['nama' => 'Siti Aisyah',  'email' => 'siti.aisyah@alazharjayaindonesia.sch.id', 'nis' => '2024002', 'kelas' => '7A', 'jk' => 'P'],
            ['nama' => 'Budi Santoso', 'email' => 'budi.siswa@alazharjayaindonesia.sch.id', 'nis' => '2024003', 'kelas' => '7A', 'jk' => 'L'],
            ['nama' => 'Citra Dewi',   'email' => 'citra.dewi@alazharjayaindonesia.sch.id', 'nis' => '2024004', 'kelas' => '7A', 'jk' => 'P'],
        ];
        $siswaIds = [];
        foreach ($siswaSD as $sd) {
            $user = User::firstOrCreate(
                ['email' => $sd['email']],
                ['name' => $sd['nama'], 'password' => Hash::make('password123'), 'role' => 'siswa_sd']
            );
            $siswaIds[$sd['nis']] = Siswa::firstOrCreate(
                ['nis' => $sd['nis']],
                ['user_id' => $user->id, 'nama' => $sd['nama'], 'kelas_id' => $kelasIds[$sd['kelas']], 'jenis_kelamin' => $sd['jk']]
            )->id;
        }

        // === USER & SISWA SMP (nonaktif) ===
        $user = User::firstOrCreate(
            ['email' => 'doni.prasetyo@alazharjayaindonesia.sch.id'],
            ['name' => 'Doni Prasetyo', 'password' => Hash::make('password123'), 'role' => 'siswa_smp']
        );
        Siswa::firstOrCreate(
            ['nis' => '2023101'],
            ['user_id' => $user->id, 'nama' => 'Doni Prasetyo', 'kelas_id' => $kelasIds['8B'], 'jenis_kelamin' => 'L', 'status' => 'nonaktif']
        );

        // === USER & SISWA SMP (aktif - Kelas 9 untuk KTI) ===
        $userKti = User::firstOrCreate(
            ['email' => 'rian.hidayat@alazharjayaindonesia.sch.id'],
            ['name' => 'Rian Hidayat', 'password' => Hash::make('password123'), 'role' => 'siswa_smp']
        );
        Siswa::firstOrCreate(
            ['nis' => '2022001'],
            ['user_id' => $userKti->id, 'nama' => 'Rian Hidayat', 'kelas_id' => $kelasIds['9A'], 'jenis_kelamin' => 'L', 'status' => 'aktif']
        );


        // === USER & ORANG TUA ===
        $user = User::firstOrCreate(
            ['email' => 'sari.rohmah@email.com'],
            ['name' => 'Ibu Sari Rahmawati', 'password' => Hash::make('password123'), 'role' => 'orang_tua']
        );
        OrangTua::firstOrCreate(
            ['user_id' => $user->id],
            ['nama' => 'Ibu Sari Rahmawati']
        );

        // === USER: ADMIN ===
        User::firstOrCreate(
            ['email' => 'admin@alazharjayaindonesia.sch.id'],
            ['name' => 'Admin Sekolah', 'password' => Hash::make('password123'), 'role' => 'admin']
        );

        // === USER: KEPALA SEKOLAH ===
        User::firstOrCreate(
            ['email' => 'kepala@alazharjayaindonesia.sch.id'],
            ['name' => 'Kepala Sekolah', 'password' => Hash::make('password123'), 'role' => 'kepala_sekolah']
        );


        // === JADWAL (for SD kelas 7A) ===
        $hariMap = [
            'Senin' => [
                ['mapel' => 'TAH', 'start' => '06:30', 'end' => '07:30'],
                ['mapel' => 'MTK', 'start' => '07:30', 'end' => '08:30'],
                ['mapel' => 'B.IND', 'start' => '08:30', 'end' => '09:30'],
                ['mapel' => 'IPA', 'start' => '10:00', 'end' => '11:00'],
                ['mapel' => 'PAI', 'start' => '11:00', 'end' => '12:00'],
            ],
            'Selasa' => [
                ['mapel' => 'TAH', 'start' => '06:30', 'end' => '07:30'],
                ['mapel' => 'ING', 'start' => '07:30', 'end' => '08:30'],
                ['mapel' => 'MTK', 'start' => '08:30', 'end' => '09:30'],
                ['mapel' => 'IPS', 'start' => '10:00', 'end' => '11:00'],
                ['mapel' => 'SBK', 'start' => '11:00', 'end' => '12:00'],
            ],
            'Rabu' => [
                ['mapel' => 'TAH', 'start' => '06:30', 'end' => '07:30'],
                ['mapel' => 'IPA', 'start' => '07:30', 'end' => '08:30'],
                ['mapel' => 'B.IND', 'start' => '08:30', 'end' => '09:30'],
                ['mapel' => 'PAI', 'start' => '10:00', 'end' => '11:00'],
                ['mapel' => 'PJOK', 'start' => '11:00', 'end' => '12:00'],
            ],
            'Kamis' => [
                ['mapel' => 'TAH', 'start' => '06:30', 'end' => '07:30'],
                ['mapel' => 'MTK', 'start' => '07:30', 'end' => '08:30'],
                ['mapel' => 'ING', 'start' => '08:30', 'end' => '09:30'],
                ['mapel' => 'IPS', 'start' => '10:00', 'end' => '11:00'],
                ['mapel' => 'PRAK', 'start' => '11:00', 'end' => '12:00'],
            ],
            'Jumat' => [
                ['mapel' => 'TAH', 'start' => '06:30', 'end' => '07:30'],
                ['mapel' => 'PAI', 'start' => '07:30', 'end' => '08:30'],
                ['mapel' => 'B.IND', 'start' => '08:30', 'end' => '09:30'],
                ['mapel' => 'MTK', 'start' => '10:00', 'end' => '11:00'],
            ],
        ];
        foreach ($hariMap as $hari => $items) {
            foreach ($items as $item) {
                Jadwal::firstOrCreate(
                    ['kelas_id' => $kelasIds['7A'], 'mapel_id' => $mapelIds[$item['mapel']], 'hari' => $hari, 'jam_mulai' => $item['start']],
                    ['guru_id' => $guruIds[$item['mapel']], 'jam_selesai' => $item['end']]
                );
            }
        }

        // === TUGAS ===
        $tugasData = [
            ['judul' => 'Tugas Praktek Sholat', 'mapel' => 'PAI', 'tipe' => 'tugas', 'deadline' => '2026-04-02'],
            ['judul' => 'PR Persamaan Linear', 'mapel' => 'MTK', 'tipe' => 'tugas', 'deadline' => '2026-04-05'],
            ['judul' => 'Laporan Pengamatan', 'mapel' => 'IPA', 'tipe' => 'tugas', 'deadline' => '2026-04-10'],
            ['judul' => 'Esai Liburan', 'mapel' => 'B.IND', 'tipe' => 'tugas', 'deadline' => '2026-04-15'],
            ['judul' => 'Vocabulary Quiz', 'mapel' => 'ING', 'tipe' => 'tugas', 'deadline' => '2026-04-12'],
            ['judul' => 'Ulangan Harian Bab 4', 'mapel' => 'B.IND', 'tipe' => 'ulangan', 'deadline' => '2026-04-08'],
            ['judul' => 'UTS Genap', 'mapel' => 'IPA', 'tipe' => 'ulangan', 'deadline' => '2026-04-20'],
            ['judul' => 'Ulangan Harian Bab 3', 'mapel' => 'MTK', 'tipe' => 'ulangan', 'deadline' => '2026-03-15'],
        ];
        foreach ($tugasData as $td) {
            Tugas::firstOrCreate(
                ['judul' => $td['judul']],
                ['mapel_id' => $mapelIds[$td['mapel']], 'kelas_id' => $kelasIds['7A'], 'guru_id' => $guruIds[$td['mapel']], 'tipe' => $td['tipe'], 'tanggal_deadline' => $td['deadline']]
            );
        }

        // === NILAI for Ahmad Rizky ===
        $nilaiMap = [
            'TAH' => 80, 'PAI' => 92, 'MTK' => 85,
            'B.IND' => 88, 'IPA' => 90, 'ING' => 84, 'IPS' => 78,
        ];
        foreach ($nilaiMap as $kode => $n) {
            Nilai::firstOrCreate(
                ['siswa_id' => $siswaIds['2024001'], 'mapel_id' => $mapelIds[$kode]],
                ['nilai' => $n]
            );
        }

        // === KEHADIRAN ===
        $statusDistribution = [
            'hadir' => 90, 'sakit' => 3, 'izin' => 3, 'alpha' => 4,
        ];
        $date = Carbon::create(2026, 1, 5);
        $end = Carbon::create(2026, 5, 29);
        $attCount = ['hadir' => 0, 'sakit' => 0, 'izin' => 0, 'alpha' => 0];
        $totalDays = 0;
        while ($date->lte($end)) {
            if ($date->isWeekday()) {
                $totalDays++;
                $pick = 'hadir';
                $rand = rand(1, 100);
                $cum = 0;
                foreach ($statusDistribution as $s => $pct) {
                    $cum += $pct;
                    if ($rand <= $cum) { $pick = $s; break; }
                }
                Kehadiran::firstOrCreate(
                    ['siswa_id' => $siswaIds['2024001'], 'tanggal' => $date->format('Y-m-d')],
                    ['status' => $pick]
                );
                $attCount[$pick]++;
            }
            $date->addDay();
        }

        // === CATATAN WALI KELAS ===
        $catatanWaliData = [
            ['nis' => '2024001', 'catatan' => 'Ananda adalah siswa yang rajin dan memiliki semangat belajar tinggi. Tingkatkan lagi fokus pada mata pelajaran IPS agar nilai lebih maksimal.'],
            ['nis' => '2024002', 'catatan' => 'Ananda memiliki potensi besar di bidang agama. Pertahankan dan tingkatkan lagi hafalan Al-Qur\'an.'],
            ['nis' => '2024003', 'catatan' => 'Ananda aktif dalam kegiatan kelas, namun perlu lebih teliti dalam mengerjakan soal matematika.'],
            ['nis' => '2024004', 'catatan' => 'Ananda siswi yang kreatif dan disiplin. Terus kembangkan bakat di bidang seni dan olahraga.'],
        ];
        foreach ($catatanWaliData as $cd) {
            CatatanWali::firstOrCreate(
                ['siswa_id' => $siswaIds[$cd['nis']], 'semester' => 'Genap 2025/2026'],
                ['catatan' => $cd['catatan'], 'created_by' => $guruIds['PAI']]
            );
        }

        // === TAHFIDZ SETORAN ===
        $tahfidzData = [
            ['nis' => '2024001', 'surah' => 'An-Naba\'', 'ayat_mulai' => 1, 'ayat_selesai' => 10, 'jml' => 10, 'status' => 'baru', 'nilai' => 85],
            ['nis' => '2024001', 'surah' => 'An-Naba\'', 'ayat_mulai' => 11, 'ayat_selesai' => 20, 'jml' => 10, 'status' => 'baru', 'nilai' => 90],
            ['nis' => '2024001', 'surah' => 'An-Nazi\'at', 'ayat_mulai' => 1, 'ayat_selesai' => 15, 'jml' => 15, 'status' => 'baru', 'nilai' => 82],
            ['nis' => '2024001', 'surah' => 'An-Naba\'', 'ayat_mulai' => 1, 'ayat_selesai' => 10, 'jml' => 10, 'status' => 'murojaah', 'nilai' => 92],
            ['nis' => '2024002', 'surah' => 'An-Naba\'', 'ayat_mulai' => 1, 'ayat_selesai' => 8, 'jml' => 8, 'status' => 'baru', 'nilai' => 88],
        ];
        foreach ($tahfidzData as $td) {
            TahfidzSetoran::create([
                'siswa_id' => $siswaIds[$td['nis']],
                'guru_id' => $guruIds['TAH'],
                'tanggal' => '2026-03-' . str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT),
                'surah' => $td['surah'],
                'ayat_mulai' => $td['ayat_mulai'],
                'ayat_selesai' => $td['ayat_selesai'],
                'jumlah_ayat' => $td['jml'],
                'status' => $td['status'],
                'nilai' => $td['nilai'],
            ]);
        }

        // === PENGUMUMAN ===
        $pengumumanData = [
            ['judul' => 'Libur Hari Raya Nyepi', 'konten' => 'Sekolah libur pada tanggal 30 Maret 2026 dalam rangka Hari Raya Nyepi. Kegiatan belajar diliburkan satu hari penuh.', 'tanggal' => '2026-03-25'],
            ['judul' => 'Pesantren Kilat Ramadhan', 'konten' => 'Kegiatan pesantren kilat akan diadakan pada minggu kedua April. Harap persiapkan diri dan membawa perlengkapan ibadah.', 'tanggal' => '2026-03-20'],
            ['judul' => 'Pembagian Rapor Tengah Semester', 'konten' => 'Pembagian rapor akan dilaksanakan pada 5 April 2026 pukul 08.00 WIB di aula sekolah.', 'tanggal' => '2026-03-15'],
        ];
        $adminUser = User::where('role', 'admin')->first();
        foreach ($pengumumanData as $pd) {
            Pengumuman::firstOrCreate(
                ['judul' => $pd['judul']],
                ['konten' => $pd['konten'], 'created_by' => $adminUser->id, 'created_at' => $pd['tanggal'], 'updated_at' => $pd['tanggal']]
            );
        }

        // === PESAN ===
        $guruUser = User::where('email', 'dewi.sartika@alazharjayaindonesia.sch.id')->first();
        $ahmadUser = User::where('email', 'ahmad.rizky@alazharjayaindonesia.sch.id')->first();
        if ($guruUser && $ahmadUser) {
            Pesan::firstOrCreate(
                ['pengirim_id' => $guruUser->id, 'penerima_id' => $ahmadUser->id, 'subjek' => 'PR Matematika'],
                ['isi' => 'Jangan lupa kumpulkan PR besok!']
            );
            Pesan::firstOrCreate(
                ['pengirim_id' => $guruUser->id, 'penerima_id' => $ahmadUser->id, 'subjek' => 'Pesantren Kilat'],
                ['isi' => 'Informasi jadwal pesantren kilat...']
            );
        }

        // === BADGES ===
        $badgeData = [
            ['nama' => 'Rajin Belajar', 'deskripsi' => 'Aktif 30 hari berturut-turut', 'icon' => '⭐'],
            ['nama' => 'Juara Quiz', 'deskripsi' => 'Nilai quiz di atas 90', 'icon' => '🎯'],
            ['nama' => 'Pembaca Aktif', 'deskripsi' => 'Baca 20 materi', 'icon' => '📖'],
            ['nama' => 'Streak 7 Hari', 'deskripsi' => 'Login 7 hari berturut-turut', 'icon' => '🏆'],
            ['nama' => 'Hafidz Cilik', 'deskripsi' => 'Hafal 1 juz Al-Qur\'an', 'icon' => '📿'],
            ['nama' => 'Disiplin', 'deskripsi' => 'Tidak pernah terlambat 1 bulan', 'icon' => '⏰'],
        ];
        $badgeIds = [];
        foreach ($badgeData as $bd) {
            $badgeIds[$bd['nama']] = Badge::firstOrCreate(
                ['nama' => $bd['nama']],
                ['deskripsi' => $bd['deskripsi'], 'icon' => $bd['icon']]
            )->id;
        }

        // === SISWA BADGE ===
        SiswaBadge::firstOrCreate(
            ['siswa_id' => $siswaIds['2024001'], 'badge_id' => $badgeIds['Rajin Belajar']]
        );
        SiswaBadge::firstOrCreate(
            ['siswa_id' => $siswaIds['2024001'], 'badge_id' => $badgeIds['Juara Quiz']]
        );
        SiswaBadge::firstOrCreate(
            ['siswa_id' => $siswaIds['2024001'], 'badge_id' => $badgeIds['Hafidz Cilik']]
        );
        SiswaBadge::firstOrCreate(
            ['siswa_id' => $siswaIds['2024002'], 'badge_id' => $badgeIds['Rajin Belajar']]
        );

        // === WORKBOOKS ===
        $workbookIds = [];
        $wbData = [
            ['judul' => 'Latihan Soal Matematika Bab 5', 'mapel' => 'MTK', 'tipe' => 'latihan', 'soals' => [
                ['soal' => 'Berapakah hasil dari 25 × 4?', 'a' => '80', 'b' => '100', 'c' => '120', 'd' => '90', 'benar' => 'b', 'bobot' => 1],
                ['soal' => 'Sebutkan rumus luas persegi panjang!', 'tipe' => 'essay', 'bobot' => 2],
            ]],
            ['judul' => 'PR Bahasa Indonesia', 'mapel' => 'B.IND', 'tipe' => 'pr', 'soals' => [
                ['soal' => 'Apa sinonim dari kata "rajin"?', 'a' => 'Malas', 'b' => 'Tekun', 'c' => 'Cepat', 'd' => 'Lambat', 'benar' => 'b', 'bobot' => 1],
            ]],
        ];
        foreach ($wbData as $wb) {
            $wbModel = Workbook::firstOrCreate(
                ['judul' => $wb['judul']],
                ['mapel_id' => $mapelIds[$wb['mapel']], 'kelas_id' => $kelasIds['7A'], 'guru_id' => $guruIds[$wb['mapel']], 'tipe' => $wb['tipe']]
            );
            foreach ($wb['soals'] as $i => $s) {
                WorkbookSoal::firstOrCreate(
                    ['workbook_id' => $wbModel->id, 'nomor' => $i + 1],
                    [
                        'soal' => $s['soal'],
                        'tipe' => $s['tipe'] ?? 'pg',
                        'pilihan_a' => $s['a'] ?? null,
                        'pilihan_b' => $s['b'] ?? null,
                        'pilihan_c' => $s['c'] ?? null,
                        'pilihan_d' => $s['d'] ?? null,
                        'jawaban_benar' => $s['benar'] ?? null,
                        'bobot' => $s['bobot'] ?? 1,
                    ]
                );
            }
        }

        // === SPP & PEMBAYARAN ===
        $sppIds = [];
        $bulanSekarang = (int)now()->format('m');
        $tahunSekarang = (int)now()->format('Y');
        for ($b = 1; $b <= $bulanSekarang; $b++) {
            $spp = Spp::firstOrCreate(
                ['siswa_id' => $siswaIds['2024001'], 'bulan' => $b, 'tahun' => $tahunSekarang],
                ['jumlah' => 250000, 'tenggat' => "{$tahunSekarang}-" . str_pad($b, 2, '0', STR_PAD_LEFT) . '-10', 'status' => $b < $bulanSekarang ? 'lunas' : 'belum']
            );
            if ($b < $bulanSekarang) {
                Pembayaran::firstOrCreate(
                    ['spp_id' => $spp->id],
                    ['orang_tua_id' => 1, 'tanggal_bayar' => "{$tahunSekarang}-" . str_pad($b, 2, '0', STR_PAD_LEFT) . '-05', 'jumlah' => 250000, 'metode' => 'transfer', 'status' => 'confirmed']
                );
            }
        }

        // === LOG AKTIVITAS ===
        $logData = [
            ['user_id' => $adminUser->id, 'tipe' => 'User', 'deskripsi' => 'Login admin dashboard', 'created_at' => '2026-03-25 08:00:00'],
            ['user_id' => null, 'tipe' => 'Sistem', 'deskripsi' => 'Backup database otomatis', 'status' => 'sukses', 'created_at' => '2026-03-25 02:00:00'],
            ['user_id' => $adminUser->id, 'tipe' => 'Kelas', 'deskripsi' => 'Menambah kelas baru 1A', 'created_at' => '2026-03-24 10:30:00'],
            ['user_id' => $adminUser->id, 'tipe' => 'User', 'deskripsi' => 'Mendaftarkan siswa baru: Citra Dewi', 'created_at' => '2026-03-24 09:15:00'],
            ['user_id' => $guruUser->id, 'tipe' => 'Tugas', 'deskripsi' => 'Membuat tugas: PR Persamaan Linear', 'created_at' => '2026-03-23 14:00:00'],
            ['user_id' => $adminUser->id, 'tipe' => 'Laporan', 'deskripsi' => 'Generate laporan kehadiran bulan Maret', 'created_at' => '2026-03-22 11:00:00'],
        ];
        foreach ($logData as $ld) {
            LogAktivitas::firstOrCreate(
                ['deskripsi' => $ld['deskripsi']],
                [
                    'user_id' => $ld['user_id'],
                    'tipe' => $ld['tipe'],
                    'status' => $ld['status'] ?? null,
                    'created_at' => $ld['created_at'],
                    'updated_at' => $ld['created_at'],
                ]
            );
        }

        // === PENGATURAN ===
        $pengaturanData = [
            ['key' => 'nama_sekolah', 'value' => 'SDIT/SMPIT Al Azhar Jaya Indonesia'],
            ['key' => 'tahun_ajaran', 'value' => '2025/2026'],
            ['key' => 'semester', 'value' => 'Genap'],
            ['key' => 'alamat_sekolah', 'value' => 'Jl. Raya Cendana No. 123, Kota Tangerang Selatan, Banten'],
            ['key' => 'kkm_default', 'value' => '70'],
        ];
        foreach ($pengaturanData as $pd) {
            Pengaturan::firstOrCreate(
                ['key' => $pd['key']],
                ['value' => $pd['value']]
            );
        }

        $this->command->info('Database seeded successfully!');
    }
}
