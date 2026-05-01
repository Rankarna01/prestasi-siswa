@extends('layouts.app')

@section('title', 'Notifikasi - Kepala Sekolah')
@section('header_title', 'Notifikasi')
@section('header_subtitle', 'Pemberitahuan data masuk dan pembaruan sistem')

@section('content')
<div class="max-w-4xl bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-white sticky top-0 z-10">
        <div class="flex items-center gap-3">
            <h3 class="text-gray-800 font-bold">Pemberitahuan</h3>
            @php $unreadCount = auth()->user()->unreadNotifications->count(); @endphp
            @if($unreadCount > 0)
                <span class="bg-orange-100 text-orange-600 py-0.5 px-3 rounded-full text-[10px] font-black uppercase tracking-wider">{{ $unreadCount }} Baru</span>
            @endif
        </div>
        
        @if($unreadCount > 0)
        <form action="{{ route('kepsek.notifikasi.read-all') }}" method="POST">
            @csrf
            <button type="submit" class="text-xs font-bold text-primary hover:text-blue-700 transition-colors uppercase tracking-widest">
                Tandai Semua Dibaca
            </button>
        </form>
        @endif
    </div>

    <div class="divide-y divide-gray-50">
        @forelse($notifikasis as $notif)
            @php 
                $isUnread = is_null($notif->read_at); 
                $data = $notif->data;
            @endphp
            <div class="p-6 flex gap-5 transition-all {{ $isUnread ? 'bg-blue-50/20' : 'opacity-70 hover:opacity-100 hover:bg-gray-50' }}">
                <div class="w-12 h-12 rounded-2xl flex-shrink-0 flex items-center justify-center {{ $data['warna'] ?? 'bg-blue-50 text-blue-500' }} shadow-sm">
                    <i class="{{ $data['icon'] ?? 'fa-solid fa-bell' }} text-xl"></i>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-start">
                        <h4 class="text-sm font-bold {{ $isUnread ? 'text-gray-900' : 'text-gray-600' }} truncate pr-4">
                            {{ $data['judul'] ?? 'Pemberitahuan Baru' }}
                        </h4>
                        <span class="text-[10px] font-medium text-gray-400 whitespace-nowrap uppercase tracking-tighter">
                            {{ $notif->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <p class="text-sm mt-1 {{ $isUnread ? 'text-gray-700' : 'text-gray-500' }} leading-relaxed">
                        {{ $data['pesan'] ?? 'Ada informasi terbaru untuk Anda tinjau.' }}
                    </p>

                    <div class="mt-4 flex gap-4">
                        @if($isUnread)
                            <form action="{{ route('kepsek.notifikasi.read', $notif->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-[10px] font-black text-primary uppercase tracking-widest hover:underline">Baca Sekarang</button>
                            </form>
                        @endif
                        
                        @if(isset($data['url']))
                            <a href="{{ $data['url'] }}" class="text-[10px] font-black text-gray-400 hover:text-gray-800 uppercase tracking-widest underline decoration-gray-200">Lihat Detail</a>
                        @endif
                    </div>
                </div>

                <div class="flex-shrink-0">
                    <form action="{{ route('kepsek.notifikasi.destroy', $notif->id) }}" method="POST" class="form-delete">
                        @csrf @method('DELETE')
                        <button type="button" class="btn-delete text-gray-300 hover:text-red-500 transition-colors">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-20 text-center flex flex-col items-center justify-center">
                <div class="w-16 h-16 bg-gray-50 text-gray-200 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-solid fa-bell-slash text-2xl"></i>
                </div>
                <p class="text-gray-400 text-sm font-medium">Kotak masuk kosong. Tidak ada pemberitahuan baru.</p>
            </div>
        @endforelse
    </div>

    <div class="p-6 bg-gray-50/50 border-t border-gray-50">
        {{ $notifikasis->links() }}
    </div>
</div>

<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            Swal.fire({
                title: 'Hapus Notifikasi?',
                text: "Riwayat pemberitahuan ini akan dihapus permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) this.closest('form').submit();
            });
        });
    });
</script>
@endsection