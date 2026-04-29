<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    // Ganti 'kelas' menjadi 'kelas_id'
    protected $fillable = ['nisn', 'nama', 'kelas_id', 'tahun_ajaran_id', 'status'];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    // Tambahkan relasi kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}