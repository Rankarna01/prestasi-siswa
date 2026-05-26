<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Kita kembali menggunakan Storage bawaan Laravel

class PengaturanController extends Controller
{
    public function index()
    {
        // Ambil data pertama, jika tidak ada, buat otomatis dengan id 1
        $pengaturan = Pengaturan::firstOrCreate(
            ['id' => 1],
            ['nama_sekolah' => 'SMP Negeri 1 Example']
        );

        return view('admin.pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $pengaturan = Pengaturan::findOrFail(1);

        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'email' => 'nullable|email',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'logo_kop' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'hero_image' => 'nullable|image|mimes:png,jpg,jpeg|max:5120',
        ]);

        $data = $request->except(['logo', 'hero_image', 'logo_kop', '_token', '_method']);

        // Handle Upload Logo
        if ($request->hasFile('logo')) {
            // Hapus logo lama dari disk public (storage/app/public/pengaturan)
            if ($pengaturan->logo && Storage::disk('public')->exists('pengaturan/' . $pengaturan->logo)) {
                Storage::disk('public')->delete('pengaturan/' . $pengaturan->logo);
            }
            
            $logoName = 'logo_' . time() . '.' . $request->logo->getClientOriginalExtension();
            // Simpan ke storage/app/public/pengaturan
            $request->logo->storeAs('pengaturan', $logoName, 'public'); 
            $data['logo'] = $logoName;
        }

        // Handle Upload Logo Kop
        if ($request->hasFile('logo_kop')) {
            if ($pengaturan->logo_kop && Storage::disk('public')->exists('pengaturan/' . $pengaturan->logo_kop)) {
                Storage::disk('public')->delete('pengaturan/' . $pengaturan->logo_kop);
            }
            
            $logoKopName = 'logo_kop_' . time() . '.' . $request->logo_kop->getClientOriginalExtension();
            $request->logo_kop->storeAs('pengaturan', $logoKopName, 'public');
            $data['logo_kop'] = $logoKopName;
        }

        // Handle Upload Hero Image
        if ($request->hasFile('hero_image')) {
            if ($pengaturan->hero_image && Storage::disk('public')->exists('pengaturan/' . $pengaturan->hero_image)) {
                Storage::disk('public')->delete('pengaturan/' . $pengaturan->hero_image);
            }
            
            $heroName = 'hero_' . time() . '.' . $request->hero_image->getClientOriginalExtension();
            $request->hero_image->storeAs('pengaturan', $heroName, 'public');
            $data['hero_image'] = $heroName;
        }

        $pengaturan->update($data);

        return back()->with('success', 'Pengaturan website berhasil diperbarui!');
    }
}