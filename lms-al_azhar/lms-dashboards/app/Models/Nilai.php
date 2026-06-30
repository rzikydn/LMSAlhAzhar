<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $fillable = [
        'siswa_id', 'tugas_id', 'mapel_id', 'nilai', 'catatan'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
}
