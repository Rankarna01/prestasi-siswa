<?php
namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung statistik untuk Kepsek
        $stats = [
            'total' => Prestasi::count(),
            'pending' => Prestasi::where('status', 'pending')->count(),
            'disetujui' => Prestasi::where('status', 'disetujui')->count(),
            'ditolak' => Prestasi::where('status', 'ditolak')->count(),
        ];

        // Ambil data terbaru yang butuh verifikasi (Pending)
        $prestasiPending = Prestasi::with(['siswa', 'kategori', 'tingkat'])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('kepsek.dashboard.index', compact('stats', 'prestasiPending'));
    }
}
