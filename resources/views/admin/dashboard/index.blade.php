@extends('layouts.app')

@section('title', 'Dashboard - Admin Tata Usaha')
@section('header_title', 'Dashboard')
@section('header_subtitle', 'Ringkasan data prestasi siswa')

@section('content')
<div class="space-y-6 pb-8">
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-primary text-white rounded-xl p-5 shadow-sm relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-sm font-medium text-blue-100 mb-1">Total Prestasi</p>
                <h3 class="text-3xl font-bold mb-2">{{ number_format($stats['total'], 0, ',', '.') }}</h3>
                <p class="text-xs text-blue-200"><i class="fa-solid fa-arrow-trend-up mr-1"></i> +12% dari tahun lalu</p>
            </div>
            <i class="fa-solid fa-medal absolute -right-4 -bottom-4 text-7xl text-blue-600 opacity-50 z-0"></i>
        </div>

        <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Disetujui</p>
                <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $stats['disetujui'] }}</h3>
                <p class="text-xs text-gray-400">69.7%</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center text-green-500 text-xl">
                <i class="fa-solid fa-check-double"></i>
            </div>
        </div>

        <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Pending</p>
                <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $stats['pending'] }}</h3>
                <p class="text-xs text-gray-400">19.5%</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-yellow-50 flex items-center justify-center text-yellow-500 text-xl">
                <i class="fa-regular fa-clock"></i>
            </div>
        </div>

        <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Ditolak</p>
                <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $stats['ditolak'] }}</h3>
                <p class="text-xs text-gray-400">10.8%</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-red-500 text-xl">
                <i class="fa-regular fa-rectangle-xmark"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm lg:col-span-2">
            <h4 class="text-sm font-semibold text-gray-800 mb-4">Grafik Prestasi per Tahun</h4>
            <div class="h-64 w-full">
                <canvas id="lineChart"></canvas>
            </div>
        </div>

        <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm">
            <h4 class="text-sm font-semibold text-gray-800 mb-4">Prestasi Berdasarkan Kategori</h4>
            <div class="h-56 w-full relative flex items-center justify-center">
                <canvas id="doughnutChart"></canvas>
                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none mt-4">
                    <span class="text-xs text-gray-400">Total</span>
                    <span class="text-xl font-bold text-gray-800">{{ $stats['total'] }}</span>
                </div>
            </div>
            <div class="mt-4 space-y-2">
                @foreach(['Akademik' => ['bg-blue-500', 439], 'Seni & Budaya' => ['bg-indigo-500', 314], 'Olahraga' => ['bg-sky-400', 251]] as $label => $val)
                <div class="flex items-center justify-between text-xs">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full {{ $val[0] }}"></span>
                        <span class="text-gray-600">{{ $label }}</span>
                    </div>
                    <span class="text-gray-800 font-medium">{{ $val[1] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-100 rounded-xl shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-50 flex justify-between items-center">
            <h4 class="text-sm font-semibold text-gray-800">Notifikasi Terbaru</h4>
            <a href="#" class="text-xs text-primary hover:underline">Lihat Semua</a>
        </div>
        <div class="p-0">
            @foreach($notifikasiTerbaru as $notif)
            <div class="flex gap-4 p-5 border-b border-gray-50 last:border-0 hover:bg-gray-50 transition-colors">
                <div class="w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center {{ $notif['bg'] }} {{ $notif['color'] }}">
                    <i class="{{ $notif['icon'] }}"></i>
                </div>
                <div class="flex-1">
                    <h5 class="text-sm font-semibold text-gray-800">{{ $notif['judul'] }}</h5>
                    <p class="text-xs text-gray-500 mt-1">{{ $notif['pesan'] }}</p>
                </div>
                <span class="text-[11px] text-gray-400 whitespace-nowrap">{{ $notif['waktu'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Init Line Chart
        const ctxLine = document.getElementById('lineChart').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartTahunan['labels']) !!},
                datasets: [{
                    label: 'Total Prestasi',
                    data: {!! json_encode($chartTahunan['data']) !!},
                    borderColor: '#3b82f6', // primary color
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#3b82f6',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, border: {display: false}, grid: {color: '#f3f4f6'} },
                    x: { border: {display: false}, grid: {display: false} }
                }
            }
        });

        // Init Doughnut Chart
        const ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
        new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chartKategori['labels']) !!},
                datasets: [{
                    data: {!! json_encode($chartKategori['data']) !!},
                    backgroundColor: ['#3b82f6', '#6366f1', '#38bdf8', '#818cf8', '#e0e7ff'],
                    borderWidth: 0,
                    cutout: '75%' // Membuat lubang donat agak lebar
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } } // Kita pakai custom legend di HTML
            }
        });
    });
</script>
@endsection