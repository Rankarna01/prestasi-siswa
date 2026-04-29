<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    // Beritahu Laravel nama tabelnya secara eksplisit
    protected $table = 'tahun_ajaran';

    protected $fillable = ['tahun', 'status'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}