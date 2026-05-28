<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Models\Kategori;
use App\Models\Tingkat;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();
        $tingkat = Tingkat::orderBy('nama_tingkat')->get();
        $tahunAjaran = TahunAjaran::orderBy('tahun', 'desc')->get();
        $query = Prestasi::with(['siswa', 'kategori', 'tingkat', 'tahunAjaran']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lomba', 'like', "%{$search}%")
                  ->orWhereHas('siswa', function($qSiswa) use ($search) {
                      $qSiswa->where('nama', 'like', "%{$search}%")
                             ->orWhere('nisn', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }
        if ($request->filled('tingkat_id')) {
            $query->where('tingkat_id', $request->tingkat_id);
        }
        if ($request->filled('tahun_ajaran_id')) {
            $query->where('tahun_ajaran_id', $request->tahun_ajaran_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

       
        $prestasi = $query->latest()->paginate(10)->withQueryString();

        return view('kepsek.prestasi.index', compact('prestasi', 'kategori', 'tingkat', 'tahunAjaran'));
    }
}
