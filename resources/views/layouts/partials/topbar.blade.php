<header class="bg-white h-16 border-b border-gray-100 flex items-center justify-between px-6 shadow-sm z-10">
    <div>
        <h2 class="text-lg font-semibold text-gray-800">@yield('header_title', 'Dashboard')</h2>
        <p class="text-xs text-gray-500">@yield('header_subtitle', 'Ringkasan data prestasi siswa')</p>
    </div>

    <div class="flex items-center gap-6">
        <div class="flex flex-col items-end">
            <span class="text-[10px] text-gray-500 uppercase tracking-wider font-semibold">Tahun Ajaran Aktif</span>
            <select class="text-sm font-medium text-gray-800 bg-transparent border-none focus:ring-0 cursor-pointer outline-none">
                <option value="2024/2025">2024/2025</option>
                <option value="2023/2024">2023/2024</option>
            </select>
        </div>

        <div class="h-8 w-px bg-gray-200"></div>

        <a href="{{ route('admin.notifikasi.index') }}" class="relative text-gray-400 hover:text-primary transition-colors">
            <i class="fa-regular fa-bell text-xl"></i>
            
            @php $unreadCount = auth()->user()->unreadNotifications->count(); @endphp
            @if($unreadCount > 0)
                <span class="absolute -top-1.5 -right-2 bg-red-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white">
                    {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                </span>
            @endif
        </a>
    </div>
</header>