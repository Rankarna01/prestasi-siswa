@extends('layouts.app')

@section('title', 'Notifikasi Sistem')
@section('header_title', 'Notifikasi')
@section('header_subtitle', 'Informasi dan pengingat sistem terbaru')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
    
    <div class="p-5 border-b border-gray-50 flex justify-between items-center bg-white sticky top-0 z-10">
        <div class="flex gap-4">
            <h3 class="text-gray-800 font-medium">Semua Notifikasi</h3>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="bg-red-100 text-red-600 py-0.5 px-2.5 rounded-full text-xs font-bold">{{ auth()->user()->unreadNotifications->count() }} Baru</span>
            @endif
        </div>
        
        @if(auth()->user()->unreadNotifications->count() > 0)
        <form action="{{ route('admin.notifikasi.read-all') }}" method="POST">
            @csrf
            <button type="submit" class="text-sm text-primary hover:text-blue-700 font-medium transition-colors">
                <i class="fa-solid fa-check-double mr-1"></i> Tandai Semua Dibaca
            </button>
        </form>
        @endif
    </div>

    <div class="divide-y divide-gray-50">
        @forelse($notifikasis as $notif)
            @php 
                $isUnread = is_null($notif->read_at); 
                // Default fallback jika data belum diset dari Kepsek nanti
                $warna = $notif->data['warna'] ?? 'text-blue-500 bg-blue-50';
                $icon = $notif->data['icon'] ?? 'fa-solid fa-bell';
                $judul = $notif->data['judul'] ?? 'Notifikasi Baru';
                $pesan = $notif->data['pesan'] ?? 'Anda memiliki pembaruan sistem.';
            @endphp

            <div class="p-5 flex gap-4 transition-colors {{ $isUnread ? 'bg-blue-50/30' : 'hover:bg-gray-50' }}">
                
                <div class="w-12 h-12 rounded-full flex-shrink-0 flex items-center justify-center {{ $warna }} shadow-sm">
                    <i class="{{ $icon }} text-lg"></i>
                </div>
                
                <div class="flex-1">
                    <div class="flex justify-between items-start mb-1">
                        <h4 class="text-sm font-bold {{ $isUnread ? 'text-gray-900' : 'text-gray-700' }}">{{ $judul }}</h4>
                        <span class="text-[11px] text-gray-400 whitespace-nowrap"><i class="fa-regular fa-clock mr-1"></i>{{ $notif->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm {{ $isUnread ? 'text-gray-700' : 'text-gray-500' }} leading-relaxed">{{ $pesan }}</p>
                    
                    <div class="mt-3 flex gap-3">
                        @if($isUnread)
                            <form action="{{ route('admin.notifikasi.read', $notif->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-xs font-medium text-primary hover:underline">Tandai Dibaca</button>
                            </form>
                        @endif

                        @if(isset($notif->data['url']))
                            <a href="{{ $notif->data['url'] }}" class="text-xs font-medium text-gray-500 hover:text-gray-800 underline">Lihat Detail</a>
                        @endif
                    </div>
                </div>

                <div class="pl-2">
                    <form action="{{ route('admin.notifikasi.destroy', $notif->id) }}" method="POST" class="delete-form">
                        @csrf @method('DELETE')
                        <button type="button" class="text-gray-300 hover:text-red-500 transition-colors btn-delete" title="Hapus Notifikasi">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-12 text-center flex flex-col items-center justify-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-regular fa-bell-slash text-3xl text-gray-300"></i>
                </div>
                <h4 class="text-gray-800 font-medium mb-1">Belum ada notifikasi</h4>
                <p class="text-sm text-gray-500">Anda akan melihat pembaruan sistem di sini.</p>
            </div>
        @endforelse
    </div>
    
    @if($notifikasis->hasPages())
    <div class="p-5 border-t border-gray-50 bg-gray-50">
        {{ $notifikasis->links() }}
    </div>
    @endif
</div>

<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            Swal.fire({
                title: 'Hapus Notifikasi?',
                text: "Notifikasi ini akan dihapus dari riwayat Anda.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#9ca3af',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) this.closest('form').submit();
            });
        });
    });
</script>
@endsection