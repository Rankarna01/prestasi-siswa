<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data Dummy Kartu Ringkasan
        $stats = [
            'total' => 1256,
            'disetujui' => 876,
            'pending' => 245,
            'ditolak' => 135,
        ];

        // 2. Data Dummy Grafik Line (Tren per Tahun)
        $chartTahunan = [
            'labels' => ['2020/2021', '2021/2022', '2022/2023', '2023/2024', '2024/2025'],
            'data' => [150, 220, 310, 420, 500] // Semakin naik sesuai gambar
        ];

        // 3. Data Dummy Chart Doughnut (Kategori)
        $chartKategori = [
            'labels' => ['Akademik', 'Seni & Budaya', 'Olahraga', 'Sains & Teknologi', 'Lainnya'],
            'data' => [439, 314, 251, 188, 64]
        ];

        // 4. Data Dummy Notifikasi Terbaru
        $notifikasiTerbaru = [
            [
                'tipe' => 'ditolak',
                'judul' => 'Data prestasi ditolak',
                'pesan' => 'Data prestasi atas nama Budi Santoso ditolak oleh Kepala Sekolah.',
                'waktu' => '10 menit lalu',
                'icon' => 'fa-solid fa-triangle-exclamation',
                'color' => 'text-red-500',
                'bg' => 'bg-red-50'
            ],
            [
                'tipe' => 'pending',
                'judul' => 'Data baru menunggu verifikasi',
                'pesan' => '5 data prestasi baru menunggu verifikasi.',
                'waktu' => '1 jam lalu',
                'icon' => 'fa-solid fa-clock',
                'color' => 'text-yellow-500',
                'bg' => 'bg-yellow-50'
            ],
            [
                'tipe' => 'sistem',
                'judul' => 'Update sistem',
                'pesan' => 'Sistem telah diperbarui ke versi 2.1.0',
                'waktu' => '2 jam lalu',
                'icon' => 'fa-solid fa-gear',
                'color' => 'text-blue-500',
                'bg' => 'bg-blue-50'
            ]
        ];

        return view('admin.dashboard.index', compact('stats', 'chartTahunan', 'chartKategori', 'notifikasiTerbaru'));
    }
}
