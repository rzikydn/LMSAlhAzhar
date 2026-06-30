<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';
    protected $fillable = [
        'judul', 'deskripsi', 'file_path', 'tipe', 'mapel_id', 'kelas_id', 'guru_id'
    ];

    public function mapel() { return $this->belongsTo(Mapel::class); }
    public function kelas() { return $this->belongsTo(Kelas::class); }
    public function guru() { return $this->belongsTo(Guru::class); }
}
