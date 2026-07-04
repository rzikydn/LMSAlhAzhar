<?php

use App\Http\Controllers\GuruTahfidzController;
use App\Http\Controllers\GuruTugasController;
use App\Http\Controllers\GuruNilaiController;
use App\Http\Controllers\GuruAbsensiController;
use App\Http\Controllers\GuruCatatanController;
use App\Http\Controllers\SiswaKondisiKelasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/guru/tahfidz', [GuruTahfidzController::class, 'store'])->name('guru.tahfidz.store');
    Route::post('/guru/tahfidz/{tahfidzSetoran}/nilai-pembanding', [GuruTahfidzController::class, 'storePembanding'])->name('guru.tahfidz.store-pembanding');
    Route::post('/siswa/kondisi-kelas', [SiswaKondisiKelasController::class, 'store'])->name('siswa.kondisi-kelas.store');
    Route::post('/guru/tugas', [GuruTugasController::class, 'store'])->name('guru.tugas.store');
    Route::post('/guru/nilai', [GuruNilaiController::class, 'store'])->name('guru.nilai.store');
    Route::post('/guru/kti', [\App\Http\Controllers\GuruKtiController::class, 'store'])->name('guru.kti.store');
    Route::post('/guru/absensi', [GuruAbsensiController::class, 'store'])->name('guru.absensi.store');
    Route::post('/guru/catatan', [GuruCatatanController::class, 'store'])->name('guru.catatan.store');
    Route::get('/guru/export/nilai', [\App\Http\Controllers\ExportController::class, 'nilaiCsv'])->name('guru.export.nilai');
    Route::post('/guru/workbook', [\App\Http\Controllers\GuruWorkbookController::class, 'store'])->name('guru.workbook.store');
    Route::post('/guru/workbook/{workbook}/soal', [\App\Http\Controllers\GuruWorkbookController::class, 'storeSoal'])->name('guru.workbook.soal');
    Route::post('/guru/materi', [\App\Http\Controllers\GuruMateriController::class, 'store'])->name('guru.materi.store');
    Route::post('/ortu/bayar', [\App\Http\Controllers\OrtuBayarController::class, 'store'])->name('ortu.bayar.store');
    Route::post('/ortu/pesan', [\App\Http\Controllers\OrtuPesanController::class, 'store'])->name('ortu.pesan.store');
    Route::post('/siswa/pesan', [\App\Http\Controllers\SiswaPesanController::class, 'store'])->name('siswa.pesan.store');
    Route::post('/guru/pengumuman', [\App\Http\Controllers\GuruPengumumanController::class, 'store'])->name('guru.pengumuman.store');
    Route::post('/guru/kelas', [\App\Http\Controllers\GuruKelasController::class, 'store'])->name('guru.kelas.store');
    Route::post('/siswa/tugas/kumpul', [\App\Http\Controllers\SiswaTugasController::class, 'kumpul'])->name('siswa.tugas.kumpul');
    Route::post('/guru/nilai-tugas', [\App\Http\Controllers\NilaiTugasController::class, 'store'])->name('guru.nilai-tugas.store');
    Route::get('/rapor/pdf', [\App\Http\Controllers\RaporController::class, 'pdf'])->name('rapor.pdf');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Search
    Route::get('/search', [\App\Http\Controllers\SearchController::class, 'search'])->name('search');

    // Siswa Workbook
    Route::prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/workbook', [\App\Http\Controllers\SiswaWorkbookController::class, 'index'])->name('workbook.index');
        Route::get('/workbook/{workbook}/kerjakan', [\App\Http\Controllers\SiswaWorkbookController::class, 'kerjakan'])->name('workbook.kerjakan');
        Route::post('/workbook/{workbook}/submit', [\App\Http\Controllers\SiswaWorkbookController::class, 'submit'])->name('workbook.submit');
        Route::get('/workbook/{workbook}/hasil', [\App\Http\Controllers\SiswaWorkbookController::class, 'hasil'])->name('workbook.hasil');
    });

    // Guru CBT
    Route::prefix('guru/cbt')->name('guru.cbt.')->group(function () {
        Route::get('/', [\App\Http\Controllers\GuruCbtController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\GuruCbtController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\GuruCbtController::class, 'store'])->name('store');
        Route::get('/{cbtExam}/add-soal', [\App\Http\Controllers\GuruCbtController::class, 'addSoal'])->name('add-soal');
        Route::post('/{cbtExam}/soal', [\App\Http\Controllers\GuruCbtController::class, 'storeSoal'])->name('store-soal');
        Route::delete('/{cbtExam}/soal/{cbtSoal}', [\App\Http\Controllers\GuruCbtController::class, 'deleteSoal'])->name('delete-soal');
        Route::post('/{cbtExam}/ajukan', [\App\Http\Controllers\GuruCbtController::class, 'ajukan'])->name('ajukan');
    });

    // Admin CBT
    Route::prefix('admin/cbt')->name('admin.cbt.')->group(function () {
        Route::get('/', [\App\Http\Controllers\AdminCbtController::class, 'index'])->name('index');
        Route::post('/{cbtExam}/approve', [\App\Http\Controllers\AdminCbtController::class, 'approve'])->name('approve');
        Route::post('/{cbtExam}/reject', [\App\Http\Controllers\AdminCbtController::class, 'reject'])->name('reject');
    });

    // Siswa CBT
    Route::prefix('siswa/cbt')->name('siswa.cbt.')->group(function () {
        Route::get('/', [\App\Http\Controllers\SiswaCbtController::class, 'index'])->name('index');
        Route::get('/{cbtExam}/kerjakan', [\App\Http\Controllers\SiswaCbtController::class, 'kerjakan'])->name('kerjakan');
        Route::post('/{cbtExam}/submit', [\App\Http\Controllers\SiswaCbtController::class, 'submit'])->name('submit');
        Route::get('/{cbtExam}/hasil', [\App\Http\Controllers\SiswaCbtController::class, 'hasil'])->name('hasil');
    });
});

require __DIR__.'/auth.php';
