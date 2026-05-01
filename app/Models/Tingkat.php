<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
    protected $table = 'tingkat';
    protected $fillable = ['nama_tingkat'];

    // Relasi ke prestasi (nanti dibuat)
    // public function prestasi() { return $this->hasMany(Prestasi::class); }
}
