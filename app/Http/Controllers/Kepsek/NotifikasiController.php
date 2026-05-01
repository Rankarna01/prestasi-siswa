<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        // Mengambil seluruh notifikasi milik Kepala Sekolah
        $notifikasis = auth()->user()->notifications()->paginate(10);
        return view('kepsek.notifikasi.index', compact('notifikasis'));
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        
        // Arahkan ke URL detail data (biasanya halaman verifikasi) jika ada
        if (isset($notification->data['url'])) {
            return redirect($notification->data['url']);
        }

        return back();
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Semua pemberitahuan telah ditandai dibaca.');
    }

    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->delete();
        return back()->with('success', 'Pemberitahuan berhasil dihapus.');
    }
}
