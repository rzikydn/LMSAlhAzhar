<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahfidzSetoran extends Model
{
    protected $table = 'tahfidz_setoran';
    protected $fillable = [
        'siswa_id', 'guru_id', 'tanggal', 'surah',
        'ayat_mulai', 'ayat_selesai', 'jumlah_ayat',
        'status', 'nilai', 'catatan_guru'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
