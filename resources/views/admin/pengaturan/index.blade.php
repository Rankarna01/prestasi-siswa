@extends('layouts.app')

@section('title', 'Pengaturan Website - Admin')
@section('header_title', 'Pengaturan Website')
@section('header_subtitle', 'Kelola identitas sekolah dan tampilan halaman pengunjung')

@section('content')
<form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-5xl pb-10">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Kolom Kiri: Info & Sosmed -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Card 1: Informasi Umum -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/50 flex items-center gap-2">
                    <i class="fa-solid fa-building text-primary"></i>
                    <h3 class="font-semibold text-gray-800">Informasi Sekolah</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah', $pengaturan->nama_sekolah) }}" required class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-primary outline-none transition-all">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Sekolah</label>
                            <input type="email" name="email" value="{{ old('email', $pengaturan->email) }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-primary outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <input type="text" name="telepon" value="{{ old('telepon', $pengaturan->telepon) }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-primary outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-primary outline-none transition-all">{{ old('alamat', $pengaturan->alamat) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Card 2: Media Sosial -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/50 flex items-center gap-2">
                    <i class="fa-solid fa-hashtag text-primary"></i>
                    <h3 class="font-semibold text-gray-800">Tautan Media Sosial</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase"><i class="fa-brands fa-instagram mr-1 text-pink-600"></i> Instagram URL</label>
                        <input type="url" name="instagram" value="{{ old('instagram', $pengaturan->instagram) }}" placeholder="https://instagram.com/..." class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-primary outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase"><i class="fa-brands fa-facebook mr-1 text-blue-600"></i> Facebook URL</label>
                        <input type="url" name="facebook" value="{{ old('facebook', $pengaturan->facebook) }}" placeholder="https://facebook.com/..." class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-primary outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase"><i class="fa-brands fa-tiktok mr-1 text-black"></i> TikTok URL</label>
                        <input type="url" name="tiktok" value="{{ old('tiktok', $pengaturan->tiktok) }}" placeholder="https://tiktok.com/@..." class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-primary outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase"><i class="fa-brands fa-youtube mr-1 text-red-600"></i> YouTube URL</label>
                        <input type="url" name="youtube" value="{{ old('youtube', $pengaturan->youtube) }}" placeholder="https://youtube.com/..." class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-primary outline-none">
                    </div>
                </div>
            </div>

        </div>

        <!-- Kolom Kanan: Gambar & Logo -->
        <div class="lg:col-span-1 space-y-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/50 flex items-center gap-2">
                    <i class="fa-solid fa-image text-primary"></i>
                    <h3 class="font-semibold text-gray-800">Aset Visual</h3>
                </div>
                
                <div class="p-6 space-y-6">
                    <!-- Upload Logo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Logo Sekolah</label>
                        <div class="mb-3 w-24 h-24 rounded-lg border border-gray-200 p-2 flex items-center justify-center bg-gray-50">
                            @if($pengaturan->logo)
                                <img src="{{ asset('storage/pengaturan/' . $pengaturan->logo) }}" class="max-w-full max-h-full object-contain">
                            @else
                                <i class="fa-solid fa-school text-3xl text-gray-300"></i>
                            @endif
                        </div>
                        <input type="file" name="logo" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-primary hover:file:bg-blue-100">
                        <p class="text-[10px] text-gray-400 mt-1">Format: JPG, PNG. Maks: 2MB.</p>
                    </div>

                    <hr class="border-gray-100">

                    <!-- Upload Hero Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Hero (Beranda)</label>
                        <div class="mb-3 w-full aspect-video rounded-lg border border-gray-200 flex items-center justify-center bg-gray-50 overflow-hidden">
                            @if($pengaturan->hero_image)
                                <img src="{{ asset('storage/pengaturan/' . $pengaturan->hero_image) }}" class="w-full h-full object-cover">
                            @else
                                <i class="fa-solid fa-image text-3xl text-gray-300"></i>
                            @endif
                        </div>
                        <input type="file" name="hero_image" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-primary hover:file:bg-blue-100">
                        <p class="text-[10px] text-gray-400 mt-1">Rasio disarankan 4:3 atau 16:9. Maks: 5MB.</p>
                    </div>
                </div>
            </div>

            <!-- Tombol Simpan -->
            <button type="submit" class="w-full py-3.5 bg-primary hover:bg-blue-600 text-white font-bold rounded-xl shadow-md shadow-blue-500/20 transition-all flex items-center justify-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Pengaturan
            </button>

        </div>
    </div>
</form>
@endsection