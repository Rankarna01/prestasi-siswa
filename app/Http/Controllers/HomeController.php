<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\TahunAjaran;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $totalPrestasi = Prestasi::where('status', 'disetujui')->count();
        $totalSiswa = Siswa::count();

        $tahunAjaran = TahunAjaran::orderBy('tahun', 'desc')->get();
       
        $unggulans = Prestasi::with(['siswa', 'kategori', 'tingkat'])
            ->where('status', 'disetujui')
            ->where('unggulan', true)
            ->latest('tanggal')
            ->take(5)
            ->get();

        $queryTimeline = Prestasi::with(['siswa.kelas', 'kategori', 'tingkat', 'tahunAjaran'])
            ->where('status', 'disetujui')
            ->where('unggulan', false);
            
        if ($request->filled('tahun_ajaran_id')) {
            $queryTimeline->where('tahun_ajaran_id', $request->tahun_ajaran_id);
        }

        $prestasi = $queryTimeline->latest('tanggal')->paginate(5)->withQueryString();

        return view('pengunjung.home.index', compact(
            'totalPrestasi', 'totalSiswa', 'tahunAjaran', 'unggulans', 'prestasi'
        ));
    }
}